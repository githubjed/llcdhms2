/*
|-----------------------------------------------------------------------------------
|  LOGIN JS
|-----------------------------------------------------------------------------------
*/ 

       $(document).on('submit','#loginForm',function(e){
              var action = $(this).attr('action');
         	  var data = $(this).serialize();

               $.ajax({
                        method:'post',
                        url:action,
                        data:data,
                        cache:false,

                        success:function(){
                                    window.location.href = "/";
                        },

		                    error:function(jqXHR){
                               if (jqXHR.status === 422) { 
                                   var errors = jqXHR.responseJSON.errors;                                                                              
                                  $.each(errors, function(key, value){
                                       $('input[name='+key+'],select[name='+key+']')
                                           .addClass('is-invalid')
                                           .next()
                                           .html(value);	
                                   });
                               }
                          }     
               });

             e.preventDefault();
       });
/*
|-----------------------------------------------------------------------------------
|  SIGN UP JS
|-----------------------------------------------------------------------------------
*/ 

    $(document).on('submit','#signUp',function(e){
             
              var action = $(this).attr('action');
         	    var data = $(this).serialize();

         
               $.ajax({
                        method:'post',
                        url:action,
                        data:data,
                        cache:false,

                        success:function(){
                                  window.location.href = "/become-a-host";
                                   
                        },

    		                error:function(jqXHR){
                                   if (jqXHR.status === 422) { 
                                       var errors = jqXHR.responseJSON.errors;                                                                              
                                      $.each(errors, function(key, value){
                                           $('input[name='+key+'],select[name='+key+']')
                                               .addClass('is-invalid')
                                               .next()
                                               .html(value);	
                                       });
                                   }
                              }     
               });

         e.preventDefault();
    });


/*
|-----------------------------------------------------------------------------------
|  EVENT LISTENER
|-----------------------------------------------------------------------------------
*/ 
   
   $("input[name='email']").click(function(){
          $(this).removeClass('is-invalid');
          $(this).val('');
   });

    $("input[name='fname']").click(function(){
          $(this).removeClass('is-invalid');
          $(this).val('');
   });

    $("input[name='lname']").click(function(){
          $(this).removeClass('is-invalid');
          $(this).val('');
    });

    $("input[name='password']").click(function(){
          $(this).removeClass('is-invalid');
          $(this).val('');
    });

     $("input[name='password_confirmation']").click(function(){
          $(this).removeClass('is-invalid');
          $(this).val('');
     });



});