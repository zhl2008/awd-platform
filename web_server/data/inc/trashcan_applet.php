<?php
//Make sure the file isn't accessed directly.
defined('IN_CMS') or exit('Access denied!');

//Count items in trashcan
$trashcan_items = count_trashcan();

//Define which image we have to display, a full trashcan or an empty one
if ($trashcan_items == '0')
	$trash_image = 'trash.png';
else
	$trash_image = 'trash-full.png';
?>
<li>
	<a href="?action=trashcan"><img src="data/image/<?php echo $trash_image; ?>" alt="<?php echo $lang['trashcan']['title'] ?>" title="<?php echo $lang['trashcan']['title']; ?>" />
	<?php echo $trashcan_items; ?> <?php echo $lang['trashcan']['items_in_trash']; ?>
	</a>
</li>
