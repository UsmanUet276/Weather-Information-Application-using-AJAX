<?php
// Check if the request method is GET and if cityName is set
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['cityId'])) {
    // Get the city name from the GET parameters
    $cityName = $_GET['cityId'];

   
    $apiEndpoint = 'https://api.weatherapi.com/v1/current.json';
    $apiKey = 'fb719b54295d4b91b56190036240302'; 

    // Construct the API URL
    $apiUrl = "{$apiEndpoint}?key={$apiKey}&q={$cityName}";

    // Initialize cURL session
    $curl = curl_init($apiUrl);

    // Set cURL options for better handling and security
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_FAILONERROR, true);

    // Perform the API request and capture the response
    $response = curl_exec($curl);

    // Check for cURL errors
    if (curl_errno($curl)) {
        $errorResponse = ['error' => 'cURL error: ' . curl_error($curl)];
        echo json_encode($errorResponse);
        // Close cURL session and exit
        curl_close($curl);
        exit;
    }

    // Get HTTP status code
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    // Close cURL session
    curl_close($curl);

    // Check if the request was successful (HTTP status code 200)
    if ($httpCode == 200) {
        // Decode the JSON response
        $weatherData = json_decode($response, true);

        // Check if the JSON decoding was successful
        if (json_last_error() == JSON_ERROR_NONE) {
            // Extract relevant weather details
            $temperature = $weatherData['current']['temp_c'];
            $description = $weatherData['current']['condition']['text'];

            // Prepare the response as JSON
            $weatherDetails = [
                'temperature' => $temperature,
                'description' => $description
            ];

            echo json_encode($weatherDetails);
        } else {
            // If JSON decoding fails, return an error response
            $errorResponse = ['error' => 'Failed to decode JSON response'];
            echo json_encode($errorResponse);
        }
    } else {
        // If the API request fails, return an error response with the HTTP status code
        $errorResponse = ['error' => "Failed to fetch weather details. HTTP Status Code: $httpCode"];
        echo json_encode($errorResponse);
    }
} else {
    // If the request method is not GET or cityName is not set, return an error response
    $errorResponse = ['error' => 'Invalid request'];
    echo json_encode($errorResponse);
}
?>
