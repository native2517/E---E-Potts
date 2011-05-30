// $Id: auto_menutitle.js,v 1.3 2011/02/08 12:32:01 alexkb Exp $

if (Drupal.jsEnabled) {

  $(document).ready(
    function() {
      if ($("#edit-menu-fixtitle:checked").val() != undefined) {
        $("#edit-menu-link-title").val($("#edit-title").val());
      }
      $("#edit-title").keyup(
      function() {
        if ($("#edit-menu-fixtitle:checked").val() != undefined) {
          $("#edit-menu-link-title").val($("#edit-title").val());
        }
      })
      
      $("#edit-menu-fixtitle").change(
      function() {
        if ($("#edit-menu-fixtitle:checked").val() != undefined) {
          $("#edit-menu-link-title").val($("#edit-title").val());
          $("#edit-menu-link-title").attr('readonly','readonly');
        }
        else {
          $("#edit-menu-link-title").attr('readonly','');
        }
      })
    }
    
    
  )
}
