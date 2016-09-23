$(document).ready(function () {
    var bucket;
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

    $('body').on('click', '.reference', function() {
        var $ref = $(this);
        var name = $ref.text();
        if (!!getLastHash()) {
            loc = getLastHash();
            $('.' + loc).remove();
            console.log('---');
            setLocation('/' + name);
        } else {
            console.log('+++');
            setLocation('#' + name);
            bucket = findBucket(location.hash.split('#')[1]);
        }

        showTable(findItem(bucket, name));

    });

    $('body').on('click', '.back', function() {
        if(location.href.slice(location.href.lastIndexOf('#'), location.href.length).split('/').length > 1) {
            if (!!getLastHash()) {
                loc = getLastHash();
                $('.' + loc).hide();
            }

            history.pushState('', '', location.href.slice(0, location.href.lastIndexOf('/')));
            var name = location.href.slice(location.href.lastIndexOf('#') + 1, location.href.length).split('/')
                [location.href.slice(location.href.lastIndexOf('#'), location.href.length).split('/').length - 1];
            showTable(findItem(bucket, name));
        } else {
            if (!!getLastHash()) {
                loc = getLastHash();
                $('.' + loc).hide();
                history.pushState('', '', location.href.slice(0, location.href.lastIndexOf('#')));
            }
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
    if (~location.href.lastIndexOf('#')) {
        return location.href.slice(location.href.lastIndexOf('#') + 1, location.href.length).split('/')
            [location.href.slice(location.href.lastIndexOf('#'), location.href.length).split('/').length - 1];
    } else {
        return false;
    }
}

function setLocation(curLoc){
    location.href = location.href + curLoc;
}

function showTable(content) {
    $('.content').hide();
    $('#loader-s3-main').remove();
    if("onhashchange" in window) {
        if (!!content) {
            if (!!content.folders) {
                content.folders.forEach(function (item) {
                    $('#myTable').append("<tr class='" + content.name + " bg'>" +
                        "<td class='reference'>" + item.name + "</td>" +
                        "<td>" + 'folder' + "</td>" +
                        "<td>" + '-' + "</td>" +
                        "<td> " + "</td>" +
                        "</tr>");
                });
            }

            if (!!content.file) {
                content.file.forEach(function (item) {
                    $('#myTable').append("<tr class='" + content.name + " files'>" +
                        "<td>" + item.name + "</td>" +
                        "<td>" + item.size + "</td>" +
                        "<td>" + item.modified + "</td>" +
                        "<td>" +
                        "<a class='btn btn-default btn-sm' href='https://s3.amazonaws.com/ml-datasets-test/" + item.name + "'><span class='glyphicon glyphicon-download'></span></a>" +
                        "<a class='btn btn-danger btn-sm btn-delete' href='/s3/delete/" + item.name + "'><span class='glyphicon glyphicon-trash'></span></a>" +
                        "</td>" +
                        "</tr>");
                });
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
    if(!!bucket) {
        if (!!itemName) {
            findItem.itemName = itemName;
            findItem.folder;
            findItem.path = location.href.slice(location.href.lastIndexOf('#'), location.href.length);
        }

        if (bucket.name == findItem.itemName) {
            findItem.folder = bucket;

        } else {
            if (typeof(bucket.folders) == 'object') {
                bucket.folders.forEach(function (content) {
                    findItem(content);
                })
            }
        }

        return findItem.folder;
    }
}


