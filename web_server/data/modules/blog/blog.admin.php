<?php
//Make sure the file isn't accessed directly.
defined('IN_CMS') or exit('Access denied!');

require_once ('data/modules/blog/functions.php');

function blog_pages_admin() {
	global $lang;
	$module_page_admin[] = array(
		'func'  => 'blog',
		'title' => $lang['blog']['title']
	);
	$module_page_admin[] = array(
		'func'  => 'deletecategory',
		'title' => $lang['blog']['delete_cat']
	);
	$module_page_admin[] = array(
		'func'  => 'editreactions',
		'title' => $lang['blog']['edit_reactions']
	);
	$module_page_admin[] = array(
		'func'  => 'editreaction',
		'title' => $lang['blog']['edit_reaction']
	);
	$module_page_admin[] = array(
		'func'  => 'deletereaction',
		'title' => $lang['blog']['delete_reaction']
	);
	$module_page_admin[] = array(
		'func'  => 'editpost',
		'title' => $lang['blog']['edit_post']
	);
	$module_page_admin[] = array(
		'func'  => 'deletepost',
		'title' => $lang['blog']['delete_post']
	);
	$module_page_admin[] = array(
		'func'  => 'newpost',
		'title' => $lang['blog']['new_post']
	);
	return $module_page_admin;
}

function blog_page_admin_blog() {
	global $cont1, $lang;
	?>
	<p>
		<strong><?php echo $lang['blog']['main_message']; ?></strong>
	</p>
	<?php showmenudiv($lang['blog']['new_post'], false, 'data/image/newpage.png', '?module=blog&amp;page=newpost', false); ?>
	<span class="kop2"><?php echo $lang['blog']['posts']; ?></span>
	<?php
	//Display existing posts.
	if (blog_get_posts()) {
		//Load posts in array.
		$posts = blog_get_posts();

		foreach ($posts as $post) {
		?>
			<div class="menudiv">
				<span>
					<img src="data/modules/blog/images/blog.png" alt="" />
				</span>
				<span class="title-page"><?php echo $post['title']; ?></span>
				<span>
					<a href="?module=blog&amp;page=editpost&amp;var1=<?php echo $post['seoname']; ?>">
						<img src="data/image/edit.png" title="<?php echo $lang['blog']['edit_post']; ?>" alt="<?php echo $lang['blog']['edit_post']; ?>" />
					</a>
				</span>
				<?php
				if (blog_get_reactions($post['seoname'])):
				?>
					<span>
						<a href="?module=blog&amp;page=editreactions&amp;var1=<?php echo $post['seoname']; ?>">
							<img src="data/modules/blog/images/reactions.png" title="<?php echo $lang['blog']['edit_reactions']; ?>" alt="<?php echo $lang['blog']['edit_reactions']; ?>" />
						</a>
					</span>
				<?php
				endif;
				?>
				<span>
					<a href="?module=blog&amp;page=deletepost&amp;var1=<?php echo $post['seoname']; ?>">
						<img src="data/image/delete_from_trash.png" title="<?php echo $lang['blog']['delete_post']; ?>" alt="<?php echo $lang['blog']['delete_post']; ?>" />
					</a>
				</span>
				<br />
				<span>
					<span style="font-size: 12px; font-style: italic">
						<?php
						//Show post date and category.
						echo $post['date'].' '.$lang['blog']['at'].' '.$post['time'];
						if (isset($post['category']) && !empty($post['category']))
							echo ' '.$lang['blog']['in'].' '.$post['category'];
						?>
					</span>
				</span>
			</div>
		<?php
		}
	}

	//If no posts exist, display message.
	else
		echo '<span class="kop4">'.$lang['general']['nothing_yet'].'</span><br /><br />';
	?>
	<span class="kop2"><?php echo $lang['blog']['categories']; ?></span>
	<?php
	//If there already are categories.
	if (blog_get_categories()) {
		//Get categories.
		$categories = blog_get_categories();

		//And show them.
		echo '<div>';
		foreach ($categories as $category) {
		?>
			<div class="menudiv">
				<span>
					<img src="data/image/page.png" alt="" />
				</span>
				<span class="title-page"><?php echo $category['title']; ?> &nbsp;</span>
				<span>
					<a href="?module=blog&amp;page=deletecategory&amp;var1=<?php echo $category['seoname']; ?>">
						<img src="data/image/delete_from_trash.png" alt="<?php echo $lang['blog']['delete_cat']; ?>" title="<?php echo $lang['blog']['delete_cat']; ?>" />
					</a>
				</span>
			</div>
		<?php
		}
		unset($category);
		echo '</div>';
	}

	//If no categories exist, show a message.
	else
		echo '<span class="kop4">'.$lang['general']['nothing_yet'].'</span><br /><br />';

	//New category.
	?>
		<form method="post" action="">
			<label class="kop2" for="cont1"><?php echo $lang['blog']['new_cat']; ?></label>
			<span class="kop4"><?php echo $lang['blog']['new_cat_message']; ?></span>
			<br />
			<input name="cont1" id="cont1" type="text" />
			<input type="submit" name="Submit" value="<?php echo $lang['general']['save']; ?>" />
		</form>
	<?php
	//When form is submitted.
	if (isset($cont1) && !empty($cont1)) {
		blog_create_category($cont1);
		redirect('?module=blog', 0);
	}
	?>
	<p>
		<a href="?action=modules">&lt;&lt;&lt; <?php echo $lang['general']['back']; ?></a>
	</p>
<?php
}

