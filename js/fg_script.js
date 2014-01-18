jQuery(document).ready(function() {
    jQuery('.fg_group').hide();
    jQuery('.fg_group:first').fadeIn();
    jQuery('#fg_of-nav li:first').addClass('current');
    jQuery('#fg_of-nav li a').click(function(evt) {
        jQuery('#fg_of-nav li').removeClass('current');
        jQuery(this).parent().addClass('current');
        if (jQuery(this).attr("title") == "Embed Code") {
            jQuery(".fg_embed_code_save").css("display", "block");
            jQuery(".fg_embed_code_save").css("float", "left");
            jQuery(".fg_embed_code_save").css("width", "120px");
            jQuery(".fg_embed_code_save").css("height", "40px");
        }
        else {
            jQuery(".fg_embed_code_save").css("display", "none");
        }
        var clicked_group = jQuery(this).attr('href');
        jQuery('.fg_group').hide();
        jQuery(clicked_group).fadeIn();
        evt.preventDefault();
    });
    jQuery('.fg_embed_code_save').click(function() {
        jQuery('div#loader_img').css("display", "block");
        var direction_of_form = jQuery('input[name=fg_form]:radio:checked').val();
        var text_value = jQuery('textarea#fg_content_html').val();
        var bg_color = jQuery('input.background_color').val();
		var button_color = jQuery('input.button_color').val();
		var button_text =  jQuery('input.button_text_to_display').val();
         if (text_value == "") {
            alert("code textarea is empty");
            jQuery('div#loader_img').css("display", "none");
        }
        else {
            var pattern = /iframe/;
            var exists = pattern.test(text_value);
            if (exists) {
                var data = {
                    action: 'master_response',
                    value: text_value,
                    direction: direction_of_form,
                    color: bg_color,
                    button_color: button_color,
                    button_txt : button_text
                };
             jQuery.post(script_call.ajaxurl, data, function(response) {
                    if (response) {
                        //alert("succesfull");
                        jQuery('div#loader_img').css("display", "none");
                    }
                    else {
                        //alert("error");
                        jQuery('div#loader_img').css("display", "none");
                    }
                });
            }
            if (!exists) {
                alert("Plz paste the correct code");
                jQuery('div#loader_img').css("display", "none");
            }
        }
    });
});