<?php
    include_once("../help/conn.php"); 

    $device_id = $_GET['device_id']; // Récupérer l'ID du périphérique à partir du paramètre passé dans l'URL

    // Fonction pour créer une nouvelle valeur de lecture dans la plage de 0 à 100
    $readingValue = rand(0, 100);

    // Insérer la nouvelle valeur de lecture dans la base de données
    $sql = "INSERT INTO device_readings (device_id, reading, created_at) VALUES (:device_id, :reading, NOW())";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':device_id' => $device_id, 
        ':reading' => $readingValue,
    ]);

    echo "New reading added: $readingValue"; 

?>
