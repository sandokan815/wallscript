<?php
include_once 'config.php';
include_once 'template_headerLogin.php';
?>
<script>
	$(document).ready(function() {
		$('body').on('click', '#login', function(e) {
			e.preventDefault();
			username=$('#username').val();
			password=$('#password').val();
			if (username == 'apple' && password == 'PurpleDream') {
				var url='/login.php';
				window.location.replace(url);
			} 
		})
	})
</script>

<title><?php echo SITE_NAME; ?> Login</title>
</head>
<body class="login">
	<div id="content" class="loginContent">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6">
					<div class="panel panel-default">
						<div class="panel-body login-body ">
							<div class="category loginTitle">Login</div>
							<form method="post" action="" name="login">
							<label class="emailUsername">Username</label>
							<input class="form-control" id="username" placeholder="Enter Username">
							<label class="password">Password</label>
							<input class="form-control" id="password" name="passcode" type="password" placeholder="Enter Password">

							<input type="submit" class="wallbutton messageButton buttonLogin" value="Go to Website" id="login" style="margin-left: 100px;"> 
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>