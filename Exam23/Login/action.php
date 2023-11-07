<?php

$email = $_POST['email'];
$password = $_POST['password'];

$connection = mysqli_connect("localhost","root","","GESTION_STOCK");

if($connection==false) die("erreur de connection au database");

$query = "SELECT * FROM CLIENT WHERE email='$email' AND password='$password";

$res = mysqli_query($connection,$query);

$ligne = mysqli_fetch_row($res);
if($ligne == null) die("utilisateur introuvable.");

$num = $ligne[0];
$nom = $ligne[1];
$prenom = $ligne[2];
$age = $ligne[3];
$adress = $ligne[4];
$email = $ligne[5];
$tel = $ligne[6];

$ch = $num + "/" +$nom + "/" +$prenom + "/" +$age + "/" +$adress + "/" +$email + "/" +$tel + "\n";

if(!file_exists("CLient.txt")){
    touch("CLient.txt");
}

$file = fopen("Client.txt","a+");
if($file == false) die("erreur d'ouverture de fichier.");
fwrite($file,$ch);
fclose($file);

$file = fopen("CLient.txt","r");
if($file == false) die("erreur d'ouverture de fichier.");

$count=0;
$som=0;

echo "<table border='1'>";
echo "<tr>
    <th>Numero Client</th>
    <th>Nom</th>
    <th>Prenom</th>
    <th>Age</th>
    <th>Adress</th>
    <th>Email</th>
    <th>Tel</th>
    </tr>";

while(!feof($file)){
    $ch = fgets($file);
    $arrch = explode("/",$ch);
    if(count($arrch) <=1) break;
    $num = $arrch[0];
    $nom = $arrch[1];
    $prenom = $arrch[2];
    $age = (int) $arrch[3];
    $som+=$age;
    $count++;
    $adress = $arrch[4];
    $email = $arrch[5];
    $tel = $arrch[6];

    echo "<tr>
    <td>$num</td>
    <td>$nom</td>
    <td>$prenom</td>
    <td>$age</td>
    <td>$adress</td>
    <td>$email</td>
    <td>$tel</td>
    </tr>";
}
echo "</table>";

echo "l'age moyen est : ".$som/$count;

?>