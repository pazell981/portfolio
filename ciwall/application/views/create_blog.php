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
					            <li class="active"><a href="/administration/add_blog">Create Blog</a></li>
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
			<?php 
				if($this->session->flashdata('wall_blog')=='fail'){
            		echo "<h3 class='fail'>Please create your blog before trying to view Your Wall or another.</h3>";
            	}
				if($this->session->flashdata('create_blog')=='success'){
					echo "<h3 class='success'>Your blog has been successfully created.</h3>";
				}
				if($this->session->flashdata('create_blog')=='fail'){
					echo "<h3 class='success'>There was an error creating your blog, please try again.</h3>";
				}
				if($this->session->flashdata('blog_validation')!==false){
					echo "<h3 class='fail'>" . $this->session->flashdata('blog_validation') . "</h3>";
				}
		    ?>
			<form action='/administration/create_blog' method='post'>
			  	<fieldset>
				    <legend>Create a Blog</legend>
				    <input type="hidden" name="user_id" value=<?php echo "'" . $userinfo['id'] . "'" ?>>
				    <label>Blog Name:</label>
				    <input class="form-control" type="text" name="name">
				    <label>Description:</label>
				    <textarea class="form-control" name="description"></textarea>
				    <input type="submit" class="btn btn-success pull-right" value='Create'>
			 	</fieldset>
			</form>
		</div><!-- end of body -->
	<p class='footer'>Page rendered in <strong>{elapsed_time}</strong> seconds</p>
	</div><!-- end of wrapper -->
</div><!-- end of container -->
</body>
</html>