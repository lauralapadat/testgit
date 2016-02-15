<?php
// autofill the ticket
$product = esc_html( get_query_var( 'ticket_product') );
$key = esc_html( get_query_var("ticket_key") );
$osversion = esc_html( get_query_var("ticket_osversion") );
$filled = esc_html( get_query_var("ticket_filled") );

$version = esc_html( get_query_var("ticket_version") );
$browser = esc_html( get_query_var("ticket_browser") );
$freeram = esc_html( get_query_var("ticket_freeram") );
$disks = esc_html( get_query_var("ticket_disks") );
$winpath = esc_html( get_query_var("ticket_winpath") );
$root = esc_html( get_query_var("ticket_root") );
$userdir = esc_html( get_query_var("ticket_userdir") );
$screen = esc_html( get_query_var("ticket_screen") );
$locale = esc_html( get_query_var("ticket_locale") );
$programdir = esc_html( get_query_var("ticket_programdir") );

?>
<div id="submission-form-wrapper">
    <div id="form1" class="ui form">
        <div class="ui two column stackable grid container">
            <div class="column form-part-one">
                <h3 class="ui top attached header">Select Department</h3>
                <div class="ui bottom attached segment">
                    <div class="grouped fields">
                        <div class="field">
                            <div class="ui radio checkbox ">
                                <input type="radio" name="department" value="Defender Antivirus and Online Security">
                                <label>Defender Pro Antivirus &amp; Online Security</label>
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui radio checkbox ">
                                <input type="radio" name="department" value="Defender Driver Control" <?php if ($product){ echo 'checked';} ?>>
                                <label>Defender Driver Control</label>
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui radio checkbox ">
                                <input type="radio" name="department" value="Defender Pro Online Backup">
                                <label>Defender Pro Online Backup</label>
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui radio checkbox ">
                                <input type="radio" name="department" value="Defender Pro PC Medic">
                                <label>Defender Pro PC Medic</label>
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui radio checkbox ">
                                <input type="radio" name="department" value="Defender Antivirus and Online Security">
                                <label>Billing / Accounts Receivable</label>
                            </div>
                        </div>
                    </div>
                    <button class="ui button" id="next-button" onclick="next()">Next</button>
                </div>
            </div>

            <div class="column">
                <img class="ui image centered" src="//cdn.defender-pro.com/wp-content/themes/defender-pro/assets/img/techsupport-art.png" alt="">
            </div>
        </div>
    </div>
    <div id="form2" class="ui form segment">

        <form id="formID" name="supportForm" action="/form/email.php" onsubmit="return formCheck()" method="post" enctype="multipart/form-data">
        <?php if ($filled): ?>
            <input type="hidden" name="other" value="<?php echo ' Version: ' . $version .', Browser: ' . $browser . ', Freeram: ' . $freeram . ', Disks: ' . $disks . ', :WinPath' . $winpath . ', Root: ' . $root . ', UserDir ' . $userdir . ', Screen: ' . $screen . ', Locale: ' . $locale . ', ProgramDir: ' . $programdir ; ?>">
        <?php endif; ?>
        <div id="support-submit-wrapper">
            <h3 class="help-label ui dividing header">
                General Information
            </h3>
            <div class="support-input-wrapper field" id="full-name">
                <label>Full Name</label>
                <input name="name" id="myName" type="text" class="custom"/>
            </div>
            <div class="support-input-wrapper field" id="email-address">
                <label>Email</label>
                <input name="email" id="myEmail" type="text" class="custom"/>
            </div>
            <div class="support-input-wrapper field">
                <label>Priority</label>
                <select name="priority" class="ui dropdown">
                    <option value="normal">Normal</option>
                    <option value="high">High</option>
                </select>
            </div>
            <br/>
            <h3 class="help-label ui dividing header">
                Technical Information
            </h3>
            <div class="support-input-wrapper field">
                <label>What product do you need help with? (required):</label>
                <select name="product" class="ui dropdown">
                    <option value="Defender Pro 2014">Defender Pro 2014</option>
                    <option value="Driver Control" <?php if($product){echo 'selected="selected"';} ?>>Driver Control</option>
                    <option value="Defender Pro 2013">Defender Pro 2013</option>
                </select>
            </div>
            <div class="support-input-wrapper field" id="license">
                <label>Product License ID: (required):</label>
                <input name="license" id="myLicense" type="text" class="custom" value="<?php if($key){echo $key;} ?>"/>
            </div>
            <div class="support-input-wrapper field">
                <label>What is your operating system?</label>
                <select name="os" class="ui dropdown">
                    <option value="">-Please select</option>
                    <option selected="selected" value="Windows">Windows</option>
                    <option value="Mac OSX">Mac OSX</option>
                </select>
            </div>
            <div class="support-input-wrapper field" id="error-code">
                <label>Error code or Issue? (required):</label>
                <input name="error" id="myError" type="text" class="custom"/>
            </div>
            <div id="message-wrapper">
                <h3 class="help-label ui dividing header">
                    Message Details
                </h3>
                <div class="support-input-wrapper field" id="subject-wrapper">
                    <label>Subject</label>
                    <input name="subject" id="mySubject" type="text" class="custom"/>
                </div>
                <div style="margin-top: 20px;">
                    <textarea name="message"></textarea>
                </div>
            </div>
            <div id="upload-wrapper">
                <span class="upload-title">Upload File(s)</span><br/><br/>
                <input type="file" name="fileatt" class="field" /><br/><br/>
                <input class="ui button" type="reset" id="reset" value="Reset Form" onclick="resetForm()">

                <!-- name="submit"-->
                <input class="ui button" type="submit" value="Submit">
            </div>
            <div id="hidden"></div>
        </div>
    </form>
    </div>
