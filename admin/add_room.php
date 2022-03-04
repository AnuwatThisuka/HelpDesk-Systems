<!DOCTYPE html>
<html lang="en">

<head>
    <title>HelpDesk Systems</title>
    <link rel="icon" href="../assets/icons/programmer.png" type="image/icon type">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../static/dist/tailwind.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="font-display">
    <?php

    require '../connect.php';

    $room = $_POST['room'];

    // check duplicate item
    $checkdup = "SELECT * FROM `location` WHERE room_name = '$room'";
    $resultdup = mysqli_query($dbcon, $checkdup);
    if($resultdup->num_rows > 0) {
        echo ("<script>
        swal('ไม่สำเร็จ','มีสถานที่ปฎิบัติงานนี้แล้ว', 'error')
        .then((value) => {
        window.history.back()';
        });
        </script>");
        exit;
    }

    $sql = "INSERT INTO location (room_name) VALUES ('$room')";
    $result = mysqli_query($dbcon, $sql);
    if ($result) {
        echo ("<script>console.log('$result')</script>");
        echo ("<script>
                swal('สำเร็จ','ระบบได้เพิ่มสถานที่ปฎิบัติงานเรียบร้อยได้', 'success')
                .then((value) => {
                window.history.back();
                });
                </script>");
    } else {
        echo "เกิดข้อผิดพลาด ". mysqli_error($dbcon);
    }
    mysqli_close($dbcon);
?>
</body>

</html>