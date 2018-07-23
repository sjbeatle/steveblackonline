		<div id="sidebar">
			<ul>
				<li class="sidebox">
					<h3>shows</h3>
					<ul>
						<li><a href="index.php?page=addshow">Add</a></li>
						<li><a href="index.php?page=editshow">Edit</a></li>
						<li><a href="index.php?page=deleteshow">Delete</a></li>
					</ul>
				</li>
				
				<li class="sidebox">
					<h3>venues</h3>
					<ul>
						<li><a href="index.php?page=addvenue">Add</a></li>
						<li><a href="index.php?page=editvenue">Edit</a></li>
						<li><a href="index.php?page=deletevenue">Delete</a></li>
					</ul>
				</li>
				
				<li class="sidebox">
					<h3>songs</h3>
					<ul>
						<li><a href="index.php?page=addsong">Add</a></li>
						<li><a href="index.php?page=editsong">Edit</a></li>
						<li><a href="index.php?page=deletesong">Delete</a></li>
					</ul>
				</li>
				
				<li class="sidebox">
					<h3>extra</h3>
					<ul>
						<?php if (isset ($_SESSION['loggedin']) && isset ($_SESSION['time'])) {echo "<li><a href=\"changepass.inc.php?page=changepass\">Change Password</a></li>\n";} ?>
						<?php if (isset ($_SESSION['loggedin']) && isset ($_SESSION['time'])) {echo "<li><a href=\"login.php?page=logout\">Logout</a></li>\n";} ?>
					</ul>
				</li>
			</ul>
		</div><!-- end id:sidebar -->