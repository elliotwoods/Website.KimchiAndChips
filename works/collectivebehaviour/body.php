<div class="padding-120"></div>
<div class="padding-10"></div>

<!-- work main image -->

<div class="full_image">
	<?= render_image("main.jpg", 'alt="halo main" style="width:100%"') ?>
</div>


<div class="mainbody animated fadeIn">

<!-- works detail -->

	<div class="works_02">
		<div class="works_name"> COLLECTIVE BEHAVIOUR </div>
		<div class="year_location_materials"> 2019 <br> KPH Volume, Copenhagen DK <br> Full mirrors, half mirrors, mylar, motorised winches, haze <br> Live performance, 40 min  </div>
	</div>
	<div class="padding-80"></div>


	<div class="padding-1"></div>

	<div class="padding-80"></div>
	
<!-- works description -->

	<div class="works_02 text_en">
		 <?= render_markdown_file("description_en.md") ?>
	</div>

	<div class="works_02 year_location_materials">
	<br> ARTISTIC DIRECTOR, SCENOGRAPHY, LIGHTING: Kimchi and Chips <br> CHOREOGRAPHY: Simone Wierød <br> DANCERS: Boram Jun, Woosang Jeon, Yoonju Song <br> MUSIC: M€RCY feat. Josefine Opsahl <br> COSTUME DESIGN: Marie Nørgaard Nielsen <br> PRODUCER: Lee Soyoung 
	</div>

	<div class="padding-60"></div>

	<div class="works_03 text_kr">
		<?= render_markdown_file("description_kr.md") ?>
	</div>

	<div class="padding-60"></div>




	<div class="works_03">
		<?= render_image("first_idea_sketch.jpg", 'alt="04" style="width:100%"') ?>
		<div class="main-subtext" style="font-style: italic; padding-top:10px;"> Early idea sketch for scenography. November. 2018 </div>

		<div class="padding-30"></div>
		<div style="padding:56.25% 0 0 0;position:relative;"><iframe style="position:absolute;top:0;left:0;width:100%;height:100%;" src="https://www.youtube-nocookie.com/embed/6ebMaR3wpUU" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		</div>

		<div class="main-subtext" style="font-style: italic; padding-top:10px;"> Early prototyping with half mirror, full mirror and light. November.
			2018 </div>
	</div>

	<div class="padding-60"></div>

	<div class="main_image">
		<?= render_image("performance1.jpg", 'alt="06" style="width:100%"') ?>
	</div>
	<div class="padding-5"></div>
	<div class="main_image">
		<?= render_image("performance2.jpg", 'alt="07" style="width:100%"') ?>
	</div>
	<div class="padding-5"></div>
	<div class="main_image">
		<?= render_image("performance3.jpg", 'alt="08" style="width:100%"') ?>
	</div>
	<div class="padding-5"></div>
	<div class="main_image">
		<?= render_image("performance4.jpg", 'alt="09" style="width:100%"') ?>
	</div>
	<div class="padding-5"></div>
	<div class="main_image">
		<?= render_image("performance5.jpg", 'alt="10" style="width:100%"') ?>
	</div>
	<div class="padding-5"></div>
	<div class="main_image">
		<?= render_image("performance6.jpg", 'alt="10" style="width:100%"') ?>
	</div>
	<div class="padding-5"></div>
	<div class="main_image">
		<?= render_image("performance7.jpg", 'alt="11" style="width:100%"') ?>
	</div>
	<div class="padding-5"></div>
	<div class="main_image">
		<?= render_image("performance8.jpg", 'alt="11" style="width:100%"') ?>
	</div>

	<div class="padding-80"></div>
	<div class="works_01">
	<div class="padding-1"></div> 
	</div>

	<div class="padding-60"></div>

<!-- process contents (can include images, texts etc..) -->

     
	<div class="othertext_left" style="font-size: 14px; font-weight: 400; position:relative; padding-bottom:30px; color: black;">Making of ↓</div>

	<div class="works_03">
		<?= render_image("workshop_01.png", 'alt="12" style="width:100%"') ?>
		<div class="main-subtext" style="font-style: italic; padding-top:10px;">Workshop in Seoul Dance Center. September. 2019 </div>
	</div>

	<div class="padding-60"></div>

	<div class="works_03">
		<?= render_image("workshop_02.png", 'alt="12" style="width:100%"') ?>
		<div class="main-subtext" style="font-style: italic; padding-top:10px;">Workshop in Seoul Dance Center. September. 2019 </div>
	</div>
	<div class="padding-60"></div>

	<div class="works_03">
		<?= render_image("workshop_03.png", 'alt="12" style="width:100%"') ?>
		<div class="main-subtext" style="font-style: italic; padding-top:10px;">Developing custome design in CPH. November. 2019 </div>
	</div>
	<div class="padding-60"></div>

	

	<div class="padding-60"></div>

	



	<div class="padding-30"></div>

		

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
</div>
<div class="currentOuter">
	<div class="current">| COLLECTIVE BEHAVIOUR | 2019. KPH VOLUME, DK.</div>
</div>

<style>
$(function () {
    "use strict";
    
    $(".popup img").click(function () {
        var $src = $(this).attr("src");
        $(".show").fadeIn();
        $(".img-show img").attr("src", $src);
    });
    
    $("span, .overlay").click(function () {
        $(".show").fadeOut();
    });
    
});
</style>
