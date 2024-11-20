"use strict"; // Start of use strict

var inprocess = 0, fs_timeout, fe_timeout, eaf_timeout, eat_timeout;

$.ajaxSetup({global:false,method:"POST",dataType:"json",timeout:25000});

function exchangeForm()
{
	if(typeof directions_from_ar !== 'undefined') set_exchange_from(directions_from_ar);
	if(typeof directions_to_ar !== 'undefined') set_exchange_to(directions_to_ar);
	
	//$('.myhtmlselect').ddslick();
}

function set_exchange_from(from_ar)
{
	$('#exchange-from').ddslick({
		data: from_ar,
		selectText: 'Select a currency',
		onSelected: function(selectedData){
			//console.log(selectedData);
			//console.log(selectedData.selectedData.value);
			process_exchange_from();
		}
	});
}

function set_exchange_to(to_ar)
{
	$('#exchange-to').ddslick({
		data: to_ar,
		selectText: 'Select a currency',
		onSelected: function(selectedData){
			process_exchange_to();
		}
	});
}

function stickyHeader() {
    if ($('.stricky').length) {
        var strickyScrollPos = 100;
        var stricky = $('.stricky');
        if ($(window).scrollTop() > strickyScrollPos) { 
            $('.header-sticky-space').addClass('is-sticky');       	
            stricky.removeClass('slideIn animated');
            stricky.addClass('stricky-fixed slideInDown animated');
            $('.scroll-to-top').fadeIn(500);
        } else if ($(this).scrollTop() <= strickyScrollPos) {
            $('.header-sticky-space').removeClass('is-sticky');   
            stricky.removeClass('stricky-fixed slideInDown animated');
            stricky.addClass('slideIn animated');
            $('.scroll-to-top').fadeOut(500);
        }
    };
}

function thmCounter() {
    if ($('.counter').length) {
        $('.counter').counterUp({
            delay: 10,
            time: 3000
        });
    };
}

function scrollToTarget() {
    if ($('.scroll-to-target').length) {
        $(".scroll-to-target").on('click', function() {
            var target = $(this).attr('data-target');
            // animate
            $('html, body').animate({
                scrollTop: $(target).offset().top
            }, 1000);

            return false;

        });
    }
}

function mobileNavToggle () {
    if ($('#main-nav-bar .navbar-nav .sub-menu').length) {
    	var subMenu = $('#main-nav-bar .navbar-nav .sub-menu');
        subMenu.parent('li').children('a').append(function () {
            return '<button class="sub-nav-toggler"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>';
        });
        var subNavToggler = $('#main-nav-bar .navbar-nav .sub-nav-toggler');
        subNavToggler.on('click', function () {
            var Self = $(this);
            Self.parent().parent().children('.sub-menu').slideToggle();
            return false;
        });
    };
	//$('#main-nav-bar .navbar-nav .sub-menu').length) {
	$('#main-nav-bar .navbar-nav').on('click','li a',function (e) {
		if($('body').hasClass('home') && $(this).hasClass('inner-link'))
		{
		$('#main-nav-bar').collapse('hide');
		var current_block = String($(this).attr('href')).split('#')[1];
			if($('#'+current_block).length > 0)
			{
				setTimeout(function(){
					$('html, body').stop(true,true).animate({scrollTop:($('#'+current_block).offset().top)}, 1000);
				},250);
			e.preventDefault();
			}
		}
	});
}

function handlePreloader() {
    if($('.preloader').length){
        $('body').removeClass('active-preloader-ovh');
        $('.preloader').fadeOut();
    }
}

function bootstrapAnimatedLayer() {

    /* Demo Scripts for Bootstrap Carousel and Animate.css article
     * on SitePoint by Maria Antonietta Perna
     */

    //Function to animate slider captions 
    function doAnimations(elems) {
        //Cache the animationend event in a variable
        var animEndEv = 'webkitAnimationEnd animationend';

        elems.each(function() {
            var $this = $(this),
                $animationType = $this.data('animation');
            $this.addClass($animationType).one(animEndEv, function() {
                $this.removeClass($animationType);
            });
        });
    }

    //Variables on page load 
    var $myCarousel = $('#minimal-bootstrap-carousel'),
        $firstAnimatingElems = $myCarousel.find('.item:first').find("[data-animation ^= 'animated']");

    //Initialize carousel 
    $myCarousel.carousel({
        interval: 57000
    });

    //Animate captions in first slide on page load 
    doAnimations($firstAnimatingElems);

    //Pause carousel  
    $myCarousel.carousel('pause');


    //Other slides to be animated on carousel slide event 
    $myCarousel.on('slide.bs.carousel', function(e) {
        var $animatingElems = $(e.relatedTarget).find("[data-animation ^= 'animated']");
        doAnimations($animatingElems);
    });
}

