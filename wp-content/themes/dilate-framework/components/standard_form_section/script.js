(function($) {
  
  $(document).ready(function($) {

    $('.comp_standard_form_section input[type="checkbox"][name="productselection"]').on('change', function (e) {
      if ($('input[type="checkbox"][name="productselection"]:checked').length > 5) {
          $(this).prop('checked', false);
          alert("A maximum of 5 samples per person can be ordered. If you require more, please contact the team via email - info@kustomtimber.com.au");
      }

      var valuesArray = $('input[type="checkbox"][name="productselection"]:checked').map( function() {
        return this.value;
      }).get().join(",");
      console.log(valuesArray);

      $(this).closest('.row').find('form .selected__products input[name="hidden-1"]').val(valuesArray);
      
    });

  });
  
} (window.jQuery || window.$) );