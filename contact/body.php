<style>
	@media screen and (max-width: 740px) {
		   
		.description_title,
		.description_detail{
			position: relative;
			padding-left: 16.25%;
		}

		.description_nobg{
			position: relative;
			margin-top:17px;
			padding-left: 0%;
		}
	}
</style>


<script src="/libs/autosize/dist/autosize.min.js"></script>
<script src="/scripts/contact.js"></script>

<div class="padding-10"></div>

<div class="mainbody animated fadeIn">

	<div class="description_nobg">
		<div class="description_title">
            <span class="text_en_bold">Studio. KIMCHI and CHIPS</span>
            <div class="padding-30"></div> 
		</div>
	</div>
	
	
	<div class="works_03_contact">
        <div class="text_en">
			#103, 405, Munbal-ro, Paju-si, Gyeonggi-do, 10881, Republic of Korea<br>
			<span class="text_kr_address">
			대한민국 경기도 파주시 문발로 405, 103호 (우)10881
			</span>
		<div class="padding-30"></div>
		</div>
	</div>


	<div class="works_03_contact">
		<div class="text_description_detail">
		<span class="press-link" ><a href="https://goo.gl/maps/Bxegk238QH32">Google Maps</a></span>,
		<span class="press-link" ><a href="http://naver.me/xFX2jIPY">Naver Maps</a></span>
		<p></p>
		<span class="press-link"><a href="https://www.facebook.com/kimchiandchips/">Facebook</a></span>,
		<span class="press-link"><a href="https://www.instagram.com/studiokimchiandchips/">Instagram</a></span>,
		<span class="press-link"><a href="https://vimeo.com/mimison">Vimeo</a></span>
		<p></p>
		<span class="press-link"><a href="mailto:info@kimchiandchips.com">info@kimchiandchips.com</a></span>
		</div>
	</div>  


	<div class="padding-100"></div>

	<!-- Newsletter form-->

	<div class="description_nobg">
		<div class="description_title">
            <span class="text_en_bold">Sign up to our newsletter</span>
            <div class="padding-30"></div> 
		</div>
	</div>
	
	<div class="works_03_contact">
		<div class="text_description_detail">
			<!-- Begin MailChimp Signup Form-->                    
			<form action="http://kimchiandchips.us2.list-manage2.com/subscribe/post?u=bbb563a4d4509a1c946a0c998&amp;id=0254b47cee" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
			<span id="contactHeader"></span>
			<input type="email" value="" name="EMAIL" class="formField subscribeField" placeholder="email address" required>
			<!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
			<div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_bbb563a4d4509a1c946a0c998_0254b47cee" tabindex="-1" value=""></div>
			<input type="submit" class="formSubmit" value="SUBSCRIBE" name="subscribe" id="mc-embedded-subscribe">
			</form> 
			<!--End MailChimp Signup Form-->
		</div>
	</div>

<?php
if($mail_form_enabled) {
?>
	<script src="https://www.google.com/recaptcha/api.js?nocookie=1" async defer></script>
	<div class="description_nobg">
		<div class="description_title">
			<span class="text_en_bold">Send a message</span> 
		</div>
	</div>

	<div class="works_03_contact text_description_detail">
		<form action="index.php" method="post">
		<input type="text" value="<?= $sender_name ?>" name="name" class="formField" placeholder="your name" required> <br />
		<input type="text" value="<?= $sender_subject ?>" name="subject" class="formField" placeholder="subject line" required> <br />
		<input type="email" value="<?= $sender_email ?>" name="email" class="formField" placeholder="your email address" required> <br />
					
		<textarea class="formField formTextArea" name="message" placeholder="message"><?= $sender_message ?></textarea> <br />

		<div class="g-recaptcha" data-sitekey="6LeUXnYUAAAAAK2iS2fAWSSnSnStPZQiL0iFPClt"></div>

		<input type="submit" class="formSubmit" value="SEND">
		</form>
	</div>

<?
}
?>
	<div class="padding-100"></div>
	<div class="padding-100"></div>
</div>
	