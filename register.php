<?php

    require 'connect.php';

    $username = $_POST['Username'];
    $password = $_POST['Password'];
    $conpassword = $_POST['conPassword'];
    if ($password != $conpassword) {
        echo ("<script LANGUAGE='JavaScript'>
            window.alert('รหัสผ่านไม่ตรงกัน');
            window.location.href='form_register.php';
            </script>");
        exit;
    }
    $name = $_POST['Name'];
    $department = $_POST['Department'];
    $lastname = $_POST['Lastname'];
    $user_id = $_POST['Userid'];

    // encrypt
    $salt = 'helpdeskprojectmotherfucker';
    $hashpassword = hash_hmac('sha256', $password, $salt);

    // check duplicate username
    $checkdup = "SELECT * FROM `users` WHERE username = '".$username."'";
    $resultdup = mysqli_query($dbcon, $checkdup);
    if($resultdup->num_rows > 0) {
        echo ("<script LANGUAGE='JavaScript'>
            window.alert('ชื่อผู้ใช้นี้มีอยู่แล้ว');
            window.location.href='form_register.php';
            </script>");
        exit;
    }

    // save username into database
    $query = "INSERT INTO users (user_id, username, password, name, lastname, dep) VALUES ('$user_id', '$username', '$hashpassword', '$name', '$lastname','$department')";
    $result = mysqli_query($dbcon, $query);
    if ($result) {
        // echo ("<script>console.log('$result')</script>");
        echo ("<script LANGUAGE='JavaScript'>
            window.alert('สมัครสมาชิกสำเร็จ');
            window.location.href='form_login.php';
            </script>");
    } else {
        echo "เกิดข้อผิดพลาด ". mysqli_error($dbcon);
    }
    // CLOSE DATABASE
    mysqli_close($dbcon);
?>