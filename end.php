<?php
session_save_path("data");
session_start();

setcookie("Product","AF-45",time()+20);
setcookie("Sale","5%",time()+20);
setcookie("Expire_date", 3);


echo "<fieldset>";
    echo "<pre>";
        echo "<h1>Information du employee a partie du SESSION/COOKIES: </h1>";
        $user = $_SESSION["username"];
        echo "<br/>Le surnom de l'employee: $user";
        $accessnb = $_SESSION["access_nb"];
        echo "<br/>Le nombre d'access au system: $accessnb";
        $d = getdate();
        // echo "$d[0]";
        $diff = $d[0] - $_SESSION["passe"];
        $nbenmin = $diff * 60;
        echo "<br/>Le temps passée dans ce systeme est $nbenmin Secondes";
    echo "</pre>";
echo "</fieldset>";

// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";
// if (isset($_SESSION))