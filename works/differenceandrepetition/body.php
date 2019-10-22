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

<!-- works main video -->

	<div class="works_01">
		<div style="padding:56.25% 0 0 0;position:relative;"><iframe src="https://player.vimeo.com/video/346172620?&title=0&byline=0&portrait=0"
			 style="position:absolute;top:0;left:0;width:100%;height:100%;" frameborder="0" webkitallowfullscreen
			 mozallowfullscreen allowfullscreen></iframe>
		</div>
		<script src="https://player.vimeo.com/api/player.js"></script>
	</div>

<!-- works contents (can include images, texts etc..) -->

	<div class="padding-60"></div>

	<div class="works_02">
		<?= render_image("audience_01.jpg", 'alt="01" style="width:100%"') ?>
	</div>

	<div class="padding-30"></div>

	<div class="works_03">
		<?= render_image("installation_02.jpg", 'alt="02" style="width:100%"') ?>
	</div>

	<div class="padding-60"></div>

	<div class="main_image">
		<?= render_image("installation_01.jpg", 'alt="03" style="width:100%"') ?>
	</div>
	<div class="padding-5"></div>
	<div class="main_image">
		<?= render_image("installation_03.jpg", 'alt="04" style="width:100%"') ?>
	</div>
	<div class="padding-5"></div>
	<div class="main_image">
		<?= render_image("installation_04.jpg", 'alt="05" style="width:100%"') ?>
	</div>
	<div class="padding-5"></div>
	<div class="main_image">
		<?= render_image("installation_05.jpg", 'alt="05" style="width:100%"') ?>
	</div>
	<div class="padding-5"></div>
	<div class="main_image">
		<?= render_image("installation_06.jpg", 'alt="05" style="width:100%"') ?>
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
		</div>
	</div>

<!-- Related links -->

	<div class="description">
		<div class="description_title">
			<span class="text_en_bold">Related links</span>
			<div class="padding-30"></div>
		</div>
		<div class="description_detail">
			<div class="text_description_detail">
				<span class="press-link"><a href="http://www.creativeapplications.net/environment/halo-sculpting-the-sunlight-into-immaterial-form/" target="_blank"> 
                HALO – Sculpting the sunlight into (im)material form</a></span> <br>
				Creative Applications / June 2018
				<p></p>
				<span class="press-link"><a href="https://www.designboom.com/art/kimchi-chips-halo-london-07-19-18/" target="_blank">
				Seoul studio Kimchi and Chips sculpt with sunlight to create HALO</a></span> <br>
				Designboom / July 2018
			</div>
			<div class="padding-90"></div>
			<div class="padding-100"></div>
		</div>
	</div>
</div>