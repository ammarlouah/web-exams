<?php

if($_FILES['nomFichier']['error'] > 0) echo $_FILES['nomFichier']['error'];

echo "<br>";

if($_FILES['nomFichier']['size'] <= 3000000 && $_FILES['nomFichier']['size'] > 0) {
    echo "taille acceptable";
    echo "<br>";
    echo $_FILES['nomFichier']['size'];
    echo "<br>";
}
else echo "taille innacceptable";
echo "<br>";

echo $_FILES['nomFichier']['name'];
echo "<br>";
echo $_FILES['nomFichier']['type'];
echo "<br>";
echo $_FILES['nomFichier']['tmp_name'];
echo "<br>";

$dossier = 'C://depl';
$file = $_FILES['nomFichier']['name'];
if(move_uploaded_file($_FILES['nomFichier']['tmp_name'],$dossier.$file)){
    echo "deplacement succee";
}else{
    echo "echec de deplacement";
}
