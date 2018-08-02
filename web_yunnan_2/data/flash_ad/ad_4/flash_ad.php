<?php
$xml='<?xml version="1.0" encoding="utf-8"?>';
$xml.='<bcaster autoPlayTime="3">';
if(!empty($rel)){
foreach($rel as $k=>$v){
	$xml.='<item item_url="'.CMS_SELF.'upload/'.$v['pic'].'" link="'.$v['pic_url'].'" itemtitle=""></item>';
}	
}
$xml.='</bcaster>';
$xml_file=DATA_PATH.'flash_ad/ad_4/flash_'.$lang.'.xml';
$xml_use=CMS_SELF.'data/flash_ad/ad_4/flash_'.$lang.'.xml';
@file_put_contents($xml_file,$xml);
?>
    <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" id=scriptmain name=scriptmain codebase="http://download.macromedia.com/pub/shockwave/cabs/
flash/swflash.cab#version=6,0,29,0" width="<?php echo isset($rel_info[0]['flash_width'])?$rel_info[0]['flash_width']:950;?>" height="<?php echo isset($rel_info[0]['flash_height'])?$rel_info[0]['flash_height']:200;?>">
      <param name="movie" value="<?php echo CMS_SELF;?>data/flash_ad/ad_4/bcastr.swf?bcastr_xml_url=<?php echo $xml_use;?>">
      <param name="quality" value="high">
      <param name=scale value=noscale>
      <param name="LOOP" value="false">
      <param name="menu" value="false">
      <param name="wmode" value="transparent">
      <embed src="<?php echo CMS_SELF;?>data/flash_ad/ad_4/bcastr.swf?bcastr_xml_url=<?php echo $xml_use;?>" width="<?php echo isset($rel_info[0]['flash_width'])?$rel_info[0]['flash_width']:950;?>" height="<?php echo isset($rel_info[0]['flash_height'])?$rel_info[0]['flash_height']:200;?>" loop="false" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" salign="T" name="scriptmain" menu="false" wmode="transparent"></embed>
    </object>