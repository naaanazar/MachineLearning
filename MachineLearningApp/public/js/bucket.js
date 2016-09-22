$(document).ready(function () {
    $('#loader-s3-main').removeClass('hide');
    if(!location.pathname.localeCompare('/s3') && !location.hash.localeCompare('')) {

        var result = [];

        $('tr.active').addClass('hide');
        $('tr.content').addClass('hide');
        $('tr.bg').addClass('hide');

        $.ajax({
            type: "GET",
            url: 's3/allbuckets',
            dataType: 'json',
            success: function (data) {
                data.forEach(function (item) {
                    for (var i = 0; i < result.length; i++) {
                        if (item.path.split('/')[2] == result[i].name) {
                            break;
                        }
                    }

                    if(i == result.length) {
                        var object = {};
                        result.push(createTree(object, item));
                    } else {
                        createTree(result[i], item);
                    }
                });

                localStorage.clear();

                for (var i = 0; i < result.length; i++) {
                    localStorage.setItem(result[i].name, JSON.stringify( result[i]));
                }

                $('tr.active').removeClass('hide');
                $('tr.content').removeClass('hide');
                $('tr.bg').removeClass('hide');
                $('#loader-s3-main').remove();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    }
});

// $(document).ready(function () {
//     $('body').on('click', '.reference', function() {
//
//
//         var $ref = $(this);
//         var name = $ref.text();
//         if (!!getLastHash()) {
//             loc = getLastHash();
//             $('.' + loc).remove();
//         }
//         setLocation('#' + name);
//         showTable(name);
//     });
// });
$(document).ready(function () {
    $('body').on('click', '.reference', function() {
        var $ref = $(this);
        var name = $ref.text();
        if (!!getLastHash()) {
            loc = getLastHash();
            $('.' + loc).remove();
            setLocation('#' + name);
        } else {
            setLocation('#' + name);
            var bucket = findBucket(location.hash.split('#')[1]);
        }
        findItem(bucket, name);

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

function getLastHash() {
    return location.hash.split('#')[location.hash.split('#').length - 1];
}

function setLocation(curLoc){
    location.href = location.href + curLoc;
}

// function showFolder(level, name) {
//     var folders = [];
//     for(var i = 0; i < localStorage.length; i++) {
//         var key = localStorage.key(i);
//
//         if(JSON.parse(localStorage.getItem(key)).path.split('/').length  >= (level + 3) &&
//             JSON.parse(localStorage.getItem(key)).path.split('/')[level + 1] == name) {
//
//             folders.push(JSON.parse(localStorage.getItem(key)).path.split('/')[level + 2]);
//
//         }
//     }
//     folders = unique(folders);
//
//     return folders;
// }
//
// function unique(arr) {
//     var result = [];
//
//     nextInput:
//         for (var i = 0; i < arr.length; i++) {
//             var str = arr[i];
//             for (var j = 0; j < result.length; j++) {
//                 if (result[j] == str) continue nextInput;
//             }
//             result.push(str);
//         }
//
//     return result;
// }
//
//
function showTable(name) {
    $('.content').hide();
    $('#loader-s3-main').remove();
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

                $('#myTable').append("<tr class='" + name + " files'>" +
                    "<td>" + JSON.parse(localStorage.getItem(key)).name + "</td>" +
                    "<td>" + JSON.parse(localStorage.getItem(key)).size + "</td>" +
                    "<td>" + JSON.parse(localStorage.getItem(key)).modified + "</td>" +
                    "<td>" +
                    "<a class='btn btn-default btn-sm' href='https://s3.amazonaws.com/ml-datasets-test/" + JSON.parse(localStorage.getItem(key)).name + "'><span class='glyphicon glyphicon-download'></span></a>" +
                    "<a class='btn btn-danger btn-sm btn-delete' href='/s3/delete/" + JSON.parse(localStorage.getItem(key)).name + "'><span class='glyphicon glyphicon-trash'></span></a>" +
                    "</td>" +
                    "</tr>");

            }

        }
    }
}

function createTree(folder, item ) {
    if (!!item) {
        createTree.item = item;
        createTree.level = 0;
    }
    ++createTree.level;
    if (!(folder.name == createTree.item.path.split('/')[createTree.level + 1])) {
        folder.name = createTree.item.path.split('/')[createTree.level + 1];
    }

    if(!!createTree.item.path.split('/')[createTree.level + 2]) {
        if(!(folder.hasOwnProperty('folders'))) {
            var obj = {};
            obj.name = createTree.item.path.split('/')[createTree.level + 2];
            folder.folders = [obj];
        } else {
            if (folder.folders[folder.folders.length - 1].name != createTree.item.path.split('/')[createTree.level + 2]) {
                    var obj = {};
                    obj.name = createTree.item.path.split('/')[createTree.level + 2];
                    folder.folders.push(obj);
            }
        }
        createTree(folder.folders[folder.folders.length - 1]);
    } else {
        if(!(folder.hasOwnProperty('file'))) {
            folder.file = [createTree.item];
        } else {
            folder.file.push(createTree.item);
        }
    }

    return folder;
}

function findBucket(bucketName) {
    for(var i = 0; i < localStorage.length; i++) {
        var key = localStorage.key(i);

        if (JSON.parse(localStorage.getItem(key)).name == bucketName){
            return JSON.parse(localStorage.getItem(key));
        }
    }
}

function findItem(bucket, itemName) {
    if (!!itemName) {
        findItem.itemName = itemName;
        console.log(findItem.itemName);
    }

    if (bucket.name == findItem.itemName) {
        return bucket;
    } else {
        bucket.folders.forEach(function (content) {
            findItem(content);
        })
    }
}


