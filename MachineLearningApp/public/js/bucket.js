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

            }
        });
    }

    $('body').on('change', '.s3-upload-file', function(event) {
        var nameBucket = $(event.target).closest('tr.content').find('td.reference').text();
        var data = new FormData();

        data.append('file', event.target.files[0]);
        data.append('nameBucket', nameBucket);

        $.ajax({
            url: "s3/upload",
            type:"post",
            cache : false,
            contentType : false,
            processData : false,
            data: data,
            success: function(response) {
                $.jGrowl('Success upload', {
                    theme: 'jgrowl-success'
                });

                $('table.table').ready(function() {
                    location.reload();
                });
            }
        });

        event.preventDefault();
    });

    $('body').on('click', '.reference', function() {
        var $ref = $(this);
        var name = $ref.text();
        if (!!getLastHash()) {
            loc = getLastHash();
            $('.' + loc).remove();
            setLocation('/' + name);
        } else {
            setLocation('#' + name);

            bucket = findBucket();
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

    if(~location.href.lastIndexOf('#')) {
        bucket = findBucket();

        var name = location.href.slice(location.href.lastIndexOf('#') + 1, location.href.length).split('/')
            [location.href.slice(location.href.lastIndexOf('#'), location.href.length).split('/').length - 1];

        showTable(findItem(bucket, name));
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
                        "<td >" + 'folder' + "</td>" +
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
                        "<a class='btn btn-default btn-sm btn-download-s3' href='https://s3.amazonaws.com/" + item.path.slice(item.path.lastIndexOf('//') + 2, item.path.length) + '/' + item.name + "'><span class='glyphicon glyphicon-download '></span></a>" +
                        '<a class="btn btn-danger btn-sm btn-delete" data-name="' + item.name + '" href="#d" id ="'+ item.path + '/'+ item.name + '"><span class="glyphicon glyphicon-trash"></span></a>' +
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

function findBucket() {
    bucketName = location.href.slice(location.href.lastIndexOf('#') + 1, location.href.length).split('/')[0];
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
            findItem.path = location.href.slice(location.href.lastIndexOf('#') + 1, location.href.length);
            findItem.level = 0;
        }

        if (bucket.name == findItem.path.split('/')[findItem.level] && findItem.level == (findItem.path.split('/').length - 1)) {
            findItem.folder = bucket;
        } else {
            if (typeof(bucket.folders) == 'object') {
                bucket.folders.forEach(function (content) {
                    if(content.name == findItem.path.split('/')[findItem.level + 1]) {
                        findItem.level++;

                        findItem(content);
                    }
                })
            }
        }

        return findItem.folder;
    }
}

function deleteFile(file) {
    var bucket = findBucket();
    var folder = location.href.slice(location.href.lastIndexOf('#') + 1, location.href.length).split('/')
        [location.href.slice(location.href.lastIndexOf('#') + 1, location.href.length).split('/').length - 1];
    var folder = findItem(bucket, folder);

    for (var i in folder.file) {
        if(file == folder.file[i].name) {
            folder.file.splice(i, 1);
        }
    }
    console.log(folder.file);
    localStorage.removeItem(bucket.name);
    localStorage.setItem(bucket.name, JSON.stringify(bucket));
}


