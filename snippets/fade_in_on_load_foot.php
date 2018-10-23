<script>
function testLoaded(iteration = 0) {
	try {
		var imageElements = $("img.fadeInOnLoad");
		
		imageElements.each(function() {
			// Manually call the load function
			if(this.complete) {
				$(this).load();
			}
		});
	}
	catch(error) {
		//try again
		if(iteration < 10) {
			testLoaded(iteration + 1);
		}
	}
}

$(document).ready(function() {
	var imageElements = $("img.fadeInOnLoad");

	imageElements.one("load", function() {
		$(this).fadeTo(1500, 1.0);
	});

	// Test each if it is already leaded
	testLoaded();

	$(window).on("load", function() {
		//everything is loaded - just in case
		$("img.fadeInOnLoad").fadeTo(1500, 1.0);
	});
})
</script>