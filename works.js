//--
//initialisation
//--
//
$(document).ready(function() {
    log('ready');
    
    checkAnchor();

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
            $root.animate({
                scrollTop: $(href).offset().top
            }, 500, function () {
                window.location.hash = href;
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
    });
    
    $(document).keyup(function(e) {
        if (e.keyCode == 27) { // esc
            hideLightBox();
        }
    });

    layoutLightBox();
});

function layoutLightBox() {
    log('layoutLightBox');
    
    var top = $('#top');
    var width = $( window ).width() - 100;
    var height = $( window ).height() - 100;

    if (width > 780 + 360) {
        width = 780 + 360;
    }
    if (height < 400) {
        height = 400;
    }
    
    top.css("height", height);
    top.css("margin-left", -width/2);
    top.css("margin-top", -height/2);
    
     var workBoxImageBlock = $('#workBoxImageBlock');
     workBoxImageBlock.css("width", width - 360);
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

function checkAnchor() {
    log('checkAnchor');

    if (lightBoxVisible) {
        //stop recursion
        return;
    }
    var workName = getWorkAnchor();
    if (isValidWorkName(workName)) {
        loadWork(workName);
        showLightBox();
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

    lightBoxVisible = true;

    var dim = $('#dim');
    dim.css('visibility', 'visible');
    dim.css('opacity', '0');

    dim.animate({
        opacity:1.0
    }, 500, function() {

    });

    var top = $('#top');
    top.css('visibility', 'visible');
    $("body").css("overflow", "hidden");
}


function hideLightBox() {
    log('hideLightBox');

    lightBoxVisible = false;
    var dim = $('#dim');
    dim.css('visibility', 'visible');
    dim.animate({
        opacity:0.0
    }, 500, function() {
        dim.css('visibility', 'hidden');
        window.location.hash = 'main'; //jumps to top of page with nothing
    });

    $('#top').css('visibility', 'hidden');
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
        
        html += '<span class="workBoxTitle">' + work.title + "</span><br />";
        html += '<span class="workBoxFormat">' + work.format + "</span><br />";
        html += '<span class="workBoxYear">' + work.year + "</span><br />";
        
        $.each(work.description, function(index, value) {
           html += '<p>' + value + '</p>'; 
        });
        
        $("#workBoxTextBlock").html(html);
        
        
        html = '';
        $.each(work.images, function(index, value) {
            html += '<img class="workBoxImage" src="' + workPath + value + '" />';
        });
        
        
        $("#workBoxImageBlock").html(html);
    }, "json");
}
//
//--
