<?php
require '../connect.php';
session_start();
if (!isset($_SESSION['id'])) {
  header("Location: form_login.php");
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>HelpDesk Systems</title>
    <link rel="icon" href="../assets/icons/programmer.png" type="image/icon type">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../static/dist/tailwind.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="mx-0 my-0 font-display dark:bg-gray-800">
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
                            class="py-2 text-sm px-6 text-gray-100 hover:bg-gray-200 dark:text-gray-100 hover:text-gray-700 dark:bg-gray-800 rounded">
                            <i class="fa-solid fa-house-chimney-user px-2 text-lg"></i>หน้าหลัก</a>
                        <a href="./form_ticket.php"
                            class="mt-3 py-2 px-6 text-sm text-gray-100 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-100  hover:bg-gray-200 dark:hover:bg-gray-800 rounded">
                            <i class="fa-solid fa-circle-exclamation px-2 text-lg"></i>แจ้งปัญหา</a>
                        <a href="waiting_tick.php"
                            class="mt-3 py-2 px-6 text-sm text-gray-100  dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-100 hover:bg-gray-200 dark:hover:bg-gray-800 rounded">
                            <i class="fa-solid fa-wrench px-2 text-lg"></i>ปัญหาที่อยู่ในระหว่างดำเนินการ</a>
                        <a href="success_tick.php"
                            class="mt-3 py-2 px-6 text-sm text-gray-100 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-100 hover:bg-gray-200 dark:hover:bg-gray-800 rounded">
                            <i class="fa-solid fa-circle-check px-2 text-lg"></i>ปัญหาที่ได้รับการแก้ไขแล้ว</a>
                        <a href="all_tick.php"
                            class="mt-3 py-2 px-6 text-sm text-gray-100 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-100 hover:bg-gray-200 dark:hover:bg-gray-800 rounded">
                            <i class="fa-solid fa-clipboard-list px-2 text-lg"></i>รวมการแจ้งปัญหา</a>
                        <a href="detailrate.php"
                            class="mt-3 py-2 px-6 text-sm text-gray-600 bg-gray-200 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-100 hover:bg-gray-200 dark:hover:bg-gray-800 rounded">
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
                                class="text-gray-500 dark:text-gray-300 focus:outline-none lg:hidden">
                                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                            <div>
                                <h1 class="text-2xl text-gray-800 dark:text-white"><i
                                        class="fa-solid fa-wrench px-2"></i>หน้าประเมินพนักงานซ่อม
                                </h1>
                                <p class="text-sm text-gray-800 dark:text-white">
                                    หน้าประเมินการซ่อม
                                    เพื่อให้ปรับปรุงในการทำงานในครั้งต่อๆไป
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <button @click="darkMode = !darkMode"
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
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none">
                                    <path
                                        d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
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
                                    <h2 class="text-gray-700 dark:text-gray-300 text-sm hidden sm:block">
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
                            <h1 class="text-3xl text-gray-700">ยินดีต้อนรับ คุณ
                                <?php echo " " . $_SESSION['name'] . " " ?>
                            </h1>
                            <h3 class="text-2xl text-gray-700">แผนก
                                <?php echo " " . $_SESSION['department'] . " " ?>
                            </h3>
                        </div>
                        <div class=" bg-gray-200 container mx-auto px-4 py-4 ">
                            <div class="bg-white w-full">
                                <h1 class="px-10 py-6 text-white text-base font-bold bg-blue-500"><i
                                        class="fa-solid fa-rectangle-list pr-2 text-lg"></i>รายละเอียดการแจ้งซ่อม</h1>
                            </div>
                            <div class="bg-white w-full">
                                <?php
                                  $jobid = $_POST['id'];
                                  $sql = "SELECT * FROM `ticket` WHERE id = $jobid";
                                  $result = $dbcon->query($sql);
                                  if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                      $id = $row["id"];
                                      $room = $row["room"];
                                      $item = $row["item"];
                                      $serial_num = $row["serial_num"];
                                      $detail = $row["detail"];
                                      $submitted_name = $row["submitted_name"];
                                      $user_id = $row["user_id"];
                                      $repairman = $row["repairman"];
                                      $job_status = $row["job_status"];
                                      $created_at = $row["created_at"];
                                      $pending_at = $row["pending_at"];
                                      $success_at = $row["success_at"];
                                    }
                                  }
                                ?>
                                <div class="px-4 pt-4 pb-2 text-gray-700 text-sm font-bold">ประเมินการแจ้งซ่อมของ :
                                    <?php echo "$id" ?>
                                </div>
                                <form action="./rate.php" method="post">
                                    <input class="hidden" name="job_id" value="<?php echo $id ?>" />
                                    <input class="hidden" name="repairman_id" value="<?php echo $repairman_id ?>" />
                                    <div class="flex flex-row justify-between px-4">
                                        <div class="w-1/4">
                                            <div class="flex flex-col"><label for="exampleEmail11"
                                                    class="text-gray-700 text-sm font-bold">ชื่อผู้แจ้งซ่อม</label><input
                                                    name="text" id="exampleEmail11" placeholder="-" type="text"
                                                    class="text-gray-700 text-sm bg-gray-200 px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-600"
                                                    value="<?php echo "$submitted_name" ?>" disabled></div>
                                        </div>
                                        <div class="w-1/4">
                                            <div class="flex flex-col"><label for="examplePassword11"
                                                    class="text-gray-700 text-sm font-bold">ชื่อพนักงานที่รับงานซ่อม</label><input
                                                    name="text" id="examplePassword11" placeholder="-" type="text"
                                                    class="text-gray-700 text-sm bg-gray-200 px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-600"
                                                    value="<?php echo "$repairman" ?>" disabled></div>
                                        </div>
                                        <div class="w-1/4">
                                            <div class="flex flex-col"><label for="exampleEmail11"
                                                    class="text-gray-700 text-sm font-bold">สถานะการแจ้งซ่อม</label><input
                                                    name="text" id="exampleEmail11" placeholder="-" type="text"
                                                    class="text-gray-700 text-sm bg-gray-200 px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-600"
                                                    value="<?php echo "$job_status" ?>" disabled></div>
                                        </div>
                                    </div>
                                    <h5 class="text-sm font-bold text-gray-700 bt-4 mt-6 ml-4">1.ความเร็วในการทำงาน</h5>
                                    <div class="relative mx-6">
                                        <div class="pb-4">
                                            <div class=""><input value="verygood" type="radio" id="speed_3" name="speed"
                                                    class=""><label class="text-sm text-gray-700" for="speed_3">
                                                    ดีมาก </label>
                                            </div>
                                            <div class=""><input value="good" type="radio" id="speed_2" name="speed"
                                                    class=""><label class="text-sm text-gray-700" for="speed_2">
                                                    ดี </label>
                                            </div>
                                            <div class=""><input value="normal" type="radio" id="speed_1" name="speed"
                                                    class=""><label class="text-sm text-gray-700" for="speed_1">
                                                    พอใช้ </label>
                                            </div>
                                        </div>
                                    </div>
                                    <h5 class="text-sm font-bold text-gray-700 bt-4 mt-6 ml-4">
                                        2.ความเรียบร้อยของการทำงาน</h5>
                                    <div class="relative mx-6">
                                        <div class="pb-4">
                                            <div class=""><input value="verygood" type="radio" id="perfect_3"
                                                    name="perfect" class=""><label class="text-sm text-gray-700"
                                                    for="perfect_3">
                                                    ดีมาก </label>
                                            </div>
                                            <div class=""><input value="good" type="radio" id="perfect_2" name="perfect"
                                                    class=""><label class="text-sm text-gray-700" for="perfect_2">
                                                    ดี </label>
                                            </div>
                                            <div class=""><input value="normal" type="radio" id="perfect_1"
                                                    name="perfect" class=""><label class="text-sm text-gray-700"
                                                    for="perfect_1">
                                                    พอใช้ </label>
                                            </div>
                                        </div>
                                    </div>
                                    <h5 class="text-sm font-bold text-gray-700 bt-4 mt-6 ml-4">3.การปฏิสัมพันธ์กับผู้ใช้
                                    </h5>
                                    <div class="relative mx-6">
                                        <div class="pb-6">
                                            <div class=""><input value="verygood" type="radio" id="talk_3" name="talk"
                                                    class=""><label class="text-sm text-gray-700" for="talk_3">
                                                    ดีมาก </label>
                                            </div>
                                            <div class=""><input value="good" type="radio" id="talk_2" name="talk"
                                                    class=""><label class="text-sm text-gray-700" for="talk_2">


                                                    ดี </label>
                                            </div>
                                            <div class=""><input value="normal" type="radio" id="talk_1" name="talk"
                                                    class=""><label class="text-sm text-gray-700" for="talk_1">
                                                    พอใช้ </label>
                                            </div>
                                        </div>
                                    </div>
                                    <h5 class="text-sm font-bold text-gray-700 bt-4 mt-6 ml-4">4.การให้คำแนะนำ,
                                        แจ้งอาการของเครื่อง และอธิบายถึงการแก้ปัญหา
                                    </h5>
                                    <div class="relative mx-6">
                                        <div class="pb-6">
                                            <div class=""><input value="verygood" type="radio" id="guide_3" name="guide"
                                                    class=""><label class="text-sm text-gray-700" for="guide_3">
                                                    ดีมาก </label>
                                            </div>
                                            <div class=""><input value="good" type="radio" id="guide_2" name="guide"
                                                    class=""><label class="text-sm text-gray-700" for="guide_2">
                                                    ดี </label>
                                            </div>
                                            <div class=""><input value="normal" type="radio" id="guide_1" name="guide"
                                                    class=""><label class="text-sm text-gray-700" for="guide_1">
                                                    พอใช้ </label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="p-4">
                                        <div>
                                            <input type="submit" value="ยืนยัน"
                                                class="bg-green-500 text-base hover:bg-green-700 text-white w-1/5 py-2 px-4 rounded-full">
                                        </div>
                                    </div>
                                    <?php
                                      $sql = "SELECT * FROM `ticket` WHERE id = $jobid";
                                      $result = $dbcon->query($sql);
                                      if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                          $id = $row["id"];
                                          $room = $row["room"];
                                          $item = $row["item"];
                                          $serial_num = $row["serial_num"];
                                          $detail = $row["detail"];
                                          $submitted_name = $row["submitted_name"];
                                          $user_id = $row["user_id"];
                                          $repairman = $row["repairman"];
                                          $repairman_id = $row['repairman_id'];
                                          $job_status = $row["job_status"];
                                          $created_at = $row["created_at"];
                                          $pending_at = $row["pending_at"];
                                          $success_at = $row["success_at"];
                                        }
                                      }
                                    ?>
                                </form>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </div>
</body>

</html>