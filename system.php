<?php
$con = mysqli_connect("127.0.0.1","root","","final-tp-php");

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}
$rep1 = "image";
$rep2 = "files";
// $sql = "SELECT `id_emp` FROM `entreprise` WHERE 1";
$sql = "SELECT `username` FROM `login` WHERE 1";

echo "$sql";

$res = mysqli_query($con, $sql);

$section = array ("Frontend", "Backend", "Cybersecurity");

$tmp = 1;

if (isset($_REQUEST["btn_insert"])) {
    $ids = $_REQUEST["id"];
    $nom = $_REQUEST["nom"];
    $prenom = $_REQUEST["prenom"];
    $section = $_REQUEST["section"];
    $user = $_REQUEST["user"];

    // echo "$ids / $nom / $prenom / $section / $user";
    echo "<pre>";
     print_r($_REQUEST);
    echo "</pre>";
} else {
    $tmp = 0;
}

if (isset($_FILES["image"])) {
    echo "<pre>";
        print_r($_FILES["image"]);
    echo "</pre>";
    if ($_FILES["image"]["error"]==0){
        if(strpos($_FILES["image"]["type"],"image")!==false){
            $dbimage = $_FILES["image"]["name"];
            $d = explode(".", $dbimage);
            $imgnom = "$ids.$d[1]";
            copy($_FILES["image"]["tmp_name"], $rep1."/".str_replace(" ","_",$imgnom));

            echo "$imgnom";

            // echo "<br>".$_FILES["image"]["name"];
            // echo "<br>".$_FILES["image"]["tmp_name"];
        } else {
            echo "Ce n'est  pas une image";
        } 
    } else {
        $tmp = 0; 
    }
}

if (isset($_FILES["fichier"])) {
    echo "<pre>";
        print_r($_FILES["fichier"]);
    echo "</pre>";
    if ($_FILES["fichier"]["error"]==0){
        if(strpos($_FILES["fichier"]["type"],"text")!==false){
            $dbfichier = $_FILES["fichier"]["name"];
            $d = explode(".", $dbfichier);
            $fichnom = "$ids.$d[1]";
            copy($_FILES["fichier"]["tmp_name"], $rep2."/".str_replace(" ","_",$fichnom));

            echo "$fichnom";

            // echo "<br>".$_FILES["fichier"]["name"];
            // echo "<br>".$_FILES["fichier"]["tmp_name"];
        } else {
            echo "Ce n'est  pas un fichier";
        }
      } else {
        $tmp = 0; 
    }
} 

