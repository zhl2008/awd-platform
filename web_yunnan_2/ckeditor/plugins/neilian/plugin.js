/**
 * Basic sample plugin inserting current date and time into CKEditor editing area.
 */

// Register the plugin with the editor.
// http://docs.cksource.com/ckeditor_api/symbols/CKEDITOR.plugins.html
CKEDITOR.plugins.add( 'neilian',
{
	// The plugin initialization logic goes inside this method.
	// http://docs.cksource.com/ckeditor_api/symbols/CKEDITOR.pluginDefinition.html#init
	init: function( editor )
	{
		// Define an editor command that inserts a timestamp. 
		// http://docs.cksource.com/ckeditor_api/symbols/CKEDITOR.editor.html#addCommand
		editor.addCommand( 'insertNeilian', new CKEDITOR.dialogCommand( 'insertNeilian' ) );
		// Create a toolbar button that executes the plugin command. 
		// http://docs.cksource.com/ckeditor_api/symbols/CKEDITOR.ui.html#addButton
		editor.ui.addButton( 'Neilian',
		{
			// Toolbar button tooltip.
			label: '插入站内链接',
			// Reference to the plugin command name.
			command: 'insertNeilian',
			// Button's icon file path.
			icon: this.path + 'images/neilian.png'
		});
		
		CKEDITOR.dialog.add( 'insertNeilian', function( editor )
		{
			return {
				title : '插入站内链接',
				minWidth : 400,
				minHeight : 200,
				contents :
				[
					{
						id : 'neilink',
						label : '链接',
						elements :
						[
						 {
							 type:'vbox',
							 padding : 0,
							 children :
							 [
							  	{
									type:'html',
									html:'可以手工输入或通过按钮选择'
								},
								//url 和按钮
								{
									type : 'hbox',
									widths : [ '280px', '110px' ],
									align : 'right',
									children :
									[
										{
											type:'text',
											id:'link_url',
											label:'URL',
											commit : function( data )
											{
												data.link_url = this.getValue();
											}
										},
										{
											type:'button',
											id:'link_button',
											style : 'display:inline-block;margin-top:10px;',
											align:'center',
											label:'选择链接',
											onClick:function(){
												var retFile = showModalDialog("admin_content_link.php", "", "dialogHeight:500;dialogWidth:800;"); 
												if(retFile != null){
													$rel=retFile.split('||');
													this.getDialog().setValueOf('neilink','link_url',$rel[0]);
													this.getDialog().setValueOf('neilink','link_text',$rel[1]);
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
											id:'link_text',
											label:'链接文字',
											commit : function( data )
											{
												data.link_text = this.getValue();
											}
										}
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
											type:'checkbox',
											id:'is_open',
											label:'新窗口',
											'default' : true,
											commit : function( data )
											{
												data.is_open = this.getValue();
											}
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
				onOk : function()
				{
					data = {},
					link = editor.document.createElement( 'a' );
					this.commitContent( data );
					link.setAttribute( 'href', data.link_url );
					link.setAttribute( 'title', data.link_text );
					if ( data.is_open ){link.setAttribute( 'target', '_blank' );}
					link.setHtml( data.link_text );
					editor.insertElement( link );
				}
			};
		} );
		
		//事件
		
	}
} );