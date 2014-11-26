<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to theWall 2.0</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
		<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
		<link href='http://fonts.googleapis.com/css?family=Abril+Fatface' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
		<link rel="stylesheet" type="text/css" href="http://www.pazellmer.com/ciwall/assets/css/style.css">
		
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script> 
		<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
	  <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
		<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
</head>
<body>
<div id='container'>
	<div id='wrapper'>
		<div id='title'>
            <h1>the<span class="turq">Wall</span> 2.0</h1>
            <div id="user">
            	<!-- display user name if logged in and log off or redireict if not logged in -->
	            <?php
                    if($this->session->userdata("userinfo")!==false){
                    	$userinfo = $this->session->userdata("userinfo");
                        echo "<h6>Welcome " . $userinfo['first_name'] . "!  </h6>";
                        echo "<a href='/users/logoff' class='btn btn-info'>Log off</a>";
                    }else{
                        redirect("/administration/index");
                    } 
                ?>
            </div><!-- end of user -->
        </div><!-- end of title -->
        <nav class='navbar navbar-default' role='navigation'>
        	<div class="container-fluid">
			    <div class="navbar-header">
			      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			      </button>
			    </div>
			    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			      	<ul class="nav navbar-nav">
				        <li><a href="/administration/index">Home</a></li>
				        <li class="dropdown active">
	          				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dashboard <span class="caret"></span></a>
	          				<ul class="dropdown-menu" role="menu">
					            <li><a href="/administration/profile">Edit Profile</a></li>
					            <li class="divider"></li>
					            <li><a href="/administration/add_blog">Create Blog</a></li>
					            <li><a href="/administration/edit_blog">Edit Blog</a></li>
					            <li class="divider"></li>
					            <li><a href="/administration/add_user">Add a User</a></li>
					            <li><a href="/administration/view_users">View All Users</a></li>
					        </ul>
					    </li>
					    <li><a href="/blogs/index">Your Wall</a></li>
					    <li><a href="/blogs/blog">View a Blog</a></li>
					    <li><a href="#"><span class='italics'>Coming Soon</span> Friend Finder</a></li>
					</ul>
			    </div>
			</div>
		</nav><!-- end of navbar -->
		<div id='body'>
			<h3>Edit User - <?php echo $user["first_name"] . " " . $user["last_name"] . " #" . $user["users_id"]; ?></h3>
			<div class='column'>
				<form role="form" action='/administration/update_profile_with_admin' method='post'>
				  	<fieldset>
					    <legend>Edit Information</legend>
					    <input type='hidden' name='user_id' value='<?php echo $user["users_id"]; ?>'>
					    <input type='hidden' name='blog_id' value='<?php echo $user["blogs_id"]; ?>'>
					    <label for='email'>E-mail:</label>
					    <input type="email" name='email' class="form-control" value= <?php echo "'" . $user['email'] . "'"; ?>>
					    <label>First Name:</label>
					    <input type="text" name='first_name' class="form-control" value= <?php echo "'" . $user['first_name'] . "'"; ?>>
					    <label>Last Name:</label>
					    <input type="text" name='last_name' class="form-control" value= <?php echo "'" . $user['last_name'] . "'"; ?>>
					    <label>Last Name:</label>
					    <select name='admin_lvl' class="form-control">
					    	<option value='0' <?php if($user['admin_lvl']==0){echo "selected= 'selected'";} ?>>Administrator</option>
					    	<option value='1' <?php if($user['admin_lvl']==1){echo "selected= 'selected'";} ?>>User</option>
					    </select>
					    <input type="submit" class="btn btn-success pull-right" value='Update'>
				 	</fieldset>
				</form>
			</div>
			<div class='column'>
				<form action='/administration/update_password' method='post'>
				  	<fieldset>
					    <legend>Change Password</legend>
					    <label>Password:</label>
					    <input type="password" class="form-control" name='password'>
					    <label>Password Confimation:</label>
					    <input type="password" class="form-control" name='passwordconf'>
					    <input type="submit" class="btn btn-success pull-right" value='Change'>
				 	</fieldset>
				</form>
			</div>
			<a href='/administration/view_users' class='btn btn-info pull-right'>Back to View Users</a>
		</div><!-- end of body -->
	<p class='footer'>Page rendered in <strong>{elapsed_time}</strong> seconds</p>
	</div><!-- end of wrapper -->
</div><!-- end of container -->
</body>
</html>