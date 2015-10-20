<!DOCTYPE html>
<html lang='en'>
	<head>
		<title>User Profile</title>
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
	    	<div class="row">
	    		<div class = 'col-md-4'>
	    			<h3><?=$user_info['first_name']?>&nbsp;<?=$user_info['last_name']?></h3>
	    			<div class="row">
			    		<div class = 'col-md-5'>
			    			<p>Registered on:</p>
			    		</div>
		    			<div class = 'col-md-7'>
			    			<p><?=$user_info['created_at']?></p>
			    		</div>
			    	</div>
			    	<div class="row">
			    		<div class = 'col-md-5'>
			    			<p>User Id:</p>
			    		</div>
		    			<div class = 'col-md-7'>
			    			<p>#<?=$user_info['user_id']?></p>
		    			</div>
			    	</div>
			    	<div class="row">
			    		<div class = 'col-md-5'>
			    			<p>Email Address:</p>
			    		</div>
		    			<div class = 'col-md-7'>
			    			<p><?=$user_info['email']?></p>
		    			</div>
			    	</div>
			    	<div class="row">
			    		<div class = 'col-md-5'>
			    			<p>Description:</p>
			    		</div>
		    			<div class = 'col-md-7'>
			    			<p><?=$user_info['description']?></p>
		    			</div>
			    	</div>
	    		</div>
	    	</div>
	    </div>
    	<div class='container'>
    		<div class="col-md-12">
	    		<h4>Leave a message for <?=$user_info['first_name']?>!</h4>
	    		<form class="form-signin full" action="/messages/post/<?=$user_info['user_id']?>/<?=$this->session->userdata['user_id']?>" method="post">
	    			<textarea class="form-control" rows="4" name="message" placeholder="write a message!"></textarea>
	    			<button class="btn btn-lg btn-primary pull-right" type="submit">Post</button>
	    		</form>
    		</div>
    	</div>
	    		<!-- Dynamic Post/Comment Section -->
	    <div class="container">
		<?php 
			$reverse_messages = array_reverse($all_messages);    					
			foreach ($reverse_messages as $message) 
			{
				foreach ($message as $key => $value) 
				{
					if ($key == 'first_name') {
						$first_name = $value;
					}
					else if ($key == 'last_name') {
						$last_name = $value;
					}
					else if ($key == 'created_at') {
						$time = $value;
					}
					else if ($key == 'message') {
						$message = $value;
					}
					else if ($key == 'user_id'){
						$id = $value;
					}
					else if ($key == 'message_id'){
						$message_id = $value;
					}
				}?>
					<div class="row bottom">
						<div class="col-md-1"></div>
						<div class="col-md-5">
							<p><a href="/user_profile/<?=$id?>"><?=$first_name?>&nbsp;<?=$last_name?></a> wrote</p>
						</div>
						<div class="col-md-6">
							<p class="pull-right"><?=$time?></p>
						</div>
					</div>
					<div class="row">
						<div class="col-md-1"></div>
						<div class="col-md-11 message-box">
							<p><?=$message?></p>
						</div>
					</div>
<?php 			foreach ($all_comments as $comment) 
				{
					foreach ($comment as $key => $value) 
					{
						if ($key == 'first_name') {
							$first_name = $value;
						}
						else if ($key == 'last_name') {
							$last_name = $value;
						}
						else if ($key == 'created_at') {
							$time = $value;
						}
						else if ($key == 'comment') {
							$comment = $value;
						}
						else if ($key == 'user_id'){
							$id = $value;
						}
						if($key == "message_id" && $value == $message_id){?>
    						<div class="row bottom">
    							<div class="col-md-2"></div>
    							<div class="col-md-5">
	    							<p><a href="/user_profile/<?=$id?>"><?=$first_name?>&nbsp;<?=$last_name?></a> wrote</p>
    							</div>
    							<div class="col-md-5">
    								<p class="pull-right"><?=$time?></p>
    							</div>
    						</div>
						
    						<div class="row">
    							<div class="col-md-2"></div>
    							<div class="col-md-10 comment-box">
    								<p><?=$comment?></p>
    							</div>
    						</div>
<?php					}
					}
				}?>
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-10">
	    				<form class="form-signin full bottom" action="/comments/post/<?=$message_id?>/<?=$this->session->userdata['user_id']?>" method="post">
			    			<textarea class="form-control" rows="3" name="comment" placeholder="write a comment!"></textarea>
			    			<button class="btn btn-lg btn-primary pull-right" type="submit">Comment</button>
			    		</form>
			    	</div>
	    		</div>
<?php 		}?>
		</div><!--end of whole container-->
	</body>
</html>