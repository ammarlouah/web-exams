<?php 

    $connection = mysqli_connect("localhost","root","");
    if($connection == false){
        die("connection impossible");
    }
    $connenctDb = mysqli_select_db($connection,"GESTION_COMPTE");
    if($connenctDb == false){
        die("database inaccessible");
    }

    $numero = $_POST['numero'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $age = $_POST['age'];
    $adress = $_POST['adress'];
    $tel = $_POST['tel'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(empty($numero)||empty($nom)||empty($prenom)||empty($age)||empty($adress)||empty($tel)||empty($email)||empty($password)){
        die("tous les champs doivent etre remplit<br>");
    }

    if(preg_match("/^[0-9]{1,2}$/",$age)){
        echo "Age valide<br>";
    }else{
        die("Age invalide<br>");
    }

    echo $email;
    if(preg_match("/^[a-zA-Z0-9]+@[a-zA-Z]+(\.[a-z]{2,5})$/",$email)){
        echo "Email valide<br>";
    }else{
        echo("Email invalide<br>");
    }


    if(preg_match("/^(06)([-\/\.[:space:]]?[0-9]{2}){4}/",$tel)){
        echo "Tel valide<br>";
    }else{
        die("Tel invalide<br>");
    }

    if(preg_match("/^.{8,}/",$password)){
        echo "password valide<br>";
    }else{
        die("password invalide<br>");
    }

    echo "correct<br>";
    $numero=(int)$numero;
    $age=(int)$age;
    $query = "INSERT INTO client VALUES ($numero,'$nom','   $prenom',$age,'$adress','$tel','$email','$password');";
    // $req = mysqli_query($connection,$query);

    // if($req == false){
    //     die("requete incorrecte.");
    // }

    $resultat = mysqli_query($connection,"SELECT * FROM client WHERE age > 30;");
    echo "<table border='1'>
    <tr>
        <th>Numero</th>
        <th>Nom</th>
        <th>Prenom</th>
        <th>Age</th>
        <th>Adress</th>
        <th>Tel</th>
        <th>Email</th>
    </tr>
    ";
    while($ligne = mysqli_fetch_row($resultat)){
        $numero = $ligne[0];
        $nom = $ligne[1];
        $prenom = $ligne[2];
        $age = $ligne[3];
        $adress = $ligne[4];
        $tel = $ligne[5];
        $email = $ligne[6];

        echo "<tr>";
        echo "<td>$numero</td>";
        echo "<td>$nom</td>";
        echo "<td>$prenom</td>";
        echo "<td>$age</td>";
        echo "<td>$adress</td>";
        echo "<td>$tel</td>";
        echo "<td>$email</td>";
        echo "</tr>";
    }
    echo "</table>";

?>