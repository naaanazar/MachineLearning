$(document).ready(function () {
    $("[data-toggle='tooltip']").tooltip();
    $('#input-file').change(function(){
        $('.form-upload').submit();
    });

    $(".create-datasource").hide();

    $(".btn-create-datasource").click(function(){
        $(".create-datasource").show();
    });
});