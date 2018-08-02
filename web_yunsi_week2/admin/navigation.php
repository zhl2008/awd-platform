<?php 


# Setup
$load['plugin'] = true;
include('inc/common.php');

# get pages
getPagesXmlValues();
$pagesSorted = subval_sort($pagesArray,'menuOrder');

global $LANG; $LANG_header = preg_replace('/(?:(?<=([a-z]{2}))).*/', '', $LANG);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Share Website</title>
	<style>
		.navigate {
			padding:20px;
			width:400px;
			background:#f6f6f6;
		}
		table {border-collapse:collapse;font-family:arial;font-size:12px;margin:0;color:#333;width:100%;}
		td, th {padding:5px 20px 5px 5px;text-shadow:1px 1px 0 #fff;}
		tr th {text-align:left;font-size:11px;text-transform:uppercase;color:#666;border-bottom:1px dotted #ccc;}
		h1 {font-size:18px;color:#111;margin:0 0 20px;font-family:georgia, garamond;font-weight:normal;text-shadow:1px 1px 0 #fff;}
		p.edit {text-align:right;margin-top:15px;color:#666;}
		p a:link, p a:visited {color:#CF3805;font-weight:bold;text-decoration:underline}
		p a:focus, p a:hover {color:#333;font-weight:bold;text-decoration:underline}
	</style>
</head>
<body>
	<div class="navigate">
	<?php
		if (count($pagesSorted) != 0) { 
			echo '<h1>'.i18n_r('CURRENT_MENU').'</h1>
			<table>';
			echo '<tr ><th>'.i18n_r('PRIORITY').'</th><th>'.i18n_r('MENU_TEXT').'</th><th>'.i18n_r('PAGE_TITLE').'</th></tr>';
			foreach ($pagesSorted as $page) {
				$sel = '';
				if ($page['menuStatus'] != '') { 
					
					if ($page['menuOrder'] == '') { 
						$page['menuOrder'] = "N/A"; 
					} 
					if ($page['menu'] == '') { 
						$page['menu'] = $page['title']; 
					}
					echo '<tr>
					<td><strong>#'.$page['menuOrder'].'</strong></td>
					<td>'. $page['menu'] .'</td>
					<td>'. $page['title'] .'</td>
					</tr>';
				}
			}
			echo '</table>';
		} else {
			echo '<p>'.i18n_r('NO_MENU_PAGES').'.</p>';	
		}
						
	?>
	<p class="edit"><a href="menu-manager.php" target="_blank" ><?php echo str_replace(array('<em>','</em>'), '', i18n_r('MENU_MANAGER')); ?> &raquo;</a></p>
	</div>
</body>
</html>