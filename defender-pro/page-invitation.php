<?php
/**
 * Template Name: Invitation (Backup Vault)
 */

if ( !defined('ABSPATH') ) exit; // Exit if accessed directly

get_header();
?>
<section id="heading">
    <div class="ui grid">
        <div class="twelve wide column centered center aligned">
            <h1 class="intro-text ui heading">
                Need Help?  Contact Us Free 9-5 PST.
            </h1>
            <h1 class="ui heading">
                <i class="call icon"></i>1-877-887-3427
            </h1>
        </div>
    </div>
</section>
<section id="backup-invitation-form">
    <div class="ui page stackable grid">
        <div class="eight wide column centered center aligned">
            <form class="ui form segment" id="backup-invitation">
                <h4 class="ui deviding header">Personal Information</h4>
                <div class="field">
                    <label>Email</label>
                    <div class="field">
                        <input type="email" name="email" id="email" placeholder="youremail@youremail.com">
                    </div>
                </div>
                <div class="field">
                <label>Name</label>
                    <div class="two fields">
                        <div class="field">
                            <input type="text" name="fname" id="fname" placeholder="First Name">
                        </div>
                        <div class="field">
                            <input type="text" name="lname" id="lname" placeholder="Last Name">
                        </div>
                    </div>
                </div>
                <div class="field">
                <label>Password</label>
                    <div class="two fields">
                        <div class="field">
                            <input type="password" name="password" id="password" placeholder="Password">
                        </div>
                        <div class="field">
                            <input type="password" name="confirm_password" placeholder="Confirm Password">
                        </div>
                    </div>
                </div>
                <div class="field">
                    <label>License Code</label>
                    <div class="field">
                        <input type="text" name="license" id="license" placeholder="License Code">
                    </div>
                </div>
                <input type="submit" class="ui submit button" id="submit" value="Sign Up!">
            </form>
        </div>
    </div>
</section>

<div id="lfuller" style="display:none;">
    <div id="lerror">
        <div class="closer">x</div>
    <div id="error_txt"></div>
    </div>
</div>


<?php get_footer(); ?>
