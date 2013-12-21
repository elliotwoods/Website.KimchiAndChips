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
        if (href == "main") {
            return true;
        } else if (href != "#") {
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

    layoutLightBox();
});


function layoutLightBox() {
    log('layoutLightBox');
    
    var top = $('#top');
    var width = $( window ).width() - 200;
    var height = $( window ).height() - 200;

    if (width < 1100) {
        width = 1100;
    }
    if (height < 400) {
        height = 400;
    }
    top.css("width", width);
    top.css("height", height);
    top.css("margin-left", -width/2);
    top.css("margin-top", -height/2);
}
//
//--


//--
//check anchor
//--
//
var validProjects = ["LSS"];
function checkAnchor() {
    log('checkAnchor');

    if (lightBoxVisible) {
        //stop recursion
        return;
    }
    var hash = window.location.hash;
    hash = hash.substring(1, hash.length);
    if (jQuery.inArray(hash, validProjects) != -1) {
        showLightBox();
        loadProject(hash);
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
    dim.css('opacity', 0.5);

    dim.animate({
        opacity:1.0
    }, 500, function() {

    });

    dim.css('opacity', '0');

    var top = $('#top');
    top.css('visibility', 'visible');
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
}

function loadProject(name) {
    log('loadProject: ' + name);
    
    var projectDefinitionPath = "works/" + name + "/project.json";
    
    log(projectDefinitionPath);

    $.get(projectDefinitionPath, function(doc) {
        log(doc);
        $("#top").text(doc.work.title);
    }, "json");
}
//
//--