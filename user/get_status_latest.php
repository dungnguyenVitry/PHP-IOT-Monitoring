<?php
include_once("../help/conn.php"); 

if (isset($_GET['device_id'])) {
    $device_id = $_GET['device_id'];

  
    $status_sql = "SELECT status FROM device_status WHERE device_id = :device_id ORDER BY created_at DESC LIMIT 1";
    $status_stmt = $pdo->prepare($status_sql);
    $status_stmt->bindParam(':device_id', $device_id, PDO::PARAM_INT);
    $status_stmt->execute();

    if ($status_stmt->rowCount() > 0) {
        $latestStatus = $status_stmt->fetch(PDO::FETCH_ASSOC);
        $response =  $latestStatus['status'];
        echo json_encode($response);
        // print_r($response);
    } else {
        echo json_encode(['No status found']);
    }
} else {
    echo json_encode(['Device ID not provided']);
}
?>
