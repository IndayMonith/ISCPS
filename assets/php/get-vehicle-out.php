<?php

require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $count_sql = "SELECT COUNT(*) as total_records FROM `logs` WHERE `time_in` IS NOT NULL AND `time_out` IS NOT NULL AND DATE(`created_at`) = CURDATE()";
    $count_stmt = $db->prepare($count_sql);
    $count_stmt->execute();

    $count_result = $count_stmt->fetch(PDO::FETCH_ASSOC);

    if ($count_result) {
        $response = array('status' => 'success', 'total_records' => $count_result['total_records']);
    } else {
        $response = array('status' => 'error', 'message' => 'Failed to retrieve records count.');
    }

    echo json_encode($response);
} else {
    $response = array('status' => 'error', 'message' => 'Invalid request method!');
    echo json_encode($response);
}
?>
