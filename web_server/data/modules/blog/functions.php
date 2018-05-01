<?php
//Make sure the file isn't accessed directly.
defined('IN_CMS') or exit('Access denied!');

define('BLOG_POSTS_DIR', 'data/settings/modules/blog/posts');
define('BLOG_CATEGORIES_DIR', 'data/settings/modules/blog/categories');

/**
 * Save or edit a blog post.
 *
 * @param string $title The title of the blog post.
 * @param string $category The category of the blog post.
 * @param string $content The contents of the blog post (the post itself).
 * @param string $seoname The current seoname of the blog post, if it already exists.
 * @param string $force_time Force a time different then current time (Unix timestamp). Not required.
 */
function blog_save_post($title, $category, $content, $current_seoname = null, $force_time = null) {
	//Check if 'posts' directory exists, if not; create it.
	if (!is_dir(BLOG_POSTS_DIR)) {
		mkdir(BLOG_POSTS_DIR);
		chmod(BLOG_POSTS_DIR, 0777);
	}

	//Create seo-filename
	$seoname = seo_url($title);

	//Sanitize variables.
	$title = sanitize($title, true);
	$content = sanitize($content, false);

	if (!empty($current_seoname)) {
		$current_filename = blog_get_post_filename($current_seoname);
		$parts = explode('.', $current_filename);
		$number = $parts[0];

		//Get the post time.
		include BLOG_POSTS_DIR.'/'.$current_filename;

		if ($seoname != $current_seoname) {
			unlink(BLOG_POSTS_DIR.'/'.$current_filename);

			if (is_dir(BLOG_POSTS_DIR.'/'.$current_seoname))
				rename(BLOG_POSTS_DIR.'/'.$current_seoname, BLOG_POSTS_DIR.'/'.$seoname);
		}
	}

	else {
		$files = read_dir_contents(BLOG_POSTS_DIR, 'files');

		//Find the number.
		if ($files) {
			$number = count($files);
			$number++;
		}
		else
			$number = 1;

		if (empty($force_time))
			$post_time = time();
		else
			$post_time = $force_time;
	}

	//Save information.
	$data['post_title']    = $title;
	$data['post_category'] = $category;
	$data['post_content']  = $content;
	$data['post_time']     = $post_time;

	save_file(BLOG_POSTS_DIR.'/'.$number.'.'.$seoname.'.php', $data);

	//Return seoname under which post has been saved (to allow for redirect).
	return $seoname;
}

function blog_get_post_filename($seoname) {
	$posts = read_dir_contents(BLOG_POSTS_DIR, 'files');

	if ($posts) {
		foreach ($posts as $filename) {
			if (strpos($filename, '.'.$seoname.'.'))
				return $filename;
		}
		unset($filename);
	}

	return false;
}

function blog_get_post_seoname($filename) {
	if (file_exists(BLOG_POSTS_DIR.'/'.$filename)) {
		$parts = explode('.', $filename);
		return $parts[1];
	}

	else
		return false;
}

/**
 * Save/add a reaction to a blog post.
 *
 * @param string $post The seoname of the blog post to which the reaction should be added.
 * @param string $name The name of the person posting the reaction.
 * @param string $email The e-mail of the person posting the reaction.
 * @param string $website The website address of the person posting the reaction.
 * @param string $message The message of the reaction.
 * @param int $id If an existing reaction needs to be edited, the id of the reaction should go here.
 * @param string $force_time Force a time different then current time (Unix timestamp). Not required.
 */
function blog_save_reaction($post, $name, $email, $website, $message, $id = null, $force_time = null) {
	global $lang;

	//Sanitize variables.
	$name = sanitize($name);
	$message = sanitize($message);
	$message = nl2br($message);

	//Have to make sure that the dir exists.
	if (!is_dir(BLOG_POSTS_DIR.'/'.$post)) {
		mkdir(BLOG_POSTS_DIR.'/'.$post);
		chmod(BLOG_POSTS_DIR.'/'.$post, 0777);
	}

	if (!empty($id))
		include BLOG_POSTS_DIR.'/'.$post.'/'.$id.'.php';

	else {
		$files = read_dir_contents(BLOG_POSTS_DIR.'/'.$post, 'files');

		if ($files) {
			$id = count($files);
			$id++;
		}

		else
			$id = 1;


		if (empty($force_time))
			$reaction_time = time();
		else
			$reaction_time = $force_time;
	}

	$data['reaction_name']    = $name;
	$data['reaction_email']   = $email;
	if ($website != 'http://' && !empty($website))
		$data['reaction_website'] = $website;
	$data['reaction_message'] = $message;
	$data['reaction_time']    = $reaction_time;

	save_file(BLOG_POSTS_DIR.'/'.$post.'/'.$id.'.php', $data);
}

