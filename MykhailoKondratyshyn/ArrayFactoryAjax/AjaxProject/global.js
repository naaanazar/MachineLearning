function funcBefore() {
    $('#information').text ("Loading...");
}

function funcSuccess (data) {
    $('#information').text (data);
}



$(document).ready(function () {
    $('button').click(function () {
        var admin = "Admin";
        $.ajax ({
            url: "index.php",
            type: "POST",
            data: ({name: admin, number: 5}),
            dataType: "html",
            beforeSend: funcBefore,
            success: funcSuccess
        });
    });
});