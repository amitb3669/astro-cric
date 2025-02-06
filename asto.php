<?php

$allowed_domain = "https://amitb3669.github.io/astro-cric/play/web.php";


    header("Access-Control-Allow-Origin: $allowed_domain");


// Get the request URI and extract the mpd link
$requestUri = $_SERVER['REQUEST_URI'];
$basePath = '/asto.php/';
$mpdLink = str_replace($basePath, '', $requestUri);

// Ensure the mpd link is valid
if (empty($mpdLink)) {
    echo "Error: No MPD link provided.";
    exit;
}

// Construct the full MPD URL
$mpdUrl = urldecode($mpdLink); // Decode the URL in case it's encoded
$mpdUrl= "https://dds.livecricketsl.xyz/proxy/sg.php/$mpdUrl";

// Initialize a cURL session to fetch the MPD link

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $mpdUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [

    'Origin: https://livecricketsl.kesug.com'
]);

// Execute the cURL request
$response = curl_exec($ch);

// Check for cURL errors
if (curl_errno($ch)) {
    echo "cURL Error: " . curl_error($ch);
    curl_close($ch);
    exit;
}

// Close the cURL session
curl_close($ch);

// Return the response
//header('Content-Type: application/xml'); // Assuming the MPD response is XML
echo $response;

?>
