<?php
	require_once __DIR__ . '/vendor/autoload.php';
	// Populate items
	$items = array_map(function ($value) {
		return [
		'name' => 'Blog post #' . $value,
		'url' => '/post/' . $value,
		];
	}, range(1,1000));
	// Get current page from query string
	$currentPage  = isset($_GET['page']) ? (int) $_GET['page'] : 1;
	// Items per page
	$perPage      = 10;
	// Get current items calculated with per page and current page
	$currentItems = array_slice($items, $perPage * ($currentPage - 1), $perPage);
	// Create paginator
	$paginator = new Illuminate\Pagination\Paginator($items, 10, $currentPage);
?>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<h1>Blog posts - page <?=$paginator->currentPage()?></h1>
				<?php foreach ($paginator->items() as $blogPost) { ?>
				<a href="<?=$blogPost['url']?>"><h3><?=$blogPost['name']?></h3></a>
				<?php } ?>
				<?=$paginator->render()?>
			</div>
		</div>
	</div>
</body>
</html>