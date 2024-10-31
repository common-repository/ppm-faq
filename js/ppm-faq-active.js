jQuery(document).ready(function($) {
       jQuery('#accordion div').hide();
       jQuery('#accordion p span').click(function(){
               $('#accordion div').slideUp();
               $(this).parent().next().slideDown();
               return false;
       });
});