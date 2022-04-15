/**
 * @license Copyright (c) 2003-2016, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For complete reference see:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config

	//config.contentsCss = 'ckeditor/contents.css';			// No se puede aca por cuestiones de referencia de las URL al momento de llamar el archivo
	/*		AUTO GENERADAS POR CKEDITOR 	*/
	// The toolbar groups arrangement, optimized for two toolbar rows.
	config.toolbarGroups = [
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'editing' ] },		//, 'spellchecker'
		{ name: 'insert', groups: [ 'insert' ] },
		{ name: 'forms', groups: [ 'forms' ] },
		{ name: 'tools', groups: [ 'tools' ] },
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'links', groups: [ 'links' ] },
		{ name: 'about', groups: [ 'about' ] },
		'/',
		{ name: 'others', groups: [ 'others' ] },
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
		{ name: 'styles', groups: [ 'styles' ] }
	];

	config.removeButtons = 'Anchor,SpecialChar,Font';	//,Source';	
	// Source se puede quitar el plugin para evitar cargarlo

	// Remove some buttons provided by the standard plugins, which are
	// not needed in the Standard(s) toolbar.
	//config.removeButtons = 'Underline,Subscript,Superscript';

	// Set the most common block elements.
	config.format_tags = 'p;h1;h2;h3'; //;pre;address;div';

	// Simplify the dialog windows.
	config.removeDialogTabs = 'image:advanced;link:advanced;link:target';

	config.disallowedContent = 'br';
	config.extraAllowedContent = 'sup(*)';


	/****************************************
	*		Configuraciones propias			*
	****************************************/
	config.defaultLanguage = 'es';	// En español cuando el idioma del navegador no es sportado
									// Si el navegador esta en ingles se carga en ingles
	config.coreStyles_bold = { element: 'b', overrides: 'strong'};
	config.enterMode = CKEDITOR.ENTER_P;					// Cambiado por margin: 0 para los elementos p


	config.disableNativeSpellChecker = false;
	//config.scayt_autoStartup = true;

	//config.uploadUrl = 'uploader.php';
	
	//config.imageUploadUrl = 'uploader.php';		// Solo para las imagenes

	CKEDITOR.stylesSet.add('estilos_crowe', [
			{name: 'Titulo', element: 'p', attributes: {'class': 'titulo'}},
			{name: 'Identado', element: 'p', styles: {'text-indent': '20px'}},
			{name: 'Sub Titulo', element: 'b', attributes: {'class': 'subtitulo'}},
			{name: 'Resaltado', element: 'span', attributes: {'class': 'resaltado'}},
		]);

	config.stylesSet = 'estilos_crowe';

	config.justifyClasses = ['alignLeft', 'alignCenter', 'alignRight', 'alignJustify'];
	config.image2_alignClasses = [ 'alignLeft', 'alignCenter', 'alignRight' ];

	config.menu_groups = 'clipboard,form,tablecellproperties,tablerow,tablecolumn,table,anchor,link,image,flash,checkbox,radio,textfield,hiddenfield,imagebutton,button,select,textarea';

	//config.div_wrapTable = true;
	/****************************************
	*		Plugins agregados despues		*
	****************************************/
	config.extraPlugins = 'colorbutton,colordialog,liststyle,tableresize,widget,lineutils,widgetselection';	//,language';
	//config.language_list = ['es:Spanish', 'en:English', 'pt:Portuguese', 'fr:French'];


	// Notas: sourcearea desactiva la opcion de ver html fuente
	// 			Las otras opciones desactivan el contextmenu para que al hacer clic derecho en una palabra genera las sugerencias de correccion sin necesidad de oprimiri ctrl
	//config.removePlugins = 'liststyle,tabletools,scayt,menubutton,contextmenu';	//,sourcearea';
	config.removePlugins = 'uploadfile,wsc,scayt,format,autogrow,sourcearea';	// Por ahora quito los estilos pero pueden servir para poner estilos predefinidos

};

CKEDITOR.on('dialogDefinition', function( ev ) {
  var dialogName = ev.data.name;
  var dialogDefinition = ev.data.definition;

  if(dialogName === 'table') {
    var infoTab = dialogDefinition.getContents('info');
    var cellSpacing = infoTab.get('txtCellSpace');
    cellSpacing['default'] = "0";
    var cellPadding = infoTab.get('txtCellPad');
    cellPadding['default'] = "1";
    var border = infoTab.get('txtBorder');
    border['default'] = "1";
    var txtWidth = infoTab.get('txtWidth');
 	txtWidth['default'] = 480;
  }
}); 
