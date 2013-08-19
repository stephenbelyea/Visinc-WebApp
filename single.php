<?php 
	$pageTitle = 'View Image';
	$pageClass = 'img';
	require 'includes/head.php'; 
	require 'includes/phpFlickr.php';
	//require 'includes/feed.php';
	// Start phpFlickr class using API key.
	$f = new phpFlickr(KEY_FLICKR);

	// Enable cache for API. Cache folder
	// permissions should be set to 777.
	$f->enableCache("fs", "cache");

	$imgID = $_GET['imgID'];
	$imgURL = $_GET['imgURL'];

	$photo = $f->photos_getInfo($imgID);
?>
		
	<div id="wrap">

		<article class="main single">
			<div class="img-back">
			<?php 
				// echo 	"<div class='img-bg' style='background-image: url(" 
				// 		. $imgURL .  
				// 		");'></div>";
				echo 	"<div class='img-big'>" .
						"<img src='" .
						$imgURL .
						"' />" .
						"</div>";
			?>
				<div class="img-info"></div>
			</div>
		</article>

	</div>

<?php require 'includes/footer.php'; ?>

<?php 
	echo 	"<pre>";
	print_r($photo['photo']);
	echo 	"</pre>";
?>