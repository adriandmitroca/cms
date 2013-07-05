<?php 

session_start();

include_once('../includes/connection.php');

if(isset($_SESSION['logged_in'])) {
	if (isset($_POST['title'], $_POST['content'])) {
		$title = $_POST['title'];
		$content = nl2br($_POST['content']);

		if(empty($title) or empty($content)) {
			$error = 'All fields are required';
			$errorstyle = 'alert alert-error';
		} else {
			$query = $pdo->prepare("INSERT INTO articles (article_title, article_content, article_timestamp) VALUES (?, ?, ?)");
		
			$query->bindValue(1, $title);
			$query->bindValue(2, $content);
			$query->bindValue(3, time());

			$query->execute();

			$error = 'Article <b>"' . $title . '"</b> has been published.';
			$errorstyle = 'alert alert-success';

			//header('Location: index.php');
		}
	}
	?>

<?php include('../includes/heading.php') ?>
		<body>
			<div class="content">

				<h2>Edit your profile details</h2>
				<hr>
				<?php if (isset($error)) { ?>
					<p class="<?php echo $errorstyle ?>"><?php echo $error; ?></p>
				<?php } ?>
				<div class="well profile-edit">
				<form action="admin/add.php" method="post" autocomplete="off">
					<label class="control-label control-label-profile">First name:</label>
					<input class="input-xlarge input-xlarge-profile" type="text" name="fname"/><br /><br />
					<label class="control-label control-label-profile">Last name:</label>
					<input class="input-xlarge input-xlarge-profile" type="text" name="lname"/><br /><br />
					<label class="control-label control-label-profile">Email adddress:</label>
					<input class="input-xlarge input-xlarge-profile" type="text" name="mail"/><br /><br />
					<input type="submit" class="btn btn-primary" value="Submit changes" />
				</form>
				</div>
				<br />
				<a href="admin">&larr; Back</a>
		</body>
	</html>

	<?php
} else {
	header('Location: index.php');
}

 ?>