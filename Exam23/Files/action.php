<?php

if($_FILES['fichier']['error'] > 0) die($_FILES['fichier']['error']);

if($_FILES['fichier']['size'] > 4000000) die("La taille de fichier est superieur a 4Mo");

echo $_FILES['fichier']['name'];
echo "<br>";
echo $_FILES['fichier']['type'];
echo "<br>";
if(date("H"==20)){
    if(move_uploaded_file($_FILES['fichier']['tmp_name'],"C:/TP")){
        die("erreur de deplacement");
    }
}