function sideNavToggler () {
    if ($('.side-navigation').length) {
        $('.side-nav-opener').on('click', function () {
            $('.side-navigation').addClass('open');
            return false;
        });
        $('.side-navigation-close-btn').on('click', function () {
            $('.side-navigation').removeClass('open');
            return false;
        });
    };
}

function countDownTimer () {
    if ($('.countdown-box').length) {

        $('.countdown-box').each(function () {
            var Self = $(this);
            var countDate = Self.data('countdown-time'); // getting date

            Self.countdown(countDate, function(event) {                    
                $(this).html('<li> <div class="box"> <h4>'+ event.strftime('%D') +'</h4> <span>Days</span> </div> </li> <li> <div class="box"> <h4>'+ event.strftime('%H') +'</h4> <span>Hours</span> </div> </li> <li> <div class="box"> <h4>'+ event.strftime('%M') +'</h4> <span>Minutes</span> </div> </li> <li> <div class="box"> <h4>'+ event.strftime('%S') +'</h4> <span>Seconds</span> </div> </li> ');
            });
        });

        

    };
}

// instance of fuction while Document ready event   
jQuery(document).on('ready', function() {
    (function($) {
        thmCounter();        
        scrollToTarget();
        mobileNavToggle();
        //bootstrapAnimatedLayer(); //Main Slider
        sideNavToggler();
        countDownTimer();
    })(jQuery);
});

// instance of fuction while Window Load event
jQuery(window).on('load', function() {
	(function($) {
		handlePreloader()
	})(jQuery);
});

// instance of fuction while Window Scroll event
jQuery(window).on('scroll', function() {
    (function($) {
        stickyHeader();   
    })(jQuery);
});

$(function() {
	exchangeForm();
	if($('.number-t').length> 0 ) set_n();
	
	if($('.order-section').length > 0)
	{
	setInterval('refresh_page()', 100000);
	}
	
	$('.exchange-form').on('keyup', '#exchange-amount-from', function (e) {
		$('.exchange-form #fixed-to').val('0');
		clearTimeout(eaf_timeout);
		eaf_timeout = setTimeout(function(){
			process_exchange_from(true);
		},1000);
	});
	$('.exchange-form').on('keyup', '#exchange-amount-to', function (e) {
		$('.exchange-form #fixed-to').val('1');
		clearTimeout(eat_timeout);
		eat_timeout = setTimeout(function(){
			process_amount_to();
		},1000);
	});
	$('.exchange-section .exchange-form').on('keyup', '#exchange-amount-from', function (e) {
		if($(this).val() == '') $('.exchange-form input.submit').addClass('disabled')
		else $('.exchange-form input.submit').removeClass('disabled');
	});
	$('.exchange-section .exchange-form').on('keyup', '#exchange-amount-to', function (e) {
		if($(this).val() == '') $('.exchange-form input.submit').addClass('disabled')
		else $('.exchange-form input.submit').removeClass('disabled');
	});

	$(document).on('click', '.exchange-form .warning a', function (e) {
		if(vf_is_number($(this).text()))
		{
		$(this).closest('div').find('input').val($(this).text());
		process_exchange_from(true);
		}
		$(this).closest('div').find('.warning').remove();
		e.preventDefault();
	});

	$('.exchange-section').on('submit','.exchange-form',function(e){
		if(!$(this).find('input.submit').hasClass('disabled')) process_exchange_form();
		e.preventDefault();
	});
	
	$('.exchange-section').on('click','#order-back',function(e){
		$('.exchange-section .confirm').fadeOut(200);
		setTimeout(function(){ $('.exchange-section .form-c').fadeIn(200); },300);
		e.preventDefault();
	});

	$('.exchange-section').on('click','#order-confirm',function(e){
		$('.exchange-section .consent-processing-c').removeClass('error');
		if($('#consent-processing').prop('checked') !== true) $('.exchange-section .consent-processing-c').addClass('error');
		else process_exchange_form(true);
		e.preventDefault();
	});

	$('.order-section').on('click','#order-paid-confirm',function(e){
		if(inprocess == 0)
		{
			if(confirm('Are you sure?'))
			{
			process_exchange_status();
			}
		}
		e.preventDefault();
	});

	$(document).on('submit','#contactsform',function(e){
		process_contactsform();
		e.preventDefault();
	});

});

