<?php

include('./ApiController.php');
include('./../components/list-item.php');

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'init') {
        $data = ApiController::init($_POST['lat'], $_POST['long']);

        if (!isset($data) || empty($data)) {
            drawEmptyItem("No Restaurants Found");
        }
        else {
            loadItems($data);
        }
    }

    if ($_POST['action'] == 'search') {
        $data = ApiController::get($_POST['lat'], $_POST['long'], $_POST['radius'], $_POST['terms']);

        if (!isset($data) || empty($data)) {
            drawEmptyItem("No Restaurants Found");
        }
        else {
            loadItems($data);
        }
    }
}

function loadItems($data) {
    foreach($data as $key) {
        drawListItem($key);
    }
}

?>