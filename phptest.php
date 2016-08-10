<?php

$con = mysqli_connect('localhost', 'sa', '123456', 'calendardb');
mysqli_query($con, "set names 'utf8'");
if (!$con) {
    die('Could not connect: ' . mysqli_error());
}

$sql = "SELECT * FROM `project`";
$result = mysqli_query($con, $sql);
if ($result) {

    $pics = array();
    $i = 0;
    while ($row = mysqli_fetch_row($result)) {
        $pics[$i] = $row;
        $i++;
    }
    echo json_encode($pics);
}
mysqli_close($con);
?>