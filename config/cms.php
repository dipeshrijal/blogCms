<?php

return [
	'theme' => [
		'folder' => 'themes',
		'active'=> 'default'
	],

	'templates' => [

		'home' => blogCms\Templates\HomeTemplate::class,
		'blog'   => blogCms\Templates\BlogTemplate::class ,
		'blog.post'   => blogCms\Templates\BlogPostTemplate::class ,

	],
];