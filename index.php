<!DOCTYPE html>
<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <meta charset="utf-8">
        <title></title>
    </head>


    <body>
        <div id="mike">
            <script>
                var request = $.ajax({
                  url: "read.php",
                  method: "POST"
                });

                request.done(function( msg ) {
                  $( "#mike" ).html( msg );
                });

                request.fail(function( jqXHR, textStatus ) {
                  alert( "Request failed: " + textStatus );
                });
            </script>
        </div>
    </body>


</html>
