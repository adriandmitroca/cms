<?php 

session_start();

include_once('../includes/connection.php');
include_once('../includes/article.php');

$article = new Article;

if(isset($_SESSION['logged_in'])) {
	if (isset($_POST['title'], $_POST['content'])) {
		$title = $_POST['title'];
		$content = nl2br($_POST['content']);
		$id = $_GET['id'];

		if(empty($title) or empty($content)) {
			$error = 'All fields are required';
		} else {
			$query = $pdo->prepare("UPDATE articles SET article_title = ?, article_content = ? WHERE article_id = ?");
		
			$query->bindValue(1, $title);
			$query->bindValue(2, $content);
			$query->bindValue(3, $id);

			$query->execute();

			$error = 'Article "<b>' . $title . '</b>" has been changed.';
			$errorstyle = 'alert alert-success';

			//header('Location: edit.php');
		}
	}
	?>

<?php include('../includes/heading.php') ?>
		<body>
			<div class="content">

<?php if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$data = $article->fetch_data($id); }
 ?>

				<h2>Editing "<?php echo $data['article_title']; ?>" article</h2>
				<hr>
				<?php if (isset($error)) { ?>
					<p class="<?php echo $errorstyle ?>"><?php echo $error; ?></p>
				<?php } ?>

				<p></p>

				<form action="admin/editview.php?id=<?php echo $data['article_id']; ?>" method="post" autocomplete="off">
					<label class="control-label">Title</label>
					<input class="input-xlarge input-xlarge-title" type="text" name="title" placeholder="Title" value="<?php echo $data['article_title']; ?>"/><br /><br />
					<label class="control-label">Content</label>
					<textarea class="input-xlarge input-xlarge-content" rows="15" cols="80" name="content" placeholder="Content"><?php echo $data=str_replace("<br />","",$data['article_content']); ?></textarea><br /><br />
					<input type="submit" class="btn btn-primary" value="Submit changes" />
				</form>
				<br />
				<a href="admin/edit.php">&larr; Back</a>
		</body>
	</html>

	<?php
} else {
	header('Location: index.php');
}

 ?>