<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>HelpDesk Systems</title>
    <link rel="stylesheet" href="static/dist/tailwind.css" />
</head>

<body class="mx-0 my-0 font-display bg-gray-100 bg-Primary">
    <div class="m-8 flex items-center justify-center min-h-screen bg-Primary">
        <div class="px-8 py-6 mt-4 text-left bg-white bg-Secondary shadow-lg">
            <h3 class="text-2xl font-bold text-center">Helpdesk Systems</h3>
            <form name="frmlogin" method="POST" action="login.php">
                <div class="mt-4">
                    <div>
                        <label class="block" for="username">ชื่อผู้ใช้งาน<label>
                                <input id="username" name="Username" value="" required autofocus type="text"
                                    placeholder="ใส่ชื่อผู้ใช้งาน"
                                    class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                    </div>
                    <div class="mt-4">
                        <label class="block">รหัสผ่าน<label>
                                <input id="password" name="Password" required type="password" placeholder="ใส่รหัสผ่าน"
                                    class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                    </div>
                    <div class="flex items-baseline justify-between">
                        <button class="px-6 py-2 mt-4 text-white bg-blue-500 rounded-lg hover:bg-blue-600"
                            type="submit">เข้าสู่ระบบ</button>
                        <a href="./form_register.php" class="text-sm text-blue-600 hover:underline">สมัครสมาชิก</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>