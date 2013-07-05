<?php 

session_start();

include_once('../includes/connection.php');
include_once('../includes/article.php');

$article = new Article;
$articles = $article->fetch_all();


if(isset($_SESSION['logged_in'])) {
	if (isset($_POST['title'], $_POST['content'])) {
		$title = $_POST['title'];
		$content = nl2br($_POST['content']);

		if(empty($title) or empty($content)) {
			$error = 'All fields are required';
		} else {
			$query = $pdo->prepare("INSERT INTO articles (article_title, article_content, article_timestamp) VALUES (?, ?, ?)");
		
			$query->bindValue(1, $title);
			$query->bindValue(2, $content);
			$query->bindValue(3, time());

			$query->execute();

			header('Location: index.php');
		}
	}
	?>

<?php include('../includes/heading.php') ?>
		<body>
			<div class="content">

				<h2>Choose article below to edit</h2>
				<hr>
				<?php if (isset($error)) { ?>
					<small style="color:#aa0000"><?php echo $error; ?></small>

					<br /><br />
				<?php } ?>

			
			<ol>
				<?php foreach ($articles as $article) { ?>
				<li>
					<a href="admin/editview.php?id=<?php echo $article['article_id']; ?>">
						<?php echo $article['article_title']; ?></a> 
						- <small>posted <?php echo date('l jS', $article['article_timestamp']); ?></small></li>
				<?php } ?>
			</ol>

			<br />
			<a href="admin">&larr; Back</a>
		</body>
	</html>

	<?php
} else {
	header('Location: index.php');
}

 ?>