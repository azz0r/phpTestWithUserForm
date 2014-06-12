$( "#createUser" ).click(
  function(ev) {

    // prevent the default button action reloading the page
    ev.preventDefault();

    $.ajax({
      type: "POST",
      url: 'api.php?module=user&action=create', //url for our api.php
      data: {
        // form elements
        name: $('#name').val(),
        email: $('#email').val(),
        phone: $('#phone').val()
      },

      // if we get a success response
      success: function() {
        // form submission was succcesful, add the hide class to the form and remove the hide class on success message
        $('#commentForm').addClass('hide');
        $('#successMessage').removeClass('hide');
      },

      // if we get an error response
      error: function(result) {
        //re-add the hide class incase were submitting the form
        $('.error').addClass('hide');

        // loop the errors returned
        $.each(result.responseJSON.errors, function( index, value ) {
          // remove the hide class and send the value to the html el
          $('.error.'+index).removeClass('hide').html(value);
        });
      }
    });
  }
);