<?php

$email = $_POST['email'];
$password = $_POST['password'];

$connection = mysqli_connect("localhost","root","");
if($connection == false) die("erreur de connection");

$db = mysqli_select_db($connection,"GESTION_HOTELIERIE");
if($db == false) die("erreur de selection de bdd");

$query = "SELECT * FROM CLIENT WHERE MAIL='$email' AND PASSWORD='$password'";
$res = mysqli_query($connection,$query);
if($res == false) die("probleme d'extraction des donnee");

$test = true;

while($ligne = mysqli_fetch_row($res)){
    $test = false;
    $id = (int) $ligne[0];
    $nom = $ligne[1];
    $age = (int) $ligne[2];
    $email = $ligne[3];
    $tel = $ligne[4];
}

if($test) die("email or password invalid");

$ch = $id . "/" . $nom . "/" . $age . "/" . $email . "/" . $tel . "</br>\n";

if(!file_exists("Client.txt")){
    touch("Client.txt");
}

$file = fopen("Client.txt","a+");

// fwrite($file,$ch);

fclose($file);

$file = fopen("Client.txt","r+");

rewind($file);

echo "<table border='1'>
    <tr>
        <th>id</th>
        <th>nom</th>
        <th>age</th>
        <th>email</th>
        <th>tel</th>
    </tr>
";

$count = 0;
$som = 0;

while(!feof($file)){
    $ch = fgets($file);
    $arr = explode('/',$ch);
    if(sizeof($arr) == 1) break;
    $id = (int) $arr[0];
    $nom = $arr[1];
    $age = (int) $arr[2];
    $som+=$age;
    $count++;
    $email = $arr[3];
    $tel = $arr[4];
    
    echo "<tr>";
    echo"<td>$id</td>";
    echo"<td>$nom</td>";
    echo"<td>$age</td>";
    echo"<td>$email</td>";
    echo"<td>$tel</td>";
    echo "</tr>";
}
echo "</table>";

echo "l'age moyen est : ".$som/$count;

fclose($file);