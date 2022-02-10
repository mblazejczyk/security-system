<?php
include 'sessionAndConnection.php';

if(!$czyZalogowany){
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>SecuritySystem - notifications</title>
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

    <script>
        function show(a){
            document.getElementById(a).style.display = "block";
        }

        function close(a){
            document.getElementById(a).style.display = "none";
        }

        function edit(a){
            document.getElementById("editForm").style.display = "block";
            document.getElementById("ide").value = a;
        }
    </script>
</head>

<?php
            if(isset($_GET["remove"])){
                $RemId = $_GET["id"];
                
                $sql = "DELETE FROM `notifications` WHERE `id` = $RemId";
                $query = mysqli_query($connect, $sql);
                $url = strtok($_SERVER['REQUEST_URI'], '?');
                header("LOCATION: $url");
                echo '<script>alert("Notification removed!")</script>';

            }

            if(isset($_POST["subCreate"])){
                
                
                $name = $_POST["who"];
                $where = $_POST["where"];
                $des = $_POST["des"];
                $since = $_POST["since"];
                $till = $_POST["till"];


                $sql = "INSERT INTO `notifications` (`id`, `Guest`, `Where`, `Description`, `SinceWhen`, `TillWhen`) VALUES (NULL, '$name', '$where', '$des', '$since', '$till');";
                
                $query = mysqli_query($connect, $sql);
            }
        ?>

<body style="background: rgb(25,38,52);">
    <nav class="navbar navbar-dark navbar-expand-lg fixed-top bg-white portfolio-navbar gradient">
        <div class="container"><a class="navbar-brand logo" href="#" style="width: 257.2px;">Security System</a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navbarNav"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse text-center" id="navbarNav" style="height: 70px;text-align: center;width: auto;">
                <ul class="navbar-nav text-center">
                    <li class="nav-item"><a class="nav-link active" href="notifications.php" style="border-radius: 11px;border: 2px solid var(--bs-purple) ;">Notifications</a></li>
                    <li class="nav-item"><a class="nav-link" href="schedule.php" style="border-radius: 11px;border: 2px solid var(--bs-purple) ;">Schedule</a></li>
                    <li class="nav-item"><a class="nav-link" href="accounts.php" style="border-radius: 11px;border: 2px solid var(--bs-purple) ;">Account management</a></li>
                    <li class="nav-item"><a class="nav-link" href="receptions.php" style="border-radius: 11px;border: 2px solid var(--bs-purple) ;">Receptions managment</a></li>
                    <li class="nav-item"><a class="nav-link" href="logbook.php" style="border-radius: 11px;border: 2px solid var(--bs-purple) ;">Log book</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php" style="border-radius: 11px;border: 2px solid var(--bs-red) ;">Log out</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <section class="login-dark">
        <form method="post" style="height: auto;width: 90%;max-width: 90%;">
            <div class="illustration" style="height: 111px;justify-content: center;">
                <h1 style="/*float: right;*//*margin-top: 54px;*/">Notifications</h1>
            </div>
            <div class="mb-3">
                <input class="form-control" type="text" name="filterWho" placeholder="Who" style="width: 50%;float: left;" require>
                <select class="form-select form-control" name="filterPlace" style="width: 50%;color: rgb(132,132,132);">
                <?php
                        
                        $sql = "SELECT * FROM `receptions`";
                
                        $query = mysqli_query($connect, $sql);
        
                        while($row = $query->fetch_assoc()) {
                            echo ' <option value="'.$row["id"].'">'.$row["Name"].'</option>';
                        }
                ?>
                </select>
                <input class="form-control" type="date" name="filterDate" style="float: right;width: 100%;color: rgb(135,135,135);" require>
                <button class="btn btn-primary d-block w-100" name="filterSub" type="submit">Filter</button></div>
            <div>
            <?php
            if($_SESSION["manNot"] == 1){
                echo '<a href="#" onclick="show(`createForm`)"><i class="fa fa-plus" style="font-size: 24px;"></i>create new</a>';
            }
            ?>    
            
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr></tr>
                        </thead>
                        <tbody>
                            <tr style="color: rgb(197,197,197);">
                                <td>Who</td>
                                <td>Where</td>
                                <td>Description</td>
                                <td>Since when</td>
                                <td>Till when</td>
                                <td>Option</td>
                            </tr>

                            <?php
                                
                                $sql = "SELECT `notifications`.*, `receptions`.`Name` FROM `notifications` INNER JOIN `receptions` ON `notifications`.`Where` = `receptions`.`id`";

                                if(isset($_POST["filterSub"])){
                                    $who = $_POST["filterWho"];
                                    $when = $_POST["filterDate"];
                                    $where = $_POST["filterPlace"];

                                    

                                    if(empty($when)){
                                        $when = date("Y-m-d");
                                        
                                    }
                                    $sql = "SELECT `notifications`.*, `receptions`.`Name` FROM `notifications` INNER JOIN `receptions` ON `notifications`.`Where` = `receptions`.`id` WHERE `notifications`.`SinceWhen` <= '$when' AND `notifications`.`TillWhen` >= '$when' AND `notifications`.`Where` = $where AND `notifications`.`Guest` LIKE '%$who%'";
                                    
                                }
                                
                                if($_SESSION["seeNot"] != 1){
                                    echo '<tr><td style="color:white;" colspan="6">You do not have premissions to see notifications</td></tr>';
                                }else{
                                    $query = mysqli_query($connect, $sql);
                
                                    while($row = $query->fetch_assoc()) {
                                        echo '<tr style="color: rgb(197,197,197);">
                                        <td>'.$row["Guest"].'</td>
                                        <td>'.$row["Name"].'</td>
                                        <td>'.$row["Description"].'</td>
                                        <td>'.$row["SinceWhen"].'</td>
                                        <td>'.$row["TillWhen"].'</td>';

                                        if($_SESSION["manNot"] == 1){
                                            echo '<td><a href="notifications.php?remove=1&id='.$row["id"].'"><i class="fa fa-remove"></i></a></td>';
                                        }else{
                                            echo '<td></td>';
                                        }
                                        echo '</tr>';
                                    }
                                }
                                
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
        <form class="shadow-lg" id="createForm" method="post" style="height: auto;width: 90%;max-width: 90%;/*float: left;*/background: #4a0025; display: none;">
            <div class="illustration" style="height: 111px;justify-content: center;">
                <h1 style="/*float: right;*//*margin-top: 54px;*/">Add notification</h1>
            </div>
            <div>
                <input class="form-control" type="text" placeholder="Who" name="who" style="margin-left: 13px;">
                <label class="form-label" style="width: 100%;color: rgb(145,145,145);padding-left: 12px;">
                Where:<select class="form-select form-control" style="color: rgb(115,115,115);" name="where">
                <?php
                        
                        $sql = "SELECT * FROM `receptions`";
                
                        $query = mysqli_query($connect, $sql);
        
                        while($row = $query->fetch_assoc()) {
                            echo ' <option value="'.$row["id"].'">'.$row["Name"].'</option>';
                        }
                ?>
                    </select></label>
                <input class="form-control" type="text" name="des" placeholder="Description" style="margin-left: 11px;">
                <label class="form-label" style="width: 100%;color: rgb(156,156,156);padding-left: 16px;">
                    Since when - till when<br>
                    <input class="form-control" type="date" style="width: 50%;float: left;" name="since">
                    <input class="form-control" type="date" style="width: 50%;float: left;" name="till">
                </label>
                <div style="width: 100%;float: left;"><button class="btn btn-primary" name="subCreate" type="submit" style="margin-right: 23px;">Save</button><button class="btn btn-primary" onclick="close('createForm')">Cancel</button></div>
            </div>
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