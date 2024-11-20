
<!DOCTYPE html>
<html lang="en">
<head>
<title>Exchange</title>
<meta charset="utf-8">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="generator" content="SMARTWEB.AM">
<meta property="og:type" content="website">
<meta property="og:site_name" content="boltchange.com">
<meta property="og:title" content="Exchange | boltchange.com">
<meta property="og:url" content="https://boltchange.com/exchange/?fixed_to=1&exchange_amount_from=1123.0425&exchange_from=2&exchange_amount_to=1078.1208&exchange_to=16">
<meta property="og:description" content="">
<meta name="twitter:card" content="summary">
<meta name="twitter:title" content="Exchange | boltchange.com">
<meta name="twitter:description" content="">
<meta name="resource-type" content="Document">
<meta name="revisit" content="1">
<meta name="robots" content="noindex, nofollow">
<meta name="format-detection" content="telephone=no">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
<meta name="google-site-verification" content="grGxK27seKZVHG_DBe91RPAa7u6QysaGKOJpLHZMFFc">
<link rel="shortcut icon" href="/favicon.ico">
<link rel="apple-touch-icon" sizes="57x57" href="/images/favicon/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="/images/favicon/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="/images/favicon/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="/images/favicon/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="/images/favicon/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="/images/favicon/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="/images/favicon/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="/images/favicon/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="/images/favicon/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="/images/favicon/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="/images/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="/images/favicon/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="/images/favicon/favicon-16x16.png">
<link rel="manifest" href="/images/favicon/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
<link rel="stylesheet" href="/css/first.css?ver=3.7.8">
<link rel="stylesheet" href="/css/style.css?ver=3.7.8">
<link rel="stylesheet" href="/css/responsive.css?ver=3.7.8">
<script>
var gw = new Array(); gw['lng']="en";
var sl_lang_current = "en";
var cookie_domain = 'boltchange.com';
</script>
<script>
var directions_from_ar = {!! json_encode($directions['directions_from_ar']) !!};
var directions_to_ar = {!! json_encode($directions['directions_to_ar']) !!};
window.csrf_token = '{{ csrf_token() }}';
</script>
</head>
<body class="exchange active-preloader-ovh">
<div class="header-sticky-space"></div>
<div class="preloader"><div class="spinner"></div></div>
<header class="header header-home-one">
    <nav class="navbar navbar-default header-navigation stricky">
        <div class="thm-container clearfix">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed bitmex-icon-menu" data-toggle="collapse" data-target=".main-navigation" aria-expanded="false"> </button>
                <a class="navbar-brand" href="/">
                    <img src="/images/page/logo.png" alt="boltchange">
                </a>
            </div>
            <div class="collapse navbar-collapse main-navigation mainmenu " id="main-nav-bar">
                <ul class="nav navbar-nav navigation-box">
                    <li><a class="inner-link" href="/blog">Blog</a></li>
                    <li><a class="inner-link" href="/#home-how-it-works">How It Works</a></li>
                    <li><a class="inner-link" href="/#home-about-us">About Us</a> </li>
                    <li><a href="/terms-of-use">Terms of Use</a></li>
                    <li><a href="/contacts">Contacts</a></li>
                </ul>                
            </div>
        </div>
    </nav>   

</header>
<section class="inner-banner gray-bg text-center">
	<div class="thm-container">
		<div class="breadcumb">
			<a href="/">Home</a><!--
			--><span class="sep">-</span><!--
			--><span class="page-name">Exchange</span>
		</div><!-- /.breadcumb -->
		<h1>Exchange</h1>
	</div><!-- /.thm-container -->
</section><!-- /.inner-banner -->

<section class="exchange-section">
    <div class="thm-container first-container">
		<div class="form-c">
			<div class="title">
				<h3>Please enter the details of your exchange</h3>
			</div>
