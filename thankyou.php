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
								if(SMTP_CONNECTION) { 
									echo "Please confirm your email.";
								} else {
									echo "Please verify your identity by connecting at least 2 social media accounts";
								}
							?>
						</h3>
						<div class="box-body">
							<a href="login_with_facebook.php">
								<img src="css/images/facebook.png" width="280px;" style="margin: 15px 20px 20px 15px; border-radius: 5px;"/>
							</a>
							<a href="login_with_instagram.php">
								<img src="css/images/instagram.png" width="280px;" style="margin: 15px 20px 20px 15px; border-radius: 5px;"/>
							</a>
							<a href="login_with_twitter.php">
								<img src="css/images/twitter.png" width="280px;" style="margin: 15px 20px 20px 15px; border-radius: 5px;"/>
							</a>
							<a href="login_with_linkedin.php.php">
								<img src="css/images/linkedin.png" width="280px;" style="margin: 15px 20px 20px 15px; border-radius: 5px;"/>
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