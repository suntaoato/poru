$(function()
  {
    $('#ss-form').validate(
      {
      rules:
        { 
          'entry.1768204962':{ required:true, maxlength:3 }
        },
        messages:
        {
          'entry.1768204962':
          {
            minlength:"Please select atleast {0} options"
          }
        },
        errorPlacement: function(error, element) 
        {
            if ( element.is(":checkbox") ) 
            {
                error.appendTo( element.parents('.container') );
            }
            else 
            { // This is the default behavior
                error.insertAfter( element );
            }
         }
      });
    
  });