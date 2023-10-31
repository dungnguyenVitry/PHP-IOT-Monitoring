<?php
include_once("../help/conn.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $deviceId = $_POST["device"];
    $operatorName = $_POST["operator"];
    $value = $_POST["value"];
    $sql = "INSERT INTO alarm_rules (device_id, operator_name, value) VALUES (:device_id, :operator_name, :value)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':device_id' => $deviceId,
        ':operator_name' => $operatorName,
        ':value' => $value
    ]);
    
    header("Location: /praPHP/test_PHP/user/dashboard.php?success=true");
    exit();
}
include_once("common.php");
include_once("../views/create_alarm.php");
?>