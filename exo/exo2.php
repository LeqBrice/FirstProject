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
        <div> <!-- Tableau contenant l'utilisateur sélectionné -->
            <table border=1 id="commentaires"></table>
        </div>

        <script>


            $(function(){


                var request = $.ajax({
                  url: "http://jsonplaceholder.typicode.com/posts",
                  method: "GET"
                })



                .done(function( msg ) {

                      var table = "<tr>";

                      $.each(msg[0], function(index, value){
                              table += "<th>";
                              table += index;
                              table += "</th>";
                        });

                        table += "</tr>";


                        for(var i=0; i < msg.length; i++){
                            table += "<tr id='posts-" + msg[i].id + "'>";

                            $.each(msg[i], function(index, value){
                                table += "<td>";
                                table += value;
                                table += "</td>";

                            });
                            table += "</tr>";
                        };

                        $( "#table" ).html(table);




                        /*********************************************  Affichage des commentaires de chaque post     ****************************************************/



                        $("tr").click(function(e){

                        var idPost = $(this).attr("id");
                        idPost = idPost.split("-");

                        $.ajax({
                            url: "http://jsonplaceholder.typicode.com/comments",
                            data: {postId : idPost[1]},
                            method: "GET",
                        })

                        .done(function( msg ) {

                        var table = "<tr>";

                        $.each(msg[0], function(index, value){
                                table += "<th>";
                                table += index;
                                table += "</th>";
                          });

                          table += "</tr>";


                          for(var i=0; i < msg.length; i++){
                              table += "<tr id='posts-" + msg[i].id + "'>";

                              $.each(msg[i], function(index, value){
                                  table += "<td>";
                                  table += value;
                                  table += "</td>";

                              });
                              table += "</tr>";
                          };

                          $( "#commentaires" ).html(table);

                      })

                    })

                })




                request.fail(function( jqXHR, textStatus ) {
                  alert( "Request failed: " + textStatus );
                });


            }) // End document.ready en JQuery

        </script>

    </body>


</html>