$(function() {

	$('.translate-c .option a img').each(function(){
		$(this).attr('src', $(this).attr('data-src'));
	});

	$('.translate-c').on('click','.selected a',function(e){
		if(!($('.translate-c .option').is(':visible')))
		{
		$('.translate-c .option').stop(true,true).delay(100).slideDown(500);
		$('.translate-c .selected a').addClass('open');
		}
		e.preventDefault();
	});
	$('body').bind('click', function(e) {
		//Continue
		if($('.translate-c .option').is(':visible') && e.target != $('.translate-c .option').get(0))
		{
		$('.translate-c .option').stop(true,true).delay(100).slideUp(500);
		$('.translate-c .selected a').removeClass('open');
		}
	});
	$('.translate-c').on('click','.option a',function(e){
		var sl_lang = $(this).data('lang');
			if(typeof Cookies.get('sl_lang_current') === 'undefined' || sl_lang != Cookies.get('sl_lang_current'))
			{
			$('.translate-c .option a.selected').removeClass('selected')
			$('.translate-c .selected a').html($(this).html());
			$('.translate-c .option a.'+sl_lang).addClass('selected')
			GoogleTranslateChange(sl_lang);
			}
		e.preventDefault();
	});

});


function process_exchange_from(amount_change)
{
	if(inprocess == 1 || !$('.exchange-form').length > 0) return false; inprocess = 1;
	if(typeof amount_change === 'undefined') amount_change = false;
	var $form = $('.exchange-form');
	var form_data = $form.serializeArray();
	if(amount_change) form_data.push({'name':'amount_change', 'value':1});

	var form_errors = false, temp_error = false;
	if(form_errors === false)
	{
	$form.find('.warning').remove();
		if($form.find('#fixed-to').val() == '1') $form.find('#exchange-amount-from').val('');
		else if($form.find('#fixed-to').val() == '0') $form.find('#exchange-amount-to').val('');
	if($form.find('#fixed-to').val() == '1') set_exchange_formloader_v2($form);
	else set_exchange_formloader($form);
	$.ajax(
		{
		url:'/ajax/process_exchange_from', data:form_data, cache:false, headers: {
            'X-CSRF-TOKEN': window.csrf_token
        },
		success: function(r){
			if(r.error == 0)
			{
				if(r.amount_change == 0)
				{
				$('#exchange-to').ddslick('destroy')
				set_exchange_to(r.directions_to_ar);
				}
				if(r.exchange_amount_from) $('#exchange-amount-from').val(r.exchange_amount_from);
				else if(r.fixed_to == 1) $form.find('#exchange-amount-from').val('-');
				if(r.exchange_amount_to) $('#exchange-amount-to').val(r.exchange_amount_to);
				else if(r.fixed_to == 0) $form.find('#exchange-amount-to').val('-');
				if($('.exchange-section').length > 0)
				{
				$form.find('#recipient-wallet').attr('placeholder',r.exchange_wallet_placeholder);
					if(r.exchange_eg_to != '') $form.find('.wallet-eg').addClass('active').find('span').text(r.exchange_eg_to);
					else $form.find('.wallet-eg').removeClass('active').find('span').text('');
				$form.find('.exchange-to-extra-fields').html(r.exchange_to_ef_html);
				}
				if(r.limit_min_from_warning) $('#exchange-amount-from').closest('div').append($('<span class="warning">'+r.limit_min_from_warning+'</span>'));
				else if(r.limit_min_to_warning) $('#exchange-amount-to').closest('div').append($('<span class="warning">'+r.limit_min_to_warning+'</span>'));
				else if(r.limit_max_from_warning) $('#exchange-amount-from').closest('div').append($('<span class="warning">'+r.limit_max_from_warning+'</span>'));
				else if(r.limit_max_to_warning) $('#exchange-amount-to').closest('div').append($('<span class="warning">'+r.limit_max_to_warning+'</span>'));
			}
			else alert('Error: '+r.error+"\r\n"+'Message: '+r.errormsg);
			if(r.fixed_to == 1) unset_exchange_formloader_v2($form);
			else unset_exchange_formloader($form);
			if(r.amount_change == 1 && r.fixed_to == 1) $form.find('#exchange-amount-to').focus();
			else if(r.amount_change == 1) $form.find('#exchange-amount-from').focus();
		inprocess = 0;
		},
		error: function(request, error){
		inprocess = 0; unset_exchange_formloader($form); refresh_page();
		}
	});
	}
	else inprocess = 0;
}

