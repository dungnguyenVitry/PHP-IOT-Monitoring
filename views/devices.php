<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="stylesheet" href="../assets/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/app.css">
    <title>Devices</title>

  </head>
  <body>
    <?php include_once("common/header.view.php");?>
    <div class= "container my-5">
        <div class ="row">
            <div class="col-12">
                <h1 class="display-4">Devices</h1>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/test_Dung/user/dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Devices</li>
                    </ol>
                </nav>
            </div>
        </div>


        <div class="row">
            <div class="col-12">
                <div class="text-right">
                    <a class="btn btn-primary" href="/test_Dung/user/add-devices.php">Add new device</a>
                </div>
            </div>
        </div>

        

        <div class="row">
            <div class="col-12">
                <div class="card shadow mt-2">
                    <div class="card-body">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($devices as $k => $device) { ?>
                                    <tr class="text-center">
                                        <td><?php echo $k + 1; ?></td>
                                        <td><?php echo $device['name']; ?></td>
                                        <td><?php echo $device['description']; ?></td>
                                        
                                        <td>
                                            <a href="/test_Dung/user/device.php?id=<?php echo $device['id']; ?>&name=<?php echo urlencode($device['name']); ?>" class="btn btn-info">Details</a>
                                         
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        
        


    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/all.min.js"></script>
    
</script>
  </body>
</html>