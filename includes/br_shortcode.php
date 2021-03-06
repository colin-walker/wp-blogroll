<?php

	if(!defined('ABSPATH')) exit; //Don't run if accessed directly


	/**
	 *
	 * @package wpblogroll
	 *
	 * create blogroll shortcode
	 *
	*/
	


	function blogroll_shortcode() {
		
		// Get site root and delete OPML file if exists

		$root = $_SERVER['DOCUMENT_ROOT'];
		$file = $root . '/blogroll.opml';

		if ( file_exists( $file ) ) {
		  unlink( $file );
		}

		$opmlfile = fopen($file, 'w');
		fwrite($opmlfile, '<?xml version="1.0" encoding="ISO-8859-1"?>'.PHP_EOL);
		fwrite($opmlfile, "<!-- OPML generated by the Webmention Directory WordPress plugin -->".PHP_EOL);
		fwrite($opmlfile, "<!-- Dynamically created on " . date('d/m/Y') . " -->".PHP_EOL);
		fwrite($opmlfile, '<opml version="2.0">'.PHP_EOL);
		fwrite($opmlfile, "\t<head>".PHP_EOL);
		fwrite($opmlfile, "\t\t<title>Blogroll links for " . get_bloginfo('name') . "</title>".PHP_EOL);
		fwrite($opmlfile, "\t\t<dateModified>" . date('D, d M Y H:i:s') . " GMT</dateModified>".PHP_EOL);
		fwrite($opmlfile, "\t</head>".PHP_EOL);
		fwrite($opmlfile, "\t<body>".PHP_EOL);
		fwrite($opmlfile, "\t\t<outline type='category' title='Bloggers'>".PHP_EOL);
		
		
		// setup query and get entries

		global $wp_query;
		global $post;
		
		$blogrollstr = ''; 
		$args = array(
        		'order'   		=> 'ASC',
			'post_type'		=> 'blogroll',
			'posts_per_page'	=> -1
		);
		
		$query = new WP_Query( $args );
		
		if ( $query->have_posts() ) : ?>

		    <?php while ( $query->have_posts() ) : $query->the_post(); 
				$id = $post->ID;
				$name = get_the_title();
				$content = get_the_content();
				$link = get_post_meta( $id, 'linkurl', true );
				$feed = get_post_meta( $id, 'feedurl', true );
				
        		$blogrollstr .= '<div class="blogroll-item">';
            	$blogrollstr .= '<h2 class="blogroll-title"><a href="' . $link . '">' . $name . '</a></h2>';
				$blogrollstr .= $content;
				$blogrollstr .= '<p><a href="' .  $feed . '">RSS Feed</a></p>';
        		$blogrollstr .= '</div>';

				fwrite($opmlfile, "\t\t\t<outline text='" . $name . "' xmlUrl='" . $feed . "' htmlUrl='" . $link . "' />".PHP_EOL);
				endwhile; wp_reset_postdata(); 
		endif;
		
		fwrite($opmlfile, "\t\t</outline>".PHP_EOL);
		fwrite($opmlfile, "\t</body>".PHP_EOL);
		fwrite($opmlfile, "</opml>".PHP_EOL);
		fclose($opmlfile);
		
		$domain = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}";
		$opmlpath = $domain . '/blogroll.opml';

		$blogrollstr .= '<div class="opmllink">';
		$blogrollstr .= 'Grab the <a href="' . $opmlpath . '">OPML file</a>';
		$blogrollstr .= '</div>';
		
		return $blogrollstr;
	
	}
