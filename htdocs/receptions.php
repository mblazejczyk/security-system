<?php
include 'sessionAndConnection.php';

if(!$czyZalogowany || $_SESSION["manRec"] != 1){
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>SecuritySystem - Receptions</title>
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
                
                $sql = "DELETE FROM `receptions` WHERE `id` = $RemId";
                $query = mysqli_query($connect, $sql);
                $url = strtok($_SERVER['REQUEST_URI'], '?');
                header("LOCATION: $url");
                echo '<script>alert("place removed!")</script>';            }

            if(isset($_POST["editSub"])){
                
                
                $id = $_POST["id"];
                $name = $_POST["name"];

                $sql = "UPDATE `receptions` SET `Name` = '$name' WHERE `id` = $id";
                
                $query = mysqli_query($connect, $sql);
            }

            if(isset($_POST["createSub"])){
                
                
                $name = $_POST["name"];

                $sql = "INSERT INTO `receptions` (`id`, `Name`) VALUES (NULL, '$name')";
                
                $query = mysqli_query($connect, $sql);
            }
        ?>

<body style="background: rgb(25,38,52);">
    <nav class="navbar navbar-dark navbar-expand-lg fixed-top bg-white portfolio-navbar gradient">
        <div class="container"><a class="navbar-brand logo" href="#" style="width: 257.2px;">Security System</a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navbarNav"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse text-center" id="navbarNav" style="height: 70px;text-align: center;width: auto;">
                <ul class="navbar-nav text-center">
                    <li class="nav-item"><a class="nav-link" href="notifications.php" style="border-radius: 11px;border: 2px solid var(--bs-purple) ;">Notifications</a></li>
                    <li class="nav-item"><a class="nav-link" href="schedule.php" style="border-radius: 11px;border: 2px solid var(--bs-purple) ;">Schedule</a></li>
                    <li class="nav-item"><a class="nav-link" href="accounts.php" style="border-radius: 11px;border: 2px solid var(--bs-purple) ;">Account management</a></li>
                    <li class="nav-item"><a class="nav-link active" href="receptions.php" style="border-radius: 11px;border: 2px solid var(--bs-purple) ;">Receptions managment</a></li>
                    <li class="nav-item"><a class="nav-link" href="logbook.php" style="border-radius: 11px;border: 2px solid var(--bs-purple) ;">Log book</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php" style="border-radius: 11px;border: 2px solid var(--bs-red) ;">Log out</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <section class="login-dark" style="height: auto;min-height: 600px;">
        <div style="background: rgb(30,40,51);padding: 40px;height: auto;width: 90%;margin: 5%;">
            <div class="illustration" style="height: 114px;justify-content: center;margin-top: 47px;">
                <h1 style="/*float: right;*//*margin-top: 54px;*/">Receptions</h1>
            </div>
            <div><a href="#" onclick="show('createForm')"><i class="fa fa-plus" style="font-size: 24px;"></i>create new</a>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr></tr>
                        </thead>
                        <tbody>
                            <tr style="color: rgb(197,197,197);">
                                <td>Name</td>
                                <td>Actions</td>
                            </tr>

                            <?php
                                
                                $sql = "SELECT * FROM `receptions`";
                        
                                $query = mysqli_query($connect, $sql);
                
                                while($row = $query->fetch_assoc()) {
                                    echo '<tr style="color: rgb(197,197,197);">
                                        <td>'.$row["Name"].'</td>
                                        <td>
                                        <a href="receptions.php?remove=1&id='.$row["id"].'" style="font-size: 24px;margin-right: 10px;"><i class="fa fa-remove"></i></a>
                                        <a href="#" onclick="edit('.$row["id"].')" style="font-size: 24px;"><i class="fa fa-edit"></i></a></td>
                                    </tr>';
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <form class="shadow-lg" id="createForm" method="post" style="height: auto;width: 90%;max-width: 90%;/*float: left;*/background: #4a0025; display: none;">
            <div class="illustration" style="height: 111px;justify-content: center;">
                <h1 style="/*float: right;*//*margin-top: 54px;*/">Create new</h1>
            </div>
            <div><input class="form-control" type="text" placeholder="Name" name="name"><button class="btn btn-primary" type="submit" style="margin-right: 23px;" name="createSub">Save</button><button class="btn btn-primary" onclick="close('createForm')">Cancel</button></div>
        </form>


        <form class="shadow-lg" id="editForm" method="post" style="height: auto;width: 90%;max-width: 90%;/*float: left;*/background: #4a0025; display: none;">
            <div class="illustration" style="height: 111px;justify-content: center;">
                <h1 style="/*float: right;*//*margin-top: 54px;*/">Edit</h1>
            </div>
            <div><input class="form-control" type="text" placeholder="Id" readonly="" id="ide" name="id"><input class="form-control" type="text" placeholder="Name" name="name"><button class="btn btn-primary" type="submit" style="margin-right: 23px;" name="editSub">Save</button><button class="btn btn-primary" onclick="close('createForm')">Cancel</button></div>
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