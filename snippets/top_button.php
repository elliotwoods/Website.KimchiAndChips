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