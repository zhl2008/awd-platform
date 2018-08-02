/**
 * Basic sample plugin inserting current date and time into CKEditor editing area.
 */

// Register the plugin with the editor.
// http://docs.cksource.com/ckeditor_api/symbols/CKEDITOR.plugins.html
CKEDITOR.plugins.add( 'media',
{
	// The plugin initialization logic goes inside this method.
	// http://docs.cksource.com/ckeditor_api/symbols/CKEDITOR.pluginDefinition.html#init
	init: function( editor )
	{
		// Define an editor command that inserts a timestamp. 
		// http://docs.cksource.com/ckeditor_api/symbols/CKEDITOR.editor.html#addCommand
		editor.addCommand( 'insertMedia', new CKEDITOR.dialogCommand( 'insertMedia' ) );
		// Create a toolbar button that executes the plugin command. 
		// http://docs.cksource.com/ckeditor_api/symbols/CKEDITOR.ui.html#addButton
		editor.ui.addButton( 'Media',
		{
			// Toolbar button tooltip.
			label: '插入媒体',
			// Reference to the plugin command name.
			command: 'insertMedia',
			// Button's icon file path.
			icon: this.path + 'images/media2.png'
		});
		
		editor.addCss(
				'img.cke_media' +
				'{' +
					'background-image: url(' + CKEDITOR.getUrl( this.path + 'images/placeholder.png' ) + ');' +
					'background-position: center center;' +
					'background-repeat: no-repeat;' +
					'border: 1px solid #a9a9a9;' +
					'width: 80px;' +
					'height: 80px;' +
				'}'
				);
		
	
		
		CKEDITOR.dialog.add( 'insertMedia', function( editor )
		{
			var previewPreloader,previewAreaHtml = '<div>' + CKEDITOR.tools.htmlEncode( editor.lang.common.preview ) +'<br>' +
			'<div id="cke_FlashPreviewLoader' + CKEDITOR.tools.getNextNumber() + '" style="display:none"><div class="loading">&nbsp;</div></div>' +
			'<div id="cke_FlashPreviewBox' + CKEDITOR.tools.getNextNumber() + '" class="FlashPreviewBox"></div></div>';
			return {
				title : '插入媒体',
				minWidth : 400,
				minHeight : 200,
				contents :
				[
					{
						id : 'media',
						label : '媒体',
						elements :
						[
						 {
							 type:'vbox',
							 padding : 0,
							 children :
							 [
								//url 和按钮
								{
									type : 'hbox',
									widths : [ '280px', '110px' ],
									align : 'right',
									children :
									[
										{
											type:'text',
											id:'media_url',
											label:'URL',
											commit : function( data )
											{
												data.media_url = this.getValue();
											},
											onLoad : function()
											{
												
												var dialog = this.getDialog(),
												updatePreview = function( src ){
													// Query the preloader to figure out the url impacted by based href.
													//previewPreloader.setAttribute( 'src', src );
													
													dialog.preview.setHtml( '<embed type="application/x-mplayer2" classid="clsid:6bf52a52-394a-11d3-b153-00c04f79faa6" src="'+src+'" enablecontextmenu="false" autostart="false" height="200" width="200">' );
												};
												// Preview element
												dialog.preview = dialog.getContentElement( 'media', 'preview' ).getElement().getChild( 3 );

												// Sync on inital value loaded.
												this.on( 'change', function( evt ){

														if ( evt.data && evt.data.value )
															updatePreview( evt.data.value );
													} );
												// Sync when input value changed.
												this.getInputElement().on( 'change', function( evt ){

													updatePreview( this.getValue() );
												}, this );
												
											}
										},
										{
											type:'button',
											id:'media_button',
											style : 'display:inline-block;margin-top:10px;',
											align:'center',
											label:'选择媒体',
											onClick:function(){
												var retFile = showModalDialog("admin_file_upload.php?method=fck", "", "dialogHeight:500;dialogWidth:800;"); 
												if(retFile != null){
													this.getDialog().setValueOf('media','media_url',retFile);
												}
											}
										}
									]	
								
								},
								//文字
								{
									type:'hbox',
									widths : [ '280px', '110px' ],
									align : 'right',
									children :
									[
									 	{
											type:'text',
											id:'media_width',
											//style:'width:100px',
											'default':300,
											label:'宽度',
											commit : function( data )
											{
												data.media_width = this.getValue();
											}
										},
										{
											type:'text',
											id:'media_height',
											//style:'width:100px',
											'default':300,
											label:'高度',
											commit : function( data )
											{
												data.media_height = this.getValue();
											}
										},
									]
								},
								//窗口和提示
								{
									type:'hbox',
									style:'margin-top:8px;',
									widths : [ '280px', '110px' ],
									align:'right',
									children:
									[
									 	{
											type : 'html',
											id : 'preview',
											style : 'width:95%;',
											html : previewAreaHtml
										}
									]
								}
								//
								
							 ]
						 }
						]
					}
				],
				//事件
				onShow : function()
				{
					// Clear previously saved elements.
				this.fakeImage = this.objectNode = this.embedNode = null;
				previewPreloader = new CKEDITOR.dom.element( 'embed', editor.document );

				// Try to detect any embed or object tag that has Flash parameters.
				var fakeImage = this.getSelectedElement();

				if ( fakeImage && fakeImage.data( 'cke-real-element-type' ) && fakeImage.data( 'cke-real-element-type' ) == 'media' )
				{
					this.fakeImage = fakeImage;

					var realElement = editor.restoreRealElement( fakeImage ),
						embedNode = null, data = {};
					if ( realElement.getName() == 'embed' )
						embedNode = realElement;
					this.embedNode = embedNode;

					this.setupContent( embedNode, data, fakeImage );
				}
				},
				
				onHide : function()
				{
					if ( this.preview )
						this.preview.setHtml('');
				},
				
				onOk : function()
				{
				// If there's no selected object or embed, create one. Otherwise, reuse the
				// selected object and embed nodes.
				
				var objectNode = null,
					embedNode = null,
					paramMap = null,
					data={};
					var data = {};
				this.commitContent(data );
				//alert(data.media_url);
				if ( !this.fakeImage )
				{
					
						embedNode = CKEDITOR.dom.element.createFromHtml( '<cke:embed></cke:embed>', editor.document );
						embedNode.setAttributes(
							{
								type : 'application/x-mplayer2',
								classid : 'clsid:6bf52a52-394a-11d3-b153-00c04f79faa6',
								enablecontextmenu:'false',
								autostart: 'false',
								src:data.media_url
							} );
						
				}
				else
				{
					embedNode = this.embedNode;
				}

				// A subset of the specified attributes/styles
				// should also be applied on the fake element to
				// have better visual effect. (#5240)
				
				//extraStyles = {}
				// Refresh the fake image.
				var newFakeImage = editor.createFakeElement( embedNode, 'cke_media', 'media', true );
				//newFakeImage.setAttributes( extraAttributes );
				//newFakeImage.setStyles( extraStyles );
				//if ( this.fakeImage )
				//{
					//newFakeImage.replace( this.fakeImage );
					//editor.getSelection().selectElement( newFakeImage );
				//}
				//else
					editor.insertElement( newFakeImage );
				}

			};
		} );
		
		//事件
		
	}
} );