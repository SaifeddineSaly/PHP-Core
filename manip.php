<?php

$con = mysqli_connect("127.0.0.1","root","","final-tp-php");

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}
$section_arr = array("Frontend", "Backend", "Cybersecurity");
$rep = "image";
$id = $_GET["id"];

$sql = "SELECT * FROM `entreprise` WHERE `id_client` = '$id'";

$res = mysqli_query($con, $sql);

$row = mysqli_fetch_assoc($res);
$nom = $row["nom_client"];
$prenom = $row["prenom_client"];
$section = $row["section_emp"];
$img = $row["image_client"];

// echo "$nom  $prenom  $section  $img";

if (isset($_REQUEST["update"])) {
  $nom = $_REQUEST["nom"];
  $prenom = $_REQUEST["prenom"];
  $section = $_REQUEST["section"];

  $sql = "UPDATE `entreprise` SET `nom_client`='$nom',`prenom_client`='$prenom', `section_emp`='$section' WHERE `id_client` = '$id'";

  $res = mysqli_query($con, $sql);

  // echo "Update Validée";
  header("location:end.php");
}

if (isset($_REQUEST["delete"])) {

  $sql = "DELETE FROM `entreprise` WHERE `id_client` = '$id'";

  $res = mysqli_query($con, $sql);
  header("location:end.php");
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Finish</title>
</head>
<body>
  <form action="" method="post">
    <fieldset>
     <legend>Information</legend>
      <table>
        <tr>
          <td>Nom</td>
          <td><input type="text" name="nom" value="<?php echo $nom ?>" id=""></td>
        </tr>
        <tr>
          <td>Prenom</td>
          <td><input type="text" name="prenom" value="<?php echo $prenom ?>" id=""></td>
        </tr>
        <tr>
          <td>Section</td>
          <td>
            <select name="section" id="">
              <?php
              foreach($section_arr as $val) {
                if ($val == $section)
                  echo "<option value=\"$val\" checked>$val";
                else
                  echo "<option value=\"$val\">$val";
              }
              ?>
            </select>
          </td>
        </tr>
        <tr>
          <td>Image</td>
          <td>
            <?php
              echo "<img src=\"".$rep."/$img\" width=\"100px\">";
            ?>
          </td>
        </tr>
        <tr>
          <td><input type="submit" value="Update" name="update"/></td>
          <td><input type="submit" value="Delete" name="delete"/></td>
        </tr>
      </table>
    </fieldset>
  </form>
</body>
</html>
