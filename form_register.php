<!DOCTYPE html>
<html lang="en">
<?php
require 'connect.php';
?>

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="../assets/icons/programmer.png" type="image/icon type">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./static/dist/tailwind.css">
    <title>HelpDesk Systems</title>
</head>

<body class="mx-0 my-0 bg-gray-100 font-display">
    <div class="m-8 flex items-center justify-center min-h-screen bg-gray-100">
        <div class=" bg-white shadow-lg">
            <h3 class="text-2xl font-bold p-5">สมัครสมาชิก</h3>
            <form name="register" id="register" action="register.php" method="POST">
                <div class="m-4 flex">
                    <div class="mr-4">
                        <label class="block=" for="firstname">ชื่อ<label>
                                <input type="text" placeholder="" name="Name" required autofocus
                                    class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                    </div>
                    <div>
                        <label class="block" for="lastname">นามสกุล<label>
                                <input type="text" placeholder="" name="Lastname" required autofocus
                                    class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                    </div>
                </div>
                <div class="m-4 flex">
                    <div class="w-full">
                        <label class="block" for="id">รหัสพนักงาน<label>
                                <input type="text" placeholder="" name="Userid" required autofocus
                                    class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                    </div>
                </div>
                <div class="m-4 flex">
                    <div class="w-full">
                        <label class="block" for="id">แผนก<label>
                                <?php
                                $sql = "SELECT dep_name FROM dep";
                                $result = $dbcon->query($sql);
                                ?>
                                <select autofocus id="inputState"
                                    class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600"
                                    name="Department" required>
                                    <option value="">- กรุณาเลือก -</option>
                                    <?php
                                    while ($rows = $result->fetch_assoc()) {
                                        $dep_name = $rows['dep_name'];
                                        echo "<option value='$dep_name'>$dep_name</option>";
                                    }
                                    ?>
                                </select>
                    </div>
                </div>
                <div class="m-4 flex">
                    <div class="w-full">
                        <label class="block" for="id">ชื่อผู้ใช้งาน<label>
                                <input type="text" placeholder="" name="Username" required autofocus
                                    class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                                <label class="block text-xs text-red-600" for="id">**ใช้สำหรับเข้าสู่ระบบ<label>
                    </div>
                </div>
                <div class="m-4 flex">
                    <div class="w-full">
                        <label class="block" for="id">รหัสผ่าน<label>
                                <input type="password" placeholder="" name="Password" minlength="8" required autofocus
                                    class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                                <label class="block text-xs text-red-600" for="id">**ใช้สำหรับเข้าสู่ระบบ<label>
                                        <label class="block text-xs text-red-600" for="id">***รหัสผ่านไม่ต่ำกว่า 8
                                            ตัว<label>
                    </div>
                </div>
                <div class="m-4 flex">
                    <div class="w-full">
                        <label class="block" for="id">ยืนยันรหัสผ่าน<label>
                                <input type="password" placeholder="" name="conPassword" minlength="8" required
                                    autofocus
                                    class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                    </div>
                </div>
                <div class="m-4 flex items-baseline justify-between">
                    <button type="submit"
                        class="w-full px-6 py-2 mt-4 text-white bg-blue-500 rounded-lg hover:bg-blue-600">สมัครสมาชิก</button>
                </div>
            </form>
            <div class="m-4 flex justify-center align-middle">
                <p class="text-base flex justify-center align-middle mr-2">ฉันมีรหัสผู้ใช้งานแล้ว </p>
                <a href="./form_login.php" class="text-base text-blue-600 hover:underline">เข้าสู่ระบบ</a>
            </div>
        </div>
    </div>
</body>

</html>