var thisUrl  = '';
var sr='';
var obg='';

function getlist(){
jQuery("#preload").css('display','block');
	dat0 ='/';
        jQuery.ajax({
            type: "POST",
            url: thisUrl+"getlist.php",
            data:( {"dat0" : dat0} ),
            success: function (html) {
jQuery("body").append(html);
jQuery("#preload").css('display','none');
            },
          error:  function(xhr, html){
                alert('Возникла ошибка: ' + xhr.responseCode);
            }
        });
} 


jQuery(document).ready(function () {
getlist();

jQuery("body").on("click", "#send", function (){
	jQuery("#preload").css('display','block');
	var count=jQuery(".tabresult .count").length;
	dat0 =count;
	dat1='';
	dat2='';
	dat3=jQuery("#catnam").text();
	dat4='';
	dat5='';
	dat6='';
for(i=0;i<count;i++){
	dat1 =dat1+jQuery(".tabresult .numid").eq(i).text()+'-nid-';
	dat2 =dat2+jQuery(".tabresult .newnam").eq(i).val()+'-nam-';
	dat4 =dat4+jQuery(".tabresult .srcimg").eq(i).attr('src')+'-src-';
	dat5 =dat5+jQuery(".tabresult .color").eq(i).val()+'-color-';
	dat6 =dat6+jQuery(".tabresult .content").eq(i).val()+'-content-';
}
        jQuery.ajax({
            type: "POST",
            url: thisUrl+"addpost.php",
            data:( {"dat0" : dat0,"dat1" : dat1,"dat2" : dat2,"dat3" : dat3,"dat4" : dat4,"dat5" : dat5,"dat6" : dat6} ),
            success: function (html) {
jQuery("body").append(html);
jQuery("#preload").css('display','none');
            },
          error:  function(xhr, html){
                alert('Возникла ошибка: ' + xhr.responseCode);
            }
        });
	 return false;
});

jQuery("#vibor").click(function(){
jQuery("#preload").css('display','block');
location.reload();	
});
 



jQuery("body").on("click", ".list_close,#loadlist", function (){
jQuery("#windowlist").remove();	
});
jQuery("body").on("click", "#loadlist li", function (){
	jQuery("#preload").css('display','block');
var dat0 = jQuery(this).find('a').attr("hreff");
jQuery("#catname").text(dat0);
jQuery("#windowlist").remove();	
//alert("OK -- "+dat0);
        jQuery.ajax({
            type: "POST",
            url: thisUrl+"gettableimg.php",
            data:( {"dat0" : dat0} ),
            success: function (html) {
jQuery("body").append(html);
jQuery("#preload").css('display','none');
            },
          error:  function(xhr, html){
                alert('Возникла ошибка: ' + xhr.responseCode);
            }
        });
        return false;	
});


});