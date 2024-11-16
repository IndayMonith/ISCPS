<?php
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $count_sql = "SELECT slot_id, COUNT(slot_id) AS total_records FROM logs WHERE created_at >= CURRENT_DATE GROUP BY slot_id";
    
    $count_stmt = $db->prepare($count_sql);
    $count_stmt->execute();

    $counts = $count_stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($counts) {
        $response = array('status' => 'success', 'counts' => $counts);
    } else {
        $response = array('status' => 'error', 'message' => 'Failed to retrieve records count.');
    }

    echo json_encode($response);
} else {
    $response = array('status' => 'error', 'message' => 'Invalid request method!');
    echo json_encode($response);
}
?>
