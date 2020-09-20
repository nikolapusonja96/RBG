/*-Tabs-*/
$('#myTabs a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
});

(function($) {
  $(function() {
  var $body = $('body'),
      $header = $('#header');

  // Scrolly.
  $('.scrolly').scrolly({
    offset: function() {
      return $header.height();
    }
  });

  // Menu.
  $('#menu')
      .append('<a href="#menu" class="close"></a>')
      .appendTo($body)
      .panel({
        delay: 500,
        hideOnClick: true,
        hideOnSwipe: true,
        resetScroll: true,
        resetForms: true,
        side: 'right'
      });
  });
})(jQuery);