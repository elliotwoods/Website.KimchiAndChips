<style>
	@media screen and (max-width: 650px) {
		.text_description_detail{
        font-family: 'Fira Sans', sans-serif;
        font-size: 11.8px;
        font-weight: 300;
        font-style: normal;
        font-stretch: normal;
        letter-spacing: 0.5px;
        line-height: 1.7;
        text-align: left;
        color: #000000
   		}
	}
</style>

<div class="padding-36"></div>


<div class="mainbody animated fadeIn">

    <div class="works_02">
        <div class="text_en">
            <?= render_markdown_file("kimchiandchips_en.md") ?>
        </div>   
    </div>
    
    <div class="padding-60"></div>

    <div class="works_03">
    	<div class="text_kr">
            <?= render_markdown_file("kimchiandchips_kr.md") ?>
        </div>
    </div>

    <div class="padding-60"></div>
    <div class="padding-1"></div>

	<div class="description_nobg">
    <div class="padding-80"></div> 
		<div class="description_title">
            <span class="text_en_bold">Artists</span>
            <div class="padding-30"></div> 
        </div>
    </div>

    <div class="works_03">
        <div class="text_en">
            <?= render_markdown_file("mimi_en.md") ?>
        </div>  
    </div>
    <div class="padding-60"></div>
    <div class="works_03">
        <div class="text_en">
            <?= render_markdown_file("elliot_en.md") ?>
        </div>  
    </div>

	<div class="padding-60"></div>
	<div class="works_01">
    <div class="padding-1"></div> 
    </div>


	<div class="description_nobg">
    <div class="padding-80"></div> 
		<div class="description_title">
            <span class="text_en_bold">Staff</span>
            <div class="padding-30"></div> 
        </div>
    </div>

    <div class="works_03">
        <div class="text_en">
            <?= render_markdown_file("soyoung_en.md") ?>
        </div>  
    </div>
    <div class="padding-60"></div>
    <div class="works_03">
        <div class="text_en">
            <?= render_markdown_file("yoona_en.md") ?>
        </div>  
    </div>


    <div class="padding-100"></div>


    <div class="description">   
    <div class="padding-30"></div> 
        <div class="description_title">
            <span class="text_en_bold">Selected Exhibitions</span> 
            <div class="padding-30"></div>
        </div>
        <div class="description_detail">
            <div class="text_description_detail">
                <?= render_markdown_file("exhibitions.md") ?>
            </div>
        </div>
    </div>


    <div class="description">    
        <div class="description_title">
            <span class="text_en_bold">Workshops / Lectures</span> 
            <div class="padding-30"></div>
        </div>
        <div class="description_detail">
            <div class="text_description_detail">
                <?= render_markdown_file("workshoplecture.md") ?>
            </div>
            <div class="padding-90"></div>
            <div class="padding-100"></div> 
        </div>
    </div>   
</div>