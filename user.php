<?php

$username = "";
$username = $_GET['username'];
$password = "";
$password = $_GET['password'];
$con = mysqli_connect('localhost', 'sa', '123456', 'calendardb');
mysqli_query($con, "set names 'utf8'");
$para = "";
if (!$con) {
    die('Could not connect: ' . mysqli_error());
}
$sql = "SELECT * FROM `user` where name='" . $username . "' and password='" . $password . "'";
$result = mysqli_query($con, $sql);
if ($result != null) {
    session_start(); //标志Session的开始     
    while ($row = mysqli_fetch_row($result)) {
        $_SESSION['id'] = $row[0];
        $_SESSION['department'] = $row[4];
        $_SESSION['role'] = $row[5];
//        $para.=$row[0] . ',' . $row[1] . ',' . $row[2] . ',' . $row[3] . ',' . $row[4] . ',' . $row[5] . "";
        $para = implode(",", $row);
    }
}
mysqli_close($con);
echo $para;
?>