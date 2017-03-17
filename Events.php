<?php

namespace humhub\modules\places;


use humhub\modules\places\libs\GeoLocation;
use humhub\modules\places\models\Place;
use humhub\modules\places\models\PlaceGps;
use humhub\modules\places\models\PlaceStatus;
use humhub\modules\places\models\PlaceType;
use yii\base\Object;
use yii\db\Expression;


class Events extends Object
{

    public function storeResidence($event)
    {
        $profile = $event->sender;
        $newPlace = new Place();
        $newPlace->created_by = $profile->user_id;
        $newPlace->name = $profile->lastname;
        $newPlace->module_id = 'places';
        $newPlace->type_id = PlaceType::find()->where(['name' => 'user residence'])->one()->id;
        $newPlace->status_id = PlaceStatus::find()->where(['type_id' => $newPlace->type_id])
            ->andWhere(['status' => 'active'])->one()->id;



        $address = $profile->street . ' ' . $profile->city . ' ' . $profile->state;

        $location = GeoLocation::getGeocodeFromGoogle($address);

        $address = $location->results[0]->formatted_address;
        $lat = $location->results[0]->geometry->location->lat;
        $lng = $location->results[0]->geometry->location->lng;
        $newPlace->google_place_id = $location->results[0]->place_id;
        $newPlace->validate();
        $newPlace->errors;
        $newPlace->save();

        $gps = new PlaceGps();
        $gps->place_id = $newPlace->id;
        $geoLocation = GeoLocation::fromDegrees($lat,$lng);
        $gps->gps = new Expression("GeomFromText('Point(".$geoLocation->getLatitudeInDegrees() . " ". $geoLocation->getLongitudeInDegrees().")')");
        $gps->validate();
        $gps->errors;
        $gps->save();




    }



}

