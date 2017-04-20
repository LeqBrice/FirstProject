<!DOCTYPE html>

<?php

$pdo = new PDO("mysql:host=localhost;dbname=mike", "root", "", array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
));

$resultat = $pdo -> query("SHOW DATABASES");
$database = $resultat -> fetchAll(PDO::FETCH_ASSOC);

?>




<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <meta charset="utf-8">
        <title>Formulaire requête</title>
    </head>


    <body>
        <div id="mike">
            <form action="" method="post">

                <label>Base de données :</label>
                <select id="bdd"/>
                    <?php foreach ($database as $key => $value) : ?>
                        <option value="<?= $value['Database'] ?>"><?= $value['Database'] ?></option>";
                    <?php endforeach; ?>
                </select><br/></br>

                <fieldset>
                    <legend>Requête :</legend><br/>
                    <textarea name="sql" id="sql" rows="8" cols="80"></textarea><br/><br/>

                    <input type="submit" value="Envoyer">
                </fieldset>

            </form></br></br>

            <div>
                <p id="message"></p>
            </div>

            <div id="req">
            </div>

            <script>
                $(function(){
                    $("input").click(function(e){ // Évènement Jquery qui se déclenche au click d'une balise "input" - La variable "e" stocke l'évènement
                        e.preventDefault(); // Annulation de l'actualisation de la page

                        console.log("moi");

                        var myRequest = $("#sql").val(); // Récupération de la valeur de notre textarea

                        var dataBase = $("#bdd").val();

                        var request = $.ajax({ // Requête Ajax - Envoi les infos du form vers une autre page de traitement
                          url: "read2.php", // Page de la requête
                          method: "POST", // Méthode de la requête
                          data: {request: myRequest, data: dataBase} // Date envoyée à la page
                        });

                        request.done(function( msg ) {
                            console.log(msg); // Affichage dans la console avant la conversion en un Object - msg est une string
                            msg = JSON.parse(msg); // Conversion Json en Object Javascript
                            console.log(msg); // Affichage dans la console après la conversion en un Object - msg est un objet javascript
                            if(msg.erreur == false){
                                $( "#req" ).html( msg.message ); // Mise à jour du contenu de la div qui a pour id "Mike"
                                $( "#requete" ).html( myRequest ); // Mise à jour du contenu du span qui a pour id "requete" genéré dans le tableau envoyé par le php
                                $("#message").text("Voici les résultats de votre requête");
                                $("#message").css("background-color" , "green");
                            }else {
                                $("#message").text(msg.message);
                                $("#message").css("background-color" , "red");
                            }
                        });

                        request.fail(function( jqXHR, textStatus ) {
                          alert( "Request failed: " + textStatus );
                        });
                    });
                });



            </script>
        </div>
    </body>


</html>
