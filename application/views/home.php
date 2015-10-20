<!DOCTYPE html>
<html lang='en'>
	<head>
		<title>Home Page</title>
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

	    <!-- Main jumbotron for a primary marketing message or call to action -->
	    <div class="jumbotron">
		    <div class="container">
		        <h1>Welcome to the User Dashboard!</h1>
		        <p>An awesome application build with CodeIgniter. Practicing creating users with some admin priviledge and writing messages on user profiles. Here we go!</p>
		        <p><a class="btn btn-primary btn-lg" href="/register" role="button">Start »</a></p>
		    </div>
	    </div>

	    <div class="container">
		    <div class="row">
		        <div class="col-md-4">
		            <h2>Manage Users</h2>
		            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
		        </div>
		        <div class="col-md-4">
		            <h2>Leave Messages</h2>
		            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
		        </div>
		        <div class="col-md-4">
		            <h2>Edit User Information</h2>
		            <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
		        </div>
		    </div>
	        <hr>
	        <footer>
	        	<p>© Kelly Howard 2015</p>
	        </footer>
	    </div> <!-- /container -->
	</body>
</html>
