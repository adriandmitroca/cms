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

				<h2>Add article</h2>
				<hr>
				<?php if (isset($error)) { ?>
					<p class="<?php echo $errorstyle ?>"><?php echo $error; ?></p>
				<?php } ?>

				<form action="admin/add.php" method="post" autocomplete="off">
					<label class="control-label">Title</label>
					<input class="input-xlarge input-xlarge-title" type="text" name="title" placeholder="Title" /><br /><br />
					<label class="control-label">Content</label>
					<textarea class="input-xlarge input-xlarge-content" rows="15" name="content" placeholder="Content"></textarea><br /><br />
					<input type="submit" class="btn btn-primary" value="Add Article" />
				</form>
				<br />
				<a href="admin">&larr; Back</a>
		</body>
	</html>

	<?php
} else {
	header('Location: index.php');
}

 ?>