Drupal.behaviors.orangeBehaviors = function(context){

  $('#nav ul li, .dd ul li', context).hover(function() {
    $(this).toggleClass('hover');
  }, function() {
    $(this).toggleClass('hover');
  });

	$('fieldset.collapsible .fieldset-title', context).click(hideFieldset);

  function hideFieldset() {
    var $content = $(this).parent().children('.fieldset-body');
    if($content.is(':hidden')){
      $(this).parent().removeClass('collapsed');
      $content.show();
    }else{
      $content.hide();
      $(this).parent().addClass('collapsed');
    }
  }
};