<?php


// Setup inclusions
$load['plugin'] = true;

// Include common.php
include('inc/common.php');

// Variable settings
$userid = login_cookie_check();

// Get passed variables
$id    = isset($_GET['id'])    ? var_out( $_GET['id']    ): null;
$uri   = isset($_GET['uri'])   ? var_out( $_GET['uri']   ): null; 
$ptype = isset($_GET['type'])  ? var_out( $_GET['type']  ): null;    
$nonce = isset($_GET['nonce']) ? var_out( $_GET['nonce'] ): null;
$path  = GSDATAPAGESPATH;

// Page variables reset
$theme_templates = ''; 
$parents_list = ''; 
$keytags = '';
$parent = '';
$template = '';
$menuStatus = ''; 
$private = ''; 
$menu = ''; 
$content = '';
$author = '';
$title = '';
$url = '';
$metak = '';
$metad = '';

if ($id){
	// get saved page data
	$file = $id .'.xml';
	
	if (!file_exists($path . $file)){ 
		redirect('pages.php?error='.urlencode(i18n_r('PAGE_NOTEXIST')));
	}

	$data_edit = getXML($path . $file);
	$title = stripslashes($data_edit->title);
	$pubDate = $data_edit->pubDate;
	$metak = stripslashes($data_edit->meta);
	$metad = stripslashes($data_edit->metad);
	$url = $data_edit->url;
	$content = stripslashes($data_edit->content);
	$template = $data_edit->template;
	$parent = $data_edit->parent;
	$author = $data_edit->author;
	$menu = stripslashes($data_edit->menu);
	$private = $data_edit->private;
	$menuStatus = $data_edit->menuStatus;
	$menuOrder = $data_edit->menuOrder;
	$buttonname = i18n_r('BTN_SAVEUPDATES');
} else {
	// prefill fields is provided
	$title      =  isset( $_GET['title']      ) ? var_out( $_GET['title']      ) : '';
	$template   =  isset( $_GET['template']   ) ? var_out( $_GET['template']   ) : '';
	$parent     =  isset( $_GET['parent']     ) ? var_out( $_GET['parent']     ) : '';
	$menu       =  isset( $_GET['menu']       ) ? var_out( $_GET['menu']       ) : '';
	$private    =  isset( $_GET['private']    ) ? var_out( $_GET['private']    ) : '';
	$menuStatus =  isset( $_GET['menuStatus'] ) ? var_out( $_GET['menuStatus'] ) : '';
	$menuOrder  =  isset( $_GET['menuOrder']  ) ? var_out( $_GET['menuOrder']  ) : '';
	$buttonname =  i18n_r('BTN_SAVEPAGE');
}


// MAKE SELECT BOX OF AVAILABLE TEMPLATES
if ($template == '') { $template = 'template.php'; }

$themes_path = GSTHEMESPATH . $TEMPLATE;
$themes_handle = opendir($themes_path) or die("Unable to open ". GSTHEMESPATH);		
while ($file = readdir($themes_handle))	{		
	if( isFile($file, $themes_path, 'php') ) {		
		if ($file != 'functions.php' && substr(strtolower($file),-8) !='.inc.php' && substr($file,0,1)!=='.') {		
      $templates[] = $file;		
    }		
	}		
}		
		
sort($templates);
//var_dump($themes_path);
//var_dump($templates);
foreach ($templates as $file){
	if ($template == $file)	{ 
		$sel="selected"; 
	} else{ 
		$sel=""; 
	}
	
	if ($file == 'template.php'){ 
		$templatename=i18n_r('DEFAULT_TEMPLATE'); 
	} else { 
		$templatename=$file;
	}
	
	$theme_templates .= '<option '.$sel.' value="'.$file.'" >'.$templatename.'</option>';
}

// SETUP CHECKBOXES
$sel_m = ($menuStatus != '') ? 'checked' : '' ;
$sel_p = ($private == 'Y') ? 'selected' : '' ;
if ($menu == '') { $menu = $title; } 

get_template('header', cl($SITENAME).' &raquo; '.i18n_r('EDIT').' '.$title); 

?>

