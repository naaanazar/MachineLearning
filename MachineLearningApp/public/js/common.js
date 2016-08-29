$(document).ready(function () {
    $("[data-toggle='tooltip']").tooltip();
    $('#input-file').change(function(){
        $('.form-upload').submit();
    });
});