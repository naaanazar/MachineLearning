<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>








    <script>
        function funcBefore() {
            $('#information').text ("Loading...");
        }

        function funcSuccess (data) {
            $('#information').text (data);
        }


        $(document).ready(function () {
            $("#load").bind("click", function () {
                var admin = "Admin";
                    $.ajax ({
                        url: "content.php",
                        type: "POST",
                        data: ({name: admin, number: 5}),
                        dataType: "html",
                        beforeSend: funcBefore,
                        success: funcSuccess
                    });
            });
        });

    </script>












</head>
<body>

<p id="load" style="cursor: pointer">Load data</p>

<!--<button type="button">Random</button>-->
<!---->
<!--<button>Horisontal</button>-->
<!--<button>Vertical</button>-->


<div id="information"></div>

</body>
</html>