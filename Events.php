<?php

namespace humhub\modules\places;


use humhub\modules\places\models\Place;
use yii\base\Object;


class Events extends Object
{

    public function storeResidence($event)
    {
        $profile = $event->sender;
        $model = new Place();
        $model->created_by = $profile->user_id;

        $address = $profile->street . ' ' . $profile->city . ' ' . $profile->state;
        // url encode the address
        $address = urlencode($address);

        // google map geocode api url
        $url = "http://maps.google.com/maps/api/geocode/json?address={$address}";

        // get the json response
        $resp_json = file_get_contents($url);

        // decode the json
        $resp = json_decode($resp_json, true);

        // response status will be 'OK', if able to geocode given address
        if($resp['status']=='OK') {

            // get the important data
            $model->location = $resp['results'][0]['geometry']['location']['lng']. ',';
            $model->location .= $resp['results'][0]['geometry']['location']['lat'];


        }

        $model->name = 'Residence';
        $model->module_id = 'places';
        $model->category = 'User Residence';
        $model->validate();
        $model->errors;

        $model->save();
    }



}

