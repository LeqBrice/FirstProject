<?php

header("Access-Control-Allow-Origin: *");

// CONNEXION BDD
$pdo = new PDO("mysql:host=localhost;dbname=mike", "root", "", array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
));


$resultat = $pdo -> prepare("SELECT * FROM utilisateurs");
$resultat -> execute();

$utilisateurs = $resultat -> fetchAll(PDO::FETCH_ASSOC);

echo "<table border ='1'";
    echo "<tr>";
    for($i=0; $i < $resultat -> columnCount(); $i++){
        $meta = $resultat -> getColumnMeta($i);
        echo "<th>" . $meta["name"] . "</th>";
    }
    echo "</tr>";
    for ($i=0; $i < count($utilisateurs) ; $i++) {
    echo "<tr>";
        foreach ($utilisateurs[$i] as $key => $value) {
            echo "<td>" . $value . "</td>";
        }
    echo "</tr>";
    }

echo "</table>";

/*
$tableau = "<table border ='1'><tr><th>Id</th><th>Nom</th><th>Prenom</th><th>Poste</th><th>Date create</th></tr>";

while($utilisateurs = $resultat -> fetchAll()){
    $tableau .= "<tr>";
    $tableau .= "<td>" .$utilisateurs[0]["id"]. "</td>";
    $tableau .= "<td>" .$utilisateurs[0]["nom"]. "</td>";
    $tableau .= "<td>" .$utilisateurs[0]["prenom"]. "</td>";
    $tableau .= "<td>" .$utilisateurs[0]["poste"]. "</td>";
    $tableau .= "<td>" .$utilisateurs[0]["date_create"]. "</td>";
    $tableau .= "</tr>";
}

$tableau .= "</table>";

echo $tableau;
*/


echo json_encode($utilisateurs);


/*sleep(20);
echo "<pre>";
var_dump($utilisateurs);
echo "</pre>";*/


?>
