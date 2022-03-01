<?php

require '../connect.php';

session_start();

// if login yet
if (!isset($_SESSION['id'])) {
    header("Location: form_login.php");
}

?>
<!doctype html>
<html lang="en">

<head>
    <title>HelpDesk Systems</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../static/dist/tailwind.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script>
    // It's best to inline this in `head` to avoid FOUC (flash of unstyled content) when changing pages or themes
    if (
        localStorage.getItem('color-theme') === 'dark' ||
        (!('color-theme' in localStorage) &&
            window.matchMedia('(prefers-color-scheme: dark)').matches)
    ) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
    </script>
</head>

<body class="mx-0 my-0 font-display">
    <div>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
        <div x-data="{ sidebarOpen: false, darkMode: false }" :class="{ 'dark': darkMode }">
            <div class="flex h-screen bg-gray-100 dark:bg-gray-800">
                <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false"
                    class="fixed z-20 inset-0 bg-black opacity-50 transition-opacity lg:hidden"></div>

                <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
                    class="fixed z-30 inset-y-0 left-0 w-60 transition duration-300 transform bg-gray-900 dark:bg-gray-900 overflow-y-auto lg:translate-x-0 lg:static lg:inset-0 px-6">
                    <div class="flex items-center justify-center mt-8">
                        <div class="flex items-center">
                            <span class="text-white dark:text-white text-3xl"><i
                                    class="fa-solid fa-screwdriver-wrench p-2"></i>ระบบแจ้งซ่อม</span>
                        </div>
                    </div>

                    <nav class="flex flex-col mt-10 px-1">
                        <a href="./main.php"
                            class="py-2 text-sm px-6 text-gray-700 dark:text-gray-100 bg-gray-200 dark:bg-gray-800 rounded">
                            <i class="fa-solid fa-house-chimney-user px-2 text-lg"></i>หน้าหลัก</a>
                        <a href="./form_ticket.php"
                            class="mt-3 py-2 px-6 text-sm text-gray-100 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-100  hover:bg-gray-200 dark:hover:bg-gray-800 rounded">
                            <i class="fa-solid fa-circle-exclamation px-2 text-lg"></i>แจ้งปัญหา</a>
                        <a href="./waiting_tick.php"
                            class="mt-3 py-2 px-6 text-sm text-gray-100 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-100 hover:bg-gray-200 dark:hover:bg-gray-800 rounded">
                            <i class="fa-solid fa-wrench px-2 text-lg"></i>ปัญหาที่อยู่ในระหว่างดำเนินการ</a>
                        <a href="success_tick.php"
                            class="mt-3 py-2 px-6 text-sm text-gray-100 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-100 hover:bg-gray-200 dark:hover:bg-gray-800 rounded">
                            <i class="fa-solid fa-circle-check px-2 text-lg"></i>ปัญหาที่ได้รับการแก้ไขแล้ว</a>
                        <a href="all_tick.php"
                            class="mt-3 py-2 px-6 text-sm text-gray-100 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-100 hover:bg-gray-200 dark:hover:bg-gray-800 rounded">
                            <i class="fa-solid fa-clipboard-list px-2 text-lg"></i>รวมการแจ้งปัญหา</a>
                        <a href="detailrate.php"
                            class="mt-3 py-2 px-6 text-sm text-gray-100 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-100 hover:bg-gray-200 dark:hover:bg-gray-800 rounded">
                            <i class="fa-solid fa-rectangle-list px-2 text-lg"></i>ประเมินการซ่อมของพนักงาน
                        </a>
                        <a href="../logout.php"
                            class="mt-3 py-2 px-6 text-sm text-gray-100 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-100 hover:bg-gray-200 dark:hover:bg-gray-800 rounded"><i
                                class="fa-solid fa-arrow-right-from-bracket px-2 text-lg"></i>ออกจากระบบ</a>
                    </nav>
                </div>

                <div class="flex-1 flex flex-col overflow-hidden">
                    <header class="flex justify-between items-center p-6">
                        <div class="flex items-center space-x-4 lg:space-x-0">
                            <button @click="sidebarOpen = true"
                                class="text-gray-700 dark:text-gray-300 focus:outline-none lg:hidden">
                                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>

                            <div class="">
                                <h1 class="text-2xl text-gray-800 dark:text-white"><i
                                        class="fa-solid fa-house-chimney-user px-2"></i>หน้าหลัก</h1>
                                <p class="text-base text-gray-800 dark:text-white">
                                    หน้าหลักจะแสดงข้อมูลต่างๆ ที่ผู้ใช้แจ้งซ่อมเอาไว้
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4 ">
                            <button @click="darkMode = !darkMode "
                                class="flex text-gray-600 dark:text-gray-300 focus:outline-none"
                                aria-label="Color Mode">
                                <svg x-show="darkMode" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                        clip-rule="evenodd" />
                                </svg>
                                <svg x-show="!darkMode" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
                                </svg>
                            </button>
                            <button class="flex text-gray-600 dark:text-gray-300 focus:outline-none">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M15 17H20L18.5951 15.5951C18.2141 15.2141 18 14.6973 18 14.1585V11C18 8.38757 16.3304 6.16509 14 5.34142V5C14 3.89543 13.1046 3 12 3C10.8954 3 10 3.89543 10 5V5.34142C7.66962 6.16509 6 8.38757 6 11V14.1585C6 14.6973 5.78595 15.2141 5.40493 15.5951L4 17H9M15 17V18C15 19.6569 13.6569 21 12 21C10.3431 21 9 19.6569 9 18V17M15 17H9"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </button>

                            <div x-data="{ dropdownOpen: false }" class="relative">
                                <button @click="dropdownOpen = ! dropdownOpen"
                                    class="flex items-center space-x-2 relative focus:outline-none">
                                    <h2 class="text-gray-700 dark:text-gray-300 text-base hidden sm:block">
                                        <?php echo " " . $_SESSION['name'] . " " ?>
                                    </h2>
                                    <img class="h-10 w-10 rounded-full border-2 border-purple-500 object-cover"
                                        src="https://images.unsplash.com/photo-1553267751-1c148a7280a1?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=634&q=80"
                                        alt="Your avatar">
                                </button>

                                <div class="absolute right-0 mt-2 w-48 bg-white rounded-md overflow-hidden shadow-xl z-10"
                                    x-show="dropdownOpen"
                                    x-transition:enter="transition ease-out duration-100 transform"
                                    x-transition:enter-start="opacity-0 scale-95"
                                    x-transition:enter-end="opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-75 transform"
                                    x-transition:leave-start="opacity-100 scale-100"
                                    x-transition:leave-end="opacity-0 scale-95" @click.away="dropdownOpen = false">
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-600 hover:text-white">ข้อมูลส่วนตัว</a>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-600 hover:text-white">แก้ไขข้อมูลส่วนตัว</a>
                                    <a href="../logout.php"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-600 hover:text-white">ออกจากระบบ</a>
                                </div>
                            </div>
                        </div>
                    </header>

                    <main class="overflow-y-scroll py-10">
                        <div class="text-3xl text-gray-700 px-4">
                            <h1 class="text-3xl text-gray-700 uppercase">ยินดีต้อนรับ คุณ
                                <?php echo " " . $_SESSION['name'] . " " ?>
                            </h1>
                            <h3 class="text-2xl text-gray-700 uppercase">แผนก :
                                <?php echo " " . $_SESSION['department'] . " " ?>
                            </h3>
                        </div>
                        <div class="container mx-auto px-1 py-4 rounded-xl">
                            <div
                                class=" p-4  text-gray-500 dark:text-gray-300 text-xl border-4 border-gray-300 border-dashed">
                                <div class="flex justify-between items-center">
                                    <div
                                        class="bg-red-500  border shadow-xl p-4 w-2/6 h-24 flex items-center justify-between">
                                        <div class="flex justify-between">
                                            <h1 class="text-base text-white dark:text-gray-100 flex items-center">
                                                <i class="fa-solid fa-address-book pr-4 text-5xl"></i>งานแจ้งซ่อมทั้งหมด
                                            </h1>
                                        </div>
                                        <div class="flex justify-between">
                                            <h1 class="text-white dark:text-gray-100 text-5xl">
                                                <?php
                                                $id = $_SESSION['id'];
                                                $sql = "SELECT COUNT(*) FROM ticket WHERE `user_id` = '$id'";
                                                $result = $dbcon->query($sql);
                                                $row = $result->fetch_row();
                                                echo $row[0];
                                                ?>
                                            </h1>
                                        </div>
                                    </div>
                                    <div
                                        class="bg-yellow-500  border shadow-xl p-4 w-2/6 h-24 flex items-center justify-between">
                                        <div class="flex justify-around">
                                            <h1 class="text-base text-white dark:text-gray-100 flex items-center">
                                                <i class="fa-solid fa-toolbox pr-4 text-5xl"></i>งานแจ้งที่รอซ่อม
                                            </h1>
                                        </div>
                                        <div class="flex justify-between">
                                            <h1 class="text-white dark:text-gray-100 text-5xl">
                                                <?php
                                                $name = $_SESSION['name'];
                                                $sql = "SELECT COUNT(*) FROM ticket WHERE `user_id` = '$id' AND `job_status` = 'waiting'";
                                                $result = $dbcon->query($sql);
                                                $row = $result->fetch_row();
                                                echo $row[0];
                                                ?>
                                            </h1>
                                        </div>
                                    </div>
                                    <div
                                        class="bg-green-500  border shadow-xl p-4 w-2/6 h-24 flex items-center justify-between">
                                        <div class="flex justify-between">
                                            <h1 class="text-base text-white dark:text-gray-100 flex items-center">
                                                <i
                                                    class="fa-solid fa-circle-check pr-4 text-5xl"></i>งานที่ได้รับการแก้ไขแล้ว
                                            </h1>
                                        </div>
                                        <div class="flex justify-between">
                                            <h1 class="text-white dark:text-gray-100 text-5xl">
                                                <?php
                                                $name = $_SESSION['name'];
                                                $sql = "SELECT COUNT(*) FROM ticket WHERE `user_id` = '$id' AND `job_status` = 'success'";
                                                $result = $dbcon->query($sql);
                                                $row = $result->fetch_row();
                                                echo $row[0];
                                                ?>
                                            </h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white p-4">
                            <div class=" bg-gray-200 container mx-auto px-1 py-4 ">
                                <div class="text-gray-700 text-base flex flex-col">
                                    <?php
                                    $id = $_SESSION['id'];
                                    $name = $_SESSION['name'];

                                    $sql = "SELECT * FROM ticket WHERE user_id= '$id' AND job_status= 'waiting' ORDER BY created_at DESC";
                                    $result = $dbcon->query($sql);
                                    if ($result->num_rows > 0) {
                                                echo "<table class='mb-0 rounded-3xl w-full'>";
                                                echo "<tr align='center' class=' bg-blue-600 text-white h-12 py-4 px-4 text-base font-thin'>";
                                                echo "<th>รหัสการแจ้งปัญหา</th>";
                                                echo "<th>ห้อง</th>";
                                                echo "<th>สิ่งของ</th>";
                                                echo "<th>Serial Number</th>";
                                                echo "<th>รายละเอียด</th>";
                                                // echo "<th>Date</th>";
                                                echo "<th>สถานะ</th>";
                                                echo "<th>จัดการ</th>";
                                                echo "</tr>";
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<tr align='center' class='bg-white text-sm shadow-md rounded-2xl h-8 border-b-2 hover:bg-gray-200'>";
                                                    echo "<td>" . $row["id"] . "</td>"; 
                                                    echo "<td>" . $row["room"] . "</td>";
                                                    echo "<td>" . $row["item"] . "</td>";
                                                    echo "<td>" . $row["serial_num"] . "</td>";
                                                    echo "<td>" . $row["detail"] . "</td>";
                                                    echo "<td>" . "<div class='bg-red-500 text-white rounded-xl py-2 uppercase'>" . $row["job_status"] . "</div>" . "</td>";
                                                    echo "<td class='py-3 text-center'>
                                                                <div class='flex justify-center items-center'>
                                                                    <form action='./detail.php' method='post'>
                                                                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                                                                        <button type='submit' tabindex='0' class='dropdown-item'>
                                                                            <div class='w-5 mr-2 transform hover:text-green-600 text-xl hover:scale-110'>
                                                                                <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24'
                                                                                stroke='currentColor'>
                                                                                    <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2'
                                                                                        d='M15 12a3 3 0 11-6 0 3 3 0 016 0z' />
                                                                                    <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2'
                                                                                        d='M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z' />
                                                                                </svg>
                                                                            </div> 
                                                                        </button>
                                                                    </form>
                                                                    <form action='./form_edit.php' method='post'>
                                                                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                                                                        <input type='hidden' name='room' value='" . $row['room'] . "'>
                                                                        <input type='hidden' name='item' value='" . $row['item'] . "'>
                                                                        <input type='hidden' name='serial_num' value='" . $row['serial_num'] . "'>
                                                                        <input type='hidden' name='detail' value='" . $row['detail'] . "'>
                                                                        <button type='submit' tabindex='0' class='dropdown-item'>
                                                                            <div class='w-5 mr-2 transform hover:text-yellow-600 hover:scale-110'>
                                                                                    <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24'
                                                                                        stroke='currentColor'>
                                                                                        <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2'
                                                                                            d='M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z' />
                                                                                    </svg>
                                                                            </div>
                                                                        </button>
                                                                    </form>                                                      
                                                                    <form action='./delete.php' method='post'>
                                                                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                                                                        <button type='submit' tabindex='0' class='w-4'>
                                                                            <div class='w-5 mr-2 transform hover:text-red-600 hover:scale-110'>
                                                                                <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24'
                                                                                    stroke='currentColor'>
                                                                                    <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2'
                                                                                        d='M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16' />
                                                                                </svg>
                                                                            </div>
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </td>";
                                                    echo "</tr>";
                                                }
                                                
                                    } else {
                                        echo "
                                                <div>
                                                    <p class='text-sm px-4'>ยังไม่มีปัญหาที่คุณแจ้ง</p>
                                                </div>
                                                <div class='flex items-center px-4 '>
                                                <i class='text-blue-600 hover:no-underline pr-2 fa-solid fa-circle-exclamation text-xl flex items-center'></i>
                                                    <a class='flex items-center text-sm text-blue-600 hover:underline' href='./form_ticket.php'> ต้องการแจ้งปัญหา</a>
                                                </div>
                                                ";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </div>

    <script src="../main.js"></script>
</body>

</html>