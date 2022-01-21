<?php

class UkGovHygieneApi {
    private static $api_url = "https://ratings.food.gov.uk/search/%name/%town/json";

    /**
     * returnUrl
     *
     * @param String $name
     * @param String $town
     * @return String Return the URL needed to perform the API request.
     */
    private static function returnUrl($name, $town) {
        $url = str_replace("%name", $name, self::$api_url);
        $url = str_replace("%town", $town, $url);

        return $url;
    }

    /**
     * performFetch
     *
     * @param String $name
     * @param String $town
     * @return Object The API response. Typically JSON string.
     */
    private static function performFetch($name, $town) {
        $url = self::returnUrl($name, $town);
        $final_url = str_replace(' ', '%20', $url);

        $response = @file_get_contents($final_url);
        $response = @json_decode($response, true);

        return $response;
    }

    public static function get($name, $town) {
        return self::performFetch($name, $town);
    }
}

?>