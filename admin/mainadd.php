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

require '../connect.php';

$username = $_POST['Username'];
$password = $_POST['Password'];
$conpassword = $_POST['conPassword'];
if ($password != $conpassword) {
    echo ("<script LANGUAGE='JavaScript'>
        window.alert('รหัสผ่านไม่ตรงกัน');
        window.history.back();
        </script>");
    exit;
}
$name = $_POST['Name'];
$department = 'Repair Man';
$lastname = $_POST['Lastname'];
$user_id = $_POST['Userid'];

// encrypt
$salt = 'helpdeskprojectmotherfucker';
$hashpassword = hash_hmac('sha256', $password, $salt);


// save username into database
$query = "INSERT INTO users (user_id, username, password, name, lastname, role, dep) VALUES ('$user_id', '$username', '$hashpassword', '$name', '$lastname', 'repairman','$department')";
$result = mysqli_query($dbcon, $query);
if ($result) {
    echo ("<script>console.log('$result')</script>");
    echo ("
            <script type='text/javascript'>
            swal('เรียบร้อย','ทำการแจ้งปัญหาไปที่ระบบเรียบร้อยแล้ว', 'success')
            .then((value) => {
            window.location.href='./addmainternance_name.php';
            });
            </script>");
} else {
    echo "เกิดข้อผิดพลาด ". mysqli_error($dbcon);
}

mysqli_close($dbcon);
?>
</body>

</html>