function process_exchange_to()
{
	if(inprocess == 1 || !$('.exchange-form').length > 0) return false; inprocess = 1;
	var $form = $('.exchange-form');
	var form_data = $form.serializeArray();
	var form_errors = false, temp_error = false;
	if(form_errors === false)
	{
	$form.find('.warning').remove();
		if($form.find('#fixed-to').val() == '1') $form.find('#exchange-amount-from').val('');
		else if($form.find('#fixed-to').val() == '0') $form.find('#exchange-amount-to').val('');
	if($form.find('#fixed-to').val() == '1') set_exchange_formloader_v2($form);
	else set_exchange_formloader($form);
	$.ajax(
		{
		url:'/ajax/process_exchange_to', data:form_data, cache:false, headers: {
            'X-CSRF-TOKEN': window.csrf_token
        },
		success: function(r){
			if(r.error == 0)
			{
				if(r.exchange_amount_from) $('#exchange-amount-from').val(r.exchange_amount_from);
				else if(r.fixed_to == 1) $form.find('#exchange-amount-from').val('-');
				if(r.exchange_amount_to) $('#exchange-amount-to').val(r.exchange_amount_to);
				else if(r.fixed_to == 0) $form.find('#exchange-amount-to').val('-');
				if($('.exchange-section').length > 0)
				{
				$form.find('#recipient-wallet').attr('placeholder',r.exchange_wallet_placeholder);
					if(r.exchange_eg_to != '') $form.find('.wallet-eg').addClass('active').find('span').text(r.exchange_eg_to);
					else $form.find('.wallet-eg').removeClass('active').find('span').text('');
				$form.find('.exchange-to-extra-fields').html(r.exchange_to_ef_html);
				}
				if(r.limit_min_from_warning) $('#exchange-amount-from').closest('div').append($('<span class="warning">'+r.limit_min_from_warning+'</span>'));
				else if(r.limit_min_to_warning) $('#exchange-amount-to').closest('div').append($('<span class="warning">'+r.limit_min_to_warning+'</span>'));
				else if(r.limit_max_from_warning) $('#exchange-amount-from').closest('div').append($('<span class="warning">'+r.limit_max_from_warning+'</span>'));
				else if(r.limit_max_to_warning) $('#exchange-amount-to').closest('div').append($('<span class="warning">'+r.limit_max_to_warning+'</span>'));
			}
			else alert('Error: '+r.error+"\r\n"+'Message: '+r.errormsg);
			if(r.fixed_to == 1) unset_exchange_formloader_v2($form);
			else unset_exchange_formloader($form);
		inprocess = 0;
		},
		error: function(request, error){
		inprocess = 0; unset_exchange_formloader($form); refresh_page();
		}
	});
	}
	else inprocess = 0;
}