function blog_page_admin_deletecategory() {
	global $var1;

	//Check if config file exists.
	if (file_exists(BLOG_CATEGORIES_DIR.'/'.$var1.'.php'))
		unlink(BLOG_CATEGORIES_DIR.'/'.$var1.'.php');

	redirect('?module=blog', 0);
}

function blog_page_admin_editreactions() {
	global $lang, $var1;
	?>
		<p>
			<strong><?php echo $lang['blog']['edit_reactions_message']; ?></strong>
		</p>
	<?php
	//Include blog post, if it exists.
	$reactions = blog_get_reactions($var1);
	if ($reactions) {

		//Display reactions
		foreach($reactions as $reaction) {
			?>
				<div class="menudiv">
					<span>
						<img src="data/modules/blog/images/reactions.png" alt="" />
					</span>
					<span class="kop2"><?php echo $reaction['id']; ?></span>
					<span class="title-page"><?php echo $reaction['name']; ?></span>
					<span>
						<a href="?module=blog&amp;page=editreaction&amp;var1=<?php echo $var1; ?>&amp;var2=<?php echo $reaction['id']; ?>">
							<img src="data/image/edit.png" alt="<?php echo $lang['blog']['edit_reaction']; ?>" title="<?php echo $lang['blog']['edit_reaction']; ?>" />
						</a>
					</span>
					<span>
						<a href="?module=blog&amp;page=deletereaction&amp;var1=<?php echo $var1; ?>&amp;var2=<?php echo $reaction['id']; ?>">
							<img src="data/image/delete_from_trash.png" alt="<?php echo $lang['blog']['delete_reaction']; ?>" title="<?php echo $lang['blog']['delete_reaction']; ?>" />
						</a>
					</span>
				</div>
			<?php
		}
	unset($key);
	}

	else
		redirect('?module=blog', 0)
	?>
		<p>
			<a href="?module=blog">&lt;&lt;&lt; <?php echo $lang['general']['back']; ?></a>
		</p>
	<?php
}

function blog_page_admin_editreaction() {
	global $cont1, $cont2, $cont3, $cont4, $lang, $var1, $var2;
	?>
		<p>
			<strong><?php echo $lang['blog']['edit_reactions_message']; ?></strong>
		</p>
	<?php
	//If form is posted...
	if (isset($_POST['save'])) {
		//Check if everything has been filled in.
		if (empty($cont1))
			$error = show_error($lang['contactform']['fields'], 1, true);
		if (filter_input(INPUT_POST, 'cont2', FILTER_VALIDATE_EMAIL) == false)
			$error = show_error($lang['contactform']['fields'], 1, true);
		if (($_POST['cont3'] != 'http://' && !empty($_POST['cont3'])) && filter_input(INPUT_POST, 'cont3', FILTER_VALIDATE_URL, FILTER_FLAG_HOST_REQUIRED) == false)
			$error = show_error($lang['contactform']['fields'], 1, true);
		if (empty($cont4))
			$error = show_error($lang['contactform']['fields'], 1, true);

		if (!isset($error)) {
			//Save reaction.
			blog_save_reaction($var1, $cont1, $cont2, $cont3, $cont4, $var2);

			redirect('?module=blog&page=editreactions&var1='.$var1, 0);
		}
		else
			echo $error;
	}

	//Include blog post, if it exists.
	$reaction = blog_get_reaction($var1, $var2);

	$reaction['message'] = str_replace('<br />', '', $reaction['message']);
	?>
		<form method="post" action="">
			<p>
				<label class="kop2" for="cont1"><?php echo $lang['blog']['name']; ?></label>
				<input name="cont1" id="cont1" type="text" value="<?php echo $reaction['name']; ?>" />
			</p>
			<p>
				<label class="kop2" for="cont2"><?php echo $lang['blog']['email']; ?></label>
				<input name="cont2" id="cont2" type="text" value="<?php echo $reaction['email']; ?>" />
			</p>
			<p>
				<label class="kop2" for="cont3"><?php echo $lang['blog']['website']; ?></label>
				<input name="cont3" id="cont3" type="text" value="<?php if (isset($reaction['website'])) echo $reaction['website']; ?>" />
			</p>
			<p>
				<label class="kop2" for="cont4"><?php echo $lang['blog']['message']; ?></label>
				<textarea name="cont4" id="cont4" rows="5" cols="50"><?php echo $reaction['message']; ?></textarea>
			</p>
			<?php show_common_submits('?module=blog&amp;page=editreactions&amp;var1='.$var1); ?>
		</form>
	<?php
}

