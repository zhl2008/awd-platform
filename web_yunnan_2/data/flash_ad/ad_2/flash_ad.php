<script language='javascript'>
linkarr = new Array();
picarr = new Array();
textarr = new Array();
var swf_width=<?php echo isset($rel_info[0]['flash_width'])?$rel_info[0]['flash_width']:950;?>;
var swf_height=<?php echo isset($rel_info[0]['flash_height'])?$rel_info[0]['flash_height']:200;?>;
var text_height=0;
var files = "";
var links = "";
var texts = "";
//这里设置调用标记
<?php
if(!empty($rel)){
foreach($rel as $key=>$v){
$key=$key+1;
?>
linkarr[<?php echo $key;?>] = "<?php echo $v['pic_url'];?>";
picarr[<?php echo $key;?>]  = "<?php echo CMS_SELF.'upload/'.$v['pic'];?>";
<?php
}
}
?>
for(i=1;i<picarr.length;i++){
  if(files=="") files = picarr[i];
  else files += "|"+picarr[i];
}
for(i=1;i<linkarr.length;i++){
  if(links=="") links = linkarr[i];
  else links += "|"+linkarr[i];
}
for(i=1;i<textarr.length;i++){
  if(texts=="") texts = textarr[i];
  else texts += "|"+textarr[i];
}
document.write('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="'+ swf_width +'" height="'+ swf_height +'">');
document.write('<param name="movie" value="<?php echo CMS_SELF;?>data/flash_ad/ad_2/bcastr.swf"><param name="quality" value="high">');
document.write('<param name="menu" value="false"><param name=wmode value="opaque">');
document.write('<param name="FlashVars" value="pics='+files+'&links='+links+'&texts='+texts+'&borderwidth='+swf_width+'&borderheight='+swf_height+'&textheight='+text_height+'">');
document.write('<embed src="<?php echo CMS_SELF;?>data/flash_ad/ad_2/bcastr.swf" wmode="opaque" FlashVars="pics='+files+'&links='+links+'&texts='+texts+'&borderwidth='+swf_width+'&borderheight='+swf_height+'&textheight='+text_height+'" menu="false" quality="high" width="'+ swf_width +'" height="'+ swf_height +'" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />'); document.write('</object>'); 
</script>