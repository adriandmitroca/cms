<?php

session_start();

include_once('../includes/connection.php');
include_once('../includes/article.php');

$article = new Article;
$articles = $article->fetch_all();

if (isset($_SESSION['logged_in'])) {
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		
		$query = $pdo->prepare("DELETE FROM articles WHERE article_id = ?");
		$query->bindValue(1, $id);

		$query->execute();

		header('Location: delete.php');
	}
	$articles = $article->fetch_all();
	?>

<?php include('../includes/heading.php') ?>
		<body>
			<div class="content">
			<h2>Delete existing article</h2>
<!--
			<form action="admin/delete.php" method="get">
				<select onchange="this.form.submit();" name="id">
					<?php foreach ($articles as $article) { ?>
						<option value="<?php echo $article['article_id']; ?>">
									   <?php echo $article['article_title']; ?>
					<?php } ?>
				</select>
			</form>
-->
			<form action="admin/delete.php" method="get">
			<ol>
				<?php foreach ($articles as $article) { ?>
				<li>
					<a href="admin/editview.php?id=<?php echo $article['article_id']; ?>">
						<?php echo $article['article_title']; ?></a> 
						- <small>posted <?php echo date('l jS', $article['article_timestamp']); ?></small> <button class="btn btn-danger btn-small" id="<?php echo $article['article_id']; ?>" name="id" onclick="showConfirm()">Delete</button></li>
				<?php } ?>
			</ol>
			</form>
	</body>
	</html>
	<?php
} else { 
	header('Location: index.php');
}
?>

<script>
function showConfirm()
{
var x;
var r=confirm("Press a button!");
if (r==true)
  {
	document.getElementById("id").submit();
  }
else
  {
  x="You pressed Cancel!";
  }
document.getElementById("demo").innerHTML=x;
}
</script>