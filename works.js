//--
//initialisation
//--
//
$(document).ready(function() {
    log('ready');
    
    checkAnchor();

    $(window).hashchange(function() {
        var hash = window.location.hash;
        if (hash == "#main" || hash == "") {
            hideLightBox();
        }
    });
    
    var $root = $('html, body');
    $('a').click(function() {
        var href = $.attr(this, 'href');
        
        //first check if it's a real link
        if (href.substring(0,1) != '#') {
            return true;
        }
        var workName = href.substring(1, href.length);     
        if (workName == "main") {
            return true;
        } else if (isValidWorkName(workName)) {
            //scroll to the work
            $root.animate({
                scrollTop: $(href).offset().top
            }, 500, function () {
                window.location.hash = href;
                //check where we're at now
                checkAnchor();
            });
        } else {
            hideLightBox();
        }
        return false;
    });

    $("#dim").click(function() {
        hideLightBox();
        return false;
    });

    $( window ).resize(function() {
        layoutLightBox();
        log('resize');
    });
    
    $(document).keyup(function(e) {
        if (e.keyCode == 27) { // esc
            hideLightBox();
        }
    });
});

var workImageBlockWidth;
var workImageBlockVideoHeight;

function layoutLightBox() {
    log('layoutLightBox');
    
    var top = $('#top');
    var workBoxImageBlock = $('#workBoxImageBlock');
    var workBoxTextBlock = $('#workBoxTextBlock');
    
    var width = window.innerWidth;
    var height = window.innerHeight;

    top.removeClass("topHidden");
    
    if (width < 720 || navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
        //tiny screen
        top.removeClass();
        top.addClass("topScroll");
        
        top.css("height", "100%");
        top.css("margin-left", 0);
        top.css("margin-top", 0);
        
        workImageBlockWidth = width;
        
        workBoxImageBlock.css("width", "100%");
        workBoxImageBlock.css("height", "100%");
        workBoxImageBlock.css("margin", "10px");
        workBoxImageBlock.css("overflow-y", "")
        workBoxTextBlock.css("overflow-y", "")
        
        workBoxTextBlock.css("padding-top", "30px");
    } else {
        //normal screen
        top.removeClass();
        top.addClass("topFloat");
        
        width -= 100;
        height -= 100;
        
        workImageBlockWidth = width - 360;
        
        top.css("height", height);
        top.css("margin-left", -width/2);
        top.css("margin-top", -height/2);
        
        workBoxImageBlock.css("width", workImageBlockWidth);
        workBoxImageBlock.css("height", "");
        workBoxImageBlock.css("margin", "");
        workBoxImageBlock.css("overflow-y", "scroll")
        
        workBoxTextBlock.css("padding-top", "130px");
        
    }
    
    if (width > 780 + 360) {
        width = 780 + 360;
    }
    
    if (height < 400) {
        height = 400;
    }
    
    workImageBlockVideoHeight = workImageBlockWidth * 9 / 16 - 10;
    //resize content
    workBoxImageBlock.children('iframe').map(function() {
        $(this).css("height", workImageBlockVideoHeight);
    });
}
//
//--


//--
//check anchor
//--
//
function isValidWorkName(name) {
    return jQuery.inArray(name, validWorks) != -1;
}

function getWorkAnchor() {
    var href = window.location.hash;
    if (href.length > 0) {
        return href.substring(1, href.length);
    } else {
        return '';
    }
}

function urlExists(url) {
    var http = new XMLHttpRequest();
    http.open('HEAD', url, false);
    http.send();
    return http.status!=404;
}

function workFilesExists(name) {
    var workPath = "works/" + name + "/";
    var workDefinitionPath = workPath + "main.json";
    return urlExists(workDefinitionPath);
}

function checkAnchor() {
    log('checkAnchor');

    if (lightBoxVisible) {
        //stop recursion
        return;
    }
    var workName = getWorkAnchor();
    if (isValidWorkName(workName)) {
        // it's a work
        loadWork(workName);
        showLightBox();
    } else if (workName.length > 1 && workFilesExists(workName)) {
        // it's a hidden work
        loadWork(workName);
        showLightBox();
        log('hidden work')
    }
}
//
//--


//--
//open/close lightbox
//--
//
var lightBoxVisible = false;

function showLightBox() {
    log('showLightBox');
    
    layoutLightBox();
    
    lightBoxVisible = true;

    var dim = $('#dim');
    var top = $('#top');
    
    dim.css('visibility', 'visible');
    dim.css('opacity', '0');
    top.css('visibility', 'visible');
    
    dim.animate({
        opacity:1.0
    }, 1000, function() { });  
    
    $("body").css("overflow", "hidden");
}


function hideLightBox() {
    log('hideLightBox');

    var top = $('#top');
    var dim = $('#dim');
    var workBoxImageBlock = $('#workBoxImageBlock');
    var workBoxTextBlock = $('#workBoxTextBlock');
    
    lightBoxVisible = false;
    
    dim.css('visibility', 'visible');
    dim.animate({
        opacity:0.0
    }, 500, function() {
        dim.css('visibility', 'hidden');
        window.location.hash = 'main'; //jumps to top of page with nothing
        workBoxImageBlock.html("");
        workBoxTextBlock.html("");
    });

    $("#workBoxImageBlock").children('iframe').map(function() {
        $(this).attr('src', "");
        log(this);
    });
    
    top.css('visibility', 'hidden');
    $("body").css("overflow", "visible");
}

function loadWork(name) {
    log('loadWork: ' + name);
    
    var workPath = "works/" + name + "/";
    var workDefinitionPath = workPath + "main.json";
    
    log(workDefinitionPath);

    $.get(workDefinitionPath, function(doc) {
        log(doc);
        
        var work = doc;
        
        var html = '';
        
        if (navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
            html += '<a href="#main"><img src="images/common/back.png" id="backButton"></a>';
        }
        html += '<span class="workBoxTitle">' + work.title + "</span><br />";
        html += '<span class="workBoxFormat">' + work.format + "</span><br />";
        html += '<span class="workBoxYear">' + work.year + "</span><br />";
        
        $.each(work.description, function(index, value) {
           html += '<p>' + value + '</p>'; 
        });
        
        $("#workBoxTextBlock").html(html);
        
        
        html = '';
        var workItemIndex = 0;
        var vimeoTag = "vimeo:";
        $.each(work.images, function(index, value) {
            if (workItemIndex != 0) {
                html += '<span class="workBoxSpacer">&nbsp;</span>';
            }
            if (value.indexOf(vimeoTag) == 0) {
                var videoIdentifier = value.substring(vimeoTag.length);
                var toStrip = unescape('%E2%80%8E');
                var vimeoUrl = '//player.vimeo.com/video/' + videoIdentifier + '?color=ffffff&amp;title=0&amp;byline=0&amp;portrait=0';
                vimeoUrl = vimeoUrl.replace("\u200e", '');
                html += '<iframe class="workBoxImage" src="' + vimeoUrl + '" style="width: 100%; height: ' + workImageBlockVideoHeight + 'px;" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
            } else {
                html += '<img class="workBoxImage" src="' + workPath + value + '" />';
            }

            workItemIndex++;
        });
        
        $("#workBoxImageBlock").html(html);
        
        //strip bottom margin of last
        $("#workBoxImageBlock > img").last().css("margin-bottom", "0px");
    }, "json");
}
//
//--