function blog_page_admin_deletereaction() {
	global $var1, $var2;

	if (isset($var1, $var2) && file_exists(BLOG_POSTS_DIR.'/'.$var1.'/'.$var2.'.php')) {
		unlink(BLOG_POSTS_DIR.'/'.$var1.'/'.$var2.'.php');
		blog_reorder_reactions($var1);
	}

	redirect('?module=blog&page=editreactions&var1='.$var1, 0);
}

function blog_page_admin_editpost() {
	global $lang, $var1, $cont1, $cont2, $cont3;

	//If form is posted...
	if (isset($_POST['save']) || isset($_POST['save_exit'])) {
		if (seo_url($cont1)) {
			//Save blogpost.
			$seoname = blog_save_post($cont1, $cont2, $cont3, $var1);

			//Redirect user.
			if (isset($_POST['save'])) {
				redirect('?module=blog&page=editpost&var1='.$seoname, 0);
				exit;
			}
			else {
				redirect('?module=blog', 0);
				exit;
			}
		}
		else
			$error = show_error($lang['page']['no_title'], 1, true);
	}

	$post = blog_get_post($var1);
	?>
	<?php
	if (isset($error))
		echo $error;
	?>
		<div class="rightmenu">
			<p><?php echo $lang['page']['items']; ?></p>
			<?php
			show_link_insert_box();
			show_image_insert_box('images');
			?>
		</div>
		<form method="post" action="">
			<p>
				<label class="kop2" for="cont1"><?php echo $lang['general']['title']; ?></label>
				<input name="cont1" id="cont1" type="text" value="<?php echo $post['title']; ?>" />
			</p>
			<p>
			<label class="kop2" for="cont2"><?php echo $lang['blog']['category']; ?></label>
			<select name="cont2" id="cont2">
				<option value=""><?php echo $lang['blog']['choose_cat']; ?></option>
				<?php
				//If there are categories.
				if (blog_get_categories()) {
					$categories = blog_get_categories();

					foreach($categories as $category) {
						if ($post['category_seoname'] == $category['seoname'])
							echo '<option value="'.$category['seoname'].'" selected="selected">'.$category['title'].'</option>';
						else
							echo '<option value="'.$category['seoname'].'">'.$category['title'].'</option>';
					}
					unset($key);
				}
				?>
			</select>
			</p>
			<p>
				<label class="kop2" for="cont3"><?php echo $lang['general']['contents']; ?></label>
				<textarea class="<?php if (defined('WYSIWYG_TEXTAREA_CLASS')) echo WYSIWYG_TEXTAREA_CLASS; ?>" name="cont3" id="cont3" cols="70" rows="20"><?php echo htmlspecialchars($post['content']); ?></textarea>
			</p>
			<?php show_common_submits('?module=blog', true); ?>
		</form>
	<?php
}

function blog_page_admin_deletepost() {
	global $var1;

	if (isset($var1) && file_exists(BLOG_POSTS_DIR.'/'.blog_get_post_filename($var1))) {
		unlink(BLOG_POSTS_DIR.'/'.blog_get_post_filename($var1));

		//If there are reactions, delete them too.
		if (is_dir(BLOG_POSTS_DIR.'/'.$var1))
			recursive_remove_directory(BLOG_POSTS_DIR.'/'.$var1);
	}

	//Redirect.
	redirect('?module=blog', 0);
}

function blog_page_admin_newpost() {
	global $lang, $var1, $cont1, $cont2, $cont3;

	//If form is posted...
	if (isset($_POST['save']) || isset($_POST['save_exit'])) {
		if (seo_url($cont1)) {
			//Save blogpost.
			$seoname = blog_save_post($cont1, $cont2, $cont3);

			//Redirect user.
			if (isset($_POST['save']))
				redirect('?module=blog&page=editpost&var1='.$seoname, 0);
			else
				redirect('?module=blog', 0);
		}
		else
			$error = show_error($lang['page']['no_title'], 1, true);
	}

	if (isset($error))
		echo $error;
	?>
		<div class="rightmenu">
			<p><?php echo $lang['page']['items']; ?></p>
			<?php
			show_link_insert_box();
			show_image_insert_box('images');
			?>
		</div>
		<form method="post" action="">
			<p>
				<label class="kop2" for="cont1"><?php echo $lang['general']['title']; ?></label>
				<input name="cont1" id="cont1" type="text" />
			</p>
			<p>
			<label class="kop2" for="cont2"><?php echo $lang['blog']['category']; ?></label>
			<select name="cont2" id="cont2">
				<option value=""><?php echo $lang['blog']['choose_cat']; ?></option>
				<?php
				//If there are categories.
				if ($categories = blog_get_categories()) {
					foreach($categories as $category)
						echo '<option value="'.$category['seoname'].'">'.$category['title'].'</option>';
					unset($key);
				}
				?>
			</select>
			</p>
			<p>
				<label class="kop2" for="cont3"><?php echo $lang['general']['contents']; ?></label>
				<textarea class="<?php if (defined('WYSIWYG_TEXTAREA_CLASS')) echo WYSIWYG_TEXTAREA_CLASS; ?>" name="cont3" id="cont3" cols="70" rows="20"></textarea>
			</p>
			<?php show_common_submits('?module=blog', true); ?>
		</form>
	<?php
}
?>
