<?php 

session_start();

include_once('includes/connection.php');
include_once('includes/article.php');

$article = new Article;

if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$data = $article->fetch_data($id);

	//print_r($data);

	?>

<?php include('includes/heading.php') ?>
			<div class="content">
				<h2>
					<?php echo $data['article_title'] ?> 
					<small>posted <?php echo date('l jS', $data['article_timestamp']) ?></small>
				</h2>

				<p><?php echo $data['article_content'] ?></p>

				<a href="index.php">&larr; Back</a>
		</body>
	</html>

	<?php

} else {
	header('Location: index.php');
	exit();
}

?>