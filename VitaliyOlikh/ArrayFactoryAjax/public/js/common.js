$(document).ready(function() {
    
    function ajaxOutput(id, file) {
        
        var path = 'js/json/' + file;

        $(id).click(function() {            
           $.getJSON(path, function(data) {
               var output = '<table border="1">';

               for (var i = 0; i < data.length; i++) {
               output += '</tr>';
               
                    $.each(data[i], function(key, val) {
                        output += '<td>' + val + '</td>';
                    });
                    
               output += '</tr>';
               }
               
               output += '</table>';
               
               $('#update').html(output);
           });
        });
    }
    
    ajaxOutput('#standart', 'Standart Sort.json');
    ajaxOutput('#snake', 'Snake Sort.json');
    ajaxOutput('#spiral', 'Spiral Sort.json');

});