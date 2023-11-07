<?php

$connection = mysqli_connect("localhost","root","");

if($connection == false) die("erreur de connexion au base de donnee");

/*
CREATE DATABASE GESTION_HOTELIERIE;
USE GESTION_HOTELIERIE;

CREATE TABLE CHAMBRE(
    NUM_CHAMBRE INT PRIMARY KEY,
    TYPE_CHAMBRE VARCHAR(255) NOT NULL,
    PRIX FLOAT NOT NULL
);

CREATE TABLE CLIENT(
    ID_CLIENT INT PRIMARY KEY,
    NOM_CLIENT VARCHAR(30) NOT NULL,
    AGE INT NOT NULL,
    MAIL VARCHAR(30) NOT NULL,
    TEL VARCHAR(30) NOT NULL,
    PASSWORD VARCHAR(30) NOT NULL
);

CREATE TABLE RESERVATION(
    NUM_CHAMBRE INT NOT NULL,
    ID_CLIENT INT NOT NULL,
    DATE_RESERVATION DATE NOT NULL,
    N_JOUR INT NOT NULL,
    PRIMARY KEY(NUM_CHAMBRE,ID_CLIENT),
    CONSTRAINT FK1 FOREIGN KEY (NUM_CHAMBRE) REFERENCES CHAMBRE(NUM_CHAMBRE),
    CONSTRAINT FK2 FOREIGN KEY (ID_CLIENT) REFERENCES CLIENT(ID_CLIENT)
);

*/

$db = mysqli_select_db($connection,"GESTION_HOTELIERIE");
if($db == false) die("Database introuvable");

$id = $_POST['id'];
$nom = $_POST['nom'];
$age = $_POST['age'];
$mail = $_POST['mail'];
$tel = $_POST['tel'];
$password = $_POST['password'];

if(empty($id) || empty($nom) || empty($age) || empty($mail) || empty($tel) || empty($password)){
    die("tous les champs doit etre bien rensegnes");
}

if(!preg_match("/^[0-9]{1,2}/",$age)) die("age invalid");

if(!preg_match("/.+?@.+\..+/",$mail)) die("email invalide");

if(!preg_match("/^(06|05)([-\/\.[:space:]]?[0-9]{2}){4}/",$tel)) die("tel invalid");

if(!preg_match("/.{8,}/",$password)) die("password invalid");

$query = "INSERT INTO CLIENT VALUES ('$id','$nom','$age','$mail','$tel','$password');";

$res = mysqli_query($connection,$query);

if($res == false) die("problem d'insertion");

$query = "SELECT * FROM CLIENT WHERE age > 30;";

$res = mysqli_query($connection,$query);

if($res == false) die("problem de selection");

echo "<table border='1'>
    <tr>
        <th>id</th>
        <th>nom</th>
        <th>age</th>
        <th>email</th>
        <th>tel</th>
    </tr>
";

while($ligne = mysqli_fetch_row($res)){
    $id = (int) $ligne[0];
    $nom = $ligne[1];
    $age = (int) $ligne[2];
    $email = $ligne[3];
    $tel = $ligne[4];
    
    echo "<tr>";
    echo"<td>$id</td>";
    echo"<td>$nom</td>";
    echo"<td>$age</td>";
    echo"<td>$email</td>";
    echo"<td>$tel</td>";
    echo "</tr>";
}
echo "</table>";



