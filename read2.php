<?php

header("Access-Control-Allow-Origin: *");

$retour = array("erreur" => true);

if(isset($_POST["request"]) && isset($_POST["data"])){
    if(!empty($_POST["request"]) && !empty($_POST["data"])){
        // CONNEXION BDD
        $pdo = new PDO("mysql:host=localhost;dbname=" . $_POST["data"], "root", "", array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
        ));


        $resultat = $pdo -> prepare($_POST["request"]);
        if($resultat -> execute()){

        $utilisateurs = $resultat -> fetchAll(PDO::FETCH_ASSOC);

        $tableau = "<div>
                <div>
                    <p>Requête : <span id='requete'></span></p>
                    <p>Nombre de lignes concernées : <span id='lignes'>" . $resultat -> rowCount() . "</span></p>
                </div>
                <div>
                <table border ='1'>
                    <tr>";
            for($i=0; $i < $resultat -> columnCount(); $i++){
                $meta = $resultat -> getColumnMeta($i);
                $tableau .= "<th>" . $meta["name"] . "</th>";
            }
            $tableau .= "</tr>";
            for ($i=0; $i < count($utilisateurs) ; $i++) {
            $tableau .= "<tr>";
                foreach ($utilisateurs[$i] as $key => $value) {
                    $tableau .= "<td>" . $value . "</td>";
                }
            $tableau .= "</tr>";
            }

        $tableau .= "</table></div></div>";
        $retour["erreur"] = false;
        $retour["message"] = $tableau;

        }else {
            $retour["message"] = $pdo -> errorInfo()[2];
        }

    }else {
        $retour["message"] = "Paramètre vide!"; // Gestion erreur if empty POST
    }
}else{
    $retour["message"] = "Paramètre manquant!"; // Gestion erreur if isset POST
}


echo json_encode($retour);

?>