function blog_get_reaction($post, $id) {
	if (file_exists(BLOG_POSTS_DIR.'/'.$post.'/'.$id.'.php')) {
		include BLOG_POSTS_DIR.'/'.$post.'/'.$id.'.php';

		$reaction['id'] = $id;
		$reaction['name'] = $reaction_name;
		$reaction['email'] = $reaction_email;
		if (isset($reaction_website))
			$reaction['website'] = $reaction_website;
		$reaction['message'] = $reaction_message;
		$reaction['date'] = blog_date_convert($reaction_time);
		$reaction['time'] = blog_time_convert($reaction_time);

		return $reaction;
		unset($reaction);
	}

	else
		return false;
}

function blog_get_reactions($post) {
	$files = read_dir_contents(BLOG_POSTS_DIR.'/'.$post, 'files');

	if ($files) {
		natcasesort($files);
		$files = array_reverse($files);

		foreach ($files as $reaction) {
			include BLOG_POSTS_DIR.'/'.$post.'/'.$reaction;
			$parts = explode('.', $reaction);
			$reactions[] = blog_get_reaction($post, $parts[0]);
		}
		unset($reaction);

		return $reactions;
	}

	else
		return false;
}

function blog_reorder_reactions($post) {
	$reactions = read_dir_contents(BLOG_POSTS_DIR.'/'.$post, 'files');

	//Only reorder if there are any files.
	if ($reactions) {
		natcasesort($reactions);

		$number = 1;
		foreach ($reactions as $reaction) {
			$parts = explode('.', $reaction);

			//Only rename the file, if the number isn't correct.
			if ($parts[0] != $number)
				rename(BLOG_POSTS_DIR.'/'.$post.'/'.$reaction, BLOG_POSTS_DIR.'/'.$post.'/'.$number.'.php');
			$number++;
		}
		unset($reaction);
	}
}

/**
 * Load posts in an array. Will return FALSE if no posts exist.
 */
function blog_get_posts() {
	$files = read_dir_contents(BLOG_POSTS_DIR, 'files');

	if ($files) {
		natcasesort($files);
		$files = array_reverse($files);

		foreach ($files as $post)
			$posts[] = blog_get_post(blog_get_post_seoname($post));
		unset($post);

		return $posts;
	}

	else
		return false;
}

function blog_get_post($seoname) {
	if (!empty($seoname) && (blog_get_post_filename($seoname))) {
		include BLOG_POSTS_DIR.'/'.blog_get_post_filename($seoname);

		return array(
			'title'            => $post_title,
			'seoname'          => $seoname,
			'content'          => $post_content,
			'category'         => blog_get_category_title($post_category),
			'category_seoname' => $post_category,
			'date'             => blog_date_convert($post_time),
			'time'             => blog_time_convert($post_time)
		);
	}

	else
		return false;
}

/**
 * Load categories in an array. Will return FALSE if no categories exist.
 * @param bool $only_return_title If set to TRUE, only the title will be returned (seoname will be discarded).
 * @return mixed
 */
function blog_get_categories($only_return_title = FALSE) {
	$files = read_dir_contents(BLOG_CATEGORIES_DIR, 'files');

	if ($files) {
	natcasesort($files);
		foreach ($files as $category) {
			include BLOG_CATEGORIES_DIR.'/'.$category;
			if ($only_return_title == TRUE)
				$categories[] = $category_title;
			else {
				$categories[] = array(
					'title'   => $category_title,
					'seoname' => str_replace('.php', '', $category)
				);
			}
		}
		unset($category);

		return $categories;
	}

	else
		return false;
}

