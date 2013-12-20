//--
//initialisation
//--
//
$(document).ready(function() {
    //if we have a hash, load the lightbox
    if (window.location.hash) {
        showLightBox();
    }

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
            });
            showLightBox();
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
    var top = $('#top');
    var width = $( window ).width() - 200;
    var height = $( window ).height() - 200;

    if (width < 1200) {
        width = 1200;
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
function checkAnchor() {
    if (window.location.hash) {
        if (window.location.hash.length != "#") {
            showLightBox();
        }
    } 
}
//
//--

//--
//open/close lightbox
//--
//
function showLightBox() {
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

    var workName = window.location.hash;
    $.get('works/' + workName + '/project.xml', function(xml) {
        $(d).find('image').each(function(){
            alert($(this));
        });
    });
}

function hideLightBox() {
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
//
//--
