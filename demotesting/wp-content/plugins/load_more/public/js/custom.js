jQuery(document).ready(function () {

   
jQuery('.filter-list ul li a').on("click", function(){
  
  jQuery('.filter-tab li').removeClass('active');
  jQuery(this).parents('li').addClass('active');
  var pageNumber  = 1;
  var offset = 4;
  var catid = jQuery(this).attr('data-id');
  //alert(catid);
 
  var num =1;
  jQuery('#load_more').data('num', num); 

    jQuery.ajax({
         method: 'POST',
         url: my_ajax_object.ajax_url,
         dataType: "html",
         data: { 
            action     : 'category_filter_blog',
            category: catid,
            offset      : offset,
            pageNumber   : num,
         },
    success: function(data) {
       if(data){
        //console.log(catid);
         jQuery(".post-listing").html(data);
         jQuery('#load_more').show();
          }
          else
          {
           jQuery('#load_more').hide();
          }
        }
        });
 });
jQuery(document).on('click','#load_more',function(){ 
  var offset = 4 ;
  var catid = jQuery('body').find('.filter-tab .active a').attr('data-id');

  var num = jQuery('#load_more').data('num')+1;

    jQuery('#load_more').data('num', num); 
   jQuery.ajax({
         method: 'POST',
         url: my_ajax_object.ajax_url,
         dataType: "html",
         data: { 
            action     : 'category_filter_blog',
            category: catid,
            offset      : offset,
            pageNumber   : num,
         },
     success: function(data) {
        if(data === ''){
            console.log('datasuccess');
            jQuery('.post-recent-wrapper  #load_more').show();
             jQuery('#load_more').hide();
          }
          else
          {
          jQuery(".post-listing").append(data);
           //jQuery('#load_more').hide();
          }
        }
        });
});

});


