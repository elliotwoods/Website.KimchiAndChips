<button onclick="goToTop()" id="goToTopButton" title="Go to top"> &#8593 </button>

<script>
	// When the user scrolls down 20px from the top of the document, show the button
	window.onscroll = function () { onScroll() };

	function onScroll() {
		if (document.body.scrollTop > 800 || document.documentElement.scrollTop > 800) {
			document.getElementById("goToTopButton").style.display = "block";
		} else {
			document.getElementById("goToTopButton").style.display = "none";
		}
	}

	// When the user clicks on the button, scroll to the top of the document
	function goToTop() {
		document.body.scrollTop = 0;
		document.documentElement.scrollTop = 0;
	}
</script>

<style>
#goToTopButton {
	font-family: 'Fira Sans', sans-serif;
    font-size: 13.5px;
    font-weight: 300;
	display: none; 
	position: fixed;
	bottom: 30px; 
	left: 2.5%; 
	z-index: 90; 
	border: none;
	outline: none; 
	cursor: pointer; 
	padding: 0px; 
	color: #a0a0a0;
	background-color: transparent;
	width: 50px;
	height: 50px;
	transition: opacity .5s, visibility .5s; 
}

@media screen and (max-width: 740px) {
	#goToTopButton {
	left: 0%; 
}
</style>