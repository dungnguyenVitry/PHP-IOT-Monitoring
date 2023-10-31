
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="../assets/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/app.css">
    <title>Add New Device</title>

  </head>
  <body>
    <?php include_once("common/header.view.php");?>
    <div class= "container my-5">
        <div class ="row">
            <div class="col-12">
                <h1 class="display-4">Add New Device</h1>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/test_Dung/user/dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/test_Dung/user/devices.php">Devices</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add New Device</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card shadow mt-2">
                    <div class="card-body">
                        <form action="/test_Dung/user/add-devices.php" method="POST">
                            <div class="form-group row text-center">
                                <label for="deviceCard" class="col-form-label col-12">
                                    Device Name
                                </label>
                                <div class="col-12 col-md-8 offset-0 offset-md-2">
                                    <input type="text" class="form-control"
                                    id="deviceCard" name="deviceCard" maxlength="20">
                                    <div class="alert alert-danger d-none" id="errorsContainer">

                                    </div>
                                </div>
                            </div>
                            <div class="form-group row text-center">
                                <label for="deviceDescription" class="col-form-label col-12">
                                    Device Description
                                </label>
                                <div class="col-12 col-md-8 offset-0 offset-md-2">
                                    <textarea class="form-control" id="deviceDescription" name="deviceDescription" rows="4"></textarea>
                                </div>
                            </div>

                            <div class="text-center">

                                <button type="submit"
                                id="addBtn"
                                class="btn mt-2">
                                Add Device 
                                </button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
        
        


    </div>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/all.min.js"></script>
    <script>
        $(document).ready(function () {
            var deviceCard = $("#deviceCard");
            var addOpenBtn = $("#addOpenBtn");
            var addBtn = $("#addBtn");

            var validFunc = function (e) {
            var errors = [];
            var errorsContainer = $("#errorsContainer");
            errorsContainer.html("");
            if (!errorsContainer.hasClass("d-none"))
                errorsContainer.addClass("d-none");

            var deviceCardValue = deviceCard.val().trim().length;

            if (deviceCardValue <= 0) {
                errors.push("<?php echo VALID_DEVICECARD_REQ; ?>");
            } else if (deviceCardValue < 3) {
                errors.push("<?php echo VALID_DEVICECARD_MIN; ?>");
            } else if (deviceCardValue > 20) {
                errors.push("<?php echo VALID_DEVICECARD_MAX; ?>");
            }

            if (errors.length > 0) {
                e.preventDefault();

                var allErrorsHTML = "";
                for (var i = 0; i < errors.length; i++) {
                allErrorsHTML += generateErrorItem(errors[i]);
                }
                errorsContainer.html(allErrorsHTML);
                errorsContainer.removeClass("d-none");
            }
            };

            addOpenBtn.click(validFunc);
            addBtn.click(validFunc);
        });
    </script>
  </body>
</html>