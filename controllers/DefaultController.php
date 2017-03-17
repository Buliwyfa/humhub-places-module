<?php

namespace humhub\modules\places\controllers;

use humhub\components\Controller;
use humhub\modules\places\libs\GeoLocation;

/**
 * DefaultController implements the CRUD actions for Place model.
 */
class DefaultController extends Controller
{

    /**
     * @param $address string with spaces between everything.
     * @return null|string in the form (lng lat)
     */
    public static function getLocation($address)
    {
        $location = GeoLocation::getGeocodeFromGoogle($address);
    }
}
