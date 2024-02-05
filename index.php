<?php
include_once('database.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Country, State, City Search</title>
  <link rel="stylesheet" href="./css/tailwind.min.css">
  <link rel="stylesheet" href="./css/style.css">
  <script src="./js/jquery.min.js"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">

  <div class="container mx-auto flex flex-wrap justify-around m-10">
    <div class="w-full md:w-1/3 lg:w-1/4">
      <div class="search-box">
        <div class="search-heading">Country</div>
        <form class="flex items-center">
          <div class="relative w-full">
            <input type="text" id="countrySearch" class="search-input" placeholder="Search Country..." required>
          </div>
        </form>
        <ul id="countryList" class="scroll-list border-2 border-[#605CEB] rounded-xl">
          <?php
          $countries = db::getRecords("SELECT * FROM countries");
          foreach ($countries as $country) {
            echo "<li data-id='{$country['id']}' class='country-item p-2'>{$country['name']}</li>";
          }
          ?>
        </ul>
      </div>
    </div>

    <div class="w-full md:w-1/3 lg:w-1/4">
      <div class="search-box">
        <div class="search-heading">State</div>
        <form class="flex items-center">
          <div class="relative w-full">
            <input type="text" id="stateSearch" class="search-input" placeholder="Search State..." required>
          </div>
        </form>
        <ul id="stateList" class="scroll-list border-2 border-[#605CEB] rounded-xl" disabled>
          <!-- States will be dynamically populated here using JavaScript -->
        </ul>
      </div>
    </div>

    <div class="w-full md:w-1/3 lg:w-1/4">
      <div class="search-box">
        <div class="search-heading">City</div>
        <form class="flex items-center">
          <div class="relative w-full">
            <input type="text" id="citySearch" class="search-input" placeholder="Search City..." required>
          </div>
        </form>
        <ul id="cityList" class="scroll-list border-2 border-[#605CEB] rounded-xl" disabled>
          <!-- Cities will be dynamically populated here using JavaScript -->
        </ul>
      </div>
    </div>
    <div id="weatherDetails" class="hidden w-full md:w-1/2 lg:w-1/3 bg-white p-6 rounded-lg shadow-md">
      <h2 class="text-3xl font-semibold mb-4 text-center text-gray-800">Weather Details</h2>
      <div id="weatherInfo" class="text-lg mb-4">
        <p id="temperature" class="mb-2"></p>
        <p id="description"></p>
      </div>
      <p id="weatherError" class="text-red-500 hidden mt-4 text-center">Failed to fetch weather details. Please try
        again later.</p>
    </div>

  </div>



  <script src="./js/script.js"></script>
  <script>
    $(document).ready(function () {
      $('#cityList').on('click', '.country-item', function () {
        var cityName = $(this).text().trim(); // Get the city name

        // Reset UI elements
        $('#temperature, #description, #weatherError').text('').addClass('hidden');
        $('#weatherDetails').removeClass('hidden');

        // AJAX call to get weather details by city name
        $.ajax({
          url: './ajax/getWeather.php',
          type: 'GET',
          data: { cityId: cityName },
          success: function (response) {
            try {
              // Log the entire JSON response
              console.log('JSON response:', response);

              // Try to parse JSON response
              var weatherDetails = JSON.parse(response);

              // Check if temperature and description are defined
              if (weatherDetails && weatherDetails.temperature !== undefined && weatherDetails.description !== undefined) {
                // Display weather details
                $('#temperature').text('Temperature: ' + weatherDetails.temperature);
                $('#description').text('Description: ' + weatherDetails.description);
                $('#temperature').removeClass('hidden');
                $('#description').removeClass('hidden');
              } else {
                console.log('Temperature or description is undefined in the JSON response:', weatherDetails);
                $('#weatherError').text('Invalid data in the JSON response. Please try again later.').removeClass('hidden');
              }
            } catch (error) {
              console.log('Error parsing JSON: ', error);
              $('#weatherError').text('Error parsing the JSON response. Please try again later.').removeClass('hidden');
            }
          },
          error: function (xhr, status, error) {
            console.log('AJAX error:', xhr.responseText, status, error);
            // Display error message on UI
            $('#weatherError').text('Failed to fetch weather details. Please try again later.').removeClass('hidden');
          }
        });
      });
    });
  </script>
</body>

</html>