</div>

<script type="text/javaScript">

    function next()
    {
        //check for one button to be pressed
        var radios = document.getElementsByTagName('input');
        var num = 0;
        var value;
        for (var i = 0; i < radios.length; i++){
            if (radios[i].type == 'radio' && radios[i].checked){
                num = num + 1;
                value = radios[i].value;
            }
        }
        if (num < 1){
            //alert("Please select a department");
            jQuery("#first-error").slideDown(100);
        }
        else{
            jQuery("#form1").fadeOut( 200, function() {
                // Animation complete.
                jQuery("#form2").fadeIn(200, function() {

                });
            });
            jQuery("#first-error").hide();
            var input = "<input type='hidden' name= 'department' value='" + value + "'>";
            document.getElementById("hidden").innerHTML = input;
        }
    }

    function emailCheck(email)
    {
        var atpos = email.indexOf("@");
        var dotpos = email.lastIndexOf(".");
        if (atpos < 1 || dotpos < atpos+2 || dotpos+2 >= email.length){
            jQuery("#email-address").css("color", "#FF0000");
            return false
        }
        return true
    }

    function formCheck()
    {
        var required = new Array("myName", "myEmail", "myLicense", "myError", "mySubject");
        var parents = new Array("#full-name", "#email-address", "#license", "#error-code", "#subject-wrapper");
        var value;
        var number = 0;
        for (var i=0; i < 5; i++)
        {
            value = document.getElementById(required[i]).value
            if (value == "")
            {
                number = number + 1;
                jQuery(parents[i]).css("color", "#FF0000");

            }
            else
            {
                jQuery(parents[i]).css("color", "#000");
            }
            value="";
        }

        if (number > 0 || emailCheck(document.forms["supportForm"][required[1]].value) != true)
        {
            jQuery("#second-error").show();
            return false;
        }
    }

    function resetForm()
    {
        jQuery("#second-error").hide();
        jQuery(".support-input-wrapper").css("color", "#000");
        document.getElementById("hidden").innerHTML = "";

        jQuery("#form2").fadeOut( 200, function() {
            // Animation complete.
            jQuery("#form1").fadeIn(200, function() {

            });
        });

        //alert("check");
        var ele = document.getElementsByName("department");
        for(var i=0;i<ele.length;i++){
            ele[i].checked = false;
        }
    }

</script>
<?php if ($product): ?>
    <style>
        #form2 { display: visible; }
        #form1 { display: none; }
    </style>
<?php else: ?>
    <style>
        #form1 { display: visible; }
        #form2 { display: none; }
    </style>
<?php endif; ?>
