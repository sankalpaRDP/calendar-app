<?php
$file = 'events.json';

// Check if the file exists
if (!file_exists($file)) {
    echo json_encode(['success' => false, 'error' => 'File not found']);
    exit;
}

// Decode incoming JSON data
$data = json_decode(file_get_contents("php://input"), true);

if ($data) {
    $currentData = json_decode(file_get_contents($file), true);
    $date = $data['date'];
    $index = $data['index'];

    // Check if the date and index exist
    if (isset($currentData[$date]) && isset($currentData[$date][$index])) {
        array_splice($currentData[$date], $index, 1); // Remove the event
        if (empty($currentData[$date])) {
            unset($currentData[$date]); // Remove the date if no events remain
        }

        // Save updated data back to the file
        file_put_contents($file, json_encode($currentData));
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Event not found']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request']);
}
?>