<form class="exchange-form" action="/confirm/" method="get">
	<input id="fixed-to" type="hidden" name="fixed_to" value="1">
	<div class="controls-group clearfix">
		<div class="control-item i1">
			<span class="head-pl">You Send</span>
			<input id="exchange-amount-from" class="required number-t" type="text" name="exchange_amount_from" maxlength="20" value="{{ $data['exchange_amount_from'] }}" placeholder="Enter Amount">
		</div>
        <div class="control-item">
			<select id="exchange-from" name="exchange_from">
			</select>
		</div>
    </div>
	<div class="controls-group i2 clearfix">
		<div class="control-item i1">
			<span class="head-pl">You Get</span>
			<input id="exchange-amount-to" class="required number-t" type="text" name="exchange_amount_to" maxlength="20" value="{{ $data['exchange_amount_to'] }}" placeholder="Enter Amount">
		</div>
        <div class="control-item">
			<select id="exchange-to" name="exchange_to">
			</select>
		</div>
    </div>
    <div class="exchange-to-extra-fields"></div>
    <div class="control-single-item">
		<input id="recipient-wallet" class="required" type="text" name="recipient_wallet" maxlength="120" value="" placeholder="Please enter your {{ $currency_to->name }} E-mail">
		<span class="wallet-eg active">e.g. <span>Please enter your {{ $currency_to->name }} E-mail</span></span>
	</div>
    <div class="control-single-item">
		<input id="recipient-email" class="required" type="text" name="recipient_email" maxlength="120" value="" placeholder="Enter your E-mail address">
	</div>
	<div class="submit-c">
		<input class="submit" type="submit" value="Continue">
	</div>
</form>
		</div>
		<div class="confirm">
			<div class="title">
				<h3>Please confirm the details of your exchange</h3>
			</div>
			<div class="item">
				<div class="i1">You Send:</div>
				<div class="value you-send"><span class="val"></span></div>
			</div>
			<div class="item">
				<div class="i1">You Get:</div>
				<div class="value you-get"><span class="sybmol">&asymp;</span> <span class="val"></span></div>
			</div>
			<div class="exchange-to-extra-fields-values"></div>
			<div class="item">
				<div class="i1">To Wallet address:</div>
				<div class="value to-wallet"><span class="val"></span></div>
			</div> 
			<div class="item">
				<div class="i1">E-mail:</div>
				<div class="value email"><span class="val"></span></div>
			</div>
			<div class="consent-processing-c">
				<div class="checkbox-c "><input id="consent-processing" type="checkbox" name="consent_processing" value="1"><label for="consent-processing"><span>I agree with <a href="/terms-of-use" target="_blank">Terms of Use</a> and <a href="/privacy-policy" target="_blank">Privacy policy</a></span></label></div>
			</div>
			<div class="buttons-c">
				<button id="order-confirm" class="thm-btn yellow-bg" type="button">Confirm</button>
				<button id="order-back" class="thm-btn gray-bg" type="button">Back</button>
			</div>
		</div>    </div>
</section>
<div class="footer-top">
	<div class="thm-container">
		<div class="row">
			<div class="col-md-4 col-xs-12">
				<div class="single-footer-top">
					<p><i class="fa fa-envelope-o"></i><span>Email: </span><a href="mailto:info@boltchange.com">info@boltchange.com</a></p>
				</div><!-- /.single-footer-top -->
			</div><!-- /.col-md-4 -->
			<div class="col-md-4 col-sm-6 col-xs-12">
				<div class="single-footer-top">
					<p><i class="fa fa-phone"></i><span>Call: </span><a href="tel:+18502800803">+18502800803</a></p>
				</div><!-- /.single-footer-top -->
			</div><!-- /.col-md-4 -->
			<div class="col-md-4 col-sm-6 col-xs-12">
				<div class="single-footer-top">
					<p><i class="fa fa-whatsapp"></i><span>Call: </span><a href="tel:+18502800803">+18502800803</a></p>
				</div><!-- /.single-footer-top -->
			</div><!-- /.col-md-4 -->
		</div><!-- /.row -->
	</div><!-- /.thm-container -->
</div><!-- /.footer-top -->

