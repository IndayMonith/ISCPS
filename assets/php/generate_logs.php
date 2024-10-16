<?php

require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $slot_id = $_POST['slot_id'];
    $time_in = isset($_POST['time_in']) ? $_POST['time_in'] : null;
    $time_out = isset($_POST['time_out']) ? $_POST['time_out'] : null;

    // Convert time_in to MySQL DATETIME format if it is set
    if ($time_in) {
        $time_in = DateTime::createFromFormat('m/d/Y, h:i:s A', $time_in);
        $time_in = $time_in ? $time_in->format('Y-m-d H:i:s') : null; // Convert to MySQL format
    }

    // Convert time_out to MySQL DATETIME format if it is set
    if ($time_out) {
        $time_out = DateTime::createFromFormat('m/d/Y, h:i:s A', $time_out);
        $time_out = $time_out ? $time_out->format('Y-m-d H:i:s') : null; // Convert to MySQL format
    }

    // Check if there's an existing record with the same slot_id and no time_out
    $check_sql = "SELECT * FROM `logs` WHERE `slot_id` = :slot_id AND `time_out` IS NULL LIMIT 1";
    $check_stmt = $db->prepare($check_sql);
    $check_stmt->bindParam(':slot_id', $slot_id);
    $check_stmt->execute();

    $existing_log = $check_stmt->fetch(PDO::FETCH_ASSOC);

    if ($existing_log) {
        // If a record is found, update it with the provided time_out
        if ($time_out) {
            $update_sql = "UPDATE `logs` SET `time_out` = :time_out WHERE `id` = :id";
            $update_stmt = $db->prepare($update_sql);
            $update_stmt->bindParam(':time_out', $time_out);
            $update_stmt->bindParam(':id', $existing_log['id']);

            if ($update_stmt->execute()) {
                $response = array('status' => 'success', 'message' => 'Record updated successfully');
            } else {
                $response = array('status' => 'error', 'message' => 'Failed to update record');
            }
        } else {
            $response = array('status' => 'error', 'message' => 'No time_out provided for update');
        }
    } else {
        // If no existing record is found, insert a new record with time_in
        if ($time_in) {
            $insert_sql = "INSERT INTO `logs` (`slot_id`, `time_in`) VALUES (:slot_id, :time_in)";
            $insert_stmt = $db->prepare($insert_sql);
            $insert_stmt->bindParam(':slot_id', $slot_id);
            $insert_stmt->bindParam(':time_in', $time_in);

            if ($insert_stmt->execute()) {
                $response = array('status' => 'success', 'message' => 'New record created successfully');
            } else {
                $response = array('status' => 'error', 'message' => 'Failed to insert new record');
            }
        } else {
            $response = array('status' => 'error', 'message' => 'No time_in provided for new record');
        }
    }
} else {
    $response = array('status' => 'error', 'message' => 'Invalid request method!');
}

echo json_encode($response);
?>
