$(document).ready(function() {
    // tooltip from upload button
    $("[data-toggle='tooltip']").tooltip();

    // upload button without submit
    $('#input-file').change(function() {
        $('.form-upload').submit();
    });

    
    $('.btn-create-mlmodel').click(function(){
        $('.create-mlmodel').toggle();
        $(".container-describeMLModels").toggle();

        $.get("/ml/select-data-source", function(response){
            var  result;
            
            for (var key in response.data) {

                result += '<option value="' + response.data[key].DataSourceId + '">' + response.data[key].Name + '</option>';
            }
            $('#SelectDataSource').html(result);
        });       
    });


    $(".btn-create-bath-description").click(function() {
        $(".create-bath-descriptions").toggle();
        $(".container-describeBatchPredictions").toggle();

        $.get("/ml/select-ml-model", function(response){
            var  result;

            for (var key in response.data) {

                result += '<option value="' + response.data[key].MLModelId + '">' + response.data[key].Name + '</option>';
            }
            $('#SelectBathMLModel').html(result);
        });

        $.get("/ml/select-data-source", function(response){
            var  result;

            for (var key in response.data) {

                result += '<option value="' + response.data[key].DataSourceId + '">' + response.data[key].Name + '</option>';
            }
            $('#SelectBathDataSource').html(result);
        });
    });


    $(".btn-create-evaluations").click(function() {
        $(".create-evaluations").toggle();
        $(".container-describeEvaluations").toggle();

        $.get("/ml/select-ml-model", function(response){
            var  result;

            for (var key in response.data) {

                result += '<option value="' + response.data[key].MLModelId + '">' + response.data[key].Name + '</option>';
            }
            $('#SelectMLModelId').html(result);
        });

        $.get("/ml/select-data-source", function(response){
            var  result;

            for (var key in response.data) {

                result += '<option value="' + response.data[key].DataSourceId + '">' + response.data[key].Name + '</option>';
            }
            $('#SelectEvDataSource').html(result);
        });      
    });

    $(".btn-create-datasource").click(function() {
        $(".create-datasource").toggle();
        $(".container-describeDataSources").toggle();

        $.get("/ml/select-S3objects", function(response){
            var  result;
            for (var key in response.data) {
                result += '<option value="' + response.data[key].Key + '">' + response.data[key].Key + '</option>';
            }
            $('#SelectDataLocationS3').html(result);
        });
    });

    
        
   

    // upload show/hide message
    $(".upload-message").show().delay(1500).fadeOut(1000);

    // delete row from s3 table using ajax
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function successS3(selector, str) {
        $(selector).append('<div class="alert alert-success upload-message-s3">'
                            + '<ul><li><strong>Success! </strong>'
                            + str  + '</li></ul></div>').show('slow').hide(4000);
    }

    function errorS3(selector) {
        $(selector).append('<div class="alert alert-danger upload-message-s3">'
                            + '<ul><li><strong>Error! File is not loaded to S3!</strong>'
                            + '</li></ul></div>').show('slow').hide(4000);

    }

    $(document).on('click', '.btn-delete', function(e){
        e.preventDefault();
        var url = $(this).attr('href');
        $.ajax({
            url     : url,
            method  : 'GET',
            success : function(data) {
                            if(data.success) {
                                $(e.target).closest('tr').hide("fast");
                            }
                            successS3('.notification-s3', 'File delete!');
                      }
        });
    });

    //upload file to s3 bucket using ajax
    $('.form-upload').on("submit", function(e){
        console.log($(".form-upload"));
        e.preventDefault();
        $('.preload-s3').show('fast').delay(4000).fadeOut(400);
        $.ajax({
            url         : '/s3/upload',
            method      : 'POST',
            data        : new FormData($(".form-upload")[0]),
            contentType : false,
            cache       : false,
            processData : false,
            success     : function (data) {
                              getListS3();
                              successS3('.notification-s3', 'File uploaded to S3!');
                         },
            error       : function () {
                              errorS3('.notification-s3');
                          },
        });
    });

    // update list s3
    function getListS3() {
        $.ajax({
            url     : '/s3/list',
            method  : 'GET',
            success : function (data) {
                              $('.s3-pagination').html($(data).find('div.pagination-list'));
                              $('.s3-table').html($(data).find('table'));
                          }
        });
    }
});
