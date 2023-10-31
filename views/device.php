<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/app.css">
</head>
<body>
    <?php include_once("common/header.view.php");?>
    <div class="container my-5">
        <div class="row">
            <div class="col-12">
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/test_Dung/user/dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/test_Dung/user/devices.php">Devices</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Device(<?php echo $device_name; ?>)</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div id="statusMessage">
                <div id="statusText"> Current status: <span id="deviceStatus" >  </span></div>
                <div id="centerContainer">
                    <button id="repairButton" style="display: none;">Repair</button>
                </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="card shadow mt-2">
                    <div class="card-body">
                        <h3 class="card-title font-weight-bold">Device Information</h3>
                        <p class="m-0"><?php echo $device_description; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card shadow mt-2">
                    <div class="card-body">
                        <h3 class="card-title font-weight-bold">Live Reading</h3>
                        <canvas id="myChart" width="400" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card shadow mt-2">
                    <div class="card-body pb-0">
                        <div>
                            <h3 class="card-title font-weight-bold">Device Readings</h3>
                        </div>
                        <table class="table table-bordered table-striped table-hover" id="reading-table">
                            <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Reading</th>
                                    <th>Create At</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($readings as $k => $reading) { ?>
                                    <tr class="text-center">
                                        <td><?php echo $k + 1; ?></td>
                                        <td><?php echo $reading['reading']; ?></td>
                                        <td><?php echo $reading['created_at']; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <div class="pagination">
                            <button id="previousPage" class="pagination-button">Previous</button>
                            <input type="text" id="pageNumber" class="pagination-input">
                            <button id="goToPage" class="pagination-button">Go To Page</button>
                            <button id="nextPage" class="pagination-button">Next</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Déclaration de variables pour le graphique
        var myChart;

        // Fonction pour mettre à jour les données du graphique
        function updateChart() {
            fetch('reading.ajax.php?device_id=<?php echo $device_id; ?>')
                .then(response => response.json())
                .then(data => {
                    //( il faut installer MomentJS avant) Récupération des données de temps et des valeurs de lecturear 
                    timeLabels = data.map(item => moment(item.created_at).format('YYYY-MM-DD HH:mm:ss')).reverse();
                    var readingValues = data.map(item => item.reading).reverse();

                    // Update data
                    updateChartWithData(timeLabels, readingValues);
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        // Fonction pour mettre à jour le graphique avec de nouvelles données
        function updateChartWithData(timeLabels, readingValues) {
            if (myChart) {
                myChart.destroy(); // Détruit le graphique précédent avant d'en créer un nouveau
            }

            var ctx = document.getElementById('myChart').getContext('2d');
            myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: timeLabels, // Axe x
                    datasets: [{
                        label: 'Reading Values',
                        data: readingValues, // Axe y
                        borderColor: 'rgba(75, 192, 192, 1)', // couleur de ligne
                        borderWidth: 1
                    }]
                }
            });
        }

        // Appeler la fonction de mise à jour du graphique toutes les 30 secondes
        setInterval(updateChart, 10000);

        
        updateChart();

        const readings = <?php echo json_encode($readings); ?>;
        const itemsPerPage = 10;
        let currentPage = 1;

        const previousPageButton = document.getElementById('previousPage');
        const nextPageButton = document.getElementById('nextPage');
        const pageNumberInput = document.getElementById('pageNumber');
        const goToPageButton = document.getElementById('goToPage');
        const tableBody = document.querySelector('#reading-table tbody');

        function updateTable() {
            const startIndex = (currentPage - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            const pageReadings = readings.slice(startIndex, endIndex);

            // Supprimer toutes les lignes actuelles dans le tableau
            tableBody.innerHTML = '';

            // Afficher les valeurs de readings
            pageReadings.forEach((reading, index) => {
                const newRow = tableBody.insertRow(tableBody.rows.length);
                const cell1 = newRow.insertCell(0);
                const cell2 = newRow.insertCell(1);
                const cell3 = newRow.insertCell(2);
                cell1.innerHTML = startIndex + index + 1;
                cell2.innerHTML = reading.reading;
                cell3.innerHTML = reading.created_at;
            });

            pageNumberInput.value = currentPage; // Mettre à jour la zone de saisie du numéro de page
        }

        function updatePaginationButtons() {
            previousPageButton.disabled = currentPage === 1;
            nextPageButton.disabled = currentPage * itemsPerPage >= readings.length;
        }

        previousPageButton.addEventListener('click', () => {
            if (currentPage > 1) {
                currentPage--;
                updateTable();
                updatePaginationButtons();
            }
        });

        nextPageButton.addEventListener('click', () => {
            if (currentPage * itemsPerPage < readings.length) {
                currentPage++;
                updateTable();
                updatePaginationButtons();
            }
        });

        goToPageButton.addEventListener('click', () => {
            const page = parseInt(pageNumberInput.value);
            if (page >= 1 && page <= Math.ceil(readings.length / itemsPerPage)) {
                currentPage = page;
                updateTable();
                updatePaginationButtons();
            }
        });

        
        updateTable();
        updatePaginationButtons();
    </script>
</body>
</html>
