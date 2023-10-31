<?php
    include_once("../help/conn.php");

    
    $notification_sql = "SELECT ds.id, d.name AS device, ds.created_at
        FROM device_status ds
        INNER JOIN devices d ON ds.device_id = d.id
        WHERE ds.status = 'broken'
        ORDER BY ds.created_at DESC";

    $notification_stmt = $pdo->prepare($notification_sql);
    $notification_stmt->execute();
    $notifications = $notification_stmt->fetchAll(PDO::FETCH_ASSOC);

    include_once("common.php");
    include_once("../views/notifications.php");
?>