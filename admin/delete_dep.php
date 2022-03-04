<!DOCTYPE html>
<html lang="en">

<head>
    <title>HelpDesk Systems</title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../static/dist/tailwind.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="font-display">
    <?php

    session_start();

    require '../connect.php';

$dep_id = $_POST['dep_id'];


$query = "DELETE FROM dep WHERE dep_id = '$dep_id'";
$result = mysqli_query($dbcon, $query);

    if ($result) {
        echo "<script>
    swal('เรียบร้อย','ระบบได้ทำการลบชื่อแผนกเรียบร้อยแล้ว', 'success')
    .then((value) => {
    window.history.back();
    });
    </script>";
    } else {
        echo "เกิดข้อผิดพลาด " . mysqli_error($dbcon);
    }

    mysqli_close($dbcon);
    ?>
</body>

</html>