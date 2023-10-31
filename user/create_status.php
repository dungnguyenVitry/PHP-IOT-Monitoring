<?php
    include_once("../help/conn.php"); 
    $device_id = $_GET['device_id']; // recouperer id

    // Génère un nombre aléatoire entre 1 et 5
    $randomNumber = mt_rand(1, 5);

    // Initialise le nouveau statut comme 'working_well' par défaut
    $newStatus = 'working_well';

    // Si le nombre aléatoire est égal à 1, le statut devient 'broken'
    if ($randomNumber === 1) {
        $newStatus = 'broken';
    }

    // Requête SQL pour insérer le nouveau statut dans la table device_status
    $insert_status_sql = "INSERT INTO device_status (device_id, status, created_at) VALUES (:device_id, :newStatus, NOW())";
    $insert_status_stmt = $pdo->prepare($insert_status_sql);
    $insert_status_stmt->bindParam(':device_id', $device_id, PDO::PARAM_INT);
    $insert_status_stmt->bindParam(':newStatus', $newStatus, PDO::PARAM_STR);
    $insert_status_stmt->execute();

    // Vérifie si des erreurs se sont produites lors de l'exécution de la requête
    if ($insert_status_stmt->errorCode() !== '00000') {
        print_r($insert_status_stmt->errorInfo());
    }
    // Affiche le nouveau statut
    echo $newStatus;

?>
