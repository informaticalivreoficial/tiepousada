jQuery(document).ready(function(){"use strict";var e=jQuery("body").css("direction");jQuery("#go-up").click(function(){jQuery("body,html").animate({scrollTop:0},1e3)}),jQuery.custom_bxslider=function(){jQuery(".bxslider").bxSlider({speed:1e3,pager:!1,mode:"fade",auto:!0,pause:8e3})},jQuery.fn.bxSlider&&jQuery.custom_bxslider(),jQuery.internal_custom_bxslider=function(){jQuery(".bxslider-internal").bxSlider({pagerCustom:"#bx-pager-internal",speed:1e3,controls:!1,mode:"fade",auto:!0,pause:5e3})},jQuery.fn.bxSlider&&jQuery.internal_custom_bxslider(),jQuery.welcome_custom_bxslider=function(){jQuery.fn.bxSlider&&jQuery(".bxslider-welcome").bxSlider({speed:1e3,controls:!0,auto:!0,mode:"fade",pause:5e3,pager:!1})},jQuery.fn.bxSlider&&jQuery.welcome_custom_bxslider(),jQuery.fn.owlCarousel&&jQuery("#testimonials-slider").owlCarousel({items:3,itemsTablet:[1024,1],navigation:!0,pagination:!1}),jQuery.fn.owlCarousel&&jQuery("#services-box").owlCarousel({items:3,itemsTablet:[980,2],itemsMobile:[480,1],navigation:!0,pagination:!1}),jQuery.fn.parsley&&0!==jQuery("#contact-form").length&&jQuery("#contact-form").parsley(),jQuery.fn.isMobile&&null==isMobile.any()&&jQuery("[data-background='parallax']").css("background-size",""),"rtl"===e?jQuery(".datepicker-fields").datepicker({Format:"dd/mm/yy",rtl:!0,language:"pt-BR"}):jQuery(".datepicker-fields").datepicker({Format:"dd/mm/yy"}),"rtl"===e?jQuery("#booking-tab-contents .booking-dates").datepicker({Format:"dd/mm/yy",rtl:!0,language:"pt-BR",inputs:jQuery(".booking-date-fields-container")}):jQuery("#booking-tab-contents .booking-dates").datepicker({Format:"dd/mm/yy",inputs:jQuery(".booking-date-fields-container")}),jQuery(".event-boxes .book-now, .event-row-container .book-now, #login-form-butt, #register-form-butt").magnificPopup({type:"ajax",removalDelay:600,mainClass:"mfp-fade"}),jQuery("#style-selector-handle").click(function(){var r="rtl"==e?"right":"left";jQuery(this).hasClass("active")?(jQuery("#style-selector").css(r,"-165px"),jQuery(this).removeClass("active")):(jQuery("#style-selector").css(r,"0"),jQuery(this).addClass("active"))}),jQuery("#layout-selector").change(function(){var e=jQuery("#style-selector-box .pattern-selector");2==jQuery(this).val()?(jQuery("body").addClass("boxed"),e.slideDown()):(jQuery("body").removeClass("boxed"),e.slideUp()),jQuery("#slider .bx-viewport").css("height",jQuery("#slider .active-slide img").height())}),jQuery("[id*=pattern_]").click(function(){var e=jQuery(this).css("background-image");jQuery("body").css({"background-image":e}),jQuery("[id*=pattern_]").removeClass("selected"),jQuery(this).addClass("selected")}),jQuery("#style-selector-box [class*=preset_]").click(function(){var r=jQuery(this).attr("data-preset-name");jQuery("#main-style-file").attr("href");var t=jQuery("#style-selector-box .selected[class*=preset_]").attr("data-preset-name");if("0"===r){if("rtl"==e)var s=jQuery("#main-style-file").attr("href").replace("styles-rtl_"+t,"styles-rtl");else s=jQuery("#main-style-file").attr("href").replace("styles_"+t,"styles");jQuery("#main-style-file").attr("href",s)}else{if("0"===t)if("rtl"==e)s=jQuery("#main-style-file").attr("href").replace("styles-rtl","styles-rtl_"+r);else s=jQuery("#main-style-file").attr("href").replace("styles","styles_"+r);else if("rtl"==e)s=jQuery("#main-style-file").attr("href").replace("styles-rtl_"+t,"styles-rtl_"+r);else s=jQuery("#main-style-file").attr("href").replace("styles_"+t,"styles_"+r);jQuery("#main-style-file").attr("href",s)}jQuery("#style-selector-box [class*=preset_]").removeClass("selected"),jQuery(this).addClass("selected")})});