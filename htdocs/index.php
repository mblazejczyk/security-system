<?php
   ob_start();
   ini_set('session.gc_maxlifetime', 900);
   session_set_cookie_params(900);
   session_start();
   $czyZalogowany = isset($_SESSION["login"]);
   if($czyZalogowany){
      header("Location: notifications.php");
   }
   echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';

   if(isset($_POST["loginForm"])){
    $connect = mysqli_connect("localhost", "root", "", "securitysystem");

    if($connect === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    $login = $_POST["login"];
    $sql = "SELECT * FROM `users` WHERE `login` = '$login'";

    $query = mysqli_query($connect, $sql);

    if(mysqli_num_rows($query) > 0){

    

        while($row = $query->fetch_assoc()) {
                $pass = password_verify($_POST['password'], $row["password"]);
                
                if($pass == true ) {
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


                header("Location: notifications.php");
                }else {
                echo '<script>alert("Login or password is incorrect")</script>';
                }
        }
    }else{
        echo '<script>alert("Login or password is incorrect")</script>';
    }
    
   }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>SecuritySystem</title>
    <meta name="description" content="Simple system for Security Company">
    <meta property="og:image" content="">
    <link rel="icon" type="image/png" sizes="64x64" href="assets/img/securitySystemIcon.png">
    <link rel="icon" type="image/png" sizes="64x64" href="assets/img/securitySystemIcon.png">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300,400,700">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.1/css/pikaday.min.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Dark.css">
</head>

<body>
    <section class="login-dark" style="height: 762px;">
        <form method="post" style="height: 452.2px;">
            <h2 class="visually-hidden">Login Form</h2>
            <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
            <div class="mb-3"><input class="form-control" type="text" name="login" placeholder="Login"></div>
            <div class="mb-3"><input class="form-control" type="password" name="password" placeholder="Password"></div>
            <div class="mb-3"><button class="btn btn-primary d-block w-100" name="loginForm" type="submit">Log In</button></div>
        </form>
    </section>
    <footer class="page-footer" style="background: linear-gradient(#192734, #1e2244);color: rgb(255,255,255);">
        <div class="container">
            <div class="links"><a href="https://blazejczyk.net/" style="color: rgb(255,255,255);">My portfolio</a><a href="https://yellowsink.pl/privacypolicy.html" style="color: rgb(255,255,255);">Privacy Policy</a><a href="https://gubru.blazejczyk.net/CookiePolicy.pdf" style="color: rgb(255,255,255);">Cookie policy</a></div>
        </div>
    </footer>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.1/pikaday.min.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>