<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="../assets/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/app.css">
    <title>Dashboard</title>

  </head>
  <body>
    <?php include_once("common/header.view.php");?>
    <div class= "container my-5">
        <div class ="row">
            <div class="col-12">
                <h1 class="display-4">Dashboard</h1>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-4">
                <a href="/test_Dung/user/devices.php" class="a-no-style">
                    <div class="card shadow border">
                        <div class="card-body">
                            <h2 class="text-center card-title">Devices</h2>
                            <p class="card-subtitle text-center font-weight-bold"><?php echo $deviceCount; ?></p>
                        </div>
                    </div>
                </a>    
            </div>
            <div class="col-12 col-md-6 col-lg-4">
                <a href="/test_Dung/user/notifications.php" class="a-no-style">
                    <div class="card shadow border">
                        <div class="card-body">
                            <h2 class="text-center card-title">Notifications</h2>
                            <p class="card-subtitle text-center font-weight-bold"><?php echo $noti_count; ?></p>
                        </div>
                    </div>
                </a>    
            </div>
        </div>
    </div>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/all.min.js"></script>
  </body>
</html>