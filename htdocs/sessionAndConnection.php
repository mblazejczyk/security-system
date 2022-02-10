<?php
ob_start();
ini_set('session.gc_maxlifetime', 900);
session_set_cookie_params(900);
session_start();
$czyZalogowany = isset($_SESSION["login"]);

$connect = mysqli_connect("localhost", "root", "", "securitysystem");
$tempLoginId = $_SESSION["id"];
$sql = "SELECT * FROM `users` WHERE `id` = '$tempLoginId'";
$query = mysqli_query($connect, $sql);

if(mysqli_num_rows($query) > 0){
    while($row = $query->fetch_assoc()) {                
        $_SESSION["login"] = $row["login"];
        $_SESSION["seeNot"] = $row["seeNot"];
        $_SESSION["manNot"] = $row["manNot"];
        $_SESSION["manAcc"] = $row["manAcc"];
        $_SESSION["manRec"] = $row["manRec"];
        $_SESSION["manLog"] = $row["manLog"];
        $_SESSION["seeLog"] = $row["seeLog"];
        $_SESSION["schAcc"] = $row["schAcc"];
        $_SESSION["schMan"] = $row["schMan"];
        $_SESSION["id"] = $row["id"];
    }
}
?>