<?php
// Hash'J Programming - hashJProgramming (Joshua Ambalong)

$table = 'daily_log_counts';
require('connection.php');

// Table's primary key
$primaryKey = 'log_date';

$columns = array(
    array('db' => 'log_date', 'dt' => 0, 
        'formatter' => function ($d, $row) {
            return date('F j, Y', strtotime($d));
        }),
    array('db' => 'log_count', 'dt' => 1,)
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
