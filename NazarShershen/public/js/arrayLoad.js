function loadStraightArray() {
    jQuery.ajax({
        url: "arrayAjaxHandler.php",
        method: "POST",
        data: {
            type: 1
        },
        dataType: "json",
        success: function (data) {
            displayArray(data.array, "for-straight");
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR.responseText);
        }
    });
}

function loadVerticalArray() {
    jQuery.post(
            "arrayAjaxHandler.php",
            { type: 2 },
            function(data) {
                displayArray(data.array, "for-vertical");
            },
            "json"
    );
}

function loadVerticalReverseArray() {
    jQuery.get(
            "arrayAjaxHandler.php",
            { type: 3 },
            function(data) {
                displayArray(data.array, "for-vertical-reverse");
            },
            "json"
    );
}

function displayArray(array, type) {

    var div = $("#" +type);
    for(var row in array) {
        div.append(array[row] + "<br>");
    }
}

jQuery(document).ready(function() {
    jQuery("#straight").click(function() {
        loadStraightArray();
    });
    jQuery("#vertical").click(function() {
        loadVerticalArray();
    });
    jQuery("#vertical_reverse").click(function() {
        loadVerticalReverseArray();
    });
});