<?php
    include_once ("../help/conn.php");
    session_start();
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Retrieve and sanitize the input data
        $deviceName = htmlspecialchars($_POST["deviceCard"]);
        $deviceDescription = htmlspecialchars($_POST["deviceDescription"]);

        // Perform the database insertion
        $insertSQL = "INSERT INTO devices (name, description) VALUES (:deviceName, :deviceDescription)";

        try {
            $stmt = $pdo->prepare($insertSQL);
            $stmt->bindParam(":deviceName", $deviceName, PDO::PARAM_STR);
            $stmt->bindParam(":deviceDescription", $deviceDescription, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        // Redirect to a success page or back to the form
        header("Location: dashboard.php");
        exit();
    }
    include_once ("common.php");
    include_once("../views/add-devices.php")
?>