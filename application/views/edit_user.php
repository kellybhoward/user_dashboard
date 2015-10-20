<!DOCTYPE html>
<html lang='en'>
	<head>
		<title>Edit User</title>
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
	          <a class="navbar-brand" href="/profile">Profile</a>
	        </div>
	        <div id="navbar" class="navbar-collapse collapse">
	          <a class="navbar-brand navbar-right" href="/users/logout">Log Out</a>
	        </div><!--/.navbar-collapse -->
	      </div>
	    </nav>
	    <div class="container">
	    	<?php
			    $this->load->view('partials/flash_messages.php');
			?>
	    	<div class="row">
	    		<div class = 'col-md-4'>	
			    	<h2 class="form-signin-heading">Edit User #<?=$user_info['user_id']?></h2>
			    </div>
			    <div class = "col-md-8">
			    	<form action="/users/dashboard">
				      	<button class="btn btn-lg btn-primary pull-right bottom" type="submit">Return to Dashboard</button>
			      	</form>
			    </div>
	    	</div>
	    	<div class='row'>
	    		<div class = 'col-md-6'>
			    	<fieldset class="scheduler-border">
			    		<legend class="scheduler-border">Edit Information</legend>
				        <form class="form-signin" action="/users/edit_user/<?=$user_info['user_id']?>" method="post">
					        <label for="inputEmail" class="sr-only">Email address</label>
					        <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Email address" value="<?=$user_info['email']?>" required="" autofocus="">
					        
					        <label for="inputFirstName" class="sr-only">First Name</label>
					        <input type="text" id="inputFirstName" class="form-control" name="first_name" placeholder="First Name" value="<?=$user_info['first_name']?>" required="" autofocus="">
					        
					        <label for="inputLastName" class="sr-only">Last Name</label>
					        <input type="text" id="inputLastName" class="form-control" name="last_name" placeholder="Last Name" value="<?=$user_info['last_name']?>" required="" autofocus="">
					        
					        <label for="inputUserLevel">User Level</label>
					        <select class="form-control" name="user_level">
					        	<option value="9">Admin</option>
					        	<option value="1">Normal</option>
					        </select>

					        <input name="user_id" type="hidden" value="<?=$user_info['user_id']?>"/>
					        <button class="btn btn-lg btn-primary pull-right" type="submit">Save</button>
					    </form>
				    </fieldset>
				</div>
				<div class = 'col-md-1'></div>
				<div class = 'col-md-5'>
				    <fieldset class="scheduler-border">
			    		<legend class="scheduler-border">Change Password</legend>
			    		<form class="form-signin" action="/users/edit_user_password/<?=$user_info['user_id']?>" method="post">
					        <label for="inputPassword" class="sr-only">Password</label>
					        <input type="password" id="inputPassword" class="form-control" name="password" required="">
					        
					        <label for="inputConfirmPassword" class="sr-only">Confirm Password</label>
					        <input type="password" id="inputConfirmPassword" class="form-control" name="confirm_password" required="">
					        <input name="user_id" type="hidden" value="<?=$user_info['user_id']?>"/>
					        <button class="btn btn-lg btn-primary pull-right" type="submit">Update Password</button>
					    </form>
			      	</fieldset>
		        </div>
		    </div>
	    </div>
	    
	</body>
</html>