function process_amount_to()
{
	if(inprocess == 1 || !$('.exchange-form').length > 0) return false; inprocess = 1;
	var $form = $('.exchange-form');
	var form_data = $form.serializeArray();
	var form_errors = false, temp_error = false;
	if(form_errors === false)
	{
	$form.find('.warning').remove();
	$form.find('#exchange-amount-from').val('');
	set_exchange_formloader_v2($form);
	$.ajax(
		{
		url:'/ajax/process_amount_to', data:form_data, cache:false, headers: {
            'X-CSRF-TOKEN': window.csrf_token
        },
		success: function(r){
			if(r.error == 0)
			{
				if(r.exchange_amount_from) $('#exchange-amount-from').val(r.exchange_amount_from);
				else $form.find('#exchange-amount-from').val('-');
				if(r.limit_min_to_warning) $('#exchange-amount-to').closest('div').append($('<span class="warning">'+r.limit_min_to_warning+'</span>'));
				else if(r.limit_max_to_warning) $('#exchange-amount-to').closest('div').append($('<span class="warning">'+r.limit_max_to_warning+'</span>'));
			}
			else alert('Error: '+r.error+"\r\n"+'Message: '+r.errormsg);
		unset_exchange_formloader_v2($form);
		$form.find('#exchange-amount-to').focus();
		inprocess = 0;
		},
		error: function(request, error){
		inprocess = 0; unset_exchange_formloader_v2($form); refresh_page();
		}
	});
	}
	else inprocess = 0;
}

function set_formloader(form) {
	$('#exchange-from').ddslick('close');
	$('#exchange-to').ddslick('close');
	form.find('input.submit, button.submit, a.button.submit').addClass('loading');
	form.find('input, button').attr('disabled',true);
}

function unset_formloader(form) {
	form.find('input.submit, button.submit, a.button.submit').removeClass('loading');
	form.find('input, button').attr('disabled',false);
}

function set_exchange_formloader(form) {
	$('#exchange-from').ddslick('close');
	$('#exchange-to').ddslick('close');
	form.addClass('loading');
	form.find('input, button').attr('disabled',true);
}

function unset_exchange_formloader(form) {
	form.removeClass('loading');
	form.find('input, button').attr('disabled',false);
}

function set_exchange_formloader_v2(form) {
	$('#exchange-from').ddslick('close');
	$('#exchange-to').ddslick('close');
	form.addClass('loading-v2');
	form.find('input, button').attr('disabled',true);
}

function unset_exchange_formloader_v2(form) {
	form.removeClass('loading-v2');
	form.find('input, button').attr('disabled',false);
}

function process_exchange_form(is_confirm)
{
	if(inprocess == 1 || !$('.exchange-form').length > 0) return false; inprocess = 1;
		if(typeof is_confirm === 'undefined') is_confirm = false;
	var $form = $('.exchange-form');
	var form_data = $form.serializeArray();
	if(is_confirm) form_data.push({'name':'confirm', 'value':1});
	var form_errors = false, temp_error = false;
	$form.find('input.required, textarea.required').each(function(){
		del_el_error($(this));
		temp_error = vf_required($(this));
		if(temp_error) form_errors = true;
	});
	temp_error = vf_number($form.find('#exchange-amount-from')); if(temp_error) form_errors = true;
	temp_error = vf_number($form.find('#exchange-amount-to')); if(temp_error) form_errors = true;
	temp_error = vf_emailinp($form.find('#recipient-email')); if(temp_error) form_errors = true;
	if(form_errors === false)
	{
	$form.find('.warning').remove();
		if(is_confirm) $('.exchange-section #order-confirm').addClass('loading');
		else set_formloader($form);
	$.ajax(
		{
		url:'/ajax/process_exchange_form', data:form_data, cache:false, headers: {
            'X-CSRF-TOKEN': window.csrf_token
        },
		success: function(r){ 
			if(r.error == 0)
			{
				if(r.cscv) window.location.href = '/order/'+r.cscv;
				else
				{
				$('.confirm .you-send span.val').text(r.exchange_amount_from+' '+r.exchange_name_from);
				$('.confirm .you-get span.val').text(r.exchange_amount_to+' '+r.exchange_name_to);
				$('.confirm .to-wallet span.val').text(r.recipient_wallet);
				$('.confirm .email span.val').text(r.recipient_email);
				$('.confirm .exchange-to-extra-fields-values').html('');
					$form.find('.exchange-to-extra-fields .control-single-item input').each(function(){
						if($(this).val() != '') $('.confirm .exchange-to-extra-fields-values').append($('<div class="item"><div class="i1">'+$(this).attr('placeholder')+'</div><div class="value">'+$(this).val()+'</div></div>'));
					});
				$('.exchange-section .form-c').fadeOut(200);
				setTimeout(function(){ $('.exchange-section .confirm').fadeIn(200); },300);
				setTimeout(function(){ $('html, body').animate({scrollTop:($('.exchange-section .confirm').offset().top-100)}, 400); },400);
				}
			}
			else if(r.error == 12)
			{
			$form.find('#recipient-wallet').addClass('error');
			}
			else if(r.error == 31)
			{
				if(r.limit_min_from_warning) $('#exchange-amount-from').closest('div').append($('<span class="warning">'+r.limit_min_from_warning+'</span>'));
			}
			else if(r.error == 32)
			{
				if(r.limit_min_to_warning) $('#exchange-amount-to').closest('div').append($('<span class="warning">'+r.limit_min_to_warning+'</span>'));
			}
			else if(r.error == 33)
			{
				if(r.limit_max_from_warning) $('#exchange-amount-from').closest('div').append($('<span class="warning">'+r.limit_max_from_warning+'</span>'));
			}
			else if(r.error == 34)
			{
				if(r.limit_max_to_warning) $('#exchange-amount-to').closest('div').append($('<span class="warning">'+r.limit_max_to_warning+'</span>'));
			}
			else alert('Error: '+r.error+"\r\n"+'Message: '+r.errormsg);
			if($form.find('.error, .warning').length > 0) $('html, body').animate({scrollTop:($form.find('.error, .warning').first().offset().top-250<0 ? 0 : $form.find('.error, .warning').first().offset().top-250)}, 400);
		inprocess = 0;
			if(is_confirm) $('.exchange-section #order-confirm').removeClass('loading');
			else unset_formloader($form);
		},
    	error: function(request, error){
		inprocess = 0; unset_formloader($form);  refresh_page();
    	}  
	});
	}
	else
	{
	inprocess = 0;
		if($form.find('.error').length > 0) $('html, body').animate({scrollTop:($form.find('.error').first().offset().top-250<0 ? 0 : $form.find('.error').first().offset().top-250)}, 400);
	}
}

