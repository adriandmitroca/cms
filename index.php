<?php

session_start();

include_once('includes/connection.php');
include_once('includes/article.php');

$article = new Article;
$articles = $article->fetch_all();

/* print_r($articles); */
?>

		<?php include('includes/heading.php'); ?>
		<div class="content">
			<ol>
				<?php foreach ($articles as $article) { ?>
				<li>
					<a href="article.php?id=<?php echo $article['article_id']; ?>">
						<?php echo $article['article_title']; ?></a> 
						- <small>posted <?php echo date('l jS', $article['article_timestamp']); ?></small></li>
				<?php } ?>
			</ol>

			<br />

        </ul>
      </div>
  </div>
	</body>
</html>