/**
 * Returns the title of a blog category.
 *
 * @param string $seoname The SEO-friendly title of the category.
 */
function blog_get_category_title($seoname) {
	global $lang;

	if (blog_category_exists($seoname)) {
		include BLOG_CATEGORIES_DIR.'/'.$seoname.'.php';
		return $category_title;
	}

	elseif (empty($seoname) || !blog_category_exists($seoname))
		return $lang['blog']['no_cat'];
	else
		return false;
}

/**
 * Checks whether a blog category exists. Returns TRUE or FALSE.
 *
 * @param string $category The category to check for.
 * @return string
 */
function blog_category_exists($category) {
	if ($files = blog_get_categories()) {
		foreach ($files as $file) {
			if ($file['seoname'] == $category)
				return true;
		}
		unset($file);
	}

	return false;
}

/**
 * Create a blog category.
 *
 * @param string $category The name of the category that needs to be created.
 */
function blog_create_category($category) {
	//Check if 'categories' directory exists, if not; create it.
	if (!is_dir(BLOG_CATEGORIES_DIR)) {
		mkdir(BLOG_CATEGORIES_DIR);
		chmod(BLOG_CATEGORIES_DIR, 0777);
	}

	$data['category_title'] = sanitize($category);

	save_file(BLOG_CATEGORIES_DIR.'/'.seo_url($category).'.php', $data);
}

function blog_date_convert($timestamp) {
	return date(module_get_setting('blog','post_date'), $timestamp);
}

function blog_time_convert($timestamp) {
	return date(module_get_setting('blog','post_time'), $timestamp);
}

/**
 * Truncates a string to a certain length.
 * @param string $text
 * @param int $limit
 * @param string $ending
 * @return string
 */
function truncate($text, $limit, $ending = '...') {
	if (strlen($text) > $limit) {
		$text = strip_tags($text);
		$text = substr($text, 0, $limit);
		$text = substr($text, 0, -(strlen(strrchr($text, ' '))));
		$text = $text.$ending;
	}

	return $text;
}

/**
 * Counts the number of pages we need for pagination of all blog posts.
 * @param mixed $category Optional, if we need a number of pages for posts in one category.
 */
function blog_count_pages($category = false) {
	if (!$category) {
		$number_posts = count(blog_get_posts());
	}
	else {
		$posts = blog_get_posts();
		$number_posts = 0;
		foreach ($posts as $post) {
			if ($post['category'] == $category)
				$number_posts++;
		}
		unset($post);
	}
	$number_pages = ceil($number_posts/module_get_setting('blog','posts_per_page'));
	return $number_pages;
}

/**
 * Shows page list for post pagination on website.
 * @param string $current_page The number of the current posts-page.
 * @param mixed $category Optional, if we need a page list for one category.
 */
function blog_show_page_no_list($current_page, $category = false) {
	//Get the number of pages we need.
	if (isset($category))
		$number_pages = blog_count_pages($category);
	else
		$number_pages = blog_count_pages();

	$param = strpos(PAGE_URL_PREFIX, '?') === false ? '?p=' : '&p=';
	$page = 1;
	while ($page <= $number_pages) {
		if ($page != $current_page) {
			if ($page == 1) {
				echo '<a href="'.SITE_URL.'/'.PAGE_URL_PREFIX.CURRENT_PAGE_SEONAME.'">'.$page.'</a> ';
				if ($current_page > $page+3)
					echo '&#133; ';
			}
			elseif ($page == $number_pages) {
				if ($current_page < $page-3)
					echo '&#133; ';
				echo '<a href="'.SITE_URL.'/'.PAGE_URL_PREFIX.CURRENT_PAGE_SEONAME.$param.$page.'">'.$page.'</a> ';
			}
			else {
				if ((!($page < $current_page-2) && !($page > $current_page+2)))
					echo '<a href="'.SITE_URL.'/'.PAGE_URL_PREFIX.CURRENT_PAGE_SEONAME.$param.$page.'">'.$page.'</a> ';
			}
		}
		else
			echo $page.' ';

		$page++;
	}
	unset($page);
}
?>
