<?php
// Path to your JSON file
$file = 'events.json';

// Check if the file exists, if not, create it
if (!file_exists($file)) {
    file_put_contents($file, json_encode([]));
}

// Decode incoming JSON data
$data = json_decode(file_get_contents("php://input"), true);

if ($data) {
    $currentData = json_decode(file_get_contents($file), true);
    $date = $data['date'];

    // Initialize date array if it doesn't exist
    if (!isset($currentData[$date])) {
        $currentData[$date] = [];
    }

    // Add the new event to the date's array
    $currentData[$date][] = $data;

    // Save updated data back to the file
    file_put_contents($file, json_encode($currentData));
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'No data received']);
}
?>
