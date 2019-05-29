<!doctype html>
<html lang="en">

<head>
<title>Dealer Login</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="description" content="Mplify Bootstrap 4.1.1 Admin Template">
<meta name="author" content="ThemeMakker, design by: ThemeMakker.com">

<link rel="icon" href="favicon.ico" type="image/x-icon">
<!-- VENDOR CSS -->
<link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../vendor/animate-css/animate.min.css">
<link rel="stylesheet" href="../vendor/font-awesome/css/font-awesome.min.css">

<!-- MAIN CSS -->
<link rel="stylesheet" href="../assets/css/main.css">
<link rel="stylesheet" href="../assets/css/color_skins.css">
</head>

<body class="theme-blue">
	<!-- WRAPPER -->
	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle auth-main">
				<div class="auth-box">
                    <div class="mobile-logo"><img src="images/logo-icon.svg" alt="Mplify"></div>
                    <div class="auth-left">
                        <div class="left-top">
                            <a href="index.html">
                                <img src="../images/logo-icon.svg" alt="Mplify">
                                <span>Login</span>
                            </a>
                        </div>
                        <div class="left-slider">
                            <img src="../images/login/1.jpg" class="img-fluid" alt="">
                        </div>
                    </div>
                    <div class="auth-right">
                        
                        <div class="card">
                            <div class="header">
                                <p class="lead">Log in</p>
                            </div>
                            <div class="body">
                                <form class="form-auth-small" action="index.html">
                                    <div class="form-group">
                                        <label for="signin-email" class="control-label sr-only">Email</label>
                                        <input type="email" class="form-control" id="signin-email" value="" placeholder="Email" required="" >
                                    </div>
                                    <div class="form-group">
                                        <label for="signin-password" class="control-label sr-only">Password</label>
                                        <input type="password" class="form-control" id="signin-password" value="" placeholder="Password" required="">
                                    </div>
                                    <div class="form-group clearfix">
                                        <label class="fancy-checkbox element-left">
                                            <input type="checkbox">
                                            <span>Remember me</span>
                                        </label>								
                                    </div>
                                    <button type="submit" class="btn btn-success btn-lg btn-block" id="signin">LOGIN</button>
                                    <div class="bottom">
                                        <span class="helper-text m-b-10" id="available"></span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
</body>
<script type="text/javascript" src="../vendor/jquery/jquery.js"></script>
<script type="text/javascript" src="../assets/js/logindealer.js"></script>
</html>