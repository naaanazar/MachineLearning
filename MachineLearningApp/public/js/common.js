$(document).ready(function () {
    // tooltip from upload button
    $("[data-toggle='tooltip']").tooltip();
    // upload button without submit
    $('#input-file').change(function() {
        $('.form-upload').submit();
    } ) ;
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
});
