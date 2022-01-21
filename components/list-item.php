<?php
    
    /**
     * drawListItem
     *
     * @param Array $data Array compiled from API responses.
     * @return void A formatted list item ready to be displayed on the web app.
     */
    function drawListItem($data) {
        echo "<div class='list-item'>";
            echo "<div class='row justify-content-md-center'>";
                echo "<div class='col-md-7'>";
                    echo "<h3>" . ucwords(strtolower($data['name'])) . "</h3>";
                echo "</div>";
                echo "<div class='col-md-5'>";
                    echo "<div class='ratings'>";
                        // 1 star
                        echo "<span class='fa fa-star";
                        if (intval($data['rating']) >= 1) echo " checked";
                        echo "'></span>";
                        // 2 star
                        echo "<span class='fa fa-star";
                        if (intval($data['rating']) >= 2) echo " checked";
                        echo "'></span>";
                        // 3 star
                        echo "<span class='fa fa-star";
                        if (intval($data['rating']) >= 3) echo " checked";
                        echo "'></span>";
                        // 4 star
                        echo "<span class='fa fa-star";
                        if (intval($data['rating']) >= 4) echo " checked";
                        echo "'></span>";
                        // 5 star
                        echo "<span class='fa fa-star";
                        if (intval($data['rating']) >= 5) echo " checked";
                        echo "'></span>";
                    echo "</div>";
                echo "</div>";
            echo "</div>";
            echo "<hr>";

            echo "<p class='services'>Services: ";
            foreach ($data['types'] as $type) {
                if (($type != 'point_of_interest') && ($type != 'establishment')) {
                    if ($type == 'meal_takeaway') {
                        echo "<span class='badge badge-info'>TAKEAWAY</span>";
                    }
                    else if ($type == 'meal_delivery') {
                        echo "<span class='badge badge-info'>DELIVERY</span>";
                    }
                    else {
                        echo "<span class='badge badge-info'>" . strtoupper($type) . "</span>";
                    }
                }
            }

            echo "</p>";

            echo "<p class='location'>Location: " . $data['location'];
                echo '<button class="btn btn-light map-open-btn" type="button" data-toggle="modal" data-target="#mapModal" data-name="' . ucwords(strtolower($data['name'])) . '" data-id="'. $data['id'] . '">Open Map</button>';
            echo "</p>";
        echo "</div>";
    }

    /**
     * drawEmptyItem
     *
     * @param String $message Message to be displayed within the empty block.
     * @return void
     */
    function drawEmptyItem($message) {
        echo "<div id='not-found' class='list-item'>";
            echo "<h3>$message</h3>";
        echo "</div>";
    }
?>