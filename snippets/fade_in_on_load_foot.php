<script>
	$(document).ready(function() {
		$("img.fadeInOnLoad").one("load", function() {
			$(this).fadeTo(1500, 1.0);
		}).each(function() {

			//We code it this way around - so that if the script fails (sometimes happens on local-loads), then the image fading is disabled by default (full opacity).
			if(this.complete) {
				$(this).load();
			}
			else {
				$(this).addClass("fadeInOnLoad_dimmed");
			}
		});
		
	})
</script>