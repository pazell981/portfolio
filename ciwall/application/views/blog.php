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
		
	<?php
		$user=$this->session->userdata('userinfo');
	?>
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
				        <li class="dropdown">
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
					    <li class="active"><a href="/blogs/blog">View a Blog</a></li>
					    <li><a href="#"><span class='italics'>Coming Soon</span> Friend Finder</a></li>
					</ul>
			    </div>
			</div>
		</nav><!-- end of navbar -->
		<div id='body'>
			<form action='/blogs/select_blog' method='post'>
			  	<fieldset>
					<legend>Choose a Blog to View</legend>
				    <label>Blog:</label>
				    <select class="form-control" name="blog_id">
				    	<?php
				    		foreach($blogs as $value){
				    			echo "<option value='" . $value['blogs_id'] . "' ";
				    			if($value['blogs_id'] == $blog_id){
				    				echo "selected='selected'";
				    			}
					    		echo ">" . $value['name'] . "</option>";
				    		}
				    	?>
				    </select>
				    <input type="submit" class="btn btn-success pull-right" value='Select'>
			 	</fieldset>
			</form>
			<?php 
				if(!is_null($blog_id)){ ?>
					<h3><?php echo $blog_name["name"]; ?></h3>
					<div id="post">
						<h4>Post a message</h4>
			            <form action="/blogs/add_post" method="post">
			                <input type="hidden" name="userid" value=<?php echo "'" . $userinfo['id'] . "'" ?>>
			                <textarea name="post" class='form-control'></textarea>
			                <input type="hidden" name="blogs_id" value=<?php echo "'" . $blog_id . "'" ?>>
				            <div id='post_submit' class='pull-right'>
			                	<input type="submit" value="Post" class="btn btn-primary width pull-right">
			            	</div>
			            </form>
			        </div><!-- end of post -->
		            <div id="wall">
                <?php
                    if(!is_null($blog_id) || !empty($blogposts)){
                        foreach ($blogposts as $post) {
                            echo "<div class='posts clearfix'><span class='name'>" . $post['first_name'] . " " . $post['last_name'] . "</span> - <span class='date'>" . date('F jS\, Y g\:i', strtotime($post['created_on'])) . "</span>";
                            if ($userinfo['id']===$post['user_id'] && time()<=strtotime("+30 minutes",strtotime($post['created_on']))){
                                echo "<div class='delete clearfix'><form action='/blogs/delete_post' method='post'><input type='hidden' name='post_id' value='" . $post['id'] . "'><input type='submit' name='delete_post' value='Delete Post' class='btn btn-danger pull-right width'></form></div>";
                            }
                            echo "<span class='post'>" . $post['post'] . "</span></div>";
                            echo "<div class='comments'>";
                            if(!is_null($post['comments'])){
                                foreach ($post['comments'] as $comment) {
                                    echo "<div class='comment'><span class='name'>" . $comment['first_name'] . " " . $comment['last_name'] . "</span> - <span class='date'>" . date('F jS\, Y g\:i', strtotime($comment['created_on'])) . "</span>";
                                    echo "<span class='content'>" . $comment['comment'] . "</span>";
                                    if ($userinfo['id']===$comment['user_id'] && time()<=strtotime("+30 minutes",strtotime($comment['created_on']))){
                                        echo "<div class='delete clearfix'><form action='/blogs/delete_comment' method='post'><input type='hidden' name='comment_id' value='" . $comment['id'] . "'><input type='submit' name='delete_comment' value='Delete Comment' class='btn btn-danger pull-right width'></form></div>";
                                    }
                                    echo "</div>";
                                }
                            }
                            echo "</div>";
                               ?>
                               <div class="comment_box">
                                   <form action="/blogs/add_comment" method="post">
                                       <input type="hidden" name="userid" value=<?php echo "'" . $userinfo['id'] . "'" ?>>
                                       <input type="hidden" name="post_id" value=<?php echo "'" . $post['id'] . "'" ?>>
                                       <textarea name="comment" class="form-control"></textarea>
                                       <input type="submit" value="Comment" class="btn btn-success pull-right width">
                                   </form>
                               </div>
                               <?php
                           }
                       }
                ?>
			<?php } ?>
		</div><!-- end of body -->
	<p class='footer'>Page rendered in <strong>{elapsed_time}</strong> seconds</p>
	</div><!-- end of wrapper -->
</div><!-- end of container -->
</body>
</html>