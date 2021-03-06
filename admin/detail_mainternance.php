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
    <link rel="icon" href="../assets/icons/programmer.png" type="image/icon type">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js">
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
                                    class="fa-solid fa-screwdriver-wrench p-2"></i>????????????????????????????????????</span>
                        </div>
                    </div>

                    <nav class="flex flex-col mt-10 px-1">
                        <a href="./admin.php"
                            class=" py-2 px-6 text-sm text-gray-100 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-100 hover:bg-gray-200 dark:hover:bg-gray-800 rounded flex  items-center">
                            <i class="fa-solid fa-house-chimney-user pr-2 text-lg"></i>????????????????????????</a>
                        <a href="./alluser.php"
                            class="mt-3 py-2 px-6 text-sm text-gray-100 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-100 hover:bg-gray-200 dark:hover:bg-gray-800 rounded flex  items-center">
                            <i class="fa-solid fa-circle-info pr-2 text-lg"></i>????????????????????????????????????????????????</a>
                        <a href="./allmainternance.php"
                            class="mt-3 py-2 px-6 text-sm text-gray-700 bg-gray-200 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-100  hover:bg-gray-200 dark:hover:bg-gray-800 rounded flex  items-center">
                            <i class="fa-solid fa-clipboard-list pr-2 text-lg"></i>??????????????????????????????????????????????????????</a>
                        <a href="allitems.php"
                            class="mt-3 py-2 px-6 text-sm text-gray-100 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-100 hover:bg-gray-200 dark:hover:bg-gray-800 rounded flex  items-center">
                            <i class="fa-solid fa-store pr-2 text-lg"></i>?????????????????????/???????????????????????????</a>
                        <a href="allroom.php"
                            class="mt-3 py-2 px-6 text-sm text-gray-100 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-100 hover:bg-gray-200 dark:hover:bg-gray-800 rounded flex  items-center">
                            <i class="fa-solid fa-map-location-dot pr-2 text-lg"></i>???????????????????????????????????????????????????</a>
                        <a href="alldep.php"
                            class="mt-3 py-2 px-6 text-sm text-gray-100 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-100 hover:bg-gray-200 dark:hover:bg-gray-800 rounded flex  items-center">
                            <i class="fa-solid fa-rectangle-list pr-2 text-lg"></i>????????????
                        </a>
                        <a href="../logout.php"
                            class="mt-3 py-2 px-6 text-sm text-gray-100 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-100 hover:bg-gray-200 dark:hover:bg-gray-800 rounded flex  items-center">
                            <i class="fa-solid fa-arrow-right-from-bracket pr-2 text-lg"></i>??????????????????????????????</a>
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
                                        class="fa-solid fa-circle-info px-2"></i>????????????????????????????????????????????????????????????????????????
                                </h1>
                                <p class="text-sm text-gray-800 dark:text-white">
                                    ???????????????????????????????????????????????????????????????????????????????????????????????????????????????
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
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-600 hover:text-white">???????????????????????????????????????</a>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-600 hover:text-white">??????????????????????????????????????????????????????</a>
                                    <a href="../logout.php"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-600 hover:text-white">??????????????????????????????</a>
                                </div>
                            </div>
                        </div>
                    </header>

                    <main class="overflow-y-scroll py-10">
                        <div class="text-3xl text-gray-700 px-4">
                            <h1 class="text-3xl text-gray-700">???????????????????????????????????? ?????????
                                <?php echo " " . $_SESSION['name'] . " " ?>
                            </h1>
                            <h3 class="text-2xl text-gray-700">????????????
                                <?php echo " " . $_SESSION['department'] . " " ?>
                            </h3>
                        </div>
                        <div class="bg-white w-full">
                            <?php
                                $user_id = $_POST['user_id'];
                                $sql = "SELECT * FROM `users` WHERE user_id = '$user_id'";
                                $result = $dbcon->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {

                                        $id = $row["id"];
                                        $user_id = $row["user_id"];
                                        $username = $row["username"];
                                        $name = $row["name"];
                                        $lastname = $row["lastname"];
                                        $role = $row["role"];
                                        $dep = $row["dep"];
                                        $created_at = $row["created_at"];

                                    }
                                }
                            ?>
                            <?php
                                $sql = "SELECT COUNT(*) FROM ticket WHERE repairman_id = '$user_id'";
                                $result = $dbcon->query($sql);
                                $row = $result->fetch_row();
                                $jobtotal = $row[0];
                            ?>
                            <?php
                                $sql = "SELECT COUNT(*) FROM ticket WHERE repairman_id = '$user_id' AND job_status = 'pending'";
                                $result = $dbcon->query($sql);
                                $row = $result->fetch_row();
                                $jobpending = $row[0];
                            ?>
                            <div class="px-4 py-4 text-gray-700 text-sm font-bold">????????????????????????????????????????????????????????? :
                                <?php echo "$user_id" ?>
                            </div>
                            <div class=" px-4 py-1">
                                <div class=" flex justify-between pb-4">
                                    <div class="flex flex-col">
                                        <label for="exampleEmail11"
                                            class="text-gray-700 text-sm font-bold">?????????????????????????????????</label>
                                        <input name="text" id="exampleEmail11" placeholder="-" type="text"
                                            class="text-gray-700 text-sm bg-gray-200 w-48 px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-600"
                                            value="<?php echo "$user_id" ?>" disabled>
                                    </div>
                                    <div class="flex flex-col">
                                        <label for="examplePassword11"
                                            class="text-gray-700 text-sm font-bold">??????????????????????????????</label>
                                        <input name="text" id="examplePassword11" placeholder="-" type="text"
                                            class="text-gray-700 text-sm bg-gray-200 w-48 px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-600"
                                            value="<?php echo "$username" ?>" disabled>
                                    </div>
                                    <div class="flex flex-col">
                                        <label for="exampleEmail11"
                                            class="text-gray-700 text-sm font-bold">???????????????????????????????????????</label>
                                        <input name="text" id="exampleEmail11" placeholder="-" type="text"
                                            class="text-gray-700 text-sm bg-gray-200 w-48 px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-600"
                                            value="<?php echo "$name" ?>" disabled>
                                    </div>
                                    <div class="flex flex-col">
                                        <label for="examplePassword11"
                                            class="text-gray-700 text-sm  font-bold">?????????????????????</label>
                                        <input name="text" id="examplePassword11" placeholder="-" type="text"
                                            class="text-gray-700 text-sm bg-gray-200 w-48 px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-600"
                                            value="<?php echo "$lastname" ?>" disabled>
                                    </div>
                                </div>
                                <div class="flex pb-4 justify-between">
                                    <div class="flex flex-col">
                                        <label for="examplePassword11"
                                            class="text-gray-700 text-sm  font-bold">????????????</label>
                                        <input name="text" id="examplePassword11" placeholder="-" type="text"
                                            class="text-gray-700 text-sm bg-gray-200 w-48 px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-600"
                                            value="<?php echo "$dep" ?>" disabled>
                                    </div>
                                    <div class="flex flex-col">
                                        <label for="examplePassword11"
                                            class="text-gray-700 text-sm  font-bold">??????????????????????????????????????????????????????????????????</label>
                                        <input name="text" id="examplePassword11" placeholder="-" type="text"
                                            class="text-gray-700 text-sm bg-gray-200 w-48 px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-600"
                                            value="<?php echo "$created_at" ?>" disabled>
                                    </div>
                                    <div class="flex flex-col">
                                        <label for="examplePassword11"
                                            class="text-gray-700 text-sm  font-bold">?????????????????????????????????????????????????????????????????????</label>
                                        <input name="text" id="examplePassword11" placeholder="-" type="text"
                                            class="text-gray-700 text-sm bg-gray-200 w-48 px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-600"
                                            value="<?php echo "$jobtotal" ?>" disabled>
                                    </div>
                                    <div class="flex flex-col">
                                        <label for="examplePassword11"
                                            class="text-gray-700 text-sm  font-bold">??????????????????????????????????????????????????????????????????????????????????????????</label>
                                        <input name="text" id="examplePassword11" placeholder="-" type="text"
                                            class="text-gray-700 text-sm bg-gray-200 w-48 px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-600"
                                            value="<?php echo "$jobpending" ?>" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col bg-gray-200">
                                <div class=" flex justify-center m-4">
                                    <h class="text-base text-white bg-blue-500 rounded-md px-4 py-1 uppercase">
                                        ?????????????????????????????????????????????????????????????????????????????? ????????????:
                                        <?php echo "$name" ?>&nbsp;
                                        &nbsp;<?php echo "$lastname" ?>
                                    </h>
                                </div>
                                <div class="flex justify-around items-center">

                                    <!-- Chart 1 ?????????????????????????????????????????????????????? -->
                                    <div
                                        class=" px-6 py-6 bg-white w-5/12 h-auto text-sm text-white rounded-3xl border-gray-700 border-2 m-4">
                                        <div class="pb-4 px-2">
                                            <div class="flex justify-between items-center">
                                                <span class="text-gray-700"><i
                                                        class="fa-solid fa-chart-pie px-1"></i>??????????????????????????????????????????????????????</span>
                                                <button id="btnDownloadspeed"
                                                    class="bg-green-500 hover:bg-green-600 text-sm py-1 px-3 rounded-lg"
                                                    type='button'>
                                                    <i class="fa-solid fa-cloud-arrow-down pr-1"></i>
                                                    ??????????????????
                                                </button>
                                            </div>
                                            <?php
                                    $user_id = $_POST['user_id'];
                                    $sql = "SELECT * FROM `users` WHERE user_id = '$user_id'";
                                    $result = $dbcon->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $speed3 = $row['speed_3'];
                                            $speed2 = $row['speed_2'];
                                            $speed1 = $row['speed_1'];

                                            $perfect3 = $row['perfect_3'];
                                            $perfect2 = $row['perfect_2'];
                                            $perfect1 = $row['perfect_1'];

                                            $talk3 = $row['talk_3'];
                                            $talk2 = $row['talk_2'];
                                            $talk1 = $row['talk_1'];

                                            $guide3 = $row['guide_3'];
                                            $guide2 = $row['guide_2'];
                                            $guide1 = $row['guide_1'];
                                        }
                                    }
                                    ?>
                                        </div>
                                        <canvas id="speed" class="text-white"></canvas>
                                        <script>
                                        var ctx = document.getElementById('speed').getContext('2d');
                                        var speed_speed = new Chart(ctx, {
                                            type: 'pie',
                                            data: {
                                                labels: ['??????????????? [<?php echo "$speed3" ?>]',
                                                    '?????? [<?php echo "$speed2" ?>]',
                                                    '??????????????? [<?php echo "$speed1" ?>]'
                                                ],
                                                datasets: [{
                                                    label: '# of Users',
                                                    data: [<?php echo "$speed3" ?>,
                                                        <?php echo "$speed2" ?>,
                                                        <?php echo "$speed1" ?>
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
                                                    text: '??????????????????????????????????????????????????????'
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
                                        const btnDownloadspeed = document.querySelector('#btnDownloadspeed');
                                        const myCanvas2 = document.querySelector('#speed');
                                        btnDownloadspeed.addEventListener("click", function() {
                                            console.log('click')
                                            if (window.navigator.msSaveBlob) {
                                                window.navigator.msSaveBlob(myCanvas2.msSaveBlob(),
                                                    "speed.png");
                                            } else {
                                                const a = document.createElement("a");
                                                document.body.appendChild(a);
                                                a.href = myCanvas2.toDataURL();
                                                a.download = "speed.png";
                                                a.click();
                                                document.body.removeChild(a);
                                            }
                                        });
                                        </script>
                                    </div>

                                    <!-- chart 2 ????????????????????????????????????????????????????????????????????? -->
                                    <div
                                        class=" px-6 py-6 bg-white w-5/12 h-auto text-sm text-white rounded-3xl border-gray-700 border-2 m-4">
                                        <div class="pb-4 px-2">
                                            <div class="flex justify-between items-center">
                                                <span class="text-gray-700"><i
                                                        class="fa-solid fa-chart-pie px-1"></i>?????????????????????????????????????????????????????????????????????</span>
                                                <button id="btnDownloadper"
                                                    class="bg-green-500 hover:bg-green-600 text-sm py-1 px-3 rounded-lg"
                                                    type='button'>
                                                    <i class="fa-solid fa-cloud-arrow-down pr-1"></i>
                                                    ??????????????????
                                                </button>
                                            </div>
                                            <?php
                                    $user_id = $_POST['user_id'];
                                    $sql = "SELECT * FROM `users` WHERE user_id = '$user_id'";
                                    $result = $dbcon->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $speed3 = $row['speed_3'];
                                            $speed2 = $row['speed_2'];
                                            $speed1 = $row['speed_1'];

                                            $perfect3 = $row['perfect_3'];
                                            $perfect2 = $row['perfect_2'];
                                            $perfect1 = $row['perfect_1'];

                                            $talk3 = $row['talk_3'];
                                            $talk2 = $row['talk_2'];
                                            $talk1 = $row['talk_1'];

                                            $guide3 = $row['guide_3'];
                                            $guide2 = $row['guide_2'];
                                            $guide1 = $row['guide_1'];
                                        }
                                    }
                                    ?>
                                        </div>
                                        <canvas id="per" class="text-white"></canvas>
                                        <script>
                                        var ctx = document.getElementById('per').getContext('2d');
                                        var per_per = new Chart(ctx, {
                                            type: 'pie',
                                            data: {
                                                labels: ['??????????????? [<?php echo "$perfect3" ?>]',
                                                    '?????? [<?php echo "$perfect2" ?>]',
                                                    '??????????????? [<?php echo "$perfect1" ?>]'
                                                ],
                                                datasets: [{
                                                    label: '# of Users',
                                                    data: [<?php echo "$perfect3" ?>,
                                                        <?php echo "$perfect2" ?>,
                                                        <?php echo "$perfect1" ?>
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
                                                    text: '?????????????????????????????????????????????????????????????????????'
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
                                        const btnDownload = document.querySelector('#btnDownloadper');
                                        const myCanvas = document.querySelector('#speed');
                                        btnDownload.addEventListener("click", function() {
                                            console.log('click')
                                            if (window.navigator.msSaveBlob) {
                                                window.navigator.msSaveBlob(myCanvas.msSaveBlob(),
                                                    "perfect.png");
                                            } else {
                                                const a = document.createElement("a");
                                                document.body.appendChild(a);
                                                a.href = myCanvas.toDataURL();
                                                a.download = "speed.png";
                                                a.click();
                                                document.body.removeChild(a);
                                            }
                                        });
                                        </script>
                                    </div>
                                </div>
                                <div class="flex justify-around items-center">

                                    <!-- Chart 3 ????????????????????????????????????????????????????????????????????? -->
                                    <div
                                        class=" px-6 py-6 bg-white w-5/12 h-auto text-sm text-white rounded-3xl border-gray-700 border-2 m-4">
                                        <div class="pb-4 px-2">
                                            <div class="flex justify-between items-center">
                                                <span class="text-gray-700"><i
                                                        class="fa-solid fa-chart-pie px-1"></i>?????????????????????????????????????????????????????????????????????</span>
                                                <button id="btnDownloadtalk"
                                                    class="bg-green-500 hover:bg-green-600 text-sm py-1 px-3 rounded-lg"
                                                    type='button'>
                                                    <i class="fa-solid fa-cloud-arrow-down pr-1"></i>
                                                    ??????????????????
                                                </button>
                                            </div>
                                            <?php
                                    $user_id = $_POST['user_id'];
                                    $sql = "SELECT * FROM `users` WHERE user_id = '$user_id'";
                                    $result = $dbcon->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $speed3 = $row['speed_3'];
                                            $speed2 = $row['speed_2'];
                                            $speed1 = $row['speed_1'];

                                            $perfect3 = $row['perfect_3'];
                                            $perfect2 = $row['perfect_2'];
                                            $perfect1 = $row['perfect_1'];

                                            $talk3 = $row['talk_3'];
                                            $talk2 = $row['talk_2'];
                                            $talk1 = $row['talk_1'];

                                            $guide3 = $row['guide_3'];
                                            $guide2 = $row['guide_2'];
                                            $guide1 = $row['guide_1'];
                                        }
                                    }
                                    ?>
                                        </div>
                                        <canvas id="talk" class="text-white"></canvas>
                                        <script>
                                        var ctx = document.getElementById('talk').getContext('2d');
                                        var talk_talk = new Chart(ctx, {
                                            type: 'pie',
                                            data: {
                                                labels: ['??????????????? [<?php echo "$talk3" ?>]',
                                                    '?????? [<?php echo "$talk2" ?>]',
                                                    '??????????????? [<?php echo "$talk1" ?>]'
                                                ],
                                                datasets: [{
                                                    label: '# of Users',
                                                    data: [<?php echo "$talk3" ?>,
                                                        <?php echo "$talk2" ?>,
                                                        <?php echo "$talk1" ?>
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
                                        const btnDownloadtalk = document.querySelector('#btnDownloadtalk');
                                        const myCanvastalk = document.querySelector('#talk');
                                        btnDownloadtalk.addEventListener("click", function() {
                                            console.log('click')
                                            if (window.navigator.msSaveBlob) {
                                                window.navigator.msSaveBlob(myCanvastalk.msSaveBlob(),
                                                    "talk.png");
                                            } else {
                                                const a = document.createElement("a");
                                                document.body.appendChild(a);
                                                a.href = myCanvastalk.toDataURL();
                                                a.download = "talk.png";
                                                a.click();
                                                document.body.removeChild(a);
                                            }
                                        });
                                        </script>
                                    </div>

                                    <!-- chart 4 ???????????????????????????????????????????????????????????????????????????????????????????????????????????? -->
                                    <div
                                        class=" px-6 py-6 bg-white w-5/12 h-auto text-sm text-white rounded-3xl border-gray-700 border-2 m-4">
                                        <div class="pb-4 px-2">
                                            <div class="flex justify-between items-center">
                                                <span class="text-gray-700 "><i
                                                        class="fa-solid fa-chart-pie px-1"></i>???????????????????????????????????????????????????????????????????????????
                                                </span>
                                                <button id="btnDownloadguide"
                                                    class="bg-green-500 hover:bg-green-600 text-sm py-1 px-3 rounded-lg"
                                                    type='button'>
                                                    <i class="fa-solid fa-cloud-arrow-down pr-1"></i>
                                                    ??????????????????
                                                </button>
                                            </div>
                                            <?php
                                    $user_id = $_POST['user_id'];
                                    $sql = "SELECT * FROM `users` WHERE user_id = '$user_id'";
                                    $result = $dbcon->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $speed3 = $row['speed_3'];
                                            $speed2 = $row['speed_2'];
                                            $speed1 = $row['speed_1'];

                                            $perfect3 = $row['perfect_3'];
                                            $perfect2 = $row['perfect_2'];
                                            $perfect1 = $row['perfect_1'];

                                            $talk3 = $row['talk_3'];
                                            $talk2 = $row['talk_2'];
                                            $talk1 = $row['talk_1'];

                                            $guide3 = $row['guide_3'];
                                            $guide2 = $row['guide_2'];
                                            $guide1 = $row['guide_1'];
                                        }
                                    }
                                    ?>
                                        </div>
                                        <canvas id="guide" class="text-white"></canvas>
                                        <script>
                                        var ctx = document.getElementById('guide').getContext('2d');
                                        var guide_guide = new Chart(ctx, {
                                            type: 'pie',
                                            data: {
                                                labels: ['??????????????? [<?php echo "$guide3" ?>]',
                                                    '?????? [<?php echo "$guide2" ?>]',
                                                    '??????????????? [<?php echo "$guide1" ?>]'
                                                ],
                                                datasets: [{
                                                    label: '# of Users',
                                                    data: [<?php echo "$guide3" ?>,
                                                        <?php echo "$guide2" ?>,
                                                        <?php echo "$guide1" ?>
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
                                                    text: '???????????????????????????????????????, ????????????????????????????????????????????????????????? ????????????????????????????????????????????????????????????????????? '
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
                                        const btnDownloadguide = document.querySelector('#btnDownloadguide');
                                        const myCanvasguide = document.querySelector('#guide');
                                        btnDownloadtalk.addEventListener("click", function() {
                                            console.log('click')
                                            if (window.navigator.msSaveBlob) {
                                                window.navigator.msSaveBlob(myCanvasguide.msSaveBlob(),
                                                    "guide.png");
                                            } else {
                                                const a = document.createElement("a");
                                                document.body.appendChild(a);
                                                a.href = myCanvasguide.toDataURL();
                                                a.download = "guide.png";
                                                a.click();
                                                document.body.removeChild(a);
                                            }
                                        });
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="py-4 px-4 m-5">
                            <button class="bg-green-500 text-base hover:bg-green-700 text-white py-2 px-8 rounded-full"
                                onclick="history.back()">
                                ????????????????????????
                            </button>
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </div>
</body>


</html>