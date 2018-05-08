<?php
include_once 'includes.php';
include_once 'pagination_header.php';
$Users_Details_Array=$WallAdmin->Users_Details($start,$per_page);
$Users_Count=$WallAdmin->Users_Count();
$count = $Users_Count;
$no_of_paginations = ceil($count / $per_page);
$user=1;


?>

<!DOCTYPE html>
<html>
    <?php include_once("head.php"); ?>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <?php include_once("header.php"); ?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
           <?php include_once("menu.php"); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                       Users

                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Users</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                  <div class="col-md-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Manage Users</h3>

                                    <div class="pull-right searchBlock">
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModalCenter">
                                          Create User
                                        </button>
                                        
                                    <form method="post" action="" style = 'float: right; margin-left: 10px;'>
                                        <input type="text" value="" name="searchKey"  id="searchInput" placeholder="Search"/>
                                        <input type="submit" class="btn-success wallbutton" value=" Search " rel="user" id="searchButton"/>
                                    </form>
                                    </div>


                                </div><!-- /.box-header -->

                                <div class="box-body" id="userSearchResults" style="display:none">
                                    
                                     <table class="table table-bordered">
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>UserName</th>
											<th>Full Name</th>
											<th>Email</th>
											<th>IP addr</th>
											<th>Created day</th>
                                            
											<th>Status</th>
											<th>Verified</th>
											<th >Actions</th>

                                        </tr>
                                        <tbody id="tbody">
                                            


                                        </tbody>


                                        </table>
                                </div>


                                <div class="box-body" id="userResults">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>UserName</th>
											<th>Full Name</th>
											<th>Email</th>
											<th>IP addr</th>
											<th>Created day</th>
                                            
											<th>Status</th>
											<th>Verified</th>
											<th >Actions</th>

                                        </tr>
										<?php
										foreach($Users_Details_Array as $data)
										{

										?>
                                        <tr id="users<?php echo $data['uid']; ?>">
										 <td style="width: 10px">#</td>
                                            <td><a href="<?php echo $base_url.$data['username']; ?>" target="_blank"><?php echo $data['username']; ?></a></td>
											<td>
											<?php echo $data['name']; ?>

											</td>
											<td><?php echo $data['email']; ?></td>
											<td><?php echo $data['ipaddr']; ?></td>
											<td><?php echo $data['created_day']; ?></td>
                                            <!-- td>
											<?php if($data['provider']) { ?>
											<span class="label label-primary">Social</span>
											<?php } ?>
											</td -->
											<td>
											<?php if($data['name']) { ?>
											<span class="label label-success">Complete</span>
											<?php } ?>
											</td>
											<td id="verified<?php echo $data['uid'];?>">
											<?php if($data['verified']) { ?>
											<span class="label label-blue"><i class="fa fa-star"></i> Verified</span>
											<?php }?>
											</td>
											<td>
    											<a href="#" class="btn btn-danger btn-sm block" id="<?php echo $data['uid']; ?>" rel=""><i class="fa fa-ban"></i> Block</a>&nbsp;&nbsp;&nbsp;
    											<?php if($data['verified']=='0') { ?>
    											<a href="#" class="btn btn-info btn-sm verified" id="<?php echo $data['uid']; ?>" rel=""><i class="fa fa-star-o"></i> Verify</a>
											    <button type="button" class="btn btn-info edit_btn" id = '<?php echo $data['uid']; ?>' data-toggle="modal" data-target="#editModalCenter">
                                                  Edit User
                                                </button>
											<?php } ?>
											</td>

                                        </tr>
										<?php } ?>



                                    </table>
                                </div><!-- /.box-body -->
								<?php include 'pagination_footer.php'; ?>
      </div><!-- /.box -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        
        <style>
            .username, .password {margin-top: 10px;}
        </style>
        
            <!-- Modal for create user -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="panel panel-default">
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close" style = 'padding: 20px;' >
                          <span aria-hidden="true">&times;</span>
                       </button>
                    <div class="panel-heading panel-heading-gray">
                        <h3 class="box-title">Create User</h3></div>
                       
                    <div class="panel-body">
                        <!-- div class="category registrationTitle">Registration</div -->
                        <form method="post" action="" name="signup" id="signup" autocomplete="off" autocomplete="false" >
                        
                            <label class="email">Email</label>
                            <input class="form-control reg" id="remail" type="text"  name="email" placeholder="Enter Email" autocomplete="off" autocomplete="false"  rel="0">
                            <br>
                            <label class="username">Username</label>
                            <input class="form-control reg" id="rusername" type="text" name="username" maxlength="25" placeholder="Enter Username" autocomplete="off" autocomplete="false" rel='0'>
                            <div id="urlText"><span id="baseURL" class="labelURL" ></span><span id="usernameLabel"></span></div>
                                <label class="password">Password</label>
                            <input class="form-control reg" id="rpassword" type="password"  name="password" placeholder="Enter Password" autocomplete="off" autocomplete="false" >
                            <div id="terms"><span class="agreeMessage">By clicking Sign Up, you agree to our</span> <a href="terms.php" class="terms" target="_blank">Terms</a></div>
                            <div class="has-error  displaynone" id="signupError"></div>
                            <div style="clear:both" class="text-center">
                                <input type="submit" class="wallbutton buttonSignUp" value="Sign Up" id="signupButton"> 
                            </div>
                        
                        
                        </form>
                        
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Modal for edit user -->
            
            <div class="modal fade" id="editModalCenter" tabindex="-1" role="dialog" aria-labelledby="editModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="panel panel-default">
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close" style = 'padding: 20px;' >
                          <span aria-hidden="true">&times;</span>
                       </button>
                    <div class="panel-heading panel-heading-gray">
                        <h3 class="box-title">Edit User</h3></div>
                       
                    <div class="panel-body">
                        <!-- div class="category registrationTitle">Registration</div -->
                        <form method="post" action="" name="updateForm" id="updateForm" autocomplete="off" autocomplete="false" >
                        
                            <label class="email">Email</label>
                            <input class="form-control reg" id="e_uid" type="text"  name="uid" />
                            <input class="form-control reg" id="e_email" type="text"  name="email" placeholder="Enter Email" autocomplete="off" autocomplete="false"  rel="0">
                            <br>
                            <label class="username">Username</label>
                            <input class="form-control reg" id="e_username" type="text" name="username" maxlength="25" placeholder="Enter Username" autocomplete="off" autocomplete="false" rel='0'>
                            <div id="urlText"><span id="baseURL" class="labelURL" ></span><span id="usernameLabel"></span></div>
                                <label class="password">Password</label>
                            <input class="form-control reg" id="e_password" type="password"  name="password" placeholder="Enter Password" autocomplete="off" autocomplete="false" >
                            <div id="terms"><span class="agreeMessage">By clicking Sign Up, you agree to our</span> <a href="terms.php" class="terms" target="_blank">Terms</a></div>
                            <div class="has-error  displaynone" id="signupError"></div>
                            <div style="clear:both" class="text-center">
                                <input type="submit" class="wallbutton buttonSignUp" value="Update User" id="updatebtn"> 
                            </div>
                        
                        
                        </form>
                        
                    </div>
                  </div>
                </div>
              </div>
            </div>

    <script>
          $(document).ready(function(){
                $.baseUrl = '<?php echo BASE_URL ?>';
        		$.apiBaseUrl = '<?php echo API_BASE_URL ?>';
        		$.baseUploads = '<?php echo UPLOAD_PATH ?>'; 
        		
            $('body').on('change', '#remail', function() {
    			email = $(this).val();
    			if(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/i.test(email)) {
    				encodedata = JSON.stringify({
    					"usernameEmail": email,
    					"type": "1"
    				});
    				var url = $.apiBaseUrl + 'api/usernameEmailCheck'; /* User singup API */
    				ajaxPost(url, encodedata, function(data) {
    					if(data.usernameEmailCheck.length) {
    						$('#remail').removeClass("errorInput").addClass("successInput").attr("rel", "1");
    					} else {
    						$('#remail').removeClass("successInput").addClass("errorInput").attr("rel", "0");
    					}
    				});
    			} else {
    				$('#remail').removeClass("successInput").addClass("errorInput").attr("rel", "0");
    			}
    			return false;
    		});
    		
    		$('body').on('change', '#rusername', function() {
    			username = $(this).val();
    			if(/^[a-zA-Z0-9_-]{3,25}$/i.test(username)) {
    				encodedata = JSON.stringify({
    					"usernameEmail": username,
    					"type": "0"
    				});
    				var url = $.apiBaseUrl + 'api/usernameEmailCheck'; /* User singup API */
    				ajaxPost(url, encodedata, function(data) {
    					if(data.usernameEmailCheck.length) {
    						$('#rusername').removeClass("errorInput").addClass("successInput").attr("rel", "1");
    					} else {
    						$('#rusername').removeClass("successInput").addClass("errorInput").attr("rel", "0");
    					}
    				});
    				
    			
    			} else {
    				$('#rusername').removeClass("successInput").addClass("errorInput").attr("rel", "0");
    			}
    			return false;
    		});
    		/* User Registration */
    		$('body').on('click', '#signupButton', function() {
    			$("#signupButton").val("Processing..");
    			var statusEmail = $('#remail').attr('rel');
    			var statusUsername = $('#rusername').attr('rel');
    			if(statusEmail > 0 && statusUsername > 0) {
    				username = $('#rusername').val();
    				password = $('#rpassword').val();
    				email = $('#remail').val();
    				encodedata = JSON.stringify({
    					"username": username,
    					"password": password,
    					"email": email,
    					"side" : 'admin'
    				});
    				var url = $.apiBaseUrl + 'api/signup'; /* User singup API */
    				ajaxPost(url, encodedata, function(data) {
    				    
    					if(data.signup.length) {
    						
    						if(parseInt(data.signup[0].status)) {
    						
    							location.href = $.baseUrl + 'WallAdmin/users.php';
    						} else {
    							$("#signupButton").val("Sign Up");
    						}
    					} else {
    						$("#signupError").show().html("Username or Email already present.");
    					}
    				});
    		
    			} else {
    				$("#signupError").show().html("Enter valid information");
    			}
    			return false;
    		});
    		$.validator.addMethod("email", function(value, element) {
    			return this.optional(element) || /^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/i.test(value);
    		}, "Give valid email address.");
    		$.validator.addMethod("username", function(value, element) {
    			return this.optional(element) || /^[a-zA-Z0-9_-]{3,16}$/i.test(value);
    		}, "Username should be 3-15characters and no spaces");
    		$.validator.addMethod("password", function(value, element) {
    			return this.optional(element) || /^[A-Za-z0-9!@#$%^&*()_]{6,16}$/i.test(value);
    		}, "Password should be 6-16 characters");
    		// Validate signup form
    		$("#signup").validate({
    			rules: {
    				email: "required email",
    				username: "required username",
    				password: "required password",
    			},
    		});
    		$("#rusername").keyup(function() {
    			var x = $(this).val();
    			$("#usernameLabel").html(x);
    		});
    		
    		
    		/* -------------------------------------------- Processing update ---------------------------------------------------------------*/
    		
    		$("#updateForm").validate({
    			rules: {
    				email: "required email",
    				username: "required username",
    				password: "required password",
    			},
    		});
    		$('.edit_btn').click(function(){
    		    //var uid = $(this).attr('id');
    		    $('#e_uid').val($(this).attr('id'));
    		    encodedata = JSON.stringify({
					"uid": $(this).attr('id'),
				});
				var url = $.apiBaseUrl + 'api/publicUserDetails'; /* User detail API */
				ajaxPost(url, encodedata, function(data) {
				    console.log(data.userDetails[0]);
				    var userData = data.userDetails[0];
				    
				    $('#e_email').val(userData.email);
				    $('#e_username').val(userData.username);
				    $('#e_password').val('');
				/*	if(data.usernameEmailCheck.length) {
						$('#e_username').removeClass("errorInput").addClass("successInput").attr("rel", "1");
					} else {
						$('#e_username').removeClass("successInput").addClass("errorInput").attr("rel", "0");
					}*/
				});
    		});
    		
    		$('body').on('change', '#e_email', function() {
    			email = $(this).val();
    			if(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/i.test(email)) {
    				encodedata = JSON.stringify({
    					"usernameEmail": email,
    					"type": "1"
    				});
    				var url = $.apiBaseUrl + 'api/usernameEmailCheck'; /* User singup API */
    				ajaxPost(url, encodedata, function(data) {
    					if(data.usernameEmailCheck.length) {
    						$('#e_email').removeClass("errorInput").addClass("successInput").attr("rel", "1");
    					} else {
    						$('#e_email').removeClass("successInput").addClass("errorInput").attr("rel", "0");
    					}
    				});
    			} else {
    				$('#e_email').removeClass("successInput").addClass("errorInput").attr("rel", "0");
    			}
    			return false;
    		});
    		
    		$('body').on('change', '#e_username', function() {
    			username = $(this).val();
    			if(/^[a-zA-Z0-9_-]{3,25}$/i.test(username)) {
    				encodedata = JSON.stringify({
    					"usernameEmail": username,
    					"type": "0"
    				});
    				var url = $.apiBaseUrl + 'api/usernameEmailCheck'; /* User singup API */
    				ajaxPost(url, encodedata, function(data) {
    					if(data.usernameEmailCheck.length) {
    						$('#e_username').removeClass("errorInput").addClass("successInput").attr("rel", "1");
    					} else {
    						$('#e_username').removeClass("successInput").addClass("errorInput").attr("rel", "0");
    					}
    				});
    				
    			
    			} else {
    				$('#e_username').removeClass("successInput").addClass("errorInput").attr("rel", "0");
    			}
    			return false;
    		});
    		/* User Update */
    		$('body').on('click', '#updatebtn', function() {
    			$("#updatebtn").val("Processing..");
    			var statusEmail = $('#e_email').val();
    			var statusUsername = $('#e_username').val();
    			if(statusEmail != '' && statusUsername != '') {
    				username = $('#e_username').val();
    				password = $('#e_password').val();
    				email = $('#e_email').val();
    				uid = $('#e_uid').val();
    				encodedata = JSON.stringify({
    					"username": username,
    					"password": password,
    					"email": email,
    					"side" : 'admin',
    					"uid" : uid
    				});
    				var url = $.apiBaseUrl + 'api/userUpdate'; /* User update API */
    				console.log('url',url);
    				ajaxPost(url, encodedata, function(data) {
    				    console.log('data',data);
    				/*	if(data.signup.length) {
    						
    						if(parseInt(data.signup[0].status)) {
    						
    							location.href = $.baseUrl + 'WallAdmin/users.php';
    						} else {
    							$("#updatebtn").val("Update User");
    						}
    					} else {
    						$("#signupError").show().html("Username or Email already present.");
    					}*/
    				});
    		
    			} else {
    				$("#signupError").show().html("Enter valid information");
    			}
    			return false;
    		});
    		
    	});
          
              
  </script>      

    </body>
</html>
