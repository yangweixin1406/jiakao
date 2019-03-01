/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	var cururl=String(window.location);
	var arr=cururl.split("/index.php");
	var siteurl=arr[0]+"/";
	config.filebrowserImageUploadUrl = siteurl+'Public/ckeditor/upload.php?type=img'; 
    config.filebrowserFlashUploadUrl = siteurl+'Public/ckeditor/upload.php?type=flash'; 
	config.filebrowserLinkUploadUrl = siteurl+'Public/ckeditor/upload.php?type=Link'; 

	//config.contentsCss = 'http://localhost:86/phpsite/phone/admin/ckeditor/contents.css';
  // config.skin = 'v2';

 

};

