$(document).ready(function () {
    if(!location.pathname.localeCompare('/s3') && !location.hash.localeCompare('')) {
        $.ajax({
            type: "GET",
            url: 's3/allbuckets',
            dataType: 'json',

            success: function (data) {
                localStorage.clear();
                data.forEach(function (item) {
                    localStorage.setItem(item.name, JSON.stringify(item));
                });
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    }
});

$(document).ready(function () {
    $('body').on('click', '.reference', function() {
        var $ref = $(this);
        var name = $ref.text();
        if (!!getLastHash()) {
            loc = getLastHash();
            $('.' + loc).remove();
        }
        setLocation('#' + name);
        showTable(name);
    });
});

$(document).ready(function () {
    $('body').on('click', '.back', function() {

        if(location.href.split('#').length > 2) {
            if (!!getLastHash()) {
                loc = getLastHash();
                $('.' + loc).hide();
            }
            history.pushState('', '', location.href.slice(0, location.href.lastIndexOf('#')));
            var name = location.hash.split('#')[location.hash.split('#').length -1];
            showTable(name);
        } else if(location.href.split('#').length == 2) {
            if (!!getLastHash()) {
                loc = getLastHash();
                $('.' + loc).hide();
            }
            history.pushState('', '', location.href.slice(0, location.href.lastIndexOf('#')));
            $('.content').show();
        }
    });
});

$(document).ready(function () {
    if(location.href.split('#').length > 1) {
        var name = location.hash.split('#')[location.hash.split('#').length -1];
        showTable(name);
    }
});

function setLocation(curLoc){
    location.href = location.href + curLoc;
}

function showFolder(level, name) {
    var folders = [];
    for(var i = 0; i < localStorage.length; i++) {
        var key = localStorage.key(i);

        if(JSON.parse(localStorage.getItem(key)).path.split('/').length  >= (level + 3) &&
            JSON.parse(localStorage.getItem(key)).path.split('/')[level + 1] == name) {

            folders.push(JSON.parse(localStorage.getItem(key)).path.split('/')[level + 2]);

        }
    }
    folders = unique(folders);

    return folders;
}

function unique(arr) {
    var result = [];

    nextInput:
        for (var i = 0; i < arr.length; i++) {
            var str = arr[i];
            for (var j = 0; j < result.length; j++) {
                if (result[j] == str) continue nextInput;
            }
            result.push(str);
        }

    return result;
}

function getLastHash() {
    return location.hash.split('#')[location.hash.split('#').length - 1];
}

function showTable(name) {
    $('.content').hide();
    if("onhashchange" in window) {
        var level = location.hash.split('#').length - 1;
        folders = showFolder(level, name);
        for (var item in folders) {
            $('#myTable').append("<tr class='" + name + " bg'>" +
                "<td class='reference'>" + folders[item] + "</td>" +
                "<td>" + 'folder' + "</td>" +
                "<td>" + '-' + "</td>" +
                "<td> " + "</td>" +
                "</tr>");
        }

        for(var i = 0; i < localStorage.length; i++) {
            var key = localStorage.key(i);

            if(JSON.parse(localStorage.getItem(key)).path.split('/')[JSON.parse(localStorage.getItem(key)).path.split('/').length - 1]
                == location.hash.split('#')[location.hash.split('#').length -1] &&
                JSON.parse(localStorage.getItem(key)).path.split('/')[level + 1] ==
                name) {

                $('#myTable').append("<tr class='" + name + "'>" +
                    "<td>" + JSON.parse(localStorage.getItem(key)).name + "</td>" +
                    "<td>" + JSON.parse(localStorage.getItem(key)).size + "</td>" +
                    "<td>" + JSON.parse(localStorage.getItem(key)).modified + "</td>" +
                    "<td> " +
                    "<a class='btn btn-default btn-sm' href='https://s3.amazonaws.com/ml-datasets-test/" + JSON.parse(localStorage.getItem(key)).name + "'><span class='glyphicon glyphicon-download'></span></a>" +
                    "<a class='btn btn-danger btn-sm btn-delete' href='/s3/delete/" + JSON.parse(localStorage.getItem(key)).name + "'><span class='glyphicon glyphicon-trash'></span></a>" +
                    "</td>" +
                    "</tr>");

            }
        }
    }
}



// $(document).ready(function () {
//     if(!location.pathname.localeCompare('/s3') && !location.hash.localeCompare('')) {
//         var result = [];
//         $.ajax({
//             type: "GET",
//             url: 's3/allbuckets',
//             dataType: 'json',
//
//             success: function (data) {
//                 localStorage.clear();
//                 data.forEach(function (item) {
//                     for (var i = 0; i < result.length; i++) {
//                         if (item.name == result[i].name) {
//                             break;
//                         }
//                     }
//                     if(i == result.length) {
//                         var object = {};
//                         result.push(createTree(object, item));
//                         cosole.log('1');
//                     } else {
//                         result.push(createTree(result[i].name, item));
//                         console.log('2');
//                     }
//                 });
//                 console.log(result);
//             },
//             error: function (data) {
//                 console.log('Error:', data);
//             }
//         });
//     }
// });
//
function createTree(folder, item ) {
    if (!!item) {
        createTree.item = item;
        createTree.level = 0;
    }

    if (!(folder.name == createTree.item.split('/')[createTree.level + 1])) {
        folder.name = createTree.item.split('/')[createTree.level + 1];
    }

    if(!!createTree.item.split('/')[createTree.level + 2]) {
        if(!(folder.hasOwnProperty('folders'))) {
            folder.folders = [createTree.item.split('/')[createTree.level + 2]];
        }
        folder.folders.push(createTree.item.split('/')[createTree.level + 2]);
        createTree(folder.folders, ++createTree.level);
    } else {
        folder.file =createTree.item;
    }

    return folder;
}

// var folder = {};
// var res = [];
// res.push(createTree(folder, 1, 's3://ml-datasets-test/batch-prediction/result/result2/result3'));
// console.log(folder);
// folder = createTree(folder, 1, 's3://ml-datasets-test/batch-prediction/result');

// function check(property) {
//     if(property.name == 'Serhiy') {
//         console.log('+++');
//     } else  {
//         property.name = 'Serhiy';
//     }
//
//     return property;
// }
//
// var prop = {};
// prop = check(prop);
// console.log(prop);
// prop = check(prop);
// console.log(prop);
