<?php
include 'sessionAndConnection.php';

if(!$czyZalogowany || $_SESSION["seeLog"] != 1){
    header("Location: index.php");
}
?>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
    <title>SecuritySystem - log</title>
    <meta name="description" content="Simple system for Security Company" />
    <meta property="og:image" content />
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
        <section style="width: 80%;margin: 0 auto;background-color:rgb(0,0,204,0.3);border-radius:25px;">
            <?php
                
                $id = $_GET["id"];
                $sql = "SELECT `logBook`.*, `receptions`.`Name`, `users`.`name` FROM `logBook` INNER JOIN `receptions` ON `receptions`.`id` = `logBook`.`where` INNER JOIN `users` ON `users`.`id` = `logBook`.`who` WHERE `logBook`.`id` = $id";
                //echo $sql;
                $query = mysqli_query($connect, $sql);

                while($row = $query->fetch_assoc()) {
                    echo '<div>
                    <h1 style="color: var(--bs-white);">Shift manager</h1>
                    <p style="color: var(--bs-white);">'.$row["name"].'</p>
                </div>
                <div>
                    <h1 style="color: var(--bs-white);">Shift date</h1>
                    <p style="color: var(--bs-white);">'.$row["when"].'</p>
                </div>
                <div>
                    <h1 style="color: var(--bs-white);">Shift place</h1>
                    <p style="color: var(--bs-white);">'.$row["Name"].'</p>
                </div>
                <div>
                    <h1 style="color: var(--bs-white);">Shift logs</h1>
                    <p style="color: var(--bs-white);">'. $row["log"]
                    .'</p>
                </div>';
                }
            ?>
        </section>
    </section>
    <footer class="page-footer" style="background: linear-gradient(#192734, #1e2244);color: rgb(255,255,255);">
        <div class="container">
            <div class="links"><a href="https://blazejczyk.net/" style="color: rgb(255,255,255);">My portfolio</a><a href="https://yellowsink.pl/privacypolicy.html" style="color: rgb(255,255,255);">Privacy Policy</a><a href="https://gubru.blazejczyk.net/CookiePolicy.pdf" style="color: rgb(255,255,255);">Cookie policy</a></div>
        </div>
    </footer>
</body>

</html>