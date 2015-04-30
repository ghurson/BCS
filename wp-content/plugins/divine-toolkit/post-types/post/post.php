<?php

if(!class_exists('DVT_Post')){

	class DVT_Post{

		public function __construct(){}

		public function require_widgets(){
			require_once DTK_PATH . 'post-types/post/widget/featured-video.php';
			require_once DTK_PATH . 'post-types/post/widget/articles-masonry.php';
			require_once DTK_PATH . 'post-types/post/widget/articles-list-with-thumbnail-left.php';
			require_once DTK_PATH . 'post-types/post/widget/articles-list-with-small-thumbnail.php';
		}
	}

	$dvt_post = new DVT_Post();
	$dvt_post->require_widgets();
}