function process_exchange_status()
{
	if(inprocess == 1 || !$('.order-section').length > 0) return false; inprocess = 1;
	var form_data = {'OrderHash':$('.order-section').data('cscv')};
	var form_errors = false;
	if(form_errors === false)
	{
	$('.order-section #order-paid-confirm').addClass('loading');
	$.ajax(
		{
		url:'/ajax/process_exchange_status', data:form_data, cache:false,
		success: function(r){ 
			if(r.error == 0)
			{
			$('.order-section .title h3').text(r.title_section);
			$('.order-section #order-paid-confirm').removeClass('loading');
			$('.order-statuses .item.i1').removeClass('pending').addClass('active');
			$('.order-statuses .item.i2').addClass('pending');
			//$('.order-section .instructions, .order-section .buttons-c').slideUp(500);
			$('.order-section .buttons-c').slideUp(500);
				//setTimeout(function(){ $('.order-section .instructions, .order-section .buttons-c').remove(); },700);
				setTimeout(function(){ $('.order-section .buttons-c').remove(); },700);
			}
			else refresh_page();
		inprocess = 0;
		$('.order-section #order-paid-confirm').removeClass('loading');
		},
    	error: function(request, error){
		inprocess = 0; refresh_page();
    	}  
	});
	}
	else inprocess = 0;
}

function formsuccess($form,scmsg)
{
	$('#successmsg').remove();
	$('body').append('<div class="h-p" id="successmsg">'+scmsg+'</div>');
	$('#successmsg').addClass('sp');
	hide_formsuccess($form);
	inprocess = 0;
}

function hide_formsuccess($form)
{
	clearTimeout(fs_timeout);
	fs_timeout = setTimeout(function(){
		if($('#successmsg').length > 0) $('#successmsg').removeClass('sp');
	},7000);
}

function formerror($form,ermsg)
{
	$('#errormsg').remove();
	$('body').append('<div class="h-p" id="errormsg">'+ermsg+'</div>');
	$('#errormsg').addClass('sp');
	hide_formerror($form);
	inprocess = 0;
}

function del_formerror($form)
{
	$form.find('.errormsg').remove();
}

