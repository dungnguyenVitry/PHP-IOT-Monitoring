<?php
    include_once("../help/conn.php");
    session_start();

    // Vérifie si le paramètre 'name' est défini dans l'URL
    if (isset($_GET['name'])) {
        // Si 'name' est présent, décode sa valeur en tant que nom du périphérique
        $device_name = urldecode($_GET['name']); 
        $page_title = "Device (" . $device_name . ")";
    } else {
        // Si 'name' n'est pas défini dans l'URL, définir un titre par défaut et un nom de périphérique inconnu
        $page_title = "Device";
        $device_name = "Unknown Device"; 
    }

    // Vérifie si le paramètre 'id' est défini dans l'URL
    if (isset($_GET['id'])) {
        // Si 'id' est présent, récupère sa valeur comme identifiant
        $device_id = $_GET['id'];

        // Interroge la base de données pour obtenir des informations
        $device_sql = "SELECT id, name, description FROM devices WHERE id = $device_id";
        $device_stmt = $pdo->prepare($device_sql);
        $device_stmt->execute();
        $device = $device_stmt->fetch(PDO::FETCH_ASSOC);

        if ($device) {
            // Récupère le nom et la description
            $device_name = $device['name'];
            $device_description = $device['description'];

            // Interroge la base de données pour obtenir des lectures valeur de device
            $reading_sql = "SELECT id, device_id, reading, created_at FROM device_readings WHERE device_id = $device_id";
            $reading_stmt = $pdo->prepare($reading_sql);
            $reading_stmt->execute();
            $readings = $reading_stmt->fetchAll(PDO::FETCH_ASSOC);

        } 
    }

    include_once("common.php");
    include_once("../views/device.php");
?>




<script>
    
    // Cette fonction, createNewReading, est utilisée pour créer une nouvelle valeur lecture de device
    function createNewReading() {
        const urlParams = new URLSearchParams(window.location.search);
        const deviceId = urlParams.get('id');
        fetch(`create_reading.php?device_id=${deviceId}`)
            .then(response => response.text())
            .then(data => {
            })
            .catch(error => {
                console.error('Error:', error);
            });
 
    }

    // Cette fonction, fetchAndDisplayReadings, est utilisée pour récupérer les valeurs du lecture   depuis le serveur.
    function fetchAndDisplayReadings() {
        // Effectue une requête pour récupérer les valeurs  en utilisant l'identifiant  dans l'URL.
        fetch(`reading.ajax.php?device_id=<?php echo $device_id; ?>`)
            .then(response => response.json())
            .then(data => {
                // Nettoie le contenu de la table existante.
                const tableBody = document.querySelector('#reading-table tbody');
                tableBody.innerHTML = '';

                // Parcourt les données et ajoute des lignes à la table.
                data.forEach((reading, index) => {
                    const row = tableBody.insertRow();
                    const cellIndex = row.insertCell(0);
                    const cellReading = row.insertCell(1);
                    const cellCreatedAt = row.insertCell(2);

                    // Remplit les cellules de la ligne avec les données de la lecture.
                    cellIndex.textContent = index + 1;
                    cellReading.textContent = reading.reading;
                    cellCreatedAt.textContent = reading.created_at;
                });
            })
            .catch(error => {
                // En cas d'erreur, affiche un message d'erreur dans la console.
                console.error('Error:', error);
            });
    }
    // Effectue une récupération et affichage initial des lectures lors du chargement de la page.
    fetchAndDisplayReadings();

    // Définit un intervalle pour récupérer et afficher les lectures toutes les 30 secondes.
    setInterval(fetchAndDisplayReadings, 10000);


    // Déclaration des variables permettant de gérer le statut de mise à jour
    let allowStatusUpdate = true; // Autorise la mise à jour du statut
    let statusInterval = null; // Intervalle de mise à jour du statut
    let not_broken = false; // Indique si une réparation est en cours

    // Fonction pour créer un nouveau statut
    function getStatus() {
 
        
        const urlParams = new URLSearchParams(window.location.search);
        const deviceId = urlParams.get('id');

        // Effectue une requête pour créer un nouveau statut en utilisant l'identifiant du périphérique
        fetch(`get_status_latest.php?device_id=${deviceId}`)
            .then(response => response.text())
            .then(data => {
                // console.log(data);
                // Sélectionne l'élément "deviceStatus" pour afficher le statut
                const deviceStatusSpan = document.getElementById("deviceStatus");

                // Met à jour le contenu de l'élément span avec le nouveau statut
                if (data !== null && data !== "") {
                    const statusText = document.getElementById("statusText");
                    statusText.style.display = "block"; // Affiche l'élément
                    deviceStatusSpan.textContent = data;
                }

                // Gère les cas où le statut est "working_well" ou "broken"
                if (data.includes("working_well")) {
                    createNewReading(); // Crée une nouvelle lecture
                    document.getElementById("repairButton").style.display = "none"; // Masque le bouton "Réparer"
                    createNewStatus();
                } else if (data.includes("broken")) {

                    allowStatusUpdate = false; // Arrête les mises à jour du statut si le statut est "broken"
                    clearInterval(statusInterval); // Arrête l'intervalle de mise à jour
                    document.getElementById("repairButton").style.display = "block"; // Affiche le bouton "Réparer"

                }
            })
            .catch(error => {
                console.error('Erreur :', error);
            });

        // Indique qu'une réparation est en cours
        not_broken = true;
         
    }

    // Fonction pour vérifier et générer un statut
    function checkAndGenerateStatus() {
        if (!not_broken) {
            getStatus();
        }

        // Appelle cette fonction toutes les 10 secondes
        setTimeout(checkAndGenerateStatus, 10000);
    }
    checkAndGenerateStatus();

    // Configure un intervalle pour créer un nouveau statut toutes les 10 secondes
    statusInterval = setInterval(getStatus, 10000);

    // Sélectionne le bouton "Réparer" par son ID et ajoute un gestionnaire d'événements au clic
    const repairButton = document.getElementById("repairButton");
    repairButton.addEventListener("click", function() {
        createNewStatus();
        // getStatus();
        not_broken = false; // Indique qu'aucune réparation n'est en cours
        // statusInterval = setInterval(getStatus, 10000);
        statusInterval = setInterval(getStatus, 10000);
    });

    function createNewStatus() {        
                
        const urlParams = new URLSearchParams(window.location.search);
        const deviceId = urlParams.get('id');

        // Effectue une requête pour créer un nouveau statut en utilisant l'identifiant du périphérique
        fetch(`create_status.php?device_id=${deviceId}`)
            .then(response => response.text())
            .then(data => {
                // console.log(data);
                
            })
            .catch(error => {
                console.error('Erreur :', error);
            });
    }    

</script>




