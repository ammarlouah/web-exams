<?php

/*

CREATE DATABASE GESTION_STOCK;
USE GESTION_STOCK;

CREATE TABLE CLIENT (
    num_Cli varchar(30) primary key,
    nom varchar(30) not null,
    prenom varchar(30) not null,
    age int not null,
    adress varchar(30) not null,
    email varchar(30) not null,
    tel int not null
);

CREATE TABLE PRODUIT(
    Nom_prod varchar(30) primary key,
    Libelle varchar(30) not null,
    Type boolean not null,
    Prix_Unitaire float not null,
    Qte int not null,
    Code_barre bigint not null
);

*/

$connection = mysqli_connect("localhost","root","","GESTION_STOCK");
if($connection == false) die("Erreur de connection ou selection de database.");

$num = $_POST['num'];
$lib = $_POST['lib'];
$type = (boolean) $_POST['type'];
$prixu = (float) $_POST['prixu'];
$qte = (int) $_POST['qte'];
$codeb = (int) $_POST['codeb'];

if(empty($num) || empty($lib) || empty($type) || empty($prixu) || empty($qte) || empty($codeb)) die("tous les champs doivent etre bien reseignes.");

if(!preg_match("/^[A-Z]+$/",$lib)) die("Le champ libelle doit etre en lettre majuscule.");

if(!preg_match("/^([1-9][0-9]{2}|1000)$/",$qte)) die("la quantite doit etre entre 100 et 1000.");

if(!preg_match("/^(6)[0-9]{12}/",$codeb)) die("le code barre est invalide");

if(!preg_match("/^(MAR)[a-zA-Z0-9]{8}/",$num)) die("numero invalid");

$query = "insert into PRODUIT values('$num','$lib','$type','$prixu','$qte','$codeb');";
$res = mysqli_query($connection,$query);
if($res == false) echo "erreur d'insertion.";

function affichage($type){
    global $connection;
    $query = "select * from PRODUIT where Type='$type'";
    $res = mysqli_query($connection,$query);
    if($res == false) {
        echo "erreur d'execution de query";
    }else{
        echo "<table border='1'>";
        echo "<tr>
        <th>Numero de produit</th>
        <th>Libelle</th>
        <th>Type</th>
        <th>Prix Unitaire</th>
        <th>Quantite</th>
        <th>Code barre</th>
        </tr>
        ";
        while($ligne = mysqli_fetch_row($res)){
            $num = $ligne[0];
            $lib = $ligne[1];
            $typ = (boolean) $ligne[2];
            $prixu = (float) $ligne[3];
            $qte = (int) $ligne[4];
            $codeb = (int) $ligne[5];
            
            echo "<tr>";
            echo "<td>$num<td>";
            echo "<td>$lib<td>";
            echo "<td>$typ<td>";
            echo "<td>$prixu<td>";
            echo "<td>$qte<td>";
            echo "<td>$codeb<td>";
            echo "</tr>";
        }
        echo "</table>";
    }
}

$query = "UPDATE PRODUIT SET Prix_Unitaire=(Prix_Unitaire+Prix_Unitaire*10/100) WHERE Qte > 500;";
$res = mysqli_query($connection,$query);
if($res == false) {
    echo "erreur d'execution de query";
}

$query = "SELECT COUNT(*) FROM PRODUIT WHERE Qte > 500;";
$res = mysqli_query($connection,$query);
if($res == false) {
    echo "erreur d'execution de query";
}else{
    echo "le nombre des ligne affecte est : ".$res;
}

mysqli_close($connection);

?>