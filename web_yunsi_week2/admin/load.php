<?php 



# Setup inclusions
$load['plugin'] = true;
include('inc/common.php');


global $plugin_info;

# verify a plugin was passed to this page
if (empty($_GET['id']) || !isset($plugin_info[$_GET['id']])) {
	redirect('plugins.php');
}

# include the plugin
$plugin_id = $_GET['id'];

get_template('header', cl($SITENAME).' &raquo; '. $plugin_info[$plugin_id]['name']); 

?>
	
<?php include('template/include-nav.php'); ?>

<div class="bodycontent clearfix">
	
	<div id="maincontent">
		<div class="main">

		<?php 
			call_user_func_array($plugin_info[$plugin_id]['load_data'],array()); 
		?>

		</div>
	</div>
	
	<div id="sidebar" >
    <?php 
      $res = (@include('template/sidebar-'.$plugin_info[$plugin_id]['page_type'].'.php'));
      if (!$res) { 
    ?>
      <ul class="snav">
        <?php exec_action($plugin_info[$plugin_id]['page_type']."-sidebar"); ?>
      </ul>
    <?php
      }
    ?>
  </div>

</div>
<?php get_template('footer'); ?>