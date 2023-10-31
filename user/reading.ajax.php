<?php
    include_once("../help/conn.php");
    $device_id = $_GET['device_id'];
        $sql = "SELECT created_at, reading FROM device_readings WHERE device_id = :d ORDER BY created_at DESC LIMIT 10"; // Lấy 10 bản ghi gần đây

        $stmt = $pdo->prepare($sql);
        $stmt->execute([':d' => $device_id]);
        $readings = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($readings);
        return;

?>