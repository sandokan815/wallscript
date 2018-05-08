<?php
include_once 'config.php';
include_once 'template_headerLogin.php';
?>

<script>
$(document).ready(function()
{
$.baseUrl='<?php echo BASE_URL ?>';
$.baseUploads='<?php echo UPLOAD_PATH ?>';
$.active_code='<?php echo$_GET["code"] ?>';
publicLabelData($.baseUrl);
});
</script>
</head>
<body class="login">
<?php include_once 'template_topMenuLogin.php'; ?>
<div id="content" class="loginContent">
	<div class="container-fluid">
		<div class="row">
			<div>
				<div class="panel panel-default ">
					<div class="panel-body login-body verifyMessage" >
						<h1 class="thankYou">THANK YOU!</h1>
						<h3 class="thankYouMessage">
							<?php
							if(SMTP_CONNECTION)
							{ 
							echo "Please confirm your email.";
							}
							else
							{
							echo "Please verify your identity by connecting at least 2 social media accounts";
							}
							?>
						</h3>
						<div class="box-body">
							<a  href="login_with_facebook.php" class="btn btn-block btn-social btn-facebook">
								<i class="fa fa-facebook"></i> <span class="buttonFacebook">Sign in with Facebook</span>
							</a>

							<a href="login_with_google.php" class="btn btn-block btn-social btn-google-plus">
								<i class="fa fa-google"></i> <span class="buttonGoogle">Sign in with Google</span>
							</a>

							<a href="login_with_microsoft.php" class="btn btn-block btn-social btn-microsoft">
								<i class="fa fa-windows"></i> <span class="buttonMicrosoft">Sign in with Microsoft</span>
							</a>

							<a href="login_with_linkedin.php" class="btn btn-block btn-social btn-linkedin">
								<i class="fa fa-linkedin"></i> <span class="buttonLinkedin">Sign in with LinkedIn</span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>

</html>