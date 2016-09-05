$(document).ready(function() {
    // tooltip from upload button
    $("[data-toggle='tooltip']").tooltip();

    // upload button without submit
    $('#input-file').change(function() {
        $('.form-upload').submit();
    });

    //ml hide/show form create
    $('.btn-create-mlmodel').click(function(){
        $('.create-mlmodel').toggle();
        $(".container-describeMLModels").toggle();
    });   
    $(".btn-create-bath-description").click(function() {
        $(".create-bath-description").toggle();
        $(".container-describeBatchPredictions").toggle();
    } ) ;   
    $(".btn-create-evaluations").click(function() {
        $(".create-evaluations").toggle();
        $(".container-describeEvaluations").toggle();
    }); 
    $(".btn-create-datasource").click(function() {
        $(".create-datasource").toggle();       
        $(".container-describeDataSources").toggle();      
    });

    // upload show/hide message
    $(".upload-message").show().delay(1500).fadeOut(1000);

    // delete row from s3 table using ajax
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

     // $('.btn-delete').on('click', function(e){
    $(document).on('click','.btn-delete',function(e){
        e.preventDefault();
        var url = $(this).attr('href');
        $.ajax({
            url     : url,
            method  : 'GET',
            success : function(data) {
                            if(data.success) {
                                $(e.target).closest('tr').hide("fast");
                            }
                      }
        });
    });

    //upload file to s3 bucket using ajax
    $('.form-upload').on("submit", function(event2){
        event2.preventDefault();
        $.ajax({
            url         : '/s3/upload',
            method      : 'POST',
            data        : new FormData($(".form-upload")[0]),
            contentType : false,
            cache       : false,
            processData : false,
            success: function (data) {
                getListS3();
            }
        });
    });

    // update list s3
    function getListS3() {
        console.log('getListS3');
        $.ajax({
            url         : '/s3/list',
            method      : 'GET',
            success     : function (data) {
                $('.s3-table').html($(data).find('table'));
            }
        });
    }
});
