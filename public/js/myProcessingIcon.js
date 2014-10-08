
$(document).ready(function () {

    //var lad = Ladda.bind('#downloadPDF');
    $('.downloadPDF').click(function () {
        $(this).addClass("loading_button");
        var l = Ladda.create(this);
        l.start();
        blockUIForDownload(l);
    });

    var fileDownloadCheckTimer;
    function blockUIForDownload(l) {

        var token = new Date().getTime(); //use the current timestamp as the token value
        $('.loading_button').attr("href", function (i, href) {
            return href + "?downloadId=" + token;
        });

        fileDownloadCheckTimer = window.setInterval(function () {

            var cookieValue = $.cookie("fileDownloadToken");
            
            if (cookieValue == token)
                finishDownload(l, token);
        }, 500);
    }

    function finishDownload(l, token) {
        l.stop();
        window.clearInterval(fileDownloadCheckTimer);
        $.removeCookie('fileDownloadToken'); //clears this cookie value
        $('.loading_button').attr("href", function (i, href) {

            return href.replace("?downloadId=" + token, "");
        });
        $('.loading_button').removeClass('loading_button');
    }





});










