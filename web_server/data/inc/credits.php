<?php
//Make sure the file isn't accessed directly.
defined('IN_CMS') or exit('Access denied!');
?>

<p>
	<span class="kop2"><?php echo $lang['credits']['developers']; ?></span>
	Thanks HeartSky and c014

</p>
<?php
//Translation
//-----------
//First determine who's the translator
switch($langpref) {
	case 'bg.php':
		$translator = 'Aleksander Dimov';
		break;
	case 'ca.php':
		$translator = 'Cesc Llopart';
		break;
	case 'da.php':
		$translator = 'Thomas Andresen<br />Lone Hansen';
		break;
	case 'de.php':
		$translator = 'Max Effenberger<br />Dennis Sewberath<br />stoffal';
		break;
	case 'el.php':
		$translator = 'swiss_blade';
		break;
	case 'es.php':
		$translator = 'Cesc Llopart';
		break;
	case 'fa.php':
		$translator = 'heam';
		break;
	case 'fi.php':
		$translator = 'maxtuska';
		break;
	case 'fr.php':
		$translator = 'zigzagbe<br />Dominique Heimler';
		break;
	case 'he.php':
		$translator = 'Erez Wolf';
		break;
	case 'hr.php':
		$translator = 'atghoust';
		break;
	case 'hu.php':
		$translator = 'Wix';
		break;
	case 'it.php':
		$translator = 'Skc';
		break;
	case 'ja.php':
		$translator = 'Shi-no';
		break;
	case 'lt.php':
		$translator = 'Mindaugas Salamachinas';
		break;
	case 'lv.php':
		$translator = 'Munky';
		break;
	case 'nl.php':
		$translator = 'Sander Thijsen';
		break;
	case 'no.php':
		$translator = 'John Erik Kristensen';
		break;
	case 'pl.php':
		$translator = 'Leszek Soltys<br />Bogumił Cieniek';
		break;
	case 'pt.php':
		$translator = 'Marco Paulo Ferreira<br />Hélio Carrasqueira';
		break;
	case 'pt_br.php':
		$translator = 'Gilnei Moraes<br />Henrique Gogó<br />sarkioja';
		break;
	case 'ro.php':
		$translator = 'Adi Roiban';
		break;
	case 'ru.php':
		$translator = 'Tkachev Vasily<br />Sergey Shutov';
		break;
	case 'sk.php':
		$translator = 'greppi';
		break;
	case 'sl.php':
		$translator = 'Evelina';
		break;
	case 'sv.php':
		$translator = 'Carl Jansson';
		break;
	case 'th.php':
		$translator = 'meandev';
		break;
	case 'tr.php':
		$translator = 'Gürkan Gür';
		break;
	case 'zh-cn.php':
		$translator = '';
		break;
	case 'zh-tw.php':
		$translator = '';
		break;
}

//Then display, if language is not English
if ($langpref != 'en.php') {
?>
	<p>
		<span class="kop2"><?php echo $lang['credits']['translation'].' ('.$language.')'; ?></span>
		<?php echo $translator; ?>
	</p>
<?php
}
?>
