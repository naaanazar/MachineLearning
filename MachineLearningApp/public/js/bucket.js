function setLocation(curLoc){
    location.href = curLoc;
}

$(document).ready(function () {

    if(location.href.split('#').length > 1) {
        $('.content').hide();

        var name = location.href.split('#')[location.href.split('#') - 1];
        for(var i = 0; i < localStorage.length; i++) {
            var key = localStorage.key(i);
            $('#myTable').append("<tr class='new'>" +
                "<td class='id'>" + 1 + "</td>" +
                "<td>" + JSON.parse(localStorage.getItem(key))[0] + "</td>" +
                "<td>" + JSON.parse(localStorage.getItem(key))[1] + "</td>" +
                "<td>" + JSON.parse(localStorage.getItem(key))[2] + "</td>" +
                "<td> " +
                "<a class='btn btn-default btn-sm' href='https://s3.amazonaws.com/ml-datasets-test/" + JSON.parse(localStorage.getItem(key))[0] + "'><span class='glyphicon glyphicon-download'></span></a>" +
                "<a class='btn btn-danger btn-sm btn-delete' href='/s3/delete/" + JSON.parse(localStorage.getItem(key))[0] + "'><span class='glyphicon glyphicon-trash'></span></a>" +
                "</td>" +
                "</tr>");
        }
    } else {
        $('.reference').click(function () {
            var $ref = $(this);
            var name = $ref.text();
            $('.content').hide();
            replaceTable(name);
        });
    }
});

// $(document).ready(function () {
//     if(!location.pathname.localeCompare('/bucket')) {
//         $.ajax({
//             type: "GET",
//             url: 'bucket/allbuckets',
//             dataType: 'json',
//
//             success: function (data) {
//                 var id = 0;
//                 // data.forEach(function (item) {
//                 //     console.log(item);
//                 // })
//                 console.log(data);
//             },
//             error: function (data) {
//                 console.log('Error:', data);
//             }
//         });
//     }
// });

function replaceTable(name) {
    $.ajax({
        type: "GET",
        url: 's3/list' + '/' + name,
        dataType: 'json',

        success: function (data) {
            var id = 1;
            localStorage.clear();
            if(data.length) {
                console.log('---');
                setLocation('#' + name);
                console.log(data);
                data.forEach(function (item) {
                    localStorage.setItem(id + 'Key', JSON.stringify([item.Key, item.Size, item.LastModified]));

                    $('#myTable').append("<tr class='new'>" +
                        "<td class='id'>" + id++ + "</td>" +
                        "<td>" + item.Key + "</td>" +
                        "<td>" + item.Size + "</td>" +
                        "<td>" + item.LastModified + "</td>" +
                        "<td> " +
                        "<a class='btn btn-default btn-sm' href='https://s3.amazonaws.com/ml-datasets-test/" + item.Key + "'><span class='glyphicon glyphicon-download'></span></a>" +
                        "<a class='btn btn-danger btn-sm btn-delete' href='/s3/delete/" + item.Key + "'><span class='glyphicon glyphicon-trash'></span></a>" +
                        "</td>" +
                        "</tr>");
                })
            } else {
                console.log('+++');
                setLocation('#' + name);
                $('.content').remove();
            }
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
}












function localLoadData() {
    if(~location.pathname.localeCompare('/bucket')) {

    }
}
