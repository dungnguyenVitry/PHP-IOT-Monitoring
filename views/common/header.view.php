<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="http://localhost/test_Dung/user/dashboard.php">
        <img src="../assets/images/logo.png"
        width="64" height="64"
        class= "rounded-circle"
        alt="">
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
        </svg></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <a class="nav-link" href="/test_Dung/user/dashboard.php">Dashboard</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Devices
            </a>
            <div class="dropdown-menu">
                <?php if (count($devices) > 0) { ?>
                    <?php foreach($devices as $device) { ?>
                        <a class="dropdown-item" href="/test_Dung/user/device.php?id=<?php echo $device['id']; ?>&name=<?php echo urlencode($device['name']); ?>">
                            <?php echo $device['name']; ?>
                        </a>
                    <?php } ?>
                <?php } else { ?>
                    <div class="text-center text-danger">
                       You dont have any device
                    </div>
                <?php } ?>
                
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="devices.php">All Devices</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="add-devices.php">Add New Devices</a>
            </div>
        </li>        
      </ul>      
    </div>
  </div>
</nav>