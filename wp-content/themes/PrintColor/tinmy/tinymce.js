var thisUrl  = '?????????';
var sr='';
var obg=''; 

window.tinymce.PluginManager.add('myreaddir', function(ed) {
	// important button
	ed.addButton('myreaddir_block', {
		title : 'open dir img -- открыть папки с картинками',
		//image: 'https://foto-oboi/wp-content/themes/PrintColor/img/folder.gif',
		cmd : 'myreaddir_block',
		text : 'Open_dir'
	});
	ed.addCommand('myreaddir_block', function() {
		//
dat0 ='/';
        jQuery.ajax({
            type: "POST",
            url: thisUrl+"getlist.php",
            data:( {"dat0" : dat0} ),
            success: function (html) {
jQuery("body").append(html);
            },
          error:  function(xhr, html){
                alert('Возникла ошибка: ' + xhr.responseCode);
            }
        });
        //return false;
	});

});

jQuery("body").on("click", "#imglist img", function (){
 sr = jQuery(this).attr("src");
obg='<img src="'+sr+'"/>';
jQuery("#windowlist").remove();
tinyMCE.activeEditor.selection.setContent(obg);
});

jQuery("body").on("click", ".list_close,#loadlist,#imglist", function (){
jQuery("#windowlist").remove();
//jQuery("#imglist").remove();	
});
jQuery("body").on("click", "#loadlist li", function (){
var dat0 = jQuery(this).find('a').attr("hreff");
jQuery("#windowlist").remove();	
//alert("OK -- "+dat0);
        jQuery.ajax({
            type: "POST",
            url: thisUrl+"getimg.php",
            data:( {"dat0" : dat0} ),
            success: function (html) {
jQuery("body").append(html);
jQuery("#imglist").slideDown(1200);
            },
          error:  function(xhr, html){
                alert('Возникла ошибка: ' + xhr.responseCode);
            }
        });
        return false;	
});

