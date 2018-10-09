<button onclick="goToTop()" id="goToTopButton" title="Go to top"> &#8648 </button>

<script>
	// When the user scrolls down 20px from the top of the document, show the button
	window.onscroll = function () { onScroll() };

	function onScroll() {
		if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
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
	display: none; /* Hidden by default */
	position: fixed; /* Fixed/sticky position */
	bottom: 110px; /* Place the button at the bottom of the page */
	left: 7%; /* Place the button 7% from the right */
	z-index: 4; /* Make sure it does not overlap */
	border: none; /* Remove borders */
	outline: none; /* Remove outline */
	cursor: pointer; /* Add a mouse pointer on hover */
	padding: 0px; /* Some padding */
	background-color: transparent;
	transition: opacity .5s, visibility .5s; /* transition effect. not necessary */
}
</style>