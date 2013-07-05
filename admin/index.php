<?php 

session_start();

include_once('../includes/connection.php');

if (isset($_SESSION['logged_in'])) {
	?>

<?php include('../includes/heading.php') ?>
		<body>
			<div class="content">
				<h2>Admin Panel</h2>

				<br />
				
		      	<div class="well" style="padding: 8px 0;">
		        <ul class="nav nav-list">
		          <li class="nav-header">Your account</li>
		          <li><a href="admin/profileedit.php">Change your account details (only frontend)</a></li>
		          <li class="disabled"><a href="#">Change your password</a></li>
		          <li class="nav-header">Content management</li>
		          <li><a href="admin/add.php">Add new article</a></li>
		          <li><a href="admin/edit.php">Edit existing article</a></li>
		          <li><a href="admin/delete.php">Delete existing article (needs to be rewritten)</a></li>
		          <li class="divider"></li>
		          <li><a href="admin/logout.php">Log out</a></li>
		        </ul>
      			</div>
		</body>
	</html>

	<?php
} else {
	if (isset($_POST['username'], $_POST['password'])) {
		$username = $_POST['username'];
		$password = md5($_POST['password']);

		if (empty($username) or empty($password)) {
			$error = "All fields are required!";
		} else {
			$query = $pdo->prepare("SELECT * FROM users WHERE user_name = ? AND user_password = ?");
			
			$query->bindValue(1, $username);
			$query->bindValue(2, $password);

			$query->execute();

			$num = $query->rowCount();

			if ($num == 1) {
				// correct
				$_SESSION['logged_in'] = true;

				header('Location: index.php');
				exit();
			} else {
				// false
				$error = 'Incorrect details!';
			}
		}
	}
	?>

<?php include('../includes/heading.php') ?>
		<body>
			<div class="content">
				<h2>Log in</h2>

				<br />

				<?php if (isset($error)) { ?>
					<small style="color:#aa0000"><?php echo $error; ?></small>

					<br /><br />
				<?php } ?>

				<form class="form-search" action="admin/index.php" method="post">
					<input type="text" name="username" placeholder="Username" />
					<input type="password" name="password" placeholder="Password" />
					<input type="submit" class="btn" value="Login" />
				</form>
				<div class="alert alert-success pass-hint">You can log in with <strong>admin / password</strong>.</div>
</div>
</div>
		</body>
	</html>

	<?php
}

 ?>