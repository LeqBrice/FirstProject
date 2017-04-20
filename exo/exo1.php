<!DOCTYPE html>
<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <meta charset="utf-8">
        <title>Exo</title>
    </head>


    <body>

        <div>
            <table border=1 id="table"></table> <!-- Tableau contenant tous les utilisateurs -->
        </div>
        <br/>
        <div id="user"> <!-- Tableau contenant l'utilisateur sélectionné -->
        </div>

        <script>


            $(function(){ // Start document.ready en JQuery


                /* Requête en Ajax pour récupérer les utilisateurs - Retour en Array JSON */
                var request = $.ajax({
                  url: "http://jsonplaceholder.typicode.com/users",
                  method: "GET"
                });



                request.done(function( msg ) { // En cas de réussite - On stocke les retours dans la variable msg
                      console.log(msg);

                      var table = "<tr>"; // Init variable table

                      /* Première boucle : Récupération des titres (en-têtes) du tableau - En bouclant sur le premier élément de notre réponse (msg[0]), il récupère les key */
                      $.each(msg[0], function(index, value){

                          if(index == "name" || index == "username" || index == "email" || index == "phone" || index == "company"){ // Voir exercice
                              table += "<th>";
                              table += index; // On affiche ici la key -> index de notre objet
                              table += "</th>";
                          }
                        });

                        table += "</tr>";

                        /* Seconde boucle : Parcours chaque ligne du tableau
                                              |id| name |   phone  |
                        Première itération -> |1 | Brice|0606060606|
                        Deuxième itération -> |2 | Dédé |0505050505|
                        Une itération désigne l'action de répéter un processus. Le calcul itératif permet l'application à des équations récursives
                        */
                        for(var i=0; i < msg.length; i++){
                            table += "<tr>";

                            /* Troisième boucle : Parcours chaque colonne du tableau
                                                            Deuxièùe itération
                                                Première itération  |
                                                           |        |
                                                           v        v
                                                    |id| name |   phone  |
                                                    |1 | Brice|0606060606|
                                                    |2 | Dédé |0505050505|
                            */
                            $.each(msg[i], function(index, value){
                                if(index == "name" || index == "username" || index == "email" || index == "phone" || index == "company"){

                                    if(index == "name"){ // Si l'index est le nom, on rajoute une balise <a>
                                        table += "<td><a href='#'>";
                                        table += value;
                                        table += "</a></td>";
                                    } else {
                                        table += "<td>";
                                        if(index == "company"){ //  Company est un objet
                                            table += value.name;
                                        }else {
                                            table += value;
                                        }
                                        table += "</td>";
                                    }

                                }

                            });
                            table += "</tr>";
                        };

                        $( "#table" ).html(table); // Affiche le tableau dans la balise qui a pour id "table"

                        $("a").click(function(e){ // Évènement Jquery qui se déclenche au click d'une balise "input" - La variable "e" stocke l'évènement
                        e.preventDefault(); // Annulation de l'actualisation de la page

                        var nameUser = $(this).text(); // Récupération de la valeur de notre textarea

                        var request = $.ajax({
                            url: "http://jsonplaceholder.typicode.com/users",
                            method: "GET"
                        });

                        request.done(function(msg){
                            var newTable = "";
                            for(var i=0; i < msg.length; i++){
                                console.log();
                                if(msg[i].name == nameUser) {
                                    newTable = "<table border='1'><tr>";
                                    $.each(msg[i], function(index, value){
                                        newTable += "<td>";
                                        if(index == "company"){
                                            newTable += value.name;
                                        } else if (index == "address") {
                                            newTable += value.street + " " + value.suite + " " + value.city + " " + value.zipcode;
                                        } else{
                                            newTable += value;
                                        }
                                        newTable += "</td>";
                                    });
                                    newTable += "</tr></table>";
                                }
                            }

                            $("#user").html(newTable);
                        })

                    });

                });




                request.fail(function( jqXHR, textStatus ) {
                  alert( "Request failed: " + textStatus );
                });


            }) // End document.ready en JQuery

        </script>

    </body>


</html>
