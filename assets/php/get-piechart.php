<?php
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $count_sql = "
        SELECT 
            (SELECT COUNT(*) FROM logs WHERE time_in IS NOT NULL AND DATE(created_at) = CURDATE()) as total_in,
            (SELECT COUNT(*) FROM logs WHERE time_out IS NOT NULL AND DATE(created_at) = CURDATE()) as total_out
    ";
    $count_stmt = $db->prepare($count_sql);
    $count_stmt->execute();
    $count_result = $count_stmt->fetch(PDO::FETCH_ASSOC);

    if ($count_result) {
        // Return the counts as JSON
        $response = array(
            'status' => 'success',
            'total_in' => $count_result['total_in'],
            'total_out' => $count_result['total_out']
        );
    } else {
        $response = array('status' => 'error', 'message' => 'Failed to retrieve records.');
    }

    echo json_encode($response);
} else {
    $response = array('status' => 'error', 'message' => 'Invalid request method!');
    echo json_encode($response);
}
?>
