//--
//keep navbar in place
//--
//
$(document).ready(function() {
    var navBar = $('#navigationBar');
    if (navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
        
        navBar.css("top", -1);
        navBar.css("left", 0);
        navBar.css("border", "none");
        navBar.css("background-image", "url('images/common/white.png')");
        $("body").scrollTop(66);
    } else {
        window.onscroll = function(args) {
            var y = $(window).scrollTop();
            var newY = 0;
            if (y < 0) {
                newY = 66;
            } else if (y < 66) {
                newY = 66 - y;
            } else {
                newY = 0;
            }
            newY += 'px'
            navBar.css("top", newY);
        }
        navBar.css("background", "white");
    }
});
//
//--



//--
//general logging
//--
//
function log(content) {
    if(!isLive){
        console.log(content);
    }
}
//
//--