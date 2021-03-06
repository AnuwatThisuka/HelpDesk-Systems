<?php

require '../connect.php';

session_start();

// if login yet
if (!isset($_SESSION['id'])) {
    header("Location: form_login.php");
}
if ($_SESSION['role'] != 'member') {
    header("Location: admin.php");
}

?>
<!doctype html>
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
                        <a href="./main.php"
                            class="py-2 text-sm px-6 text-gray-100 hover:bg-gray-200 dark:text-gray-100 hover:text-gray-700 dark:bg-gray-800 rounded">
                            <i class="fa-solid fa-house-chimney-user px-2 text-lg"></i>????????????????????????</a>
                        <a href="./form_ticket.php"
                            class="mt-3 py-2 px-6 text-sm text-gray-700 bg-gray-200 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-100  hover:bg-gray-200 dark:hover:bg-gray-800 rounded">
                            <i class="fa-solid fa-circle-exclamation px-2 text-lg"></i>???????????????????????????</a>
                        <a href="./waiting_tick.php"
                            class="mt-3 py-2 px-6 text-sm text-gray-100 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-100 hover:bg-gray-200 dark:hover:bg-gray-800 rounded">
                            <i class="fa-solid fa-wrench px-2 text-lg"></i>??????????????????????????????????????????????????????????????????????????????????????????</a>
                        <a href="success_tick.php"
                            class="mt-3 py-2 px-6 text-sm text-gray-100 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-100 hover:bg-gray-200 dark:hover:bg-gray-800 rounded">
                            <i class="fa-solid fa-circle-check px-2 text-lg"></i>??????????????????????????????????????????????????????????????????????????????</a>
                        <a href="all_tick.php"
                            class="mt-3 py-2 px-6 text-sm text-gray-100 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-100 hover:bg-gray-200 dark:hover:bg-gray-800 rounded">
                            <i class="fa-solid fa-clipboard-list px-2 text-lg"></i>?????????????????????????????????????????????</a>
                        <a href="detailrate.php"
                            class="mt-3 py-2 px-6 text-sm text-gray-100 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-100 hover:bg-gray-200 dark:hover:bg-gray-800 rounded">
                            <i class="fa-solid fa-rectangle-list px-2 text-lg"></i>????????????????????????????????????????????????????????????????????????
                        </a>
                        <a href="../logout.php"
                            class="mt-3 py-2 px-6 text-sm text-gray-100 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-100 hover:bg-gray-200 dark:hover:bg-gray-800 rounded"><i
                                class="fa-solid fa-arrow-right-from-bracket px-2 text-lg"></i>??????????????????????????????</a>
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
                                        class="fa-solid fa-circle-exclamation px-2"></i>???????????????????????????????????????</h1>
                                <p class="text-sm text-gray-800 dark:text-white">
                                    ?????????????????????????????????????????????????????? ??????????????????????????????????????????????????????????????????????????????????????????
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
                            <h1 class="text-3xl text-gray-700 uppercase">???????????????????????????????????? ?????????
                                <?php echo " " . $_SESSION['name'] . " " ?>
                            </h1>
                            <h3 class="text-2xl text-gray-700 uppercase">????????????
                                <?php echo " " . $_SESSION['department'] . " " ?>
                            </h3>
                        </div>
                        <form name="frmlogin" method="post" action="ticket.php">
                            <div class=" bg-gray-200 container mx-auto px-4 py-4 ">
                                <div class="bg-white w-full rounded-xl">
                                    <h1 class="px-4 py-6 text-gray-200 text-base bg-blue-600 font-bold"><i
                                            class="fa-solid fa-circle-exclamation px-2 text-lg"></i>????????????????????????
                                    </h1>
                                    <div class="p-4 flex items-center justify-between">
                                        <label for="exampleSelect" class="text-gray-700 text-sm font-bold">???????????? :
                                        </label>
                                        <div class=" w-4/5 flex items-center">
                                            <select name="room" from="frmlogin" required class=" text-gray-700 bg-white w-full px-4 py-2 mt-2 border
                                            rounded-md focus:outline-none focus:ring-1 text-sm focus:ring-blue-600 ">
                                                <option disabled selected value class="text-gray-700 text-base"> --
                                                    ??????????????????????????? --
                                                </option>
                                                <?php
                                            $sql = "SELECT room_name FROM location";
                                            $result = $dbcon->query($sql);
                                            while ($rows = $result->fetch_assoc()) {
                                                $room_name = $rows['room_name'];
                                                echo "<option value='$room_name'>$room_name</option>";
                                            }
                                            ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="p-4 flex items-center justify-between">
                                        <label for="exampleSelect" class="text-gray-700 text-sm font-bold">????????????????????? :
                                        </label>
                                        <div class=" w-4/5 flex items-center">
                                            <select name="item" from="frmlogin" required class=" text-gray-700 bg-white w-full px-4 py-2 mt-2 border
                                            rounded-md focus:outline-none focus:ring-1 text-sm focus:ring-blue-600">
                                                <option disabled selected value class="text-gray-700 text-base"> --
                                                    ????????????????????????????????????
                                                    --
                                                </option>
                                                <?php
                                            $sql = "SELECT item_name FROM items";
                                            $result = $dbcon->query($sql);
                                            while ($rows = $result->fetch_assoc()) {
                                                $item_name = $rows['item_name'];
                                                echo "<option value='$item_name'>$item_name</option>";
                                            }
                                            ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="p-4 flex items-center justify-between">
                                        <label for="exampleEmail" class="text-gray-700 text-sm font-bold">??????????????????????????????????????????
                                            :
                                        </label>
                                        <div class="w-4/5">
                                            <input name="serial_num" required id="exampleEmail"
                                                placeholder="??????????????????????????????????????????????????????" type="text" class="text-sm text-gray-700 bg-white w-full px-4 py-2 mt-2 border
                                            rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                                        </div>
                                    </div>
                                    <div class="p-4 flex items-center justify-between">
                                        <label for="exampleText" class="text-gray-700 text-sm font-bold">?????????????????????????????? :
                                        </label>
                                        <div class="text-sm text-gray-700 bg-white mt-2 border
                                            rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600 h-24 w-4/5">
                                            <textarea name="detail" required id="exampleText"
                                                class="w-full h-full p-2"></textarea>
                                        </div>
                                    </div>
                                    <div class="py-5 flex justify-center items-center">
                                        <button onclick="JSalert()" type="submit"
                                            class="bg-green-500 hover:bg-green-700 text-base text-white py-2 px-8 rounded-full">
                                            ??????????????????
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </main>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
