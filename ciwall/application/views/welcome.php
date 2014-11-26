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

	<script>
			if (window.location != window.parent.location){
				setTimeout(function(){
					$('#loginpanel').click()
				}, 100)	
				setTimeout(function(){
					$("input[name='email']").val('u')
				}, 200)
				setTimeout(function(){
					$("input[name='email']").val('us')
				}, 300)
				setTimeout(function(){
					$("input[name='email']").val('use')
				}, 400)
				setTimeout(function(){
					$("input[name='email']").val('user')
				}, 500)
				setTimeout(function(){
					$("input[name='email']").val('user@')
				}, 600)
				setTimeout(function(){
					$("input[name='email']").val('user@g')
				}, 700)
				setTimeout(function(){
					$("input[name='email']").val('user@gm')
				}, 800)
				setTimeout(function(){
					$("input[name='email']").val('user@gma')
				}, 900)
				setTimeout(function(){
					$("input[name='email']").val('user@gmai')
				}, 1000)
				setTimeout(function(){
					$("input[name='email']").val('user@gmail')
				}, 1100)
				setTimeout(function(){
					$("input[name='email']").val('user@gmail')
				}, 1200)
				setTimeout(function(){
					$("input[name='email']").val('user@gmail.')
				}, 1300)
				setTimeout(function(){
					$("input[name='email']").val('user@gmail.c')
				}, 1400)
				setTimeout(function(){
					$("input[name='email']").val('user@gmail.co')
				}, 1500)
				setTimeout(function(){
					$("input[name='email']").val('user@gmail.com')
				}, 1600)
				setTimeout(function(){
					$("input[name='password']").val('Ja')
				}, 1700)
				setTimeout(function(){
					$("input[name='password']").val('Ja')
				}, 1800)
				setTimeout(function(){
					$("input[name='password']").val('JaV')
				}, 1900)
				setTimeout(function(){
					$("input[name='password']").val('JaVa')
				}, 2000)
				setTimeout(function(){
					$("input[name='password']").val('JaVa9')
				}, 2100)
				setTimeout(function(){
					$("input[name='password']").val('JaVa98')
				}, 2200)
				setTimeout(function(){
					$("input[name='password']").val('JaVa981')
				}, 2300)
				setTimeout(function(){
					$("input[name='password']").val('JaVa9810')
				}, 2400)
				setTimeout(function(){
					$("#submit").trigger('click')
				}, 2500)	
			}
  		$(function() {
    		$( "#accordion" ).accordion(
	    			<?php 
	    				if($this->session->flashdata('add_user') == 'error' || $this->session->flashdata('errors')!==false){
	    					echo "{active: 1}";
	    				}
	    			?>
    			);
  		});
	</script>
</head>
<body>
  <div id="container">
	<div id="wrapper">
		<div id="title">
            <h1>the<span class="turq">Wall</span> 2.0</h1>
            <div id="user">
            	<!-- display user name if logged in and log off or log-in if not logged in -->
	            <?php
                    if($this->session->userdata("userinfo")!==false){
                    	$userinfo = $this->session->userdata("userinfo");
                        echo "<h6>Welcome " . $userinfo['first_name'] . "!  </h6>";
                        echo "<a href='/users/logoff' class='btn btn-info'>Log off</a>";
                    }else{
                        echo "<a href='/users/index' class='btn btn-info'>Log in</a>";
                    } 
                ?>
            </div><!-- end of user -->
        </div><!-- end of title -->
		<div id="body">
			<?php
				if($this->session->flashdata('add_user')=='success'){
					echo "<h3 class='success'>Congratulations, your account has been created please login.</h3>";
				}
				if($this->session->flashdata('add_user')=='error'){
					echo "<h3 class='fail'>Error!!! Your account was not created please try again.</h3>";
				}
				if($this->session->flashdata('errors')!==false){
					echo "<h3 class='fail'>" . $this->session->flashdata('errors') . "</h3>";
				}
				if($this->session->flashdata('login')=='email'){
            			echo "<h3 class='fail'>There was an error verifying your e-mail, please try to log-in again or create a new account.</h3>";
            		}
            	if($this->session->flashdata('login')=='password'){
            			echo "<h3 class='fail'>There was an error verifying your password, please try to log-in again.</h3>";
            		}
			?>
			<div id="accordion">
				<h3 id='loginpanel'>Log in</h3>
				<div>
					<div id="login">
		            	<form action="/users/login" method="post" class="form-horizontal">
							<div class="form-group">
								<label class="control-label col-sm-3" for='email'>E-mail:</label>
						        <div class="col-sm-9">
						        	<input type="email" name="email" class="form-control">
						        </div>
					    	</div>
					    	<div class="form-group">
						        <label class="control-label col-sm-3" for='password'>Password:</label>
						        <div class="col-sm-9">
						        	<input type="password" name="password" class="form-control">
								</div>
							</div>
							<input type="submit" value="Log in" class="btn btn-info pull-right" id='submit'>
						</form>
					</div><!-- end of login -->
				</div>
				<h3>Register</h3>
				<div>
					<div id="register">
						<form action='/users/register' method='post' class="form-horizontal">
							<div class="form-group">
			        			<label class="control-label col-sm-4">First Name:</label>
			        			<div class="col-sm-8">
			        				<input type="text" name="first_name" class="form-control">
			        			</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4">Last Name:</label>
						        <div class="col-sm-8">
						        	<input type="text" name="last_name" class="form-control">
						        </div>
					    	</div>
					    	<div class="form-group">
					        	<label class="control-label col-sm-4">E-mail:</label>
					        	<div class="col-sm-8">
						        	<input type="email" name="email" class="form-control">
								</div>
					        </div>
					        <div class="form-group">
					        	<label class="control-label col-sm-4">Password:</label>
					        	<div class="col-sm-8">
						        	<input type="password" name="password" class="form-control">
						        </div>
				        	</div>
				        	<div class="form-group">
					        	<label class="control-label col-sm-4">Password Confirmation:</label>
				        		<div class="col-sm-8">
				        			<input type="password" name="passwordconf" class="form-control">
				        		</div>
				        	</div>
							<input type="submit" value="Create Account" class="btn btn-info pull-right">
		        		</form>
					</div><!-- end of register -->
				</div>
			</div><!-- end of accordion -->
		</div><!-- end of body -->
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
	</div><!-- end of wrapper -->
</div><!-- end of container -->
<script>
  (function(i, s, o, g, r, a, m) {
      i['GoogleAnalyticsObject'] = r;
      i[r] = i[r] || function() {
          (i[r].q = i[r].q || []).push(arguments)
      }, i[r].l = 1 * new Date();
      a = s.createElement(o),
          m = s.getElementsByTagName(o)[0];
      a.async = 1;
      a.src = g;
      m.parentNode.insertBefore(a, m)
  })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

  ga('create', 'UA-55360839-1', 'auto');
  ga('require', 'linkid', 'linkid.js');
  ga('require', 'displayfeatures');
  ga('send', 'pageview');
</script>

</body>
</html>