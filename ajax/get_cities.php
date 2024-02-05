<?php

include('../database.php');

$state_id = $_POST["state_id"];


$query = "SELECT * FROM cities WHERE state_id = $state_id";
$cities = db::getRecords($query);

if ($cities != NULL) {
    foreach ($cities as $city) {
        echo "<li data-id='{$city['id']}' class='country-item p-2 cursor-pointer hover:bg-[#605CEB] hover:bg-opacity-20 transition-colors'>{$city['name']}</li>";
    }
} else {
    echo "<option>No City found</option>";
}

