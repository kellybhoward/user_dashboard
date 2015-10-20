<!DOCTYPE html>
<html lang='en'>
	<head>
		<title>Register</title>
		<?php
		    $this->load->view('partials/meta.php');
		?>
	</head>
	<body>
	    <nav class="navbar navbar-inverse navbar-fixed-top">
	      <div class="container">
	        <div class="navbar-header">
	          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	            <span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	          <a class="navbar-brand" href="/">User Dashboard</a>
	        </div>
	        <div id="navbar" class="navbar-collapse collapse">
	          <a class="navbar-brand navbar-right" href="/signin">Sign In</a>
	        </div><!--/.navbar-collapse -->
	      </div>
	    </nav>
	    <div class="container">
	      <form class="form-signin" action="/users/register" method="post">
	        <h2 class="form-signin-heading">Register</h2>
	        <label for="inputEmail" class="sr-only">Email address</label>
	        <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Email address" required="" autofocus="">
	        
	        <label for="inputFirstName" class="sr-only">First Name</label>
	        <input type="text" id="inputFirstName" class="form-control" name="first_name" placeholder="First Name" required="" autofocus="">
	        
	        <label for="inputLastName" class="sr-only">Last Name</label>
	        <input type="text" id="inputLastName" class="form-control" name="last_name" placeholder="Last Name" required="" autofocus="">
	        
	        <label for="inputPassword" class="sr-only">Password</label>
	        <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required="">
	        
	        <label for="inputConfirmPassword" class="sr-only">Confirm Password</label>
	        <input type="password" id="inputConfirmPassword" class="form-control" name="confirm_password" placeholder="Confirm Password" required="">
	        <?php
			    $this->load->view('partials/flash_messages.php');
			?>
	        <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
	      </form>
	      <a href="/signin">Have an account already? Sign in Here!</a>
	    </div>
	    
	</body>
</html>