<?php
// Hash'J Programming - hashJProgramming (Joshua Ambalong)

$table = 'logs';
require('connection.php');

// Table's primary key
$primaryKey = 'id';

$columns = array(
    array('db' => 'id', 'dt' => 0),
    array('db' => 'slot_id', 'dt' => 1,
        'formatter' => function ($d, $row) {
            return "P$d";
        }),
    array(
        'db' => 'time_in',
        'dt' => 2,
        'formatter' => function ($d, $row) {
            return date('g:i A', strtotime($d));
        }
    ),
    array(
        'db' => 'time_out',
        'dt' => 3,
        'formatter' => function ($d, $row) {
            return date('g:i A', strtotime($d));
        }
    ),
    array(
        'db' => 'time_in',  // Calculating duration
        'dt' => 4,  // Duration column
        'formatter' => function ($d, $row) {
            // Check if 'time_in' is valid and not null
            $timeIn = isset($row['time_in']) && $row['time_in'] !== null ? strtotime($row['time_in']) : time();

            // Check if 'time_out' is valid and not null
            $timeOut = isset($row['time_out']) && $row['time_out'] !== null ? strtotime($row['time_out']) : time();

            // If time_out is earlier than time_in, adjust for crossing midnight
            if ($timeOut < $timeIn) {
                $timeOut += 24 * 60 * 60; // Add 24 hours to time_out to account for crossing midnight
            }

            // Calculate the difference in seconds
            $durationInSeconds = $timeOut - $timeIn;

            // Get hours, minutes, and seconds
            $hours = floor($durationInSeconds / 3600);
            $minutes = floor(($durationInSeconds % 3600) / 60);
            $seconds = $durationInSeconds % 60;

            // Return formatted duration
            return sprintf('%02d hour(s), %02d minute(s), %02d second(s)', $hours, $minutes, $seconds);
        }
    ),
    array(
        'db' => 'created_at',
        'dt' => 5,
        'formatter' => function ($d, $row) {
            return date('F j, Y g:i A', strtotime($d));
        }
    )   
);



// SQL server connection information
$sql_details = array(
    'user' => $username,
    'pass' => $password,
    'db'   => $database,
    'host' => $host
);


echo json_encode(
    SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
);
