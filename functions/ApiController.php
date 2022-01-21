<?php

include('./apis/GoogleApi.php');
include('./apis/UkGovHygieneApi.php');

class ApiController {
    /**
     * init
     * 
     * Initialise the web application's data by calling this function.
     * Performs a basic request to gather data for the initial load or 
     * empty search.
     *
     * @param double $lat
     * @param double $long
     * @return Array An array comprised of establishment data, including ratings.
     */
    public static function init($lat, $long) {
        $response = GoogleApi::get($lat, $long, self::milesToMeters(1));
        $array = [];
        
        foreach($response as $key) {
            $name = $key['name'];
            
            $location = explode(', ', $key['location']);
            $town = array_pop($location);
            $rating = '';

            try {
                $ratingResponse = UkGovHygieneApi::get($name, $town);

                if (isset($ratingResponse['FHRSEstablishment']['EstablishmentCollection']['EstablishmentDetail']['RatingValue'])) {
                    $rating = $ratingResponse['FHRSEstablishment']['EstablishmentCollection']['EstablishmentDetail']['RatingValue'];

                    if ($rating == "AwaitingResponse") {
                        $rating = "Awaiting Response";
                    }
                }
                else {
                    $rating = 'Not Found';
                }
            }
            catch (Exception $e) {
                return $e;
            }

            $key['rating'] = $rating;
            array_push($array, $key);
        }

        return $array;
    }

    /**
     * get
     * 
     * Perform a more comprehensive search which allows the user to specify
     * the radius and name being used in the requests.
     *
     * @param double $lat
     * @param double $long
     * @param double $radius
     * @param String $name
     * @return Array An array comprised of establishment data, including ratings.
     */
    public static function get($lat, $long, $radius, $name) {
        $response = GoogleApi::getByName($lat, $long, self::milesToMeters($radius), $name);
        $array = [];
        
        foreach($response as $key) {
            $name = $key['name'];
            
            $location = explode(', ', $key['location']);
            $town = array_pop($location);
            $rating = '';

            try {
                $ratingResponse = UkGovHygieneApi::get($name, $town);

                if (isset($ratingResponse['FHRSEstablishment']['EstablishmentCollection']['EstablishmentDetail']['RatingValue'])) {
                    $rating = $ratingResponse['FHRSEstablishment']['EstablishmentCollection']['EstablishmentDetail']['RatingValue'];

                    if ($rating == "AwaitingResponse") {
                        $rating = "Awaiting Response";
                    }
                }
                else {
                    $rating = 'Not Found';
                }
            }
            catch (Exception $e) {
                return $e;
            }

            $key['rating'] = $rating;
            array_push($array, $key);
        }

        return $array;
    }

    private static function milesToMeters($miles) {
        return $miles * 1609.34;
    }
}

?>