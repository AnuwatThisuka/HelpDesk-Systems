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
    <script>
    // On page load or when changing themes, best to add inline in `head` to avoid FOUC
    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia(
            '(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark')
    }
    </script>
</head>

<body class="font-display">
    <?php

session_start();

if (!isset($_SESSION['id'])) {
    header("Location: form_login.php");
}

require '../connect.php';

$repairman = $_POST['user_id'];


$query = "DELETE FROM users WHERE user_id = '$repairman'";
$result = mysqli_query($dbcon, $query);

if ($result) {
    echo "<script type='text/javascript'>
            swal('เรียบร้อย','ระบบได้ทำการลบรายชื่อพนักงานซ่อมแล้ว', 'success')
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