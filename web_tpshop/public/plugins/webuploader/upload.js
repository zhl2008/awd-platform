$(function() {

	var $wrap = $('#uploader'),

		// 图片容器
		$queue = $( '<ul class="filelist"></ul>' ).appendTo( $wrap.find( '.queueList' ) ),

		// 状态栏，包括进度和控制按钮
		$statusBar = $wrap.find( '.statusBar' ),

		// 文件总体选择信息。
		$info = $statusBar.find( '.info' ),

		// 上传按钮
		$upload = $wrap.find( '.uploadBtn' ),

		// 没选择文件之前的内容。
		$placeHolder = $wrap.find( '.placeholder' ),

		$progress = $statusBar.find( '.progress' ).hide(),

		// 添加的文件数量
		fileCount = 0,

		// 添加的文件总大小
		fileSize = 0,

		// 优化retina, 在retina下这个值是2
		ratio = window.devicePixelRatio || 1,

		// 缩略图大小
		thumbnailWidth = 110 * ratio,
		thumbnailHeight = 110 * ratio,

		// 可能有pedding, ready, uploading, confirm, done.
		state = 'pedding',

		// 所有文件的进度信息，key为file id
		percentages = {},
		// 判断浏览器是否支持图片的base64
		isSupportBase64 = ( function() {
			var data = new Image();
			var support = true;
			data.onload = data.onerror = function() {
				if( this.width != 1 || this.height != 1 ) {
					support = false;
				}
			}
			data.src = "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";
			return support;
		} )(),

		// 检测是否已经安装flash，检测flash的版本
		flashVersion = ( function() {
			var version;

			try {
				version = navigator.plugins[ 'Shockwave Flash' ];
				version = version.description;
			} catch ( ex ) {
				try {
					version = new ActiveXObject('ShockwaveFlash.ShockwaveFlash').GetVariable('$version');
				} catch ( ex2 ) {
					version = '0.0';
				}
			}
			version = version.match( /\d+/g );
			return parseFloat( version[ 0 ] + '.' + version[ 1 ], 10 );
		} )(),

		supportTransition = (function(){
			var s = document.createElement('p').style,
				r = 'transition' in s ||
						'WebkitTransition' in s ||
						'MozTransition' in s ||
						'msTransition' in s ||
						'OTransition' in s;
			s = null;
			return r;
		})(),

		// WebUploader实例
		uploader;

	if ( !WebUploader.Uploader.support('flash') && WebUploader.browser.ie ) {
		// flash 安装了但是版本过低。
		if (flashVersion) {
			(function(container) {
				window['expressinstallcallback'] = function( state ) {
					switch(state) {
						case 'Download.Cancelled':
							alert('您取消了更新！')
							break;

						case 'Download.Failed':
							alert('安装失败')
							break;

						default:
							alert('安装已成功，请刷新！');
							break;
					}
					delete window['expressinstallcallback'];
				};

				var swf = 'js/expressInstall.swf';
				// insert flash object
				var html = '<object type="application/x-shockwave-flash" data="' +  swf + '" ';

				if (WebUploader.browser.ie) {
					html += 'classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" ';
				}

				html += 'width="100%" height="100%" style="outline:0">'  +
					'<param name="movie" value="' + swf + '" />' +
					'<param name="wmode" value="transparent" />' +
					'<param name="allowscriptaccess" value="always" /></object>';

				container.html(html);

			})($wrap);

		// 压根就没有安转。
		} else {
			$wrap.html('<a href="http://www.adobe.com/go/getflashplayer" target="_blank" border="0"><img alt="get flash player" src="http://www.adobe.com/macromedia/style_guide/images/160x41_Get_Flash_Player.jpg" /></a>');
		}

		return;
	} else if (!WebUploader.Uploader.support()) {
		alert( '您的浏览器不支持上传！');
		return;
	}


	function updateStatus() {
		var text = '', stats;
		if ( state === 'ready' ) {
			text = '选中' + fileCount + '张图片，共' + WebUploader.formatSize( fileSize ) + '。';
		} else if ( state === 'confirm' ) {
			stats = uploader.getStats();
			if ( stats.uploadFailNum ) {
				text = '已成功上传' + stats.successNum+ '张图片，'+
						stats.uploadFailNum + '张照片上传失败，<a class="retry" href="#">重新上传</a>失败图片或<a class="ignore" href="#">忽略</a>'
			}

		} else {
			stats = uploader.getStats();
			text = '共' + fileCount + '张（' + WebUploader.formatSize( fileSize ) + '），已上传' + fileCount + '张';

			if ( stats.uploadFailNum ) {
				text += '，失败' + stats.uploadFailNum + '张';
			}
		}

		$info.html( text );
	}

	function setState( val ) {
		var file, stats;

		if ( val === state ) {
			return;
		}

		$upload.removeClass( 'state-' + state );
		$upload.addClass( 'state-' + val );
		state = val;

		switch ( state ) {
			case 'pedding':
				$placeHolder.removeClass( 'element-invisible' );
				$queue.hide();
				$statusBar.addClass( 'element-invisible' );
				uploader.refresh();
				break;

			case 'ready':
				$placeHolder.addClass( 'element-invisible' );
				$( '#filePicker2' ).removeClass( 'element-invisible');
				$queue.show();
				$statusBar.removeClass('element-invisible');
				uploader.refresh();
				break;

			case 'uploading':
				$( '#filePicker2' ).addClass( 'element-invisible' );
				$progress.show();
				$upload.text( '暂停上传' );
				break;

			case 'paused':
				$progress.show();
				$upload.text( '继续上传' );
				break;

			case 'confirm':
				$progress.hide();
				$( '#filePicker2' ).removeClass( 'element-invisible' );
				$upload.text( '开始上传' );

				stats = uploader.getStats();
				if ( stats.successNum && !stats.uploadFailNum ) {
					setState( 'finish' );
					return;
				}
				break;
			case 'finish':
				stats = uploader.getStats();
				if ( stats.successNum ) {
					Manager.uploadComplete(uploader.fileList);
					// alert( '上传成功' );
				} else {
					// 没有成功的图片，重设
					state = 'done';
					location.reload();
				}
				break;
		}
		updateStatus();
	}


	// 根据ID获取file对象
	function getFileById(ID){
		var file;

		for(var i = 0; i < uploader.fileList.length; i++){

			if(ID == uploader.fileList[i].id){
				file = uploader.fileList[i];
			}

		};
		return file;
	}
	//根据ID删除文件
	function removeFileById( ID ) {

		var removeFile = getFileById(ID);

		uploader.removeFile(removeFile);

		delete percentages[ ID ];
		updateTotalProgress();
	}

	function updateTotalProgress() {
		var loaded = 0,
				total = 0,
				spans = $progress.children(),
				percent;

		$.each( percentages, function( k, v ) {
			total += v[ 0 ];
			loaded += v[ 0 ] * v[ 1 ];
		} );

		percent = total ? loaded / total : 0;


		spans.eq( 0 ).text( Math.round( percent * 100 ) + '%' );
		spans.eq( 1 ).css( 'width', Math.round( percent * 100 ) + '%' );
		updateStatus();
	}

	function webuploader(opts){

		var defaults = {
			swf: 'webuploader/Uploader.swf',
			server: 'fileupload.php',
			fileNumLimit: 10,
			fileSizeLimit: 50 * 1024 * 1024,    // 50 M
			fileSingleSizeLimit: 5 * 1024 * 1024,    // 5 M
			pick: {
				id: '#filePicker',
				label: '点击选择图片',
				name : 'file'
			},
			dnd: '#dndArea',
			paste: '#uploader',
			chunked: false,
			chunkSize: 512 * 1024,
			/*
			formData: {},
			accept: {
				 title: 'Images',
				 extensions: 'gif,jpg,jpeg,bmp,png,rar,zip',
				 mimeTypes: 'image/*'
			},*/
			//禁掉全局的拖拽功能。这样不会出现图片拖进页面的时候，把图片打开。
			disableGlobalDnd: true
		};

		opts = $.extend(defaults, opts);

		// 实例化
		uploader = WebUploader.create(opts);

		// 拖拽时不接受 js, txt 文件。
		uploader.on( 'dndAccept', function( items ) {
			var denied = false,
				len = items.length,
				i = 0,
				// 修改js类型
				unAllowed = 'text/plain;application/javascript ';

			for ( ; i < len; i++ ) {
				// 如果在列表里面
				if ( ~unAllowed.indexOf( items[ i ].type ) ) {
					denied = true;
					break;
				}
			}

			return !denied;
		});

		 uploader.on('filesQueued', function() {
		     uploader.sort(function( a, b ) {
		         if ( a.name < b.name )
		           return -1;
		         if ( a.name > b.name )
		           return 1;
		         return 0;
		     });
		 });

		// 添加“添加文件”的按钮，
		uploader.addButton({
			id: '#filePicker2',
			label: '继续添加',
			name : opts.pick.name
		});

		uploader.on('ready', function() {
			window.uploader = uploader;
		});

		uploader.on( 'uploadSuccess', function( file,data) {
		    $( '#'+file.id ).addClass('upload-state-done');
			if(data.state == 'SUCCESS'){
				var sLi = "";
				sLi += '<li class="img '+file.id+'">';
				sLi += '<img src="' + data.url + '" width="100" height="100" onerror="this.src=\'__ROOT__/Public/plugins/uploadify/nopic.png\'">';
				sLi += '<input type="hidden" name="fileurl_tmp[]" value="' + data.url + '">';
				sLi += '<a href="javascript:void(0);">删除</a>';
				sLi += '</li>';
				$(".fileWarp ul").append(sLi);

				$( '#'+file.id ).append('<div class="file-panel" style="height:0px;"><span class="cancel" data-img="'+data.url+'" onclick="Manager.del(this);">删除</span></div>');
				$( '#'+file.id ).hover(function(){
					$( '#'+file.id ).find('.file-panel').css('height','30px');
				},function(){
					$( '#'+file.id ).find('.file-panel').css('height','0px');
				})
			}else{
				alert(data.state);
			}
		});
		
		// 当有文件添加进来时执行，负责view的创建
		function addFile( file ) {
			uploader.fileList = uploader.fileList || [];
			uploader.fileList.push(file);
			var $li = $( '<li id="' + file.id + '">' +
					'<p class="title">' + file.name + '</p>' +
					'<p class="imgWrap"></p>'+
					'<p class="progress"><span></span></p>' +
					'</li>' ),

				$btns = $('<div class="file-panel">' +
					'<span class="cancel">删除</span>' +
					'<span class="rotateRight">向右旋转</span>' +
					'<span class="rotateLeft">向左旋转</span></div>').appendTo( $li ),
				$prgress = $li.find('p.progress span'),
				$wrap = $li.find( 'p.imgWrap' ),
				$info = $('<p class="error"></p>'),

				showError = function( code ) {
					switch( code ) {
						case 'exceed_size':
							text = '文件大小超出';
							break;

						case 'interrupt':
							text = '上传暂停';
							break;

						default:
							text = '上传失败，请重试';
							break;
					}

					$info.text( text ).appendTo( $li );
				};

			if ( file.getStatus() === 'invalid' ) {
				showError( file.statusText );
			} else {
				// @todo lazyload
				$wrap.text( '预览中' );
				uploader.makeThumb( file, function( error, src ) {
					var img;

					if ( error ) {
						$wrap.text( '没有预览图' );
						return;
					}

					if( isSupportBase64 ) {
						img = $('<img src="'+src+'">');
						$wrap.empty().append( img );
					} else {
						$.ajax("/index.php?m=Admin&c=Uploadify&a=preview", {
							method: 'POST',
							data: src,
							dataType:'json'
						}).done(function( response ) {
							if (response.result) {
								img = $('<img src="'+response.result+'">');
								$wrap.empty().append( img );
							} else {
								$wrap.text("预览出错");
							}
						});
					}
				}, thumbnailWidth, thumbnailHeight );

				percentages[ file.id ] = [ file.size, 0 ];
				file.rotation = 0;
			}

			file.on('statuschange', function( cur, prev ) {
				if ( prev === 'progress' ) {
					$prgress.hide().width(0);
				} else if ( prev === 'queued' ) {
					$li.off( 'mouseenter mouseleave' );
					$btns.remove();
				}
				// 成功
				if ( cur === 'error' || cur === 'invalid' ) {
					console.log( file.statusText );
					showError( file.statusText );
					percentages[ file.id ][ 1 ] = 1;
				} else if ( cur === 'interrupt' ) {
					showError( 'interrupt' );
				} else if ( cur === 'queued' ) {
					percentages[ file.id ][ 1 ] = 0;
				} else if ( cur === 'progress' ) {
					$info.remove();
					$prgress.css('display', 'block');
				} else if ( cur === 'complete' ) {
					$li.append( '<span class="success"></span>' );
				}

				$li.removeClass( 'state-' + prev ).addClass( 'state-' + cur );
			});

			$li.on( 'mouseenter', function() {
				$btns.stop().animate({height: 30});
			});

			$li.on( 'mouseleave', function() {
				$btns.stop().animate({height: 0});
			});

			$btns.on( 'click', 'span', function() {
				var index = $(this).index(),
					deg;

				switch ( index ) {
					case 0:
						uploader.removeFile( file );
						return;

					case 1:
						file.rotation += 90;
						break;

					case 2:
						file.rotation -= 90;
						break;
				}

				if ( supportTransition ) {
					deg = 'rotate(' + file.rotation + 'deg)';
					$wrap.css({
						'-webkit-transform': deg,
						'-mos-transform': deg,
						'-o-transform': deg,
						'transform': deg
					});
				} else {
					$wrap.css( 'filter', 'progid:DXImageTransform.Microsoft.BasicImage(rotation='+ (~~((file.rotation/90)%4 + 4)%4) +')');
					// use jquery animate to rotation
					// $({
					//     rotation: rotation
					// }).animate({
					//     rotation: file.rotation
					// }, {
					//     easing: 'linear',
					//     step: function( now ) {
					//         now = now * Math.PI / 180;

					//         var cos = Math.cos( now ),
					//             sin = Math.sin( now );

					//         $wrap.css( 'filter', "progid:DXImageTransform.Microsoft.Matrix(M11=" + cos + ",M12=" + (-sin) + ",M21=" + sin + ",M22=" + cos + ",SizingMethod='auto expand')");
					//     }
					// });
				}


			});

			$li.appendTo( $queue );
		}

		// 负责view的销毁
		function removeFile( file ) {

			var arr = [];

			for(var i = 0; i < uploader.fileList.length; i++){
			
				if(file.id != uploader.fileList[i].id) arr.push(uploader.fileList[i]);
			
			};

			uploader.fileList = arr;

			var $li = $('#'+file.id);

			delete percentages[ file.id ];

			$li.off().find('.file-panel').off().end().remove();
		}

		uploader.onUploadProgress = function( file, percentage ) {
			var $li = $('#'+file.id),
				$percent = $li.find('.progress span');

			$percent.css( 'width', percentage * 100 + '%' );
			percentages[ file.id ][ 1 ] = percentage;
			updateTotalProgress();
		};

		uploader.onFileQueued = function( file ) {
			fileCount++;
			fileSize += file.size;

			if ( fileCount === 1 ) {
				$placeHolder.addClass( 'element-invisible' );
				$statusBar.show();
			}

			addFile( file );
			setState( 'ready' );
			updateTotalProgress();
		};

		uploader.onFileDequeued = function( file ) {
			fileCount--;
			fileSize -= file.size;

			if ( !fileCount ) {
				setState( 'pedding' );
			}

			removeFile( file );
			updateTotalProgress();

		};

		uploader.on( 'all', function( type ) {
			var stats;
			switch( type ) {
				case 'uploadFinished':
					setState( 'confirm' );
					break;

				case 'startUpload':
					setState( 'uploading' );
					break;

				case 'stopUpload':
					setState( 'paused' );
					break;

			}
		});

		uploader.onError = function( code ) {
			alert( '提示: ' + code );
		};

		$upload.on('click', function() {
			if ( $(this).hasClass( 'disabled' ) ) {
				return false;
			}

			if ( state === 'ready' ) {
				uploader.upload();
			} else if ( state === 'paused' ) {
				uploader.upload();
			} else if ( state === 'uploading' ) {
				uploader.stop();
			}
		});

		$info.on( 'click', '.retry', function() {
			uploader.retry();
		} );

		$info.on( 'click', '.ignore', function() {
			alert( '请检查上传配置以及上传目录写入权限' );
		} );

		$upload.addClass( 'state-' + state );
		
		updateTotalProgress();

	};

	window.Manager = {

		init : function(){

			var __self = this;

			var $manageArea = $('#manage_area'),$searchArea = $('#search_area');
		
			$('#upload_tab,#manage_tab,#search_tab').click(function(){
			
				var $this = $(this), 
					
					$par = $this.parent(), 
						
					id = $this.attr('id'),
						
					$curArea = $('div.area-checked'),
						
					$now;

				if($this.hasClass('checked')) return;

				$par.find('li.checked').removeClass('checked');

				$this.addClass('checked');

				if(id == 'upload_tab') $now = $('#upload_area');

				else if(id == 'manage_tab'){

					Manager.showList();
					
					$now = $manageArea;

				}else{
					
					Manager.showSearch();
					
					$now = $searchArea;

				}

				$curArea.fadeOut('fast', function(){

					$curArea.removeClass('area-checked');
				
					$now.fadeIn('fast').addClass('area-checked');
				
				});
			
			});

			$('ul.choose-btns > li.sure').click(function(){
			
				var $checkedFile = $(this).parents('div.area').find('div.file-list li.checked');

				if($checkedFile.length < 1){
				
					alert('请选择文件');
				
				}else {
					__self.sure($checkedFile);
				}
			
			});

			$('ul.choose-btns > li.cancel').click(function(){

				__self.cancel();
			
			});

			$searchArea.find('input.submit').click(function(){
			
				var key = $(this).prev('input:text').val();

				__self.showSearch(key);
			
			});

			$searchArea.find('input.key').keyup(function(e){

				if(e.keyCode == 13) $(this).next('input.submit').click();
			
			});
		
		},

		upload : function(opts){
		
			this.opts = opts, par = window.parent, type = this.opts.type;

			if(type == 'Images'){
			
				this.opts.accept = {

					title : '图片',
				 
					extensions : 'gif,jpg,jpeg,bmp,png',
				 
					mimeTypes : 'image/gif,image/jpg,image/jpeg,image/png,image/bmp'

				}
			
			}else if(type == 'Flash'){

				this.opts.accept = {

					title : '视频',
				 
					extensions : 'flash,swf,zip',
				 
					mimeTypes : 'image/*'

				}
			
			}else{}

			if(Object.prototype.toString.call(this.opts.formData) != '[object Object]') this.opts.formData = {};
			
			//this.opts.formData = $.extend(this.opts.formData, {uid : 1});
			if(this.opts.auto == true){
				$('.uploadBtn').hide();
			}
			if(this.opts.fileNumLimit == 1){
				$('#filePicker2').hide();
			}
			webuploader(opts);

			this.uploader = uploader;

			return this;
		
		},

		showList : function(){

			if(this.lock1) return;

			this.lock1 = true;

			this.showFiles({type : this.opts.type}, $('#file_all_list'))
		
		},

		showSearch : function(key){

			if(this.lock2) return;

			this.lock2 = true;

			var data = {};

			if(key) data.key = key;

			data.type = this.opts.type;
		
			this.showFiles(data, $('#file_search_list'))
		
		},

		//显示文件列表
		showFiles : function(data, $container){

			var __self = this;

			$container.empty().parents('div.area').addClass('loading');

			data = typeof data == 'object' && data != null ? data : {};

			data = $.extend(data, this.opts.formData);

			$.ajax({
			
				url : __self.opts.filelistPah,

				data : data,

				dataType : 'json',

				success : function(data){
				
					var $html = __self.createFile(data);

					if(typeof $html == 'string') $container.append($html);

					else{
					
						for(var i = 0; i < $html.length; i++) $container.append($html[i]);
					
					}
				
				},

				complete : function(){
				
					__self.lock1 = false;

					__self.lock2 = false;

					$container.parents('div.area').removeClass('loading');

				}

			});
	
		},

		//生成单个文件
		createFile : function(data){

			var __self = this, str = '<li class="nofile">没有文件</li>';
			
			if(data && data.list && data.list.length > 0){

				var arr = [], li, i = 0, t, file, ext;
			
				for(; i < data.list.length; i++){

					t = data.list[i];

					ext = t.name.split('.');

					ext = ext[ext.length - 1];

					file = '<div class="img" title="' + t.name + '"><img width="100%" src="' + t.url + '" /><span class="icon"></span></div>';

					if(!/png|jpg|jpeg|gif|bmp/.test(ext)) file = '<div class="img file-global file-' + ext + '" title="' + t.name + '"><span class="icon"></span></div>';
					
					$li = $('<li class="file"><div class="file-panel"><span class="cancel">删除</span></div>' + file + '<div class="desc">' + t.name + '</div></li>');

					$li.click(function(){
					
						__self.checkFile($(this));
					
					}).data('file', {name : t.name, url : t.url, mtime : t.mtime, list : data.list});

					$li.find('span.cancel').click(function(){
					
						__self.delFile($(this).parents('li'));

						return false;
					
					});

					$li.find('div.img').dblclick(function(){
					
						__self.sure($(this).parent());
					
					});

					arr.push($li);

				}

				return arr;
			
			}
			
			return str;
		
		},

		checkFile : function($file){

			if(this.$curFile) this.cancelFile(this.$curFile);

			$file.addClass('checked');

			this.$curFile = $file;
		
		},

		delFile : function($file){

			if(!confirm('确定删除吗?')) return false;

			var file = $file.data('file');

			$file.find('div.file-panel').css('display', 'none');

			var data = {url : file.url, name : file.name, mtime : file.mtime};

			data = $.extend(data, this.opts.formData);

			$.ajax({
			
				url : this.opts.delPath,

				data : data,

				success : function(data){

					if(data == 1){
					
						$file.fadeOut(function(){
						
							$(this).remove();
						
						});
					
					}else{
					
						alert('删除失败');
					
					}
				
				},

				complete : function(){

					$file.find('div.file-panel').css('display', 'block');

				}
			
			});
		
		},

		cancelFile : function($file){
			
			if(!$file) $file = this.$curFile;
		
			if($file) $file.removeClass('checked');
		
		},

		//选中文件
		sure : function($file){
			var data = $file.data('file');
			var sLi = "";
			sLi += '<li class="img">';
			sLi += '<img src="' + data.url + '" width="100" height="100" onerror="this.src=\'__ROOT__/Public/plugins/uploadify/nopic.png\'">';
			sLi += '<input type="hidden" name="fileurl_tmp[]" value="' + data.url + '">';
			sLi += '<a href="javascript:void(0);">删除</a>';
			sLi += '</li>';
			$(".fileWarp ul").append(sLi);
			$(".statusBar .saveBtn").trigger("click");
		},

		cancel : function(){
			window.parent.layer.closeAll();
		},

		uploadComplete : function(list){
			console.log(list)
		},
		
		del:function(obj){
			if(!confirm('确定删除吗?')) return false;
		    $.get("/index.php?m="+moudle+"&c=Uploadify&a=delupload",{action:"del", filename:$(obj).attr('data-img')},function(res){
					if(res == 1){
			    		var id = $(obj).parents('.state-complete').attr('id');
						removeFileById(id);
                        $('.'+id).remove();
					}else{
						alert("删除失败");
					}
	        	}
		    );
		}
	};

	Manager.init();

});