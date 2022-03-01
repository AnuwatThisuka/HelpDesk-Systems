<!DOCTYPE html>
<html lang="en">

<head>
    <title>HelpDesk Systems</title>
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

$jobid = $_POST['id'];
$repairman = $_SESSION['name'];
$repairman_id = $_SESSION['user_id'];

$query = "UPDATE ticket SET repairman = '$repairman', repairman_id = '$repairman_id', job_status = 'pending', pending_at = NOW() WHERE id = $jobid";
$result = mysqli_query($dbcon, $query);

if ($result) {

    // LINE NOTIFICATION START
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    date_default_timezone_set("Asia/Bangkok");
    $date = date("Y-m-d H:i:s");
    
    $sToken = "";
    
    $sMessage = "แจ้งเตือนการแจ้งซ่อม
$repairman ได้รับงานการแจ้งซ่อม
รหัสการแจ้งซ่อม: $jobid
สถานะของการแจ้งซ่อม: กำลังดำเนินการ
เวลา: $date"; 

    $chOne = curl_init();
    curl_setopt($chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
    curl_setopt($chOne, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($chOne, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($chOne, CURLOPT_POST, 1);
    curl_setopt($chOne, CURLOPT_POSTFIELDS, "message=" . $sMessage);
    $headers = array('Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer ' . $sToken . '',);
    curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($chOne, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($chOne);

    //Result error 
    if (curl_error($chOne)) {
        echo 'error:' . curl_error($chOne);
    }
    curl_close($chOne);
    // LINE NOTIFICATION STOP

    echo "<script type='text/javascript'>
            swal('เรียบร้อย','คุณได้รับงานซ่อมเรียบ', 'success')
            .then((value) => {
            window.location.href='mainternance.php';
            });
          </script>
          
          ";
} else {
    echo "เกิดข้อผิดพลาด " . mysqli_error($dbcon);
}

mysqli_close($dbcon);
?>
</body>

</html>