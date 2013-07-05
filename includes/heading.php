<html>
<head>
	<title>CMS</title>

	<link rel="stylesheet" href="<?php $SERVER_ROOT ?>/cms/assets/bootstrap.min.css" />
	<link rel="stylesheet" href="<?php $SERVER_ROOT ?>/cms/assets/style.css" />

	 <base href="http://86.63.111.125:8080/cms/">
</head>

<body>
<div class="navbar">
  <div class="navbar-inner">
    <div class="container">
      <a class="brand" href="index.php">CMS</a>
        <ul class="nav">
          <li><a href="index.php">Home</a></li>
          <?php if(isset($_SESSION['logged_in'])) { if($_SESSION['logged_in']) { ?>
          <li><a href="admin">Admin Panel</a></li>
          <?php } } ?>
          <!--
          <li><a href="">Features</a></li>
          <li><a href="">To do</a></li>
          -->
        </ul>

    	<?php if (isset($_SESSION['logged_in'])) { 
        	if($_SESSION['logged_in']) { 
        	?>
	        <p class="navbar-text pull-right">
          	<a class="btn" href="admin/logout.php">Log out</a></a>
        	</p>
    	<?php } } else { ?>
    		 <p class="navbar-text pull-right">
          	<a class="btn" href="admin">Log in</a></a>
        	</p>
        <?php } ?>

    </div>
  </div>
</div>
