<?php
//Make sure the file isn't accessed directly.
defined('IN_CMS') or exit('Access denied!');

run_hook('admin_editpage_before');

//Include page information, if we're editing a page.
if (isset($_GET['page']) && file_exists(PAGE_DIR.'/'.get_page_filename($_GET['page'])))
	require_once (PAGE_DIR.'/'.get_page_filename($_GET['page']));

//If form is posted...
if (isset($_POST['save']) || isset($_POST['save_exit'])) {
	//Allow modules to add data to page
	$module_additional_data = null;
	run_hook('admin_save_page_afterpost', array(&$module_additional_data));

	if (!isset($_POST['hidden']))
		$_POST['hidden'] = 'yes';

	//Save the page, but only if a title has been entered and it's seo url is not empty.
	if (!empty($_POST['title']) && seo_url($_POST['title'])) {
		if (!empty($_POST['seo_name']) && $_POST['seo_name'] != seo_url($_POST['title'])) {
			$title = array('title' => $_POST['title'], 'seo_name' => trim(str_replace(array('\\', '/', ':', '*', '?', '"', '<', '>', '|'), '', $_POST['seo_name'])));
		}
		else
			$title = $_POST['title'];
		//If we are editing an existing page, pass current seo-name.
		if (isset($_GET['page'])) {
			$seoname = save_page($title, htmlspeicalchars($_POST['content']), $_POST['hidden'], $_POST['sub_page'], $_POST['description'], $_POST['keywords'], $module_additional_data, $_GET['page']);
		} else {
		//If we are creating a new page, don't pass seo-name.
			$seoname = save_page($title, htmlspecialchars($_POST['content']), $_POST['hidden'], $_POST['sub_page'], $_POST['description'], $_POST['keywords'], $module_additional_data);
		}
		//If seoname is false, a file already exists with the same name
		if (empty($seoname)) {
			$error = show_error($lang['page']['name_exists'], 1, true);
		}
	} else {
	//If no title has been chosen or the seo url for the title is empty, set error.
		$error = show_error($lang['page']['no_title'], 1, true);
	}

	//Redirect to the new title only if it is a plain save.
	if (isset($_POST['save']) && !isset($error)) {
		redirect(SITE_URI.'/'.SITE_SCRIPT.'?action=editpage&page='.$seoname, 0);
		include_once ('data/inc/footer.php');
		exit;
	}

	//Redirect the user. only if they are doing a save_exit.
	elseif (isset($_POST['save_exit']) && !isset($error)) {
		redirect(SITE_URI.'/'.SITE_SCRIPT.'?action=page', 0);
		include_once ('data/inc/footer.php');
		exit;
	}
}
?>
<?php
if (isset($error))
	echo $error;
?>
<div class="rightmenu">
<p><?php echo $lang['page']['items']; ?></p>
<?php
	show_module_insert_box();
	show_link_insert_box();
	show_image_insert_box('images');
	show_file_insert_box('files');
	run_hook('admin_save_page_sidebar');
?>
</div>
<form name="page_form" method="post" action="">
	<p>
		<label class="kop2" for="title"><?php echo $lang['general']['title']; ?></label>
		<input name="title" id="title" type="text" value="<?php if (isset($_GET['page'])) echo $title; ?>" />
	</p>
	<p><a href="#" class="kop2" onclick="return kadabra('seo-name');"><?php echo $lang['page']['seo_urls']; ?></a></p>
	<div id="seo-name" style="display: none;">
		<input name="seo_name" id="seo_name" type="text" value="<?php if (isset($_GET['page'])) if (isset($seoname)) echo $seoname; else echo $title; ?>" />
	</div>
	
	<label class="kop2" for="content-form"><?php echo $lang['general']['contents']; ?></label>
	<textarea class="<?php if (defined('WYSIWYG_TEXTAREA_CLASS')) echo WYSIWYG_TEXTAREA_CLASS; ?>" name="content" id="content-form" cols="70" rows="20"><?php if (isset($_GET['page'])) echo htmlspecialchars($content); ?></textarea>


	<div class="menudiv" style="width: 588px; margin-<?php if (DIRECTION_RTL) echo 'right'; else echo 'left'; ?>: 0;">
		<p><a href="#" class="kop2" onclick="return kadabra('meta-options');"><?php echo $lang['editmeta']['title']; ?></a></p>
		<p class="kop4" style="margin-bottom: 5px;"><?php echo $lang['editmeta']['descr']; ?></p>

		<div id="meta-options" style="display: none;">
			<label for="description"><?php echo $lang['general']['description']; ?></label>
			<br />
			<textarea id="description" name="description" rows="2" cols="40" class="white"><?php if (isset($description)) echo $description; ?></textarea>
			<br />

			<label for="keywords"><?php echo $lang['editmeta']['keywords']; ?></label>
			<br />
			<span class="kop4"><?php echo $lang['editmeta']['comma']; ?></span>
			<br />
			<textarea id="keywords" name="keywords" rows="1" cols="40" class="white"><?php if (isset($keywords)) echo $keywords; ?></textarea>
		</div>
	</div>

	<div class="menudiv" style="width: 588px; margin-<?php if (DIRECTION_RTL) echo 'right'; else echo 'left'; ?>: 0;">
		<p><a href="#" class="kop2" onclick="return kadabra('other-options');"><?php echo $lang['general']['other_options']; ?></a></p>
		<p class="kop4" style="margin-bottom: 5px;"><?php echo $lang['page']['options']; ?></p>

		<div id="other-options" style="display: block;">
			<table>
			<tr>
				<td><label for="hidden"><?php echo $lang['page']['in_menu']; ?></label><br /></td>
				<td><input type="checkbox" name="hidden" id="hidden" <?php if (!isset($_GET['page']) || $hidden == 'no') echo'checked="checked"'; ?> value="no" /></td>
			</tr>

			<tr>
				<td><label for="sub_page"><?php echo $lang['page']['sub_page']; ?></label></td>
				<td> <?php if (isset($_GET['page'])) show_subpage_select('sub_page', $_GET['page']); else show_subpage_select('sub_page'); ?></td>
			</tr>

			<?php run_hook('admin_save_page_beforepost'); ?>
			</table>
		</div>
	</div>
	<?php show_common_submits('?action=page', true); ?>
</form>
