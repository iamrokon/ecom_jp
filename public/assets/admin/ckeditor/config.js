/**
 * @license Copyright (c) 2003-2020, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'ja';
	config.language = 'en';
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';

	config.plugins = 'dialogui,dialog,about,a11yhelp,dialogadvtab,basicstyles,bidi,blockquote,notification,button,toolbar,clipboard,panelbutton,panel,floatpanel,colorbutton,colordialog,templates,menu,contextmenu,copyformatting,div,editorplaceholder,resize,elementspath,enterkey,entities,exportpdf,popup,filetools,filebrowser,find,fakeobjects,flash,floatingspace,listblock,richcombo,font,forms,format,horizontalrule,htmlwriter,iframe,wysiwygarea,image,indent,indentblock,indentlist,smiley,justify,menubutton,language,link,list,liststyle,magicline,maximize,newpage,pagebreak,pastetext,pastetools,pastefromgdocs,pastefromword,preview,print,removeformat,save,selectall,showblocks,showborders,sourcearea,specialchar,scayt,stylescombo,tab,table,tabletools,tableselection,undo,lineutils,widgetselection,widget,notificationaggregator,uploadwidget,uploadimage,wsc';
	config.extraPlugins = 'lineheight';
	config.line_height = "0px; 10px; 20px; 30px; 40px; 50px; 60px; 70px; 80px; 90px; 100px;";
	config.contentsCss = "styles.css";
	// config.font_names = "Satisfy;" +
	// 										"NotoSerifJP;" +
	// 										"Arial/Arial, Helvetica, sans-serif;" +
	// 										"Times New Roman/Times New Roman, Times, serif;" +
	// 										"Verdana";
	config.font_names =	"メイリオ, Meiryo;" +
											"Yu Gothic Medium, 游ゴシック Medium, YuGothic, 游ゴシック体, YuGothicM, Yu Gothic;" +
											"ＭＳ Ｐゴシック;" +
											"ＭＳ ゴシック;" +
											"游明朝, Yu Mincho, YuMincho;" +
											"ＭＳ Ｐ明朝;" +
											"ＭＳ 明朝;" +
											"Arial / Arial, Helvetica, sans - serif;" +
											"Comic Sans MS / Comic Sans MS, cursive;" +
											"Courier New / Courier New, Courier, monospace;" +
											"Georgia / Georgia, serif;" +
											"Lucida Sans Unicode / Lucida Sans Unicode, Lucida Grande, sans - serif;" +
											"Tahoma / Tahoma, Geneva, sans - serif;" +
											"Times New Roman / Times New Roman, Times, serif;" +
											"Trebuchet MS / Trebuchet MS, Helvetica, sans - serif;" +
											"Verdana / Verdana, Geneva, sans - serif;"


	// config.toolbarGroups = [
	// 	{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
	// 	{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
	// 	{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
	// 	{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
	// 	{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
	// 	{ name: 'links', groups: [ 'links' ] },
	// 	{ name: 'insert', groups: [ 'insert' ] },
	// 	{ name: 'styles', items: ['Font', 'FontSize', 'Styles', 'Format', 'lineheight'] },
	// 	{ name: 'colors', groups: [ 'colors' ] },
	// 	{ name: 'tools', groups: [ 'tools' ] },
	// 	{ name: 'others', groups: [ 'others' ] },
	// 	{ name: 'about', groups: [ 'about' ] }
	// ];
	config.toolbar = [
		{ name: 'clipboard', items: ['Undo', 'Redo'] },
		{ name: 'styles', items: ['Font', 'FontSize', 'Format', 'lineheight'] },
		{ name: 'basicstyles', items: ['Bold', 'Italic'] },
		{ name: 'colors', items: ['TextColor', 'BGColor'] },
		{ name: 'paragraph', items: ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
		{ name: 'links', items: ['Link', 'Unlink'] },
	];

	// .cke_editable p {
	// 	margin-bottom: 44px; margin-top: 0px;
	// 	
	// 	
	// }

	config.removeButtons = 'Source,Save,NewPage,ExportPdf,Preview,Print,Templates,Cut,Copy,Paste,PasteText,PasteFromWord,Find,Replace,SelectAll,Scayt,Underline,Strike,Subscript,Superscript,CopyFormatting,RemoveFormat,NumberedList,BulletedList,Outdent,Indent,CreateDiv,Blockquote,Image,Flash,Table,HorizontalRule,Smiley,SpecialChar,PageBreak,Iframe,Maximize,ShowBlocks,Anchor,BidiLtr,BidiRtl,Language,About';

};

