<?php
    include_once("../help/conn.php");

    function generateRandomStatusAndInsert($pdo, $device_id) {
        $device_id =1;
        // Kiểm tra trạng thái ban đầu từ cơ sở dữ liệu
        $initialStatus = '';
        try {
            $status_sql = "SELECT status FROM device_status WHERE device_id = :device_id";
            $status_stmt = $pdo->prepare($status_sql);
            $status_stmt->bindParam(':device_id', $device_id, PDO::PARAM_INT);
            $status_stmt->execute();
            $status_result = $status_stmt->fetch(PDO::FETCH_ASSOC);
        
            if ($status_result) {
                $initialStatus = $status_result['status'];
                // Tiếp tục xử lý
            } else {
                echo "error";
            }
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
        


        // Nếu trạng thái ban đầu là 'broken', thì không cập nhật nữa
        if ($initialStatus === 'broken') {
            return;
        }

        // Sinh số ngẫu nhiên từ 1 đến 10
        $randomNumber = mt_rand(1, 10);

        // Thiết lập trạng thái mặc định là 'working_well'
        $newStatus = 'working_well';

        // Nếu randomNumber là 1, thì trạng thái sẽ là 'broken'
        if ($randomNumber === 1) {
            $newStatus = 'broken';
        }

        // Cập nhật trạng thái vào cơ sở dữ liệu
        $update_status_sql = "UPDATE device_status SET status = :newStatus WHERE device_id = :device_id";
        $update_status_stmt = $pdo->prepare($update_status_sql);
        $update_status_stmt->bindParam(':newStatus', $newStatus, PDO::PARAM_STR);
        $update_status_stmt->bindParam(':device_id', $device_id, PDO::PARAM_INT);
        $update_status_stmt->execute();
    }

    // Lấy device_id từ yêu cầu và gọi hàm
    if (isset($_GET['device_id'])) {
        
        $device_id = $_GET['device_id'];
        generateRandomStatusAndInsert($pdo, $device_id);
    } else {
        echo "Device ID is not provided in the URL.";
    }
?>
