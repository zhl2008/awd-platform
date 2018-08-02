<?php 


# Setup
$load['plugin'] = true;
include('inc/common.php');

# save page priority order
if (isset($_POST['menuOrder'])) {
	$menuOrder = explode(',',$_POST['menuOrder']);
	$priority = 0;
	foreach ($menuOrder as $slug) {
		$file = GSDATAPAGESPATH . $slug . '.xml';
		if (file_exists($file)) {
			$data = getXML($file);
			if ($priority != (int) $data->menuOrder) {
				unset($data->menuOrder);
				$data->addChild('menuOrder')->addCData($priority);
				XMLsave($data,$file);
			}
		}
		$priority++;
	}
	create_pagesxml('true');
	$success = i18n_r('MENU_MANAGER_SUCCESS');
}

# get pages
getPagesXmlValues();
$pagesSorted = subval_sort($pagesArray,'menuOrder');

get_template('header', cl($SITENAME).' &raquo; '.i18n_r('PAGE_MANAGEMENT').' &raquo; '.str_replace(array('<em>','</em>'), '', i18n_r('MENU_MANAGER'))); 

?>
	
<?php include('template/include-nav.php'); ?>

<div class="bodycontent clearfix">
	
	<div id="maincontent">
		<div class="main" >
			<h3><?php echo str_replace(array('<em>','</em>'), '', i18n_r('MENU_MANAGER')); ?></h3>
			<p><?php i18n('MENU_MANAGER_DESC'); ?></p>
			<?php
				if (count($pagesSorted) != 0) { 
					echo '<form method="post" action="menu-manager.php">';
					echo '<ul id="menu-order" >';
					foreach ($pagesSorted as $page) {
						$sel = '';
						if ($page['menuStatus'] != '') { 
							
							if ($page['menuOrder'] == '') { 
								$page['menuOrder'] = "N/A"; 
							} 
							if ($page['menu'] == '') { 
								$page['menu'] = $page['title']; 
							}
							echo '<li class="clearfix" rel="'.$page['slug'].'">
											<strong>#'.$page['menuOrder'].'</strong>&nbsp;&nbsp;
											'. $page['menu'] .' <em>'. $page['title'] .'</em>
										</li>';
						}
					}
					echo '</ul>';
					echo '<input type="hidden" name="menuOrder" value=""><input class="submit" type="submit" value="'. i18n_r("SAVE_MENU_ORDER").'" />';
					echo '</form>';
				} else {
					echo '<p>'.i18n_r('NO_MENU_PAGES').'.</p>';	
				}
			?>
			
			<script>
				$("#menu-order").sortable({
					cursor: 'move',
					placeholder: "placeholder-menu",
					update: function() {
						var order = '';
						$('#menu-order li').each(function(index) {
							var cat = $(this).attr('rel');
							order = order+','+cat;
						});
						$('[name=menuOrder]').val(order);
					}
				});
				$("#menu-order").disableSelection();
			</script>
			
		</div>
	</div>
	
	<div id="sidebar" >
		<?php include('template/sidebar-pages.php'); ?>
	</div>

</div>
<?php get_template('footer'); ?>