function hide_formerror($form)
{
	clearTimeout(fe_timeout);
	fe_timeout = setTimeout(function(){
		if($('#errormsg').length > 0) $('#errormsg').removeClass('sp');
	},5000);
}

function set_n() {
	$(document).on('keyup change','.number-t',function(){
		var old_val = this.value;
		var new_val = old_val.replace(/[^0-9.]/g,'');
		var dotpos = new_val.indexOf('.');
		if(dotpos !== -1 && (new_val.length-dotpos) > 10)
		{
		new_val = new_val.split('.');
		new_val = new_val[0]+'.'+new_val[1].substr(0,11);
		}
		if(new_val.substr(0,2) == '00') while(new_val.substr(0,2) == '00') new_val = new_val.substr(1);
		if(new_val != old_val) this.value = new_val;
	});
	$(document).on('keypress', '.number-t', function (evt) {
	evt = (evt) ? evt : ((window.event) ? event : null);
		if(evt) {
		var elem = (evt.target)	? evt.target : ( evt.srcElement	? evt.srcElement : null );
			if (elem) {
				var dotpos = this.value.indexOf('.');
				var charCode = evt.charCode	? evt.charCode : ( evt.which ? evt.which : evt.keyCode );
				if ((charCode < 32) ||
					(charCode == 46 && dotpos === -1 && this.value!='') || //(charCode == 47 && this.value!='') || 
					(charCode > 47 && charCode < 58)) {
					return true;
				}
				else return false;
			}
		}
	});	
	$(document).on('paste drop','.number-t',function(e){
		e.preventDefault();
	});
}

function process_contactsform()
{
	if(inprocess == 1 || !$('#contactsform').length > 0) return false; inprocess = 1;
	var $form = $('#contactsform');
	var process_url = 'ajax/process_contactsform';
	var form_data = $form.serializeArray();
	var form_errors = false, temp_error = false;
	$form.find('input.required, textarea.required').each(function(){
		del_el_error($(this));
		temp_error = vf_required($(this));
		if(temp_error) form_errors = true;
	});
	$form.find('#s_phone').removeClass('error');
	if($form.find('#s_phone').val() != '') { temp_error = vf_phoneinp($form.find('#s_phone')); if(temp_error) form_errors = true; }
	temp_error = vf_emailinp($form.find('#s_email')); if(temp_error) form_errors = true;
	temp_error = vf_length($form.find('#s_message'),10); if(temp_error) form_errors = true;
	if(form_errors === false)
	{
	set_formloader($form);
	$.ajax(
		{
		url:process_url, data:form_data, cache:false,
		success: function(r){ 
			if(r.error == 0)
			{
			document.getElementById("contactsform").reset();
			formsuccess($form, r.msg);
			}
			else formerror($form, 'Error: '+r.error);
		inprocess = 0; unset_formloader($form);
		},
    	error: function(request, error){
		inprocess = 0; unset_formloader($form);
    	}  
	});
	}
	else
	{
	inprocess = 0;
		if($form.find('.error').length > 0) $('html, body').animate({scrollTop:$form.find('.error').first().offset().top-100}, 400);
	}
}

function get_top(el) {
	if(!el.length >0) return false;
	return el.offset().top;
}

function del_el_error($element)
{
	if($element.hasClass('error')) $element.removeClass('error');
}

function vf_required($element)
{
	var elvalue = $element.val();
	if(!elvalue) {
		$element.addClass('error');
		return true;
	}
	return false;
}

function vf_number($element)
{
	var elvalue = $element.val();
	if(isNaN(elvalue)) {
		$element.addClass('error');
		return true;
	}
	return false;
}

function vf_is_number(val)
{
	if(isNaN(val)) {
		return false;
	}
	return true;
}

function vf_emailinp($element)
{
	var elvalue = $element.val();
    var reg = /^([a-z0-9_\.\-\+]+)@([\da-z\.\-]+)\.([a-z\.]{2,20})$/i;
	if(!reg.test(elvalue)) {
		$element.addClass('error');
		return true;
	}
	return false;
}

function vf_phoneinp($element)
{
	var elvalue = $element.val();
    var reg = /^[-()+ 0-9]{4,25}$/;
	if(!reg.test(elvalue)) {
		$element.addClass('error');
		return true;
	}
	return false;
}

