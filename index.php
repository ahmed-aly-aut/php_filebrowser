<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Test</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="style/filebrowser.css" rel="stylesheet">
    <link href="style/main.css" rel="stylesheet">
    <link href="style/bootstrap.icon-large.min.css" rel="stylesheet">
    <link href="style/scrollbar.css" rel="stylesheet">

</head>
<body>
<div class="header"></div>
<div class="navigationbar">
    <a href="javascript:back()">
        <div class="box">
            <i class="icon-large icon-left-arrow"></i>
        </div>
    </a>
    <a href="javascript:forward()">
        <div class="box">
            <i class="icon-large icon-right-arrow"></i>
        </div>
    </a>
    <a href="javascript:out()">
        <div class="box">
            <i class="icon-large icon-up-arrow"></i>
        </div>
    </a>
    <a href="javascript:home()">
        <div class="box">
            <i class="icon-large icon-home"></i>
        </div>
    </a>
    <a href="javascript:createdir('Test')">
        <div class="box">
            <i class="icon-large icon-plus-sign"></i>
        </div>
    </a>

</div>

<div class="files" id="files">
</div>

<div class="main">
    <div class="image" id="box_3"></div>
</div>
<div class="info" id="info"></div>

<div class="tag"><textarea></textarea>
</div>
<div class="footer"></div>
<script>
    var main = "upload/";
    var current = main;
    var _back = [];
    var _last = [];
    var httpLoad = new HttpLoad();
    window.onload = function () {
        listElements();
    };

    function listElements() {

        httpLoad.changestatewhenready("files");
        httpLoad.send("GET", 'request.php?action=listelements&current=' + current);
    }

    function home() {
        httpLoad.changestatewhenready("files");
        _back.push(current);
        current = main;
        httpLoad.send("GET", 'request.php?action=home&current=' + main);
    }

    function out() {
        if (current != main) {
            httpLoad.changestatewhenready("files");
            httpLoad.send("GET", 'request.php?action=out&current=' + current);
            var currents = current.split("/");
            _back.push(current);
            current = "";
            for (var i = 0; i < currents.length - 2; i++)
                current += currents[i] + "/";
        }
    }

    function back() {
        if (_back.length != 0) {
            httpLoad.changestatewhenready("files");
            _last.push(current);
            current = _back[_back.length - 1];
            httpLoad.send("GET", 'request.php?action=back&back=' + current);
            _back.pop();
        }
    }

    function forward() {
        if (_last.length != 0) {
            httpLoad.changestatewhenready("files");
            current = _last[_last.length - 1];
            httpLoad.send("GET", 'test.php?action=forward&forward=' + current);
            _back.push(current);
            _last.pop();
        }
    }

    function opendir(dir) {
        httpLoad.changestatewhenready("files");
        httpLoad.send("GET", 'request.php?action=opendir&dir=' + dir + '&current=' + current);
        _back.push(current);
        current += dir;
    }

    function createdir(dir) {
        httpLoad.changestatewhenready("files");
        httpLoad.send("GET", 'request.php?action=createdir&dir=' + dir + '&current=' + current);
    }

    function openfile(file) {
        httpLoad.changestatewhenready("box_3");
        httpLoad.send("GET", 'request.php?action=openfile&file=' + file + '&current=' + current);
    }

    function HttpLoad() {
        var xmlhttp;

        if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        }
        else {// code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }


        HttpLoad.prototype.changestatewhenready = function (elementById) {
            if (elementById == null) {
                xmlhttp.onreadystatechange = null;
            } else {
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById(elementById).innerHTML = xmlhttp.responseText;
                    }
                };
            }
        };

        HttpLoad.prototype.send = function (method, url) {
            xmlhttp.open(method, url, true);
            xmlhttp.send();
        };
    }
</script>
</body>
</html>