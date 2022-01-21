<?php

class GoogleApi {
    private static $api_key = "AIzaSyCkhC-xm4889UE2ERJ77vrArep25R6_m0A";
    private static $restaurant_lookup_url = "https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=%lat,%long&radius=%rad&type=restaurant&key=%key";
    private static $restaurant_name_lookup_url = "https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=%lat,%long&radius=%rad&type=restaurant&name=%name&key=%key";

    /**
     * returnUrl
     *
     * @param double $lat
     * @param double $long
     * @param double $radius
     * @return String URL required for the initial API request.
     */
    private static function returnUrl($lat, $long, $radius) {
        $url = str_replace("%lat", $lat, self::$restaurant_lookup_url);
        $url = str_replace("%long", $long, $url);
        $url = str_replace("%rad", $radius, $url);
        $url = str_replace("%key", self::$api_key, $url);

        return $url;
    }

    /**
     * returnUrlWithName
     *
     * @param double $lat
     * @param double $long
     * @param double $radius
     * @param String $name
     * @return String URL required for more complex API requests.
     */
    private static function returnUrlWithName($lat, $long, $radius, $name) {
        $url = str_replace("%lat", $lat, self::$restaurant_name_lookup_url);
        $url = str_replace("%long", $long, $url);
        $url = str_replace("%rad", $radius, $url);
        $url = str_replace("%name", $name, $url);
        $url = str_replace("%key", self::$api_key, $url);
        $url = str_replace(" ", "%20", $url);
        $url = str_replace("'", "%27", $url);

        return $url;
    }

    /**
     * performFetch
     *
     * @param double $lat
     * @param double $long
     * @param double $radius
     * @return Array An array containing the establishment's retrieved from the request.
     */
    private static function performFetch($lat, $long, $radius) {
        $url = self::returnUrl($lat, $long, $radius);

        $response = @file_get_contents($url);
        $response = @json_decode($response, true);

        $restaurants = [];

        foreach ($response['results'] as $key) {
           $item = array(
               "id" => $key['place_id'],
               "name" => $key['name'],
               "icon" => $key['icon'],
               "types" => $key['types'],
               "location" => $key['vicinity'],
               "pos" => $key['geometry']['location']
           );

           array_push($restaurants, $item);
        }

        return $restaurants;
    }

    /**
     * performFetchFromName
     *
     * @param double $lat
     * @param double $long
     * @param double $radius
     * @param String $name
     * @return Array An array containing the establishment's retrieved from the request.
     */
    private static function performFetchFromName($lat, $long, $radius, $name) {
        $url = self::returnUrlWithName($lat, $long, $radius, $name);

        $response = @file_get_contents($url);
        $response = @json_decode($response, true);

        $restaurants = [];

        foreach ($response['results'] as $key) {
           $item = array(
               "id" => $key['place_id'],
               "name" => $key['name'],
               "icon" => $key['icon'],
               "types" => $key['types'],
               "location" => $key['vicinity'],
               "pos" => $key['geometry']['location']
           );

           array_push($restaurants, $item);
        }

        return $restaurants;
    }

    public static function get($lat, $long, $radius) {
        return self::performFetch($lat, $long, $radius);
    }

    public static function getByName($lat, $long, $radius, $name) {
        return self::performFetchFromName($lat, $long, $radius, $name);
    }
}

?>