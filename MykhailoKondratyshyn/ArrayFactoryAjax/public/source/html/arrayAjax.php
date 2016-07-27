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
            $('#information').html(data);
        }


        $(document).ready(function () {
            $('button#Ran').click(function () {
                var type = "HorizontalArray";
                $.ajax({
                    url: "../../index.php",
                    type: "POST",
                    data: ({name: type}),
                    dataType: "html",
                    beforeSend: funcBefore,
                    success: funcSuccess
                });
            });
        });


    </script>


</head>
<body>


<button type="button" id="Ran">Random</button>


<!--<button type="button" id="Hor">Horisontal</button>-->
<!---->
<!--<script>-->
<!---->
<!--    function funcBefore() {-->
<!--        $('#information').html("Loading...");-->
<!--    }-->
<!---->
<!--    function funcSuccess(data) {-->
<!--        $('#information').html(data);-->
<!--    }-->
<!---->
<!---->
<!--    $(document).ready(function () {-->
<!--        $('button#Hor').click(function () {-->
<!--            var type = "HorizontalArray";-->
<!--            $.post("../../index.php",-->
<!--                {name: type},-->
<!--                funcBefore,-->
<!--                funcSuccess-->
<!---->
<!--        });-->
<!--    });-->
<!---->
<!---->
<!--</script>-->


<button type="button" id="Ver">Vertical</button>

<script>

    function funcBefore() {
        $('#information').html("Loading...");
    }

    function funcSuccess(data) {
        $('#information').html(data);
    }


    $(document).ready(function () {
        $('button#Ver').click(function () {
            var type = "VerticalArray";
            $.ajax({
                url: "../../index.php",
                type: "POST",
                data: ({name: type}),
                dataType: "html",
                beforeSend: funcBefore,
                success: funcSuccess
            });
        });
    });


</script>


<div id="information"></div>

</body>
</html>