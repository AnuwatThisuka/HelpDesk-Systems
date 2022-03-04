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
        <link rel="icon" href="../assets/icons/programmer.png" type="image/icon type">
        <title>HelpDesk Systems</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="../static/dist/tailwind.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
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
                            <a href="./admin.php"
                                class="py-2 px-6 text-sm text-gray-700 bg-gray-200 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-100  hover:bg-gray-200 dark:hover:bg-gray-800 rounded flex  items-center">
                                <i class="fa-solid fa-house-chimney-user pr-2 text-lg"></i>หน้าหลัก</a>
                            <a href="./alluser.php"
                                class="mt-3 py-2 px-6 text-sm text-gray-100 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-100 hover:bg-gray-200 dark:hover:bg-gray-800 rounded flex  items-center">
                                <i class="fa-solid fa-circle-info pr-2 text-lg"></i>รายชื่อผู้ใช้งาน</a>
                            <a href="./allmainternance.php"
                                class="mt-3 py-2 px-6 text-sm text-gray-100 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-100 hover:bg-gray-200 dark:hover:bg-gray-800 rounded flex  items-center">
                                <i class="fa-solid fa-clipboard-list pr-2 text-lg"></i>รายชื่อพนักงานซ่อม</a>
                            <a href="allitems.php"
                                class="mt-3 py-2 px-6 text-sm text-gray-100 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-100 hover:bg-gray-200 dark:hover:bg-gray-800 rounded flex  items-center">
                                <i class="fa-solid fa-store pr-2 text-lg"></i>สิ่งของ/คุรุภัณฑ์</a>
                            <a href="allroom.php"
                                class="mt-3 py-2 px-6 text-sm text-gray-100 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-100 hover:bg-gray-200 dark:hover:bg-gray-800 rounded flex  items-center">
                                <i class="fa-solid fa-map-location-dot pr-2 text-lg"></i>สถานที่ปฎิบัติงาน</a>
                            <a href="alldep.php"
                                class="mt-3 py-2 px-6 text-sm text-gray-100 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-100 hover:bg-gray-200 dark:hover:bg-gray-800 rounded flex  items-center">
                                <i class="fa-solid fa-rectangle-list pr-2 text-lg"></i>แผนก
                            </a>
                            <a href="../logout.php"
                                class="mt-3 py-2 px-6 text-sm text-gray-100 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-100 hover:bg-gray-200 dark:hover:bg-gray-800 rounded flex  items-center">
                                <i class="fa-solid fa-arrow-right-from-bracket pr-2 text-lg"></i>ออกจากระบบ</a>
                        </nav>
                    </div>
                    <div class="flex-1 flex flex-col overflow-hidden">
                        <header class="flex justify-between items-center p-6">
                            <div class="flex items-center space-x-4 lg:space-x-0">
                                <button @click="sidebarOpen = true"
                                    class="text-gray-700 dark:text-gray-300 focus:outline-none lg:hidden">
                                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
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
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
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
                                            class="bg-gray-700  border shadow-xl p-4 w-2/6 h-24 flex items-center justify-between">
                                            <div class="flex justify-between">
                                                <h1 class="text-base text-white dark:text-gray-100 flex items-center">
                                                    <i class="fas fa-user-shield pr-4 text-5xl"></i>แอดมิน
                                                </h1>
                                            </div>
                                            <div class="flex justify-between">
                                                <h1 class="text-white dark:text-gray-100 text-5xl">
                                                    <?php
                                                        $name = $_SESSION['name'];
                                                        $sql = "SELECT COUNT(*) FROM users WHERE role ='admin'";
                                                        $result = $dbcon->query($sql);
                                                        $row = $result->fetch_row();
                                                        echo $row[0];
                                                        $user_total = $row[0];
                                                    ?>
                                                </h1>
                                            </div>
                                        </div>
                                        <div
                                            class="bg-gray-700  border shadow-xl p-4 w-2/6 h-24 flex items-center justify-between">
                                            <div class="flex justify-around">
                                                <h1 class="text-base text-white dark:text-gray-100 flex items-center">
                                                    <i class="fa-solid fa-users pr-4 text-5xl"></i>ผู้ใช้งานทั่วไป
                                                </h1>
                                            </div>
                                            <div class="flex justify-between">
                                                <h1 class="text-white dark:text-gray-100 text-5xl">
                                                    <?php
                                                        $name = $_SESSION['name'];
                                                        $sql = "SELECT COUNT(*) FROM users WHERE role = 'member'";
                                                        $result = $dbcon->query($sql);
                                                        $row = $result->fetch_row();
                                                        echo $row[0];
                                                        $user_member = $row[0];
                                                    ?>
                                                </h1>
                                            </div>
                                        </div>
                                        <div
                                            class="bg-gray-700  border shadow-xl p-4 w-2/6 h-24 flex items-center justify-between">
                                            <div class="flex justify-between">
                                                <h1 class="text-base text-white dark:text-gray-100 flex items-center">
                                                    <i class="fa-solid fa-user-gear pr-4 text-5xl"></i>พนักงานซ่อม
                                                </h1>
                                            </div>
                                            <div class="flex justify-between">
                                                <h1 class="text-white dark:text-gray-100 text-5xl">
                                                    <?php
                                                        $name = $_SESSION['name'];
                                                        $sql = "SELECT COUNT(*) FROM users WHERE role = 'repairman'";
                                                        $result = $dbcon->query($sql);
                                                        $row = $result->fetch_row();
                                                        echo $row[0];
                                                        $user_repairman = $row[0];
                                                    ?>
                                                </h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-200 w-full h-auto p-6 flex justify-around">
                                <!-- main chart -->
                                <!-- chart user -->
                                <div class=" px-6 py-6 bg-white w-5/12 h-auto text-sm text-white rounded-3xl">
                                    <div class="pb-4 px-2">
                                        <div class="flex justify-between items-center">
                                            <span class="text-gray-700"><i
                                                    class="fa-solid fa-chart-pie px-1"></i>ชาร์ตจำนวนผู้ใช้งานทั้งหมด</span>
                                            <button id="btnDownload"
                                                class="bg-green-500 hover:bg-green-600 text-sm py-1 px-3 rounded-lg"
                                                type='button'>
                                                <i class="fa-solid fa-cloud-arrow-down pr-1"></i>
                                                บันทึก
                                            </button>
                                        </div>
                                    </div>
                                    <canvas id="pie-chart" class="text-white"></canvas>
                                    <script>
                                    var ctx = document.getElementById('pie-chart').getContext('2d');
                                    var role2 = new Chart(ctx, {
                                        type: 'pie',
                                        data: {
                                            labels: ['แอดมิน [<?php echo "$user_total" ?>]',
                                                'พนักงานซ่อม [<?php echo "$user_repairman" ?>]',
                                                'ผู้ใช้งาน [<?php echo "$user_member" ?>]'
                                            ],
                                            datasets: [{
                                                label: '# of Users',
                                                data: [<?php echo "$user_total" ?>,
                                                    <?php echo "$user_repairman" ?>,
                                                    <?php echo "$user_member" ?>
                                                ],
                                                backgroundColor: [
                                                    'rgba(255, 99, 132, 1)',
                                                    'rgba(54, 162, 235, 1)',
                                                    'rgba(255, 206, 86, 1)',
                                                    'rgba(75, 192, 192, 1)',
                                                    'rgba(153, 102, 255, 1)',
                                                    'rgba(255, 159, 64, 1)'
                                                ],
                                                borderColor: [
                                                    'rgba(255, 99, 132, 1)',
                                                    'rgba(54, 162, 235, 1)',
                                                    'rgba(255, 206, 86, 1)',
                                                    'rgba(75, 192, 192, 1)',
                                                    'rgba(153, 102, 255, 1)',
                                                    'rgba(255, 159, 64, 1)'
                                                ],
                                            }]
                                        },
                                        options: {
                                            title: {
                                                display: true,
                                                text: ''
                                            },
                                            font: {
                                                size: 16,
                                                family: 'Noto Sans Thai',
                                            },
                                            datalabel: {
                                                color: '#000000'
                                            }
                                        }
                                    });
                                    //Fucntion Export PNG
                                    const btnDownload = document.querySelector('#btnDownload');
                                    const myCanvas = document.querySelector('#pie-chart');
                                    btnDownload.addEventListener("click", function() {
                                        console.log('click')
                                        if (window.navigator.msSaveBlob) {
                                            window.navigator.msSaveBlob(myCanvas.msSaveBlob(), "user.png");
                                        } else {
                                            const a = document.createElement("a");
                                            document.body.appendChild(a);
                                            a.href = myCanvas.toDataURL();
                                            a.download = "jobs.png";
                                            a.click();
                                            document.body.removeChild(a);
                                        }
                                    });
                                    </script>
                                </div>
                                <div class=" px-6 py-6 bg-white w-5/12 h-auto text-sm text-white rounded-3xl">
                                    <div class="pb-4 px-2">
                                        <div class="flex justify-between items-center">
                                            <span class="text-gray-700 text-center"><i
                                                    class="fa-solid fa-chart-pie px-1"></i>ชาร์ตจำนวนการแจ้งซ่อมทั้งหมด
                                            </span>
                                            <button id="btnDownload2"
                                                class="bg-green-500 hover:bg-green-600 text-sm py-1 px-3 rounded-lg"
                                                type='button'>
                                                <i class="fa-solid fa-cloud-arrow-down pr-1"></i>
                                                บันทึก
                                            </button>
                                        </div>
                                    </div>
                                    <?php
                                        $sql = "SELECT COUNT(*) FROM ticket ";
                                        $result = $dbcon->query($sql);
                                        $row = $result->fetch_row();
                                        echo $row[0];
                                        $job_total = $row[0];
                                    ?>
                                    <?php
                                        $sql = "SELECT COUNT(*) FROM ticket WHERE job_status = 'waiting'";
                                        $result = $dbcon->query($sql);
                                        $row = $result->fetch_row();
                                        echo $row[0];
                                        $job_waiting = $row[0];
                                    ?>
                                    <?php
                                        $sql = "SELECT COUNT(*) FROM ticket WHERE job_status = 'pending'";
                                        $result = $dbcon->query($sql);
                                        $row = $result->fetch_row();
                                        echo $row[0];
                                        $job_pending = $row[0];
                                    ?>
                                    <?php
                                        $sql = "SELECT COUNT(*) FROM ticket WHERE job_status = 'success'";
                                        $result = $dbcon->query($sql);
                                        $row = $result->fetch_row();
                                        echo $row[0];
                                        $job_success = $row[0];
                                    ?>
                                    <canvas id="pie-chart2" class="text-white"></canvas>
                                    <script>
                                    var ctx = document.getElementById('pie-chart2').getContext('2d');
                                    var role3 = new Chart(ctx, {
                                        type: 'pie',
                                        data: {
                                            labels: ['การแจ้งซ่อมสถานะรอ [<?php echo "$job_waiting" ?>]',
                                                'การแจ้งซ่อมสถานะกำลังดำเนินการ [<?php echo "$job_pending" ?>]',
                                                'การแจ้งซ่อมสถานะเสร็จแล้ว [<?php echo "$job_success" ?>]'
                                            ],


                                            datasets: [{
                                                label: '# of Users',
                                                data: [<?php echo "$job_waiting" ?>,
                                                    <?php echo "$job_pending" ?>,
                                                    <?php echo "$job_success" ?>
                                                ],
                                                backgroundColor: [

                                                    'rgba(75, 192, 192, 1)',
                                                    'rgba(153, 102, 255, 1)',
                                                    'rgba(255, 206, 86, 1)'
                                                ],
                                                borderColor: [

                                                    'rgba(75, 192, 192, 1)',
                                                    'rgba(153, 102, 255, 1)',
                                                    'rgba(255, 206, 86, 1)'
                                                ],
                                            }]
                                        },
                                        options: {
                                            legend: {
                                                labels: {
                                                    fontColor: '#000000'
                                                }
                                            }
                                        }
                                    });
                                    //Fucntion Export PNG
                                    const btnDownload2 = document.querySelector('#btnDownload2');
                                    const myCanvas2 = document.querySelector('#pie-chart2');
                                    btnDownload2.addEventListener("click", function() {
                                        console.log('click')
                                        if (window.navigator.msSaveBlob) {
                                            window.navigator.msSaveBlob(myCanvas2.msSaveBlob(), "jobs.png");
                                        } else {
                                            const a = document.createElement("a");
                                            document.body.appendChild(a);
                                            a.href = myCanvas2.toDataURL();
                                            a.download = "jobs.png";
                                            a.click();
                                            document.body.removeChild(a);
                                        }
                                    });
                                    </script>
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