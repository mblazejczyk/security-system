<?php
include 'sessionAndConnection.php';

if(!$czyZalogowany || $_SESSION["schAcc"] != 1){
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>SecuritySystem - Schedule</title>
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
                
                $sql = "DELETE FROM `schedule` WHERE `id` = $RemId";
                $query = mysqli_query($connect, $sql);
                $url = strtok($_SERVER['REQUEST_URI'], '?');
                header("LOCATION: $url");
                echo '<script>alert("Shift removed!")</script>';

            }

            if(isset($_POST["subCreate"])){
                
                
                $shiftStart = $_POST["startShift"];
                $shiftEnd = $_POST["endShift"];
                $Where = $_POST["Where"];
                $Whom = $_POST["forWhom"];

                $sql = "INSERT INTO `schedule` (`id`, `StartShift`, `EndShift`, `Where`, `Who`) VALUES (NULL, '$shiftStart', '$shiftEnd', '$Where', '$Whom');";
                echo $sql;
                $query = mysqli_query($connect, $sql);
            }
        ?>

<body style="background: rgb(27,36,60);">
    <nav class="navbar navbar-dark navbar-expand-lg fixed-top bg-white portfolio-navbar gradient">
        <div class="container"><a class="navbar-brand logo" href="#" style="width: 257.2px;">Security System</a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navbarNav"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse text-center" id="navbarNav" style="height: 70px;text-align: center;width: auto;">
                <ul class="navbar-nav text-center">
                    <li class="nav-item"><a class="nav-link" href="notifications.php" style="border-radius: 11px;border: 2px solid var(--bs-purple) ;">Notifications</a></li>
                    <li class="nav-item"><a class="nav-link active" href="schedule.php" style="border-radius: 11px;border: 2px solid var(--bs-purple) ;">Schedule</a></li>
                    <li class="nav-item"><a class="nav-link" href="accounts.php" style="border-radius: 11px;border: 2px solid var(--bs-purple) ;">Account management</a></li>
                    <li class="nav-item"><a class="nav-link" href="receptions.php" style="border-radius: 11px;border: 2px solid var(--bs-purple) ;">Receptions managment</a></li>
                    <li class="nav-item"><a class="nav-link" href="logbook.php" style="border-radius: 11px;border: 2px solid var(--bs-purple) ;">Log book</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php" style="border-radius: 11px;border: 2px solid var(--bs-red) ;">Log out</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <section class="login-dark" style="height: auto;min-height: 600px;">
        <div style="background: rgb(30,40,51);padding: 40px;height: auto;width: 90%;margin: 5%;">
            <div class="illustration" style="height: 114px;justify-content: center;margin-top: 47px;">
                <h1 style="/*float: right;*//*margin-top: 54px;*/">Schedule</h1>
            </div>
            <div class="illustration" style="height: 114px;justify-content: center;">
                <form class="shadow-none" method="post" style="width: 100%;margin: 0px;height: 114px;position: relative;"><input name="monthForm" class="form-control" type="month" style="margin-top: -18px;padding-top: 0px;padding-right: 0px;padding-bottom: 0px;padding-left: 0px;"><button class="btn btn-primary" type="submit" style="margin-top: -115px;padding: 11px;padding-top: 11px;width: 100%;">Filter</button></form>
            </div>
            <div>
                <?php
                if($_SESSION["schMan"] == 1){
                    echo '<a href="#" onclick="show(`createForm`)"><i class="fa fa-plus" style="font-size: 24px;"></i>add shift</a>';
                    
                }
                ?>
                


                <div class="table-responsive" style="color: rgb(255,255,255);">
                    <table class="table">
                        <thead style="color: var(--bs-white);">
                            <tr style="color: var(--bs-white);">
                                <th>Who</th>
                                <?php
                                    for($x = 1; $x < 32; $x++){
                                        echo '<td>'.$x.'</td>';
                                    }
                                ?>
                            </tr>
                        </thead>
                        <tbody style="color: var(--bs-gray-200);">
                        <?php
                                
                        
                
                                $lastWho = '';
                                $lastDay = date('Y-m-00');
                                $lastMonthDay = date("Y-m-t")." 23:59:59";
                                $sql = "SELECT `schedule`.*, `receptions`.`Name`, `users`.`name` FROM `schedule` INNER JOIN `receptions` ON `receptions`.`id` = `schedule`.`where` INNER JOIN `users` ON `users`.`id` = `schedule`.`Who` WHERE `schedule`.`StartShift` >= '$lastDay' AND `schedule`.`StartShift` <= '$lastMonthDay' ORDER BY `schedule`.`Who` ASC, `schedule`.`StartShift` ASC;";


                                if(isset($_POST["monthForm"])){
                                    $lastDay = $_POST["monthForm"]."-00";
                                    $lastMonthDay = date("Y-m-t", strtotime($_POST["monthForm"]."-01"))." 23:59:59";
                                    $sql = "SELECT `schedule`.*, `receptions`.`Name`, `users`.`name` FROM `schedule` INNER JOIN `receptions` ON `receptions`.`id` = `schedule`.`where` INNER JOIN `users` ON `users`.`id` = `schedule`.`Who` WHERE `schedule`.`StartShift` >= '$lastDay' AND `schedule`.`StartShift` <= '$lastMonthDay' ORDER BY `schedule`.`Who` ASC, `schedule`.`StartShift` ASC;";
                                    //echo $sql;
                                }
                                $query = mysqli_query($connect, $sql);
                                while($row = $query->fetch_assoc()) {
                                    $sameDay = 0;

                                    if($row["Who"] != $lastWho){
                                        $lastWho = $row["Who"];
                                        echo '<tr style="color: rgb(197,197,197);">
                                        <td>'.$row["name"].'</td>';
                                    }


                                    $temp = explode(' ', $row["StartShift"]);
                                    $diff = strtotime($temp[0]) - strtotime($lastDay);
                                    $dayDif = abs(round($diff / 86400));
                                    if($lastDay == $temp[0]){
                                        $sameDay = 1;
                                    }else{
                                        echo '</td>';
                                    }
                                    $lastDay = $temp[0];
                                    for($x = 0; $x < $dayDif - 1; $x++){
                                        echo '<td></td>';
                                    }

                                    $startShift = explode(':', $temp[1]);
                                    $temp1 = explode(' ', $row["EndShift"]);
                                    $endShift = explode(':', $temp1[1]);

                                    if($sameDay == 1){
                                        echo '<div style="background-color: darkblue; color: white; border-width: 1px; border-radius: 15px; border-style: solid;opacity: 0.7;">('.$startShift[0].':'.$startShift[1].' - '.$endShift[0].':'.$endShift[1].') '.$row["Name"].'<a style="color:red;" href="schedule.php?remove=1&id='.$row["id"].'">(Remove)</a></div>';

                                        if($_SESSION["schMan"] == 1){
                                            echo '<a style="color:red;" href="schedule.php?remove=1&id='.$row["id"].'">(Remove)</a>';
                                        }
                                        echo '</div>';

                                    }else{
                                        echo '<td><div style="background-color: darkblue; color: white; border-width: 1px; border-radius: 15px; border-style: solid;opacity: 0.7;">('.$startShift[0].':'.$startShift[1].' - '.$endShift[0].':'.$endShift[1].') '.$row["Name"].'';

                                        if($_SESSION["schMan"] == 1){
                                            echo '<a style="color:red;" href="schedule.php?remove=1&id='.$row["id"].'">(Remove)</a>';
                                        }
                                        echo '</div>';
                                    }

                                    if($row["Who"] != $lastWho){
                                        
                                        echo '</tr>';
                                    }
                                }
                                
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <form class="shadow-lg" id="createForm" method="post" style="height: auto;width: 90%;max-width: 90%;/*float: left;*/background: #4a0025; display: none;">
            <div class="illustration" style="height: 111px;justify-content: center;">
                <h1 style="/*float: right;*//*margin-top: 54px;*/">Create new shift</h1>
            </div>
            <div><label class="form-label" style="width: 100%;">Start shift - end shift<br><input name="startShift" class="form-control" type="datetime-local" style="width: 50%;float: left;"><input name="endShift" class="form-control" type="datetime-local" style="width: 50%;float: left;"></label>
            <label class="form-label" style="width: 100%;">
            Where<select name="Where" class="form-select form-control" style="color: rgb(143,143,143);">
                <?php
                        
                        $sql = "SELECT * FROM `receptions`";
                
                        $query = mysqli_query($connect, $sql);
        
                        while($row = $query->fetch_assoc()) {
                            echo ' <option value="'.$row["id"].'">'.$row["Name"].'</option>';
                        }
                ?>
                    </select></label>
                    
                    <label class="form-label" style="width: 100%;">Who
                    <select name="forWhom" class="form-select form-control" style="color: rgb(143,143,143);">
                    <?php
                        
                        $sql = "SELECT * FROM `users`";
                
                        $query = mysqli_query($connect, $sql);
        
                        while($row = $query->fetch_assoc()) {
                            echo '<option value="'.$row["id"].'">'.$row["name"].'</option>';
                        }
                    ?>
                    </select></label><button class="btn btn-primary" name="subCreate" type="submit" style="margin-right: 23px;">Save</button><button class="btn btn-primary" onclick="close('createForm')">Cancel</button></div>
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