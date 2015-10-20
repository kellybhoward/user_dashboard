<!DOCTYPE html>
<html lang='en'>
	<head>
		<title>Dashboard</title>
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
	      <h1>All Users</h1>
	      <table class="table table-responsive table-striped">
	      	<thead>
	      		<tr class='main-table-row'>
		      		<th>ID</th>
		      		<th>Name</th>
		      		<th>Email</th>
		      		<th>Created At</th>
		      		<th>User Level</th>
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
						if($key =='name'){?>
							<td><a href='/user_profile/<?= $user["user_id"] ?>'><?=$value?></a></td>
<?php 					}
						else
						{?>
							<td><?=$value?></td>
<?php					}
					}?>
		      		</tr>
<?php 		}?>
	      	</tbody>
	      </table>
	    </div>
	</body>
</html>