@extends('template.master')

@section('content')

<div class="container">
    <div class="row col-lg-5">
        ajax request
        <button type="button" class="btn btn-warning" id="getRequest">getRequest</button>
    </div>
    <div class="row col-lg-5">
        <form id="register" action="#">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
            <label for="firstName"></label>
            <input type="text" id="firstName" class="form-control"/>
            
            <label for="lastName"></label>
            <input type="text" id="lastName" class="form-control" />
            <input type="submit" value="Register" class="btn btn-primary" />
        </form>
    </div>
</div>

<div id="getRequestData"></div>
 <pre>
<div id="postRequestData"></div>
 </pre>
@endsection

@section('script')

<script>
    $(document).ready(function() {
        $('#getRequest').click(function() {
//            $.get('getRequest', function(data) {
//                $('#getRequestData').append(data);
//                console.log(data);
//            });
            $.ajax({
                type: "GET",
                url: "getRequest",
                success: function(data) {
                    console.log(data);
                    $('#getRequestData').append(data);

                }
            });
        });

        $('#register').submit(function() {
            var fname = $('#firstName').val();
            var lname = $('#lastName').val();

//            $.post('register', { firstName:fname, lastName:lname }, function(data) {
//                console.log(data);
//                $('#postRequestData').html(data);
//            });
            var dataString = "First name = " + fname + "& last name = " + lname;
            $.ajax({
                type: "POST",
                url: "register",
                data: dataString,
                success: function(data) {
                    console.log(data);
                    $('#postRequestData').html(data);
                }
            });
        });
    });
</script>

@endsection