<noscript><style>#metadata_window {display:block !important} </style></noscript>

<?php include('template/include-nav.php'); ?>

<div class="bodycontent clearfix">
	
	<div id="maincontent">
		<div class="main">
		
		<h3 class="floated"><?php if(isset($data_edit)) { i18n('PAGE_EDIT_MODE'); } else { i18n('CREATE_NEW_PAGE'); } ?></h3>	

		<!-- pill edit navigation -->
		<div class="edit-nav" >
			<?php 
			if(isset($id)) {
				echo '<a href="', find_url($url, $parent) ,'" target="_blank" accesskey="', find_accesskey(i18n_r('VIEW')), '" >', i18n_r('VIEW'), ' </a>';
			} 
			?>
			<a href="#" id="metadata_toggle" accesskey="<?php echo find_accesskey(i18n_r('PAGE_OPTIONS'));?>" ><?php i18n('PAGE_OPTIONS'); ?></a>
			<div class="clear" ></div>
		</div>	
			
		<form class="largeform" id="editform" action="changedata.php" method="post" accept-charset="utf-8" >
			<input id="nonce" name="nonce" type="hidden" value="<?php echo get_nonce("edit", "edit.php"); ?>" />			
			<input id="author" name="post-author" type="hidden" value="<?php echo $USR; ?>" />	

			<!-- page title toggle screen -->
			<p id="edit_window">
				<label for="post-title" style="display:none;"><?php i18n('PAGE_TITLE'); ?></label>
				<input class="text title" id="post-title" name="post-title" type="text" value="<?php echo $title; ?>" placeholder="<?php i18n('PAGE_TITLE'); ?>" />
			</p>
				

			<!-- metadata toggle screen -->
			<div style="display:none;" id="metadata_window" >
			<div class="leftopt">
				<p class="inline clearfix" id="post-private-wrap" >
					<label for="post-private" ><?php i18n('KEEP_PRIVATE'); ?>: &nbsp; </label>
					<select id="post-private" name="post-private" class="text autowidth" >
						<option value="" ><?php i18n('NORMAL'); ?></option>
						<option value="Y" <?php echo $sel_p; ?> ><?php echo ucwords(i18n_r('PRIVATE_SUBTITLE')); ?></option>
					</select>
				</p>
				<p class="inline clearfix" >
					<label for="post-parent"><?php i18n('PARENT_PAGE'); ?>:</label>
					<select class="text autowidth" id="post-parent" name="post-parent"> 
						<?php 
						getPagesXmlValues();
						$count = 0;
						foreach ($pagesArray as $page) {
							if ($page['parent'] != '') { 
								$parentTitle = returnPageField($page['parent'], "title");
								$sort = $parentTitle .' '. $page['title'];
							} else {
								$sort = $page['title'];
							}
							$page = array_merge($page, array('sort' => $sort));
							$pagesArray_tmp[$count] = $page;
							$count++;
						}
						// $pagesArray = $pagesArray_tmp;
						$pagesSorted = subval_sort($pagesArray_tmp,'sort');
						$ret=get_pages_menu_dropdown('','',0);
						$ret=str_replace('value="'.$id.'"', 'value="'.$id.'" disabled', $ret);
						
						// handle 'no parents' correctly
						if ($parent == '') { 
							$none='selected';
							$noneText='< '.i18n_r('NO_PARENT').' >'; 
						} else { 
							$none=null; 
							$noneText='< '.i18n_r('NO_PARENT').' >'; 
						}
						
						// Create base option
						echo '<option '.$none.' value="" >'.$noneText.'</option>';
						echo $ret;
						?>
					</select>
				</p>			
				<p class="inline clearfix" >
					<label for="post-template"><?php i18n('TEMPLATE'); ?>:</label>
					<select class="text autowidth" id="post-template" name="post-template" >
						<?php echo $theme_templates; ?>
					</select>
				</p>
				
				<p class="inline post-menu clearfix">
					<input type="checkbox" id="post-menu-enable" name="post-menu-enable" <?php echo $sel_m; ?> />&nbsp;&nbsp;&nbsp;<label for="post-menu-enable" ><?php i18n('ADD_TO_MENU'); ?></label><a href="navigation.php" class="viewlink" rel="facybox" ><img src="template/images/search.png" id="tick" alt="<?php echo strip_tags(i18n_r('VIEW')); ?>" /></a>
				</p>
				<div id="menu-items">
					<img src="template/images/tick.png" id="tick" />
					<span style="float:left;width:81%;" ><label for="post-menu"><?php i18n('MENU_TEXT'); ?></label></span><span style="float:left;width:10%;" ><label for="post-menu-order"><?php i18n('PRIORITY'); ?></label></span>
					<div class="clear"></div>
					<input class="text" style="width:73%;" id="post-menu" name="post-menu" type="text" value="<?php echo $menu; ?>" />&nbsp;&nbsp;&nbsp;&nbsp;<select class="text"  style="width:16%" id="post-menu-order" name="post-menu-order" >
					<?php if(isset($menuOrder)) { 
						if($menuOrder == 0) {
							echo '<option value="" selected>-</option>'; 
						} else {
							echo '<option value="'.$menuOrder.'" selected>'.$menuOrder.'</option>'; 
						}
					} ?>
						<option value="">-</option>
						<?php
						$i = 1;
						while ($i <= 30) { 
							echo '<option value="'.$i.'">'.$i.'</option>';
							$i++;
						}
						?>
					</select>
				</div>				
			</div>
			
			<div class="rightopt">
				<p>
					<label for="post-id"><?php i18n('SLUG_URL'); ?>:</label>
					<input class="text short" type="text" id="post-id" name="post-id" value="<?php echo $url; ?>" <?php echo ($url=='index'?'readonly="readonly" ':''); ?>/>
				</p>
				<p>
					<label for="post-metak"><?php i18n('TAG_KEYWORDS'); ?>:</label>
					<input class="text short" id="post-metak" name="post-metak" type="text" value="<?php echo $metak; ?>" />
				</p>
				<p>
					<label for="post-metad" class="clearfix"><?php i18n('META_DESC'); ?>: <span id="countdownwrap"><strong id="countdown" ></strong> <?php i18n('REMAINING'); ?></span></label>
					<textarea class="text" id="post-metad" name="post-metad" ><?php echo $metad; ?></textarea>
				</p>
				

			</div>
			<div class="clear"></div>
			<?php exec_action('edit-extras'); ?>		

			</div>	<!-- / metadata toggle screen -->
				
		
			<!-- page body -->
			<p>
				<label for="post-content" style="display:none;"><?php i18n('LABEL_PAGEBODY'); ?></label>
				<textarea id="post-content" name="post-content"><?php echo $content; ?></textarea>
			</p>
			
			<?php exec_action('edit-content'); ?> 
			
			<?php if(isset($data_edit)) { 
				echo '<input type="hidden" name="existing-url" value="'. $url .'" />'; 
			} ?>	
			
			<span class="editing"><?php echo i18n_r('EDITPAGE_TITLE') .': ' . $title; ?></span>
			<div id="submit_line" >
				<input type="hidden" name="redirectto" value="" />
				
				<span><input id="page_submit" class="submit" type="submit" name="submitted" value="<?php echo $buttonname; ?>" /></span>
				
				<div id="dropdown">
					<h6 class="dropdownaction"><?php i18n('ADDITIONAL_ACTIONS'); ?></h6>
					<ul class="dropdownmenu">
						<li id="save-close" ><a href="#" ><?php i18n('SAVE_AND_CLOSE'); ?></a></li>
						<?php if($url != '') { ?>
							<li><a href="pages.php?id=<?php echo $url; ?>&amp;action=clone&amp;nonce=<?php echo get_nonce("clone","pages.php"); ?>" ><?php i18n('CLONE'); ?></a></li>
						<?php } ?>
						<li id="cancel-updates" class="alertme"><a href="pages.php?cancel" ><?php i18n('CANCEL'); ?></a></li>
						<?php if($url != 'index' && $url != '') { ?>
							<li class="alertme" ><a href="deletefile.php?id=<?php echo $url; ?>&amp;nonce=<?php echo get_nonce("delete","deletefile.php"); ?>" ><?php echo strip_tags(i18n_r('ASK_DELETE')); ?></a></li>
						<?php } ?>
					</ul>
				</div>
				
			</div>
			
			<?php if($url != '') { ?>
				<p class="backuplink" ><?php 
					if (isset($pubDate)) { 
						echo sprintf(i18n_r('LAST_SAVED'), '<em>'.$author.'</em>').' '. lngDate($pubDate).'&nbsp;&nbsp; ';
					}
					if ( file_exists(GSBACKUPSPATH.'pages/'.$url.'.bak.xml') ) {	
						echo '&bull;&nbsp;&nbsp; <a href="backup-edit.php?p=view&amp;id='.$url.'" target="_blank" >'.i18n_r('BACKUP_AVAILABLE').'</a>';
					} 
				?></p>
			<?php } ?>
			
		</form>
		
		<?php 

			if(isset($EDTOOL)) $EDTOOL = returnJsArray($EDTOOL);
			if(isset($toolbar)) $toolbar = returnJsArray($toolbar); // handle plugins that corrupt this

			else if(strpos(trim($EDTOOL),'[[')!==0 && strpos(trim($EDTOOL),'[')===0){ $EDTOOL = "[$EDTOOL]"; }

			if(isset($toolbar) && strpos(trim($toolbar),'[[')!==0 && strpos($toolbar,'[')===0){ $toolbar = "[$toolbar]"; }
			$toolbar = isset($EDTOOL) ? ",toolbar: ".trim($EDTOOL,",") : '';
			$options = isset($EDOPTIONS) ? ','.trim($EDOPTIONS,",") : '';

		?>
		<?php if ($HTMLEDITOR != '') { ?>
		<script type="text/javascript" src="template/js/ckeditor/ckeditor.js<?php echo getDef("GSCKETSTAMP",true) ? "?t=".getDef("GSCKETSTAMP") : ""; ?>"></script>

			<script type="text/javascript">
			<?php if(getDef("GSCKETSTAMP",true)) echo "CKEDITOR.timestamp = '".getDef("GSCKETSTAMP") . "';\n"; ?>
			var editor = CKEDITOR.replace( 'post-content', {
					skin : 'getsimple',
					forcePasteAsPlainText : true,
					language : '<?php echo $EDLANG; ?>',
					defaultLanguage : 'en',
					<?php if (file_exists(GSTHEMESPATH .$TEMPLATE."/editor.css")) { 
						$fullpath = suggest_site_path();
						?>
						contentsCss: '<?php echo $fullpath; ?>theme/<?php echo $TEMPLATE; ?>/editor.css',
					<?php } ?>
					entities : false,
					// uiColor : '#FFFFFF',
					height: '<?php echo $EDHEIGHT; ?>',
					baseHref : '<?php echo $SITEURL; ?>',
					tabSpaces:10,
					filebrowserBrowseUrl : 'filebrowser.php?type=all',
					filebrowserImageBrowseUrl : 'filebrowser.php?type=images',
					filebrowserWindowWidth : '730',
					filebrowserWindowHeight : '500'
					<?php echo $toolbar; ?>
					<?php echo $options; ?>					
			});

			CKEDITOR.instances["post-content"].on("instanceReady", InstanceReadyEvent);

			function InstanceReadyEvent(ev) {
				_this = this;

				this.document.on("keyup", function () {
					$('#editform #post-content').trigger('change');
					_this.resetDirty();
				});

			    this.timer = setInterval(function(){trackChanges(_this)},500);
			}		

			/**
			 * keep track of changes for editor
			 * until cke 4.2 is released with onchange event
			 */
			function trackChanges(editor) {
				// console.log('check changes');
				if ( editor.checkDirty() ) {
					$('#editform #post-content').trigger('change');
					editor.resetDirty();			
				}
			};

			</script>
			
			<?php
				# CKEditor setup functions
				ckeditor_add_page_link();
				exec_action('html-editor-init'); 
			?>
			
		<?php } ?>
		
		
		
		<script type="text/javascript">
			/* Warning for unsaved Data */
			var yourText = null;
			var warnme = false;
			var pageisdirty = false;
			
			$('#cancel-updates').hide();
	
			window.onbeforeunload = function () {
				if (warnme || pageisdirty == true) {
					return "<?php i18n('UNSAVED_INFORMATION'); ?>";
				}
			}
			
			$('#editform').submit(function(){
				warnme = false;
				return checkTitle();
			});

			checkTitle = function(){
				if($.trim($("#post-title").val()).length == 0){
					alert("<?php i18n('CANNOT_SAVE_EMPTY'); ?>");
					return false;
				}					
			}

			jQuery(document).ready(function() { 

			<?php if (defined('GSAUTOSAVE') && (int)GSAUTOSAVE != 0) { /* IF AUTOSAVE IS TURNED ON via GSCONFIG.PHP */ ?>	

					$('#pagechangednotify').hide();
					$('#autosavenotify').show();
					$('#autosavenotify').html('Autosaving is <b>ON</b> (<?php echo (int)GSAUTOSAVE; ?> s)');   		    	
					
					function autoSaveIntvl(){
						// console.log('autoSaveIntvl called, isdirty:' + pageisdirty);
						if(pageisdirty == true){
							autoSave();
							pageisdirty = false;
						}						
					}
					
					function autoSave() {
						$('input[type=submit]').attr('disabled', 'disabled');

						// we are using ajax, so ckeditor wont copy data to our textarea for us, so we do it manually
						if(typeof(editor)!='undefined'){ $('#post-content').val(CKEDITOR.instances["post-content"].getData()); }
						
						var dataString = $("#editform").serialize();
						
						// not internalionalized or using GS date format!
						var currentTime = new Date();
						var hours = currentTime.getHours();
						var minutes = currentTime.getMinutes();
						if (minutes < 10){ minutes = "0" + minutes; }
						if(hours > 11){ daypart = "PM";	} else {	daypart = "AM";	}
						if(hours > 12){ hours-=12; }
						
						$.ajax({
							type: "POST",
							url: "changedata.php",
							data: dataString+'&autosave=true&submitted=true',
							success: function(msg) {
								if (msg.toString()=='OK') {
									$('#autosavenotify').text("<?php i18n('AUTOSAVE_NOTIFY'); ?> "+ hours +":"+minutes+" "+daypart);
									$('#pagechangednotify').hide();
									$('#pagechangednotify').text('');                    
									$('input[type=submit]').attr('disabled', false);
									$('input[type=submit]').css('border-color','#ABABAB');
									warnme = false;
									$('#cancel-updates').hide();
								}
								else {
									pageisdirty=true;
									$('#autosavenotify').text("<?php i18n('AUTOSAVE_FAILED'); ?>");                
								}
							}
						});	
					}
					
					// We register title and slug changes with change() which only fires when you lose focus to prevent midchange saves.
					$('#post-title, #post-id').change(function () {
							$('#editform #post-content').trigger('change');
				  });					
					
					// We register all other form elements to detect changes of any type by using bind
					$('#editform input,#editform textarea,#editform select').not('#post-title').not('#post-id').bind('change keypress paste textInput input',function(){
							pageisdirty = true;
							warnme = true;
							autoSaveInd();
					});
				
				setInterval(autoSaveIntvl, <?php echo (int)GSAUTOSAVE*1000; ?>);
				
				<?php } else { /* AUTOSAVE IS NOT TURNED ON */ ?>
					$('#editform').bind('change keypress paste focus textInput input',function(){					
							warnme = true;
							pageisdirty = false;
							autoSaveInd();
					});
					<?php } ?>
					
					function autoSaveInd(){
							$('#pagechangednotify').show();                
							$('#pagechangednotify').text("<?php i18n('PAGE_UNSAVED')?>");  
							$('input[type=submit]').css('border-color','#CC0000');              
							$('#cancel-updates').show();						
					}
			});
		</script>
	</div>
	</div><!-- end maincontent -->
	
	
	<div id="sidebar" >
		<?php include('template/sidebar-pages.php'); ?>	
	</div>

</div>
<?php get_template('footer'); ?>
