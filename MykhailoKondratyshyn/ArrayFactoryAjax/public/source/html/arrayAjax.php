

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Title</title>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <!--<script src="global.js"></script>-->

        <script>
            function funcBefore() {
                $('#information').html("Loading...");
            }

            function funcSuccess(data) {
                var result = '';

                for(var i in  data) {
                    result += data[i] + '<br>';
                }

                $('#information').html(result);
            }

            $(document).ready(function () {
                $('button#Ran').click(function () {
                    var type = "HorizontalArray";

                    $.ajax({
                        url: "../../index.php",
                        type: "POST",
                        data: ({name: type}),
                        dataType: "json",
                        beforeSend: funcBefore,
                        success: funcSuccess
                    });
                });

                $('button#Hor').click(function () {
                    var type = "HorizontalArray";

                    $.get("../../index.php", {
                        name: type
                    }, funcSuccess, 'json');
                });

                $('button#Ver').click(function () {
                    var type = "VerticalArray";

                    $.post("../../index.php", {
                        name: type
                    }, funcSuccess, 'json');
                });
            });
        </script>
    </head>
    <body>
        <button type="button" id="Ran">Random</button>
        <button type="button" id="Hor">Horisontal</button>
        <button type="button" id="Ver">Vertical</button>

        <div id="information"></div>
    </body>
</html>
