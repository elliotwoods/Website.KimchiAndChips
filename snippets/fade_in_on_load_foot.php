<script>
function testLoaded(iteration) {
	try {
		var imageElements = $("img.fadeInOnLoad");
		
		imageElements.each(function() {
			// Manually call the load function
			if(this.complete) {
				$(this).fadeTo(1500, 1.0);
				
				//$(this).load();
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

	// Test each if it is already loaded
	testLoaded(0);

	$(window).on("load", function() {
		//everything is loaded - just in case
		$("img.fadeInOnLoad").fadeTo(1500, 1.0);
	});
})
</script>