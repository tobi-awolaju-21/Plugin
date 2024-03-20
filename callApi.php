<?php
// Replace with your actual DeepL API key
$authKey = "c0a7daee-7756-eba3-f1cf-6e1ba124ef6d"; // Replace with your key

// Text to translate (replace with actual text or accept from user input)
$text = "Hello, world!";

// Target language (can be dynamically set)
$targetLanguage = "DE";

// Prepare data as an associative array
$data = array(
  "text" => array($text),
  "target_lang" => $targetLanguage
);

// Build the header with authorization key
$headers = array(
  "Authorization: DeepL-Auth-Key " . $authKey,
  "Content-Type: application/json"
);

// Initialize cURL
$curl = curl_init("https://api-free.deepl.com/v2/translate");

// Set cURL options
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// Execute the request and get the response
$response = curl_exec($curl);

// Check for errors
if(curl_errno($curl)) {
  echo 'Error: ' . curl_error($curl);
} else {
  // Decode the JSON response
  $responseData = json_decode($response, true);
  
  // Extract the translated text
  $translatedText = $responseData['translations'][0]['text'];
  
  // Print the translated text
  echo $translatedText;
}

// Close cURL connection
curl_close($curl);

?>