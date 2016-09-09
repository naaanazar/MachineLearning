<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script   src="https://code.jquery.com/jquery-3.1.0.min.js"   integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s="   crossorigin="anonymous"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


    </script>

@yield('header')

</head>
<body>
<script>

    $(document).ready(function () {
        $('a.btn-danger').on('click', function (e) {
            e.preventDefault();

            $.ajax({
                'url': $(e.target).attr('href'),
                'type': 'DELETE',
                success : function (response) {
                    if (response.success) {
                        $(e.target).closest('div.product').fadeOut();
                        location.reload();
                    }
                }
            });
        });
    });


</script>

    @yield('content')



@yield('footer')
</body>
</html>



