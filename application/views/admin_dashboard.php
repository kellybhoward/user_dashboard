<!DOCTYPE html>
<html lang='en'>
	<head>
		<title>Admin Dashboard</title>
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
	          <a class="navbar-brand navbar-right" href="/edit">Edit Profile</a>
	        </div><!--/.navbar-collapse -->
	      </div>
	    </nav>
	   <div class="container">
	    <div class="row">
	      <div class = 'col-md-4'>
	      	<h1>Manage Users</h1>
	      </div>
	      <div class = "col-md-8">
	      	<form action="/add">
		      	<button class="btn btn-lg btn-primary pull-right bottom" type="submit">Add New User</button>
	      	</form>
	      </div>
	     </div>
	      <table class="table table-responsive table-striped">
	      	<thead>
	      		<tr class='main-table-row'>
		      		<th>ID</th>
		      		<th>Name</th>
		      		<th>Email</th>
		      		<th>Created At</th>
		      		<th>User Level</th>
		      		<th>Actions</th>
	      		</tr>
	      	</thead>
	      	<tbody class='table-bordered'>
<?php 		foreach ($user_info as $key => $user) 
			{
				if($key%2 == 0)
				{?>
					<tr class='alt'>
<?php			}
				else
				{?>
					<tr class='reg'>
<?php			}
					foreach ($user as $key => $value) 
					{
						if($key == 'user_level' && $value == 9){$value='admin';}
						else if($key == 'user_level' && $value ==1){$value='normal';}
						else if($key == 'user_id'){$id = $value;}
						if($key =='name'){?>
							<td><a href="/user_profile/<?=$id?>"><?=$value?></a></td>
<?php 					}
						else
						{?>
							<td><?=$value?></td>
<?php					}
					}?>
		      			<td><a href="/edit_user/<?=$id?>">edit</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="/users/delete_user/<?=$id?>" onclick="return confirm('Are you sure you want to delete?')" class="remove">remove</a></td>
		      		</tr>
<?php 		}?>
	      	</tbody>
	      </table>
	    </div>  
	</body>
</html>