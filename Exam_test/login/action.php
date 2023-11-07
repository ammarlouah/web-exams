<?php

$nom = $_POST['nom'];
$password = $_POST['password'];

$connection = mysqli_connect("localhost","root","");
if($connection == false){
    die("connection impossible");
}

$connenctDb = mysqli_select_db($connection,"GESTION_COMPTE");
if($connenctDb == false){
    die("database inaccessible");
}

$query = "SELECT * FROM client WHERE Nom='$nom' AND Motpasse = '$password'";
$resultat = mysqli_query($connection,$query);
$ligne = mysqli_fetch_row($resultat);
if($ligne == NULL) die("Utilisateur introuvable");
$numero = $ligne[0];
$nom = $ligne[1];
$prenom = $ligne[2];
$age = $ligne[3];
$adress = $ligne[4];
$tel = $ligne[5];
$email = $ligne[6];
$password = $ligne[7];
$infos = $numero. "/" .$nom. "/" .$prenom. "/" .$age. "/" .$adress. "/" .$email. "/" .$tel . "\n";
if(!file_exists('Client.txt')) touch('Client.txt');
$file = fopen('Client.txt','a+');
if(!$file) die("Erreur d'ouvraiture de fichier");
fwrite($file,$infos);

fclose($file);

$file = fopen('Client.txt','r');

rewind($file);

$count = 0;
$som = 0;

echo "<table border='1'>
<tr>
<th>Numero</th>
<th>Nom</th>
<th>Prenom</th>
<th>Age</th>
<th>Adress</th>
<th>Email</th>
<th>Tel</th>
</tr>
";
    while(!feof($file)){
        $str = fgets($file);
        $strarr = explode('/',$str);
        if(count($strarr) <= 1) break;
        $numero = $strarr[0];
        $nom = $strarr[1];
        $prenom = $strarr[2];
        $age = $strarr[3];
        $som += (int) $age;
        $count++;
        $adress = $strarr[4];
        $email = $strarr[5];
        $tel = $strarr[6];

        echo "<tr>";
        echo "<td>$numero</td>";
        echo "<td>$nom</td>";
        echo "<td>$prenom</td>";
        echo "<td>$age</td>";
        echo "<td>$adress</td>";
        echo "<td>$email</td>";
        echo "<td>$tel</td>";
        echo "</tr>";
    }
echo "</table>";

echo "l'age moyen est : " . $som/$count;

fclose($file);