<?php
include('../database.php');

$countryId = $_POST["country_id"];


$query = "SELECT * FROM states WHERE country_id = $countryId";
$states = db::getRecords($query);

if ($states != NULL) {
    foreach ($states as $state) {
        echo "<li data-id='{$state['id']}' class='country-item p-2 cursor-pointer hover:bg-[#605CEB] hover:bg-opacity-20 transition-colors'>{$state['name']}</li>";
    }
} else {
    echo "<option>No States found</option>";
}

