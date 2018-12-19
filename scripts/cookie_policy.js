//from https://www.w3schools.com/js/js_cookies.asp
function getCookie(cname) {
	var name = cname + "=";
	var decodedCookie = decodeURIComponent(document.cookie);
	var ca = decodedCookie.split(';');
	for(var i = 0; i <ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) == ' ') {
			c = c.substring(1);
		}
		if (c.indexOf(name) == 0) {
			return c.substring(name.length, c.length);
		}
	}
	return "";
}
function setCookie(cname, cvalue, exdays) {
	var d = new Date();
	d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
	var expires = "expires="+d.toUTCString();
	document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

$(document).ready(function() {
	var accepted_cookie = getCookie("accept_cookies");
	if(accepted_cookie == "") {
		$("#cookie_policy").css("visibility", "visible");
	}

	$("#accept_cookies_button").click(function() {
		setCookie("accept_cookies", true, 365);
		$("#cookie_policy").css("visibility", "hidden");
	})
});