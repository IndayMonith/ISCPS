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
        'db' => 'created_at',
        'dt' => 4,
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
