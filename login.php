
<?php
    session_save_path("data");
    session_start();

    $con = mysqli_connect("127.0.0.1","root","","final-tp-php");

    if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      exit();
    }

    // if (isset($_SESSION["access_nb"])) {
    //     $nbaccess = $_SESSION["access_nb"];

    //     if ($nbaccess > 3)
        
    // }
    if (isset($_REQUEST["btn_login"])) {
        $user = $_REQUEST["username"];
        $pass = $_REQUEST["password"];

        $sql = "SELECT `username`, `password`, `nombreAcce` FROM `login` WHERE `username` = 'Ali123' AND `password` = '123456'";

        echo "$sql";

        $res = mysqli_query($con, $sql);

        if (mysqli_num_rows($res) == 1) {
            $row = mysqli_fetch_assoc($res);

            // pour sauvgauder les informations dans la session pour l'utilisation:

            $username = $row["username"];
            $_SESSION["username"] = $username;
            $date = getdate();
            $_SESSION["passe"] = $date[0];
            $_SESSION["time"] = $date["mday"] . "/" . $date["mon"] . "/" . $date["year"];    

            // C'est pour sauvguarder le nombre d'acces dans le session pour controle le fois d'accées au system:

            if (isset($_SESSION["access_nb"]))
                $_SESSION["access_nb"] = $_SESSION["access_nb"] + 1;
            else
                $_SESSION["access_nb"] = 1;
            
            // incrementation du nombre d'acces d'utilisateur au system dans la base de données:

            $nombre_accee = $row["nombreAcce"];
            if ($row["nombreAcce"] != 0)
                $nombre_accee = $nombre_accee + 1;
            
            $sql = "UPDATE `login` SET `nombreAcce`='$nombre_accee' WHERE `username` = '$username'";
            $res = mysqli_query($con, $sql);

            header("location:system.php");   
        }
    } else {
        $user = "";
        $pass = "";
    }

    if (isset($_REQUEST["signup"])) {
        $user2 = $_REQUEST["username2"];
        $mail2 = $_REQUEST["mail2"];
        $password2 = $_REQUEST["password2"];
        
        $sql = "INSERT INTO `login`(`username`, `password`, `mail`) VALUES ('$user2', '$password2', '$mail2')";

        echo "$sql";

        $res = mysqli_query($con, $sql);

        echo "Insertion Validée, Welcome";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css"/>
    <title>Login Page</title>
</head>
<body>
    <div class="main-div">
        <div class="img">
            <img src="image/system.jpg" alt="img"/>
        </div>
        <div class="forms">
            <h3>Welcome to our system, Hello World</h3>
            <form method="post" action="">
                <div class="login" id="login">
                <fieldset>
                    <legend>Login</legend>
                        <table class="premier">
                            <tr>
                                <td>Username/E-Mail</td>
                                <td><input type="text" name="username"/></td>
                            </tr>
                            <tr>
                                <td>Password</td>
                                <td><input type="password" name="password"/></td>
                            </tr>
                            <tr>
                                <td></td><td><input type="submit" value="Login" name="btn_login"></td>
                            </tr>
                        </table>
                    </fieldset>
                </div>
                <p onclick="send(1)" class="p1" id="p1">Signup</p>
                <div class="signup" id="signup">
                <fieldset>
                    <legend>SingUp</legend>
                        <table class="deux">
                            <tr>
                                <td>Username</td><td><input type="text" name="username2"/></td>
                            </tr>
                            <tr>
                                <td>E-Mail</td><td><input type="email" name="mail2"/></td>
                            </tr>
                            <tr>
                                <td>password</td><td><input type="password" name="password2"/></td>
                            </tr>
                            <tr>
                                <td></td><td><input type="submit" value="Signup" name="signup"></td>
                            </tr>
                        </table>
                    </fieldset>
                </div>
                <p onclick="send(2)" class="p2" id="p2">Login</p>
            </form>
        </div>
    </div>
    <script>
        function send(nb) {
            if (nb == 1) {
                document.getElementById("login").style.visibility = "hidden";
                document.getElementById("p1").style.visibility = "hidden";
                document.getElementById("signup").style.visibility = "visible";
                document.getElementById("p2").style.visibility = "visible";
            } else {
                document.getElementById("login").style.visibility = "visible";
                document.getElementById("p1").style.visibility = "visible";
                document.getElementById("signup").style.visibility = "hidden";
                document.getElementById("p2").style.visibility = "hidden";
            }
        }
        function send1() {
            var url = window.location.href;
            console.log(url);
        }
    </script>
</body>
</html>