if ($tmp) {

    echo "$ids $nom $prenom $section $imgnom $fichnom $user";
    $sql = "INSERT INTO `entreprise`(`id_client`, `nom_client`, `prenom_client`, `image_client`, `fichier_client`, `section_emp`, `id_emp`) VALUES ('$ids','$nom','$prenom', '$imgnom', '$fichnom', '$section', '$user')";

    echo "$sql";

    $r = mysqli_query($con, $sql);

    echo "insertion affichée";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System</title>
    <style>
        .display {
            border: 1px solid gray;
            width: 550px;
            align: center;
        }
        .centre {
        margin: auto;
        }
        .bordure {
            border-style: solid;
            border-color: lightgray;
        }
        /* <!-- HTML !--> */
/* <button class="button-80" role="button">Button 80</button> */

/* CSS */
.button-80 {
  background: #fff;
  backface-visibility: hidden;
  border-radius: .375rem;
  border-style: solid;
  border-width: .125rem;
  box-sizing: border-box;
  color: #212121;
  cursor: pointer;
  display: inline-block;
  font-family: Circular,Helvetica,sans-serif;
  font-size: 1.125rem;
  font-weight: 700;
  letter-spacing: -.01em;
  line-height: 1.3;
  padding: .875rem 1.125rem;
  position: relative;
  text-align: left;
  text-decoration: none;
  transform: translateZ(0) scale(1);
  transition: transform .2s;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
}

.button-80:not(:disabled):hover {
  transform: scale(1.05);
}

.button-80:not(:disabled):hover:active {
  transform: scale(1.05) translateY(.125rem);
}

.button-80:focus {
  outline: 0 solid transparent;
}

.button-80:focus:before {
  content: "";
  left: calc(-1*.375rem);
  pointer-events: none;
  position: absolute;
  top: calc(-1*.375rem);
  transition: border-radius;
  user-select: none;
}

.button-80:focus:not(:focus-visible) {
  outline: 0 solid transparent;
}

.button-80:focus:not(:focus-visible):before {
  border-width: 0;
}

.button-80:not(:disabled):active {
  transform: translateY(.125rem);
}
input[type=text] {
  border: 2px solid green;
  border-radius: 4px;
  width: 175px;
}
    </style>
</head>
<body>
    <div class="main-system">
        <form action="" method="post" enctype="multipart/form-data">
            <caption>System</caption>
                <table class="centre">
                    <tr>
                        <td>ID Client</td>
                        <td><input type="text" name="id" id=""></td>
                    </tr>
                    <tr>
                        <td>Nom Client</td>
                        <td><input type="text" name="nom"></td>
                    </tr>
                    <tr>
                        <td>Prenom Client</td>
                        <td><input type="text" name="prenom"></td>
                    </tr>
                    <tr>
                        <td>Image Client</td>
                        <td><input type="file" name="image" id=""></td>
                    </tr>
                    <tr>
                        <td>Fichier Client</td>
                        <td><input type="file" name="fichier" id=""></td>
                    </tr>
                    <tr>
                        <td>Section</td>
                        <td>
                        <select name="section" id="">
                                <?php
                                foreach($section as $ind => $val) {
                                    echo "<option value=\"$val\"/>$val";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Username_Employe</td>
                        <td>
                            <select name="user" id="">
                                <?php
                                while($row = mysqli_fetch_assoc($res)) {
                                    $id = $row["username"];
                                    echo "<option value=\"$id\">$id";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr></tr>
                    <tr>
                        <td>Insertion</td>
                        <td><input type="submit" value="Insert" name="btn_insert" class="btn-insert"/></td>
                    </tr>
                </table>
                <br/>
                <table class="bordure centre">
                    <tr>
                        <td><input type="submit" value="Search" class="button-80" name="btn_search"></td>
                        <td><input type="text" name="search" id="" placeholder="entrer le nom"></td>
                        <td><input type="submit" class="button-80" value="Display All" name="btn_display"></td>
                    </tr>
                </table>
        </form>
    </div>
    <?php
    if (isset($_REQUEST["btn_search"])) {
        $searchnom = $_REQUEST["search"];
        $sql = "SELECT * FROM `entreprise` WHERE `nom_client` = '$searchnom'";

        $r = mysqli_query($con, $sql);

        ?>
        <table class="centre bordure display">
        <?php
        // echo "<table class=\"display\" \"centre\" \"bordure\">";
        echo "<tr><th>Id</th><th>nom</th><th>prenom</th><th>Image</th><th>Fichier</th><th>Section</th><th>Emp</th><th>Update</th><th>Delete</th></tr>";
        $row = mysqli_fetch_array($r);
            echo "<tr><td>$row[0]</td>";
            echo "<td>$row[1]</td>";
            echo "<td>$row[2]</td>";
            echo "<td><img src=\"".$rep1."/$row[3]\" width=\"50px\"></td>";
            echo "<td>$row[4]</td>";
            echo "<td>$row[5]</td>";
            echo "<td>$row[6]</td>";
            echo "<td><a href=manip.php?id=".$row[0].">Modifier</a></td>";
            echo "<td> <a href=manip.php?id=".$row[0].">Supprimer</a></td></tr>";
        
        echo "</table>";
    }
    
    if (isset($_REQUEST["btn_display"])) {
    
        $sql = "SELECT * FROM `entreprise`";
    
        $r = mysqli_query($con, $sql);
        ?>
        <table class="centre bordure display">
        <?php
        // echo "<table class=\"display\" \"centre\" \"bordure\">";
        echo "<tr><th>Id</th><th>nom</th><th>prenom</th><th>Image</th><th>Fichier</th><th>Section</th><th>Emp</th><th>Update</th><th>Delete</th></tr>";
        while($row = mysqli_fetch_array($r)) {
            echo "<tr><td>$row[0]</td>";
            echo "<td>$row[1]</td>";
            echo "<td>$row[2]</td>";
            echo "<td><img src=\"".$rep1."/$row[3]\" width=\"50px\"></td>";
            echo "<td>$row[4]</td>";
            echo "<td>$row[5]</td>";
            echo "<td>$row[6]</td>";
            echo "<td><a href=manip.php?id=".$row[0].">Modifier</a></td>";
            echo "<td> <a href=manip.php?id=".$row[0].">Supprimer</a></td></tr>";
        }
        echo "</table>";
    }
?>
</body>
</html>
