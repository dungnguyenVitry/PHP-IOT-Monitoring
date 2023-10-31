<?php
    $sql = "SELECT id, name, description FROM devices"; 

    try {
        $stmt = $pdo->query($sql);
        $devices = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } 

?>