<footer class="site-footer">
	<div class="thm-container">
		<div class="row masonary-layout">
			<div class="col-md-2 col-sm-6 col-xs-12">
				<div class="single-footer-widget">
					<div class="title">
						<h3>About</h3>
					</div><!-- /.title -->
					<ul class="links-list">
						<li><a href="/#home-about-us">About Us</a></li>
						<li><a href="/contacts">Contacts</a></li>
						<li><a href="/faq">FAQ</a></li>
					</ul><!-- /.links-list -->
				</div><!-- /.single-footer-widget -->
			</div>
			<div class="col-md-2 col-sm-6 col-xs-12">
				<div class="single-footer-widget">
					<div class="title">
						<h3>Legal</h3>
					</div><!-- /.title -->
					<ul class="links-list">
						<li><a href="/terms-of-use">Terms of Use</a></li>
						<li><a href="/privacy-policy">Privacy policy</a></li>
					</ul><!-- /.links-list -->
				</div><!-- /.single-footer-widget -->
			</div>
			<div class="col-md-4 col-sm-6 col-xs-12">
				<div class="single-footer-widge hiddent">
					<div class="title">
						<h3>Exchange Pairs</h3>
					</div><!-- /.title -->
					<ul class="links-list clearfix exchange-pairs">
						<li><a href="/direction/usdt-to-cash-app">USDT (TRC20) to Cash App</a></li>
						<li><a href="/direction/usdt-to-wise">USDT (TRC20) to TransferWise</a></li>
						<li><a href="/direction/usdt-payoneer">USDT (TRC20) to Payoneer</a></li>
						<li><a href="/direction/btc-to-skrill">BTC to Skrill</a></li>
						<li><a href="/direction/trust-wallet-to-paypal">Trust Wallet to Paypal</a></li>
						<li><a href="/direction/USDT-to-Skrill">USDT (TRC20) to Skrill</a></li>
						<li><a href="/direction/usdt-to-paypal">USDT (TRC20) to Paypal</a></li>
					</ul><!-- /.links-list -->
				</div><!-- /.single-footer-widget -->
			</div>
			<div class="col-md-4 col-sm-6 col-xs-12">
				<div class="single-footer-widget">
					<div class="title">
						<h3>Blog</h3>
					</div><!-- /.title -->
					<ul class="links-list">
						<li><a href="/post/boltchange-Crypto-Exchange">User's Guide: Navigating boltchange's Crypto Exchange Features</a></li>
						<li><a href="/post/Exchange-on-boltchange-in-2024">Top Cryptocurrencies to Exchange on boltchange in 2024</a></li>
						<li><a href="/post/boltchange-to-paypal">Seamless Crypto to PayPal Transfers: How boltchange Makes It Possible</a></li>
						<li><a href="/post/boltchange-platform-to-payoneer">Exploring the Benefits of Using Crypto with Payoneer through boltchange</a></li>
					</ul><!-- /.links-list -->
				</div><!-- /.single-footer-widget -->
			</div><!-- /.col-sm-4 -->
		</div><!-- /.row -->
	</div><!-- /.thm-container -->
</footer><!-- /.site-footer -->

<div class="footer-bottom">
	<div class="thm-container clearfix">
		<div class="pull-left copy-text">
			<p>&copy; 2024 boltchange. All rights reserved.</p>
		</div><!-- /.pull-left copy-text -->
		<div class="social pull-right">
			<a href="https://x.com/BoltChange_com" class="fa fa-twitter" target="_blank"></a><a href="https://www.instagram.com/boltchange_com?igshid=OGQ5ZDc2ODk2ZA%3D%3D&amp;utm_source=qr" class="fa fa-instagram" target="_blank"></a><a href="https://www.youtube.com/@boltchange_com" class="fa fa-youtube-play" target="_blank"></a>        </div><!-- /.social -->
		
	</div><!-- /.thm-container -->
</div><!-- /.footer-bottom -->


<script>var _smartsupp = _smartsupp || {};
_smartsupp.key = '13d35c10fc9d3a578b46e0cac6d4b202331d321c';
window.smartsupp||(function(d) {
  var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
  s=d.getElementsByTagName('script')[0];c=d.createElement('script');
  c.type='text/javascript';c.charset='utf-8';c.async=true;
  c.src='https://www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
})(document);</script>             
<script async src="https://www.googletagmanager.com/gtag/js?id=G-2KQ2JZQ1K3"></script>
<script>window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'G-2KQ2JZQ1K3');</script>
<script src="/js/jquery.js"></script>
<script src="/js/myhtmlselect.js?ver=3.7.8"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/custom.js?ver=3.7.8"></script>
<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInitN"></script>
<script src="//code.tidio.co/3teqm79ccbgvspbbyu3pqoopv5gfb7qy.js" async></script>
<span style="display:none;">0.018 second</span></body>
</html>