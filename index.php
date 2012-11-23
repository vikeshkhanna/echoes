<?php
include dirname(__FILE__)."/php/login.php";

if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');
	echo $user_profile['name'];	  
    } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}
?>

<html>
<head>
	<title>Echoes</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet">
	<script src="http://connect.facebook.net/en_US/all.js"></script>
	<script src="assets/js/main.js"></script>

	<script>
		// init the FB JS SDK
		FB.init({
		  appId      : '556761407680480', // App ID from the App Dashboard
		  //channelUrl : '//WWW.YOUR_DOMAIN.COM/channel.html', // Channel File for x-domain communication
		  status     : true, // check the login status upon init?
		  cookie     : true, // set sessions cookies to allow your server to access the session?
		  xfbml      : true  // parse XFBML tags on this page?
		});

		FB.getLoginStatus(function(response) {
			if (response.status === 'connected') {
				// the user is logged in and has authorized your app
				var uid = response.authResponse.userID;
				var accessToken = response.authResponse.accessToken;
				replace("preloader-facebook", "btn-facebook-login");
				fetch_id();
			} else if (response.status === 'not_authorized') {
			// the user is logged in to Facebook, 
			// but has not authenticated your app
			} else {
			// the user isn't logged in to Facebook.
			
			}
		});
	
		function login()
		{
			// Additional initialization code such as adding Event Listeners goes here
			FB.login(function(response) {
				if (response.authResponse) {
				 console.log('Welcome!  Fetching your information.... ');
				 replace("preloader-facebook", "btn-facebook-login");
				 fetch_id();
				} else {
				 console.log('User cancelled login or did not fully authorize.');
				}
			});
		};
		
		function get_id()
		{
			FB.api('/me', function(response) {
				   console.log('Good to see you, ' + response.name + ' : ' + response.id + '.');
				 });
		}	
	</script>

</head>
<style>
 .container-narrow {
        margin: 0 auto;
        max-width: 800px;
    }
 
 .jumbotron {
	margin: 60px 0;
	text-align: center;
  }
  .jumbotron h1 {
	font-size: 72px;
	line-height: 1;
  }
  .jumbotron .btn {
	font-size: 21px;
	padding: 14px 24px;
  }
  
  .preloader
  {
	display:none;
	margin: 20px auto 10px auto;
	width:75px;
	height:75px;
  }
  
</style>

<body>
<div id="fb-root"></div>
<div class="container-narrow">

  <div class="masthead">
	<ul class="nav nav-pills pull-right">
	  <li class="active"><a href="#">Home</a></li>
	  <li><a href="/about.php">About</a></li>
	  <li><a href="/contact.php">Contact</a></li>
	  <?php if($user) { echo '<li><a href=http://facebook.com/'. $user . '><img src="http://graph.facebook.com/'. $user . '/picture" /></a></li>'; } ?>
	</ul>
	<h3 class="muted">Echoes</h3>
  </div>

  <hr />
	
  <div class="jumbotron">
        <p class="lead">Echoes is a chrome extension that lets you add music to your Facebook profile, which is kind of silly and juvenile. But yes, that's what it does.</p>
        <a id="btn-facebook-login" class="btn btn-large btn-primary" onclick="login()">Log in with Facebook</a>
		<img id="preloader-facebook" class="preloader" src="assets/img/preloader.gif" />
  </div>
  
  <hr>
</div>

</body>
</html>
