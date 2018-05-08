<?php
include_once 'includes.php';
include_once 'pagination_header.php';
$Groups_Details_Array=$WallAdmin->Groups_Details($start,$per_page);
$Groups_Count=$WallAdmin->Groups_Count();
$count = $Groups_Count;
$no_of_paginations = ceil($count / $per_page);
$groups=1;
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
                       Groups
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Groups</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                  <div class="col-md-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Manage Groups</h3>

                                    <div class="pull-right searchBlock">
                                        <!-- a href = 'admin_createGroup.php' class = 'btn btn-info' >Create Group</a -->
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModalCenter">
                                          Create Group
                                        </button>
                                    <form method="post" action="" style = 'float:right; margin-left: 10px;' >
                                    <input type="text" value="" name="searchKey"  id="searchInput" placeholder="Search"/>
                                    <input type="submit" class="btn-success" value=" Search " rel="group" id="searchButton"/>
                                    </form>
                                    </div>

                                </div><!-- /.box-header -->
                                <div class="box-body" id="groupSearchResults" style="display:none">
                                    
                                <table class="table table-bordered">
                                        <tr>
                                            <th style="width: 10px">ID</th>
                                            
                                            <th>Group Name</th>
                                            <th>Group Desc</th>
                                            <th>User</th>
                                            <th>IP Address</th>
                                            <th >Actions</th>
                                            
                                        </tr>
                                        <tbody id="tbody"></tbody></table>

                                </div>
                               
                                <div class="box-body" id="groupResults">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th style="width: 10px">ID</th>
                                            
											<th>Group Name</th>
                                            <th>Group Desc</th>
											<th>User</th>
                                            <th>IP Address</th>
											<th style="width: 185px">Actions</th>
                                            
                                        </tr>
                                    	<?php 
										foreach($Groups_Details_Array as $data)
										{
										
										?>
                                        <tr id="groups<?php echo $data['group_id']; ?>">
										 <td style="width: 10px"><?php echo $data['group_id']; ?></td>
                                           
											<td><a href="<?php echo $base_url.'group/'.$data['group_id']; ?>"><?php echo htmlcode($data['group_name']); ?></a></td>
                                           <td><?php echo htmlcode($data['group_desc']); ?></td>
										    <td><a href="<?php echo $base_url.$data['username']; ?>" target="_blank"><?php echo $data['username']; ?></a></td>
                                            <td><?php echo $data['group_ip']; ?></td>
											<td><a href="#" class="btn btn-warning btn-sm groupBlock" id="<?php echo $data['group_id']; ?>" rel=""><i class="fa fa-ban"></i> Block</a>
											    <!-- a href="#" class="btn btn-info" id="<?php echo $data['group_id']; ?>" rel=""><i class="fa fa-ban"></i> Edit</a -->
											    <button type="button" class="btn btn-info edit_btn" id = '<?php echo $data['group_id']; ?>' data-toggle="modal" data-target="#editModalCenter">
                                                  Edit Group
                                                </button>

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

       
       
       
       
        <!-- Modal for creat group-->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="panel panel-default">
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close" style = 'padding: 20px;' >
                          <span aria-hidden="true">&times;</span>
                       </button>
                    <div class="panel-heading panel-heading-gray">
                        <h3 class="box-title">Create Groups</h3></div>
                       
                    <div class="panel-body">
                        <!-- form class="form-horizontal" role="form" method="post" -->
                        <div class="form-horizontal" >
                            <span id = 'networkError' ></span>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">Name</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="groupName" placeholder="Group Name">
                                </div>
                            </div>
                          
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Description </label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" rows="5" id="groupDesc"></textarea>
                                </div>
                            </div>
            
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-8">
                                    <button type="" id="createGroup_admin" class="wallbutton">Create Group</button>
                                </div>
                            </div>
                            
                         
                        </div>
                        <!-- /form --> 
                    </div>
                  </div>
                </div>
              </div>
            </div>


            <!-- Modal for edit group-->
            <div class="modal fade" id="editModalCenter" tabindex="-1" role="dialog" aria-labelledby="editModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="panel panel-default">
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close" style = 'padding: 20px;' >
                          <span aria-hidden="true">&times;</span>
                       </button>
                    <div class="panel-heading panel-heading-gray">
                        <h3 class="box-title">Edit Group</h3></div>
                       
                    <div class="panel-body">
                        <!-- form class="form-horizontal" role="form" method="post" -->
                        <div class="form-horizontal" >
                            <span id = 'networkError' ></span>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">Name</label>
                                <div class="col-sm-8">
                                    <input type="hidden" class="form-control" id="e_groupid" >
                                    <input type="text" class="form-control" id="e_groupName" placeholder="Group Name">
                                </div>
                            </div>
                          
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Description </label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" rows="5" id="e_groupDesc"></textarea>
                                </div>
                            </div>
            
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-8">
                                    <button type="" id="updateGroup_admin" class="wallbutton">Update Group</button>
                                </div>
                            </div>
                            
                         
                        </div>
                        <!-- /form --> 
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            
        <script>
          $(document).ready(function(){
                var apiBaseUrl = 'http://www.ravexchange.co/wallscript/';
                var baseUrl = 'http://www.ravexchange.co/WallAdmin/';
                
                    $('body').on("click", '#createGroup_admin', function() {
                        var groupName = $("#groupName").val();
                        var groupDesc = $("#groupDesc").val();
                        
                        if ($.trim(groupName).length > 0 && $.trim(groupDesc).length > 0 && /^[a-zA-Z0-9_ -]{3,100}$/i.test(groupName)) {
                          //createGroup_admin(uid, token, apiBaseUrl, baseUrl, groupName, groupDesc);
                          createGroup_admin( apiBaseUrl, baseUrl, groupName, groupDesc);
                          console.log(   groupName, groupDesc);
                        } else {
                          $("#networkError").fadeIn("slow").html("Please enter valid details.");
                        }
            
                        return false;
                    });
                    
                    
                /* Create Group  */
                function createGroup_admin(apiBaseUrl, baseUrl, groupName, groupDesc) {
                  var encodedata = JSON.stringify({
                    "uid": 1,
                    
                    "groupName": groupName,
                    "groupDesc": groupDesc
                  });
                
                  var url = apiBaseUrl + 'api/createGroup';
                  $.ajax({
                        type: 'POST',
                        url: url,
                        data: encodedata,
                        success: function(data){
                        
                              $("#groupName").val("");
                              $("#groupDesc").val("");
                              var group = JSON.parse(data);
                              console.log(group.group[0].groupID);
                              if (group.group[0].groupID > 0) {
                                 location.href = 'http://www.ravexchange.co/WallAdmin/groups.php' ;
                              } else {
                                $("#networkError").show().html("Group name is already present, please try different name. ");
                              }
                        
                        //    });
                        }
                    });
                }
                
                
                $('.edit_btn').click(function(){
                    var id = $(this).attr('id');
                    //console.log(id);
                    var encodedata = JSON.stringify({
                        "uid": 1,
                        "group_id": id
                      });
                    var url = apiBaseUrl + 'api/groupDetails';
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: encodedata,
                        success: function(data){
                            console.log(data);
                            data = JSON.parse(data);
                            //var groupDetail = data[0];
                            //console.log(data.groupDetails[0]);
                            var groupDetail = data.groupDetails[0];
                            $('#e_groupid').val(groupDetail.group_id);
                            $('#e_groupName').val(groupDetail.group_name);
                            $('#e_groupDesc').val(groupDetail.group_desc);
                            
                        }
                    });
                });
                $('#updateGroup_admin').click(function(){
                    
                    var encodedata = JSON.stringify({
                        "uid" : 1,
                        "group_id" : $('#e_groupid').val(),
                        "group_name" : $('#e_groupName').val(),
                        "group_desc" : $('#e_groupDesc').val()
                      });
                      
                      var url = apiBaseUrl + 'api/groupUpdate';
                      $.ajax({
                        type: 'POST',
                        url: url,
                        data: encodedata,
                        success: function(data){
                            //console.log(data);
                            location.href = apiBaseUrl + 'WallAdmin/groups.php';
                            
                        }
                    });
                });
          });
              
  </script>      
    </body>
</html>
