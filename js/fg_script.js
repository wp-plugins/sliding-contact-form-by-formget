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
	jQuery('.bounce_to').click(function(){
	 jQuery('.fg_group').hide();
	 jQuery('#pn_review').show();
	});
	
		jQuery('div#fg_video_getting_started').click(function(){
			//alert("jfhdjf");
		jQuery('div#fg_videoContainer').css({"display": "block"});
			autoPlayVideo('84023688','700','400');		
});
	

function autoPlayVideo(vcode, width, height){
  "use strict";
  jQuery("#fg_videoContainer").html('<iframe class="video_tobe_shown" width="'+width+'" height="'+height+'" src="//player.vimeo.com/video/'+vcode+'?autoplay=1&loop=1&rel=0&wmode=transparent" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>');
}

jQuery('div#fg_videoContainer').click(function(){
jQuery('div#fg_videoContainer').css({"display": "none"});
	jQuery('div#fg_videoContainer').empty();
	});
	//jQuery("div.")
	jQuery(".hide_video_notice").click(function(){
	//alert("hello");
	var hide_data = {
            action: 'master_response',
            value_hide: "hide"
        };
        jQuery.post(script_call.ajaxurl, hide_data, function(response) {
            if (response) {
               //alert(response); 
			    jQuery('.fg_notice_div').hide();
            }
            else {

               
            }
        });
	});
	
	var showTooltip = function(event) {
   jQuery('div.tooltip').remove();
   jQuery('<div class="tooltip">Here are some absolute knockout forms for you</div>')
     .appendTo('body');
   changeTooltipPosition(event);
};
var changeTooltipPosition = function(event) {
	var tooltipX = event.pageX - 8;
	var tooltipY = event.pageY + 8;
	jQuery('div.tooltip').css({top: tooltipY, left: tooltipX});
};
var hideTooltip = function() {
	jQuery('div.tooltip').remove();
};
jQuery("#tooltip_target").bind({
	mousemove : changeTooltipPosition,
	mouseenter : showTooltip,
	mouseleave: hideTooltip
});

	var showTooltipsy = function(event) {
   jQuery('div.tooltipsy').remove();
   jQuery('<div class="tooltipsy">Let\'s Review</div>')
     .appendTo('body');
   changeTooltipsyPosition(event);
};
var changeTooltipsyPosition = function(event) {
	var tooltipsyX = event.pageX - 8;
	var tooltipsyY = event.pageY + 8;
	jQuery('div.tooltipsy').css({top: tooltipsyY, left: tooltipsyX});
};
var hideTooltipsy = function() {
	jQuery('div.tooltipsy').remove();
};
jQuery("#tooltipsy_target").bind({
	mousemove : changeTooltipsyPosition,
	mouseenter : showTooltipsy,
	mouseleave: hideTooltipsy
});

});