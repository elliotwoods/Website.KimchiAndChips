//--
//keep navbar in place
//--
//
window.onscroll = function(args) {
    var y = window.pageYOffset;
    var navBar = document.getElementById("navigationBar");
    var newY = 0;
    if (y < 0) {
        newY = 66;
    } else if (y < 66) {
        newY = 66 - y;
    } else {
        newY = 0;
    }
    newY += 'px'
    navBar.style.top = newY;
}
//
//--



//--
//smooth scrolling to anchors
//--
//
var $root = $('html, body');
$('a').click(function() {
    var href = $.attr(this, 'href');
    $root.animate({
        scrollTop: $(href).offset().top
    }, 500, function () {
        window.location.hash = href;
    });
    return false;
});
//
//--