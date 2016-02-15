
/**
 * @require ../../../../../bower_components/flexslider/jquery.flexslider.js
 * @require ../../../../../bower_components/jquery-address/src/jquery.address.js
 * @require ../../../../../bower_components/isotope/dist/isotope.pkgd.js
 */

 //Youtube API
if (document.getElementById('ytid') ) {
    var ytid = document.getElementById('ytid').getAttribute('data-link');
    function onYouTubePlayerAPIReady(){
        player = new YT.Player('player', {
            playerVars: {
                'autoplay': 1,
                'controls': 0,
                'showinfo': 0,
                'rel': 0,
                'html5': 1,
                'wmode': 'transparent'
            },
            videoId: ytid,
            events: {
                'onReady': function() {
                    player.mute();
                }
            }
        });
    }
}


(function(window, document, $, undefined) {
    'use strict';

    $(document).on('ready', function() {

        //Youtube
        window.mobileCheck = function() {
            var check = false;
            (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4)))check = true})(navigator.userAgent||navigator.vendor||window.opera);
            return check;
        }

        var tag = document.createElement('script');
        tag.src = "//www.youtube.com/player_api";
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

        if (window.mobileCheck()) {
            $('#clickable-wrapper').hide();
            $(".sound-banner").hide();
        } else {
            $('#clickable-wrapper').click(function() {
                $("#clickable-wrapper").fadeOut();
                $(".sound-banner").fadeOut();
                player.seekTo(0, true)
                player.unMute();
            });
        }

        // Backup Vault Server Status

        if ( $('body').hasClass('backup-vault-status') ) {

            var $backupVaultStatus = $('#backup-vault-status'),
                statusPage = $backupVaultStatus.find('#status-scrape').data('html'),
                $statusPage = $.parseHTML(statusPage),
                description = $('.update-message', $statusPage ).html();
            $('.description', $backupVaultStatus).html(description);

        }

        //Init Isotope
        $('#kb-grid').isotope({
            itemSelector: '.iso-item',
            layoutMode: 'masonry',
            filter: '.iso-categories'
        });

        //Iso Filter Menu
        $('#iso-filters').on('click', 'a', function() {
            $('#iso-filters a').removeClass("active");
            $(this).addClass("active");
            $('#kb-grid').isotope({ filter: $(this).attr('data-filter') });
        });


        // Init Checkbox
        $('.ui.checkbox').checkbox();

        // Init Select
        $('select.dropdown').dropdown();

        // Init Tabs
        $('#support-tabs .item').tab({
            history: true,
            historyType: 'hash'
        });

        $('#product-tabs .item').tab();

        // Init popups
        $('#nav .item.dropdown.products').popup({
            inline       : true,
            hoverable    : true,
            position     : 'bottom left',
            delay        : {
                show : 300,
                hide : 500
            },
            transition   : 'slide down',
            hideOnScroll : false
        });

        $('#nav .item.dropdown:not(.products)').popup({
            inline       : true,
            hoverable    : true,
            position     : 'bottom center',
            delay        : {
                show : 300,
                hide : 500
            },
            transition   : 'slide down',
            hideOnScroll : false
        });

        $('#cart .dropdown, #search .dropdown').popup({
            inline       : true,
            on           : 'click',
            hoverable    : true,
            position     : 'bottom center',
            transition   : 'slide down',
            hideOnScroll : false
        });


        // Init sliders
        $('.maccleanse .flexslider#screenshots').flexslider({
            animation      : "slide",
            directionNav   : true,
            controlNav     : false,
            pauseOnAction  : true,
            touch          : true,
            keyboard       : false,
            useCSS         : false,
            pauseOnHover   : true,
            slideshowSpeed : 7000,
            animationSpeed : 500,
            allowOneSlide  : true
        });

        $('.maccleanse .flexslider#testimonials').flexslider({
            selector       : ".slides > .slide",
            animation      : "slide",
            directionNav   : true,
            controlNav     : false,
            pauseOnAction  : true,
            touch          : true,
            keyboard       : false,
            useCSS         : false,
            pauseOnHover   : true,
            slideshowSpeed : 7000,
            animationSpeed : 500,
            allowOneSlide  : true
        });


        // Init modals
        $('.ui.modal').modal();


        // Init checkboxes
        $('.ui.checkbox').checkbox();


        // Scalable Image
        $('.maccleanse img.overlayable:not(.overlay-image)').click(function(){
            var source = $(this).attr("src")
            $('body').append(
                "<div class='overlay-image'><div class='image-holder'><img src='" + source + "' ><i class='icon remove'></i></div></div><div class='overlay-shadow'></div>"
            );
            $('.overlay-shadow').fadeIn();
            $('.overlay-image').fadeIn().click(function(){
                $(this).fadeOut(function(){
                    $(this).remove();
                })
                $(".overlay-shadow").fadeOut(function(){
                    $(".overlay-shadow").remove();
                });
            })
        })

        /*
         * Form validation
         */

        //Backup Vault Invitation Account Creation

        $('#backup-invitation').form({
            email: {
                identifier: 'email',
                rules: [
                    {
                        type   : 'empty',
                        prompt : 'Please enter your email address',
                    },
                    {
                        type   : 'email',
                        prompt : 'Please enter a valid email address'
                    },
                    {
                        type   : 'maxLength[255]',
                        prompt : 'Your entry cannot exceed 255 characters'
                    }
                ]
            },
            fname: {
                identifier: 'fname',
                rules: [
                    {
                        type   : 'empty',
                        prompt : 'Please enter your first name'
                    },
                    {
                        type   : 'maxLength[255]',
                        prompt : 'Your entry cannot exceed 255 characters'
                    }
                ]
            },
            lname: {
                identifier: 'lname',
                rules: [
                    {
                        type   : 'empty',
                        prompt : 'Please enter your last name'
                    },
                    {
                        type   : 'maxLength[255]',
                        prompt : 'Your entry cannot exceed 255 characters'
                    }
                ]
            },
            password: {
                identifier: 'password',
                rules: [
                    {
                        type   : 'empty',
                        prompt : 'Please enter a password'
                    },
                    {
                        type   : 'length[6]',
                        prompt : 'Your password must be at least 6 characters long'
                    },
                    {
                        type   : 'maxLength[255]',
                        prompt : 'Your entry cannot exceed 255 characters'
                    }
                ]
            },
            confirm_password: {
                identifier: 'confirm_password',
                rules: [
                    {
                        type   : 'match[password]',
                        prompt : 'Both passwords must match'
                    }
                ]
            },
            license: {
                identifier: 'license',
                rules: [
                    {
                        type   : 'empty',
                        prompt : 'Please enter your license code'
                    }
                ]
            }
        },
        {
            inline : true,
            onSuccess: function(event) {
                // calls server to create account
                event.preventDefault();
                jQuery("#submit").attr('disabled','disabled');
                var query = jQuery.post('//defender-pro.com/cloud/api/', {
                    'action': 'create',
                    'license': jQuery("#license").val(),
                    'first': jQuery("#fname").val(),
                    'last': jQuery("#lname").val(),
                    'email': jQuery("#email").val(),
                    'password': jQuery("#password").val()
                });
                query.done(function(data) {
                    var $response = jQuery(data),
                    $code = $response.find("code").text(),
                    $message = $response.find('message').text();

                    if ($code == 1) {
                        window.location.href = '/download/online-backup';
                    } else {
                        jQuery("#submit").removeAttr('disabled');
                        jQuery("#error_txt").html("Error: " + $message);
                        jQuery("#lfuller").fadeIn("fast");
                    }
                });
                jQuery("#lfuller").click(function(){jQuery("#lfuller").fadeOut("fast");});
                jQuery("#lerror").click(function(){jQuery("#lfuller").fadeOut("fast");});
                jQuery(".closer").click(function(){jQuery("#lfuller").fadeOut("fast");});
            }
        });

        // My Account / Login
        $('#customer_login .ui.form.login').form({
            username: {
                identifier: 'username',
                rules: [
                    {
                        type   : 'empty',
                        prompt : 'Please enter your username or email address'
                    }
                ]
            },
            password: {
                identifier: 'password',
                rules: [
                    {
                        type   : 'empty',
                        prompt : 'Please enter your password'
                    }
                ]
            }
        },
        {
            inline : true
        });

        // My Account / Register
        $('#customer_login .ui.form.register').form({
            username: {
                identifier: 'username',
                rules: [
                    {
                        type   : 'empty',
                        prompt : 'Please enter your username'
                    }
                ]
            },
            email: {
                identifier: 'email',
                rules: [
                    {
                        type   : 'empty',
                        prompt : 'Please enter your email address',
                    },
                    {
                        type   : 'email',
                        prompt : 'Please enter a valid email address'
                    }
                ]
            },
            password: {
                identifier: 'password',
                rules: [
                    {
                        type   : 'empty',
                        prompt : 'Please enter your password'
                    },
                    {
                        type   : 'length[6]',
                        prompt : 'Your password must be at least 6 characters long'
                    }
                ]
            }
        },
        {
            inline : true
        });

        // My Account / Lost Password
        $('#lost_reset_password .ui.form').form({
            user_login: {
                identifier: 'user_login',
                rules: [
                    {
                        type   : 'empty',
                        prompt : 'Please enter your username or email address'
                    }
                ]
            },
            password_1: {
                identifier: 'password_1',
                rules: [
                    {
                        type   : 'empty',
                        prompt : 'Please enter your new password'
                    },
                    {
                        type   : 'length[6]',
                        prompt : 'Your new password must be at least 6 characters long'
                    }
                ]
            },
            password_2: {
                identifier: 'password_2',
                rules: [
                    {
                        type   : 'match[password]',
                        prompt : 'Both passwords must match'
                    }
                ]
            }
        },
        {
            inline : true
        });

        // My Account / Edit Account
        $('#edit_account .ui.form').form({
            account_first_name: {
                identifier: 'account_first_name',
                rules: [
                    {
                        type   : 'empty',
                        prompt : 'Please enter a first name'
                    }
                ]
            },
            account_last_name: {
                identifier: 'account_last_name',
                rules: [
                    {
                        type   : 'empty',
                        prompt : 'Please enter a last name'
                    }
                ]
            },
            email: {
                identifier: 'account_email',
                rules: [
                    {
                        type   : 'email',
                        prompt : 'Please provide a valid email address'
                    }
                ]
            },
            password_current: {
                identifier: 'password_current',
                optional   : true,
                rules: [
                    {
                        type   : 'empty',
                        prompt : 'Please enter your password'
                    },
                    {
                        type   : 'not[password_1]',
                        prompt : 'Please'
                    }
                ]
            },
            password_1: {
                identifier: 'password_1',
                optional   : true,
                rules: [
                    {
                        type   : 'empty',
                        Prompt : 'Please enter a password'
                    },
                    {
                        type   : 'length[6]',
                        prompt : 'Your new password must be at least 6 characters long'
                    }
                ]
            },
            password_2: {
                identifier: 'password_2',
                rules: [
                    {
                        type   :  'match[password_1]',
                        prompt : 'Both passwords must match'
                    }
                ]
            }
        },
        {
            inline : true
        });

        // My Account / Edit Address
        $('#edit_address .ui.form').form({
            billing_country: {
                identifier: 'billing_country',
                rules: [
                    {
                        type   : 'empty',
                        prompt : 'Please select a country'
                    }
                ]
            },
            billing_first_name: {
                identifier: 'billing_first_name',
                rules: [
                    {
                        type   : 'empty',
                        prompt : 'Please enter a first name'
                    }
                ]
            },
            billing_last_name: {
                identifier: 'billing_last_name',
                rules: [
                    {
                        type   : 'empty',
                        prompt : 'Please enter a last name'
                    }
                ]
            },
            billing_address_1: {
                identifier: 'billing_address_1',
                rules: [
                    {
                        type   : 'empty',
                        prompt : 'Please enter a billing address name'
                    }
                ]
            },
            billing_city: {
                identifier: 'billing_city',
                rules: [
                    {
                        type   : 'empty',
                        prompt : 'Please enter a billing city'
                    }
                ]
            },
            billing_state: {
                identifier: 'billing_state',
                rules: [
                    {
                        type   : 'empty',
                        prompt : 'Please enter a billing state'
                    }
                ]
            },
            billing_postcode: {
                identifier: 'billing_postcode',
                rules: [
                    {
                        type   : 'empty',
                        prompt : 'Please enter a valid postcode'
                    }
                ]
            },
            billing_email: {
                identifier: 'billing_email',
                rules: [
                    {
                        type   : 'email',
                        prompt : 'Please enter a valid email address'
                    }
                ]
            },
            billing_phone: {
                identifier: 'billing_phone',
                rules: [
                    {
                        type   : 'empty',
                        prompt : 'Please enter a valid phone number'
                    }
                ]
            }

        },
        {
            inline  : true
        });


    });

    $(window).on('load', function() {

    });

})(window, document, jQuery);
