<?php 
function baseurl(){
	$baseurl1 = 'http://www.1socialmedia.nl/developer/facebook/blueboot/';
	return $baseurl1;
}

function pageUrl(){
	$baseurl1 = 'http://www.1socialmedia.nl/developer/facebook/blueboot/index.php/';
	return $baseurl1;
}


function themeUrl(){
	$theme = '1socialmedia';
	$turl = baseurl().'themes/'.$theme.'/';
	return $turl;
}

function mediaUrl(){
	$theme = '1socialmedia';
	$turl = baseurl().'themes/'.$theme.'/images/';
	return $turl;
}

function Image($image){
	$theme = '1socialmedia';
	$turl = '<img src="';
	$turl .= baseurl().'themes/'.$theme.'/images/'.$image.'';
	$turl .= '">';
	return $turl;
}

function slide($image){
	$theme = '1socialmedia';
	$turl = '<img src="';
	$turl .= baseurl().'themes/'.$theme.'/images/slider/'.$image.'';
	$turl .= '">';
	return $turl;
}

function Headers(){	
	 require 'application/libraries/facebook/facebook.php';
	 $app_id = '12321';
	 $local_lang = 'en_GB';
	 $tlink = Themeurl();
	 $header =  '<!DOCTYPE html>
	 ';
	 $header .= '<html lang="en">
	 ';
	 $header .= '<head>
	 ';
	 $header .= '<link rel="stylesheet" type="text/css" href="'.$tlink.'css/style.css">
	 ';
	 $header .= '<link rel="stylesheet" type="text/css" href="'.$tlink.'css/jquery.tweet.css">
	 ';
	  $header .= '<link rel="stylesheet" type="text/css" href="'.$tlink.'js/shadowbox/shadowbox.css">
	 ';
	 $header .= '<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	 ';
	 $header .= '<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>';
	 $header .= '<script type="text/javascript" src="'.themeUrl().'js/shadowbox/shadowbox.js"></script>';
		$files ='
		cufon-yui.js,
		cent_400-cent_700.font.js,
		jquery.youtubeChannel.js,
		jquery.tweet.js
		';
		$mkurl = explode(",",$files);
		
		foreach($mkurl as $item){
			$link = str_replace('
		', '', $item);
			$header .= '<script type="text/javascript" src="'.themeUrl().'js/'.$link.'"></script>
			';
		}
	 $header .= "
	 <script type=\"text/javascript\">
			Cufon.replace('h2');
			Cufon.replace('.title');
			Shadowbox.init();
	</script>
	";		 
	 $header .= '</head>
	 ';
	 $header .= '<body>
	 ';
	 $header .= '<div id="fb-root"></div>
	 ';
     $header .= '<script>
     ';
	 $header .= "window.fbAsyncInit = function() {FB.init({appId: ".$app_id.", status: true, cookie: true, xfbml: true});FB.Canvas.setAutoGrow();";
	 $header .= "};(function() {var e = document.createElement('script'); e.type = 'text/javascript'; e.src = document.location.protocol + '//connect.facebook.net/".$local_lang."/all.js'; e.async = true;";
	 $header .= "document.getElementById('fb-root').appendChild(e);";
	 $header .= "}());";
	 $header .= "</script>
	 ";
$header .= '
<div class="main_centering">
';	 
$header .= '
	<div class="main_wrapper">
';
	 echo $header;	 
}


function Footer(){
	$footer  = '</div>	
	'; 
$footer .= '
</div>
';	
	$footer .= '</body>
	';
	$footer .= '</html>
	';
	echo $footer;
}

function plugin($name){
	$pluginlink = 'application/plugins/'.$name.'.php';
	include($pluginlink);
}


?>