function vf_length($element,length)
{
	var elvalue = $element.val();
	if(elvalue.length < length) {
		$element.addClass('error');
		return true;
	}
	return false;
}

function viewObject(array) {
  var res = '';
  for (var v in array) {
    res += v + ': ' + array[v] + '\n';
  }
  console.log('RESULT:');
  console.log(res);
  console.log('');
}

Object.kkcc = function(mobj) {
	var length = 0, okey;
		for(okey in mobj) if(mobj.hasOwnProperty(okey)) length++;
	return length;
};

function refresh_page() 
{
	window.location.reload(true);
}

function in_array(val,arr) 
{
	for(var i=0; i<arr.length; i++) 
	{
		if(String(arr[i])==String(val)) return true;
	}
	return false;
}

function str_replace(search, replace, subject) {
    return subject.split(search).join(replace);
}

function googleTranslateElementInitN() {
  new google.translate.TranslateElement({pageLanguage:'en',autoDisplay:false}, 'google_translate_element_n');
}

function fireGtEvent(el,ev) {
	try{
		if(document.createEventObject) { var evt = document.createEventObject(); el.fireEvent('on'+ev,evt) }
		else { var evt = document.createEvent('HTMLEvents'); evt.initEvent(ev,true,true); el.dispatchEvent(evt); }
	}
	catch(e){}
}

function doGTranslate(lang_pair){if(lang_pair.value)lang_pair=lang_pair.value;if(lang_pair=='')return;var lang=lang_pair.split('|')[1];if(GTranslateGetCurrentLang() == null && lang == lang_pair.split('|')[0])return;if(typeof ga == 'function'){ga('send', 'event', 'GTranslate', lang, location.hostname+location.pathname+location.search);}else{if(typeof _gaq!='undefined')_gaq.push(['_trackEvent', 'GTranslate', lang, location.hostname+location.pathname+location.search]);}var teCombo;var sel=document.getElementsByTagName('select');for(var i=0;i<sel.length;i++)if(/goog-te-combo/.test(sel[i].className))teCombo=sel[i];if(document.getElementById('google_translate_element2')==null||document.getElementById('google_translate_element2').innerHTML.length==0||teCombo.length==0||teCombo.innerHTML.length==0){setTimeout(function(){doGTranslate(lang_pair)},500)}else{teCombo.value=lang;GTranslateFireEvent(teCombo,'change');GTranslateFireEvent(teCombo,'change')}}


function GoogleTranslateChange(sl_lang){
var goog_te_combo_de;
var page_sb_all = document.getElementsByTagName('select');
	for(var i=0; i<page_sb_all.length; i++)
	{
		if(/goog-te-combo/.test(page_sb_all[i].className))
		{
		goog_te_combo_de = page_sb_all[i];
		break;
		}
	}
	if(!(document.getElementById('google_translate_element_n')==null || document.getElementById('google_translate_element_n').innerHTML.length==0 || goog_te_combo_de.length==0 || goog_te_combo_de.innerHTML.length==0))
	{
	Cookies.set('sl_lang_current', sl_lang, { expires: 7, path: '/', domain:cookie_domain });
	goog_te_combo_de.value=sl_lang;
	fireGtEvent(goog_te_combo_de,'change');
	fireGtEvent(goog_te_combo_de,'change');
	}
	else setTimeout(function(){ GoogleTranslateChange(sl_lang) },300);
}

function GoogleTranslateChangeV2(sl_lang)
{
	if($(document).find('#google_translate_element_n select.goog-te-combo').length > 0 && $(document).find('#google_translate_element_n select.goog-te-combo').html().length > 0)
	{
	Cookies.set('sl_lang_current', sl_lang, { expires: 7, path: '/', domain:cookie_domain });
	var $goog_te_combo = $(document).find('#google_translate_element_n select.goog-te-combo');
	var goog_te_combo_de = $goog_te_combo.get(0);
	$goog_te_combo.val(sl_lang);
	fireGtEvent(goog_te_combo_de, "change");
	fireGtEvent(goog_te_combo_de, "change");
	}
	else setTimeout(function(){ GoogleTranslateChange(sl_lang) },300);
}