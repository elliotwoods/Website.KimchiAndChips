<? require("defaults.php"); ?>
<!DOCTYPE html>  
<html lang="en">  
    <head>
<? require("header.php"); ?>
        <link rel="stylesheet" type="text/css" href="contact.css">
    </head>  
    <body>
        <div id="main">
        
<? require("navigationBar.php"); ?>            
            <div id="contactColumn1">
                <span id="contactHeader">Address</span>
                <p>
                    &#35;1204, 202 Dong Chunui Techno Park II<br />
                    Chunuidong 202, Wonmigu, Bucheonsi<br />
                    South Korea (zip ; 420-857)
                </p>
                <p>
                    경기도 부천시 원미구 춘의동 202<br />
                    춘의테크노파크 2차 202동<br />
                    1204호
                </p>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3165.2822098595625!2d126.7877955!3d37.5012616!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x357b62b15237472f%3A0xab5782b63f04303d!2z7LaY7J2Y7YWM7YGs64W47YyM7YGsMuywqOq0gOumrOyGjA!5e0!3m2!1sen!2s!4v1392608003293" width="422" height="422" frameborder="0" style="border:0"></iframe>
                
                <!-- Begin MailChimp Signup Form -->
                <br /><br />
                <style type="text/css">
                    #mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; }
                    /* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
                       We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
                </style>
                
                <form action="http://kimchiandchips.us2.list-manage2.com/subscribe/post?u=bbb563a4d4509a1c946a0c998&amp;id=0254b47cee" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                    <span id="contactHeader">Subscribe to our mailing list</span>
                    <input type="email" value="" name="EMAIL" class="formField" placeholder="email address" required>
                    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                    <div style="position: absolute; left: -5000px;"><input type="text" name="b_bbb563a4d4509a1c946a0c998_0254b47cee" value=""></div>
                    <div class="clear">
                        <input type="submit" class="formSubmit" value="SUBSCRIBE" name="subscribe" id="mc-embedded-subscribe">
                    </div>
                </form>
                
                <!--End mc_embed_signup-->
            </div>
            
            <div id="contactColumn2">
                <span id="contactHeader">Contact us</span>
<?
if ($mailform_sent) {
?>
                <p>
                    Thank you for your message. We'll be in touch as soon as we can.
                </p>
                <p>
                    You can also email directly to <a href="mailto:info@kimchiandchips.com">info@kimchiandchips.com</a> in future. Speak soon!
                </p>
<?
} else {
?>
                <p>
                    Use the boxes below to send a message to us. We're always open to making new friends.
                </p>
                <form action="contact-sender.php" method="post" name="form1" id="form1">
                    <div class="formFieldCaption">Name</div>
                    <input class="formField" type="text" name="name" value="<?= $_POST["name"] ?>" />
                    
                    <div class="formFieldCaption">EMail Address</div>
                    <input class="formField" type="email" name="email" value="<?= $_POST["email"] ?>" />
    
                    <div class="formFieldCaption">Subject</div>
                    <input class="formField" type="text" name="subject" value="<?= $_POST["subject"] ?>" />
                    
                    <div class="formFieldCaption">Verification code</div>
                    <div class="verificationArea">
                        <img class="formVerificationImage" src="verificationimage.php?<?php echo rand(0,9999);?>" alt="Verification code" />
                        <div class="dottedConnection"></div>
                        <input class="formField formVerificationField" type="text" name="verification" placeholder="####" 
                        <?= $mailform_failed_verification ? " style=\"background: #fcc;\"" : "" ?>
                        />
                    </div>
                    <div class="formNotes">
                        Robots are great, but they don't make good pen pals.<br />
                        Please type out the code you see so we can tell that you're human.</br >
                    </div>
                    
                    <div class="formFieldCaption">Message</div>
                    <textarea class="formField formMessageArea" name="message"><?= $_POST["message"] ?></textarea>
                    
                <input class="formSubmit" type="submit" value="SEND" />
                </form>
<?
}
?>
            </div>
            
            <div class="footer">
            	KIMCHI and CHIPS
            </div>
        </div>
    </body>
</html>