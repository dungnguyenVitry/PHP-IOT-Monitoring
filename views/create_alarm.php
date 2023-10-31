<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="../assets/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/app.css">
    <title>Create Alarm Rule</title>
</head>
<body>
    <?php include_once("common/header.view.php");?>
    <div class= "container my-5">
        <div class ="row">
            <div class="col-12">
                
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/test_Dung/user/dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create Alarm</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
            <h2>Create Alarm Rule</h2>
    
    <form action="create_alarm.php" method="POST">
        <label for="device">Select Device:</label>
        <select name="device" id="device">
            <!-- Hiển thị danh sách các thiết bị từ cơ sở dữ liệu -->
            <?php
            // Kết nối đến cơ sở dữ liệu và truy vấn danh sách các thiết bị
            $devices = $pdo->query("SELECT id, name FROM devices")->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($devices as $device) {
                echo "<option value='{$device['id']}'>{$device['name']}</option>";
            }
            ?>
        </select>
        <br>

        
        <label for="operator">Select Operator:</label>
        <select name="operator" id="operator">
            <!-- Hiển thị danh sách các toán tử từ cơ sở dữ liệu -->
            <?php
            // Kết nối đến cơ sở dữ liệu và truy vấn danh sách các toán tử
            $operators = $pdo->query("SELECT id, name FROM operators")->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($operators as $operator) {
                echo "<option value='{$operator['name']}'>{$operator['name']}</option>";
            }
            ?>
        </select>
        <br>
        
        <label for="value">Enter Value:</label>
        <input type="text" name="value" id="value">
        <br>
        <div class="row">
            <div class="col-12">
                <div class="text-center">
        <button type="submit" class="btn btn-primary">Create Alarm Rule</button>
        </div>
        </div>
        </div>
    </form>
            </div>
        </div>


    </div>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/all.min.js"></script>
</body>
</html>
