<div class="padding-120"></div>
<div class="padding-10"></div>

<!-- work main image -->

<div class="full_image">
	<?= render_image("main.jpg", 'alt="halo main" style="width:100%"') ?>
</div>


<div class="mainbody animated fadeIn">

<!-- works detail -->

	<div class="works_02">
		<div class="works_name"> DIFFERENCE AND REPETITION </div>
		<div class="year_location_materials"> 2019 <br> Uni-City, Changwon KR <br> Concrete, mirror, LED light <br> 77,000mm x 30,000mm x 30,000mm </div>
	</div>
	<div class="padding-80"></div>


	<div class="padding-1"></div>

	<div class="padding-80"></div>

<!-- works description -->

	<div class="works_02 text_en">
		 <?= render_markdown_file("description_en.md") ?>
	</div>

	<div class="padding-60"></div>
	<div class="works_03 text_kr">
		<?= render_markdown_file("description_kr.md") ?>
	</div>

	<div class="padding-60"></div>


<!-- works contents (can include images, texts etc..) -->

<div class="threeCol">
		<div class="leftwork">
		<?= render_image("installation_06.jpg", 'alt="05" style="width:100%"') ?>
		</div>
		<div class="centerwork">
		<?= render_image("installation_07.jpg", 'alt="06" style="width:100%"') ?>
		</div>
		<div class="rightwork">
		<?= render_image("installation_08.jpg", 'alt="07" style="width:100%"') ?>
		</div>
	</div>

	<div class="padding-60"></div>

	<!-- works main video -->

	<div class="works_03">
		<div style="padding:56.25% 0 0 0;position:relative;"><iframe src="https://player.vimeo.com/video/346172620?&title=0&byline=0&portrait=0"
			 style="position:absolute;top:0;left:0;width:100%;height:100%;" frameborder="0" webkitallowfullscreen
			 mozallowfullscreen allowfullscreen></iframe>
		</div>
		<script src="https://player.vimeo.com/api/player.js"></script>
	</div>
	<div class="works_03">  
		<div class="main-subtext" style="font-style:italic; padding-top:10px;">
		Working video, April 2019
		</div>
	</div>
	<div class="padding-60"></div>

	<div class="works_02">
		<?= render_image("prototype.jpg", 'alt="04" style="width:100%"') ?>
	</div>
	<div class="works_02">  
		<div class="main-subtext" style="font-style:italic; padding-top:10px;">
		Scaled prototype March 2019
		</div>
	</div>

	<div class="padding-30"></div>

	
	<div class="works_03">
		<?= render_image("audience_01.jpg", 'alt="01" style="width:100%"') ?>
	</div>

	<div class="padding-30"></div>


	<div class="works_02">
		<?= render_image("installation_01.jpg", 'alt="01" style="width:100%"') ?>
	</div>

	<div class="padding-30"></div>


	<div class="works_03">
		<?= render_image("installation_02.jpg", 'alt="02" style="width:100%"') ?>
	</div>

	<div class="padding-5"></div>

	<div class="works_03">
		<?= render_image("installation_03.jpg", 'alt="02" style="width:100%"') ?>
	</div>

	<div class="padding-30"></div>
	
	

	
	<div class="padding-5"></div>
	<div class="main_image">
		<?= render_image("installation_04.jpg", 'alt="04" style="width:100%"') ?>
	</div>
	<div class="padding-5"></div>
	<div class="main_image">
		<?= render_image("installation_05.jpg", 'alt="05" style="width:100%"') ?>
	</div>
	


	

	<div class="padding-100"></div>

<!-- Ackhowledgements -->

	<div class="description">
	<div class="padding-30"></div>
		<div class="description_title">
			<span class="text_en_bold">Acknowledgements</span>
			<div class="padding-30"></div>
		</div>
		<div class="description_detail">
			<div class="text_description_detail">
				<?= render_markdown_file("acknowledgements.md") ?>
			</div>
			<div class="padding-90"></div>
			<div class="padding-100"></div>
		</div>
	</div>

<!-- Related links -->

	
</div>