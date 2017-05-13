var text_max = 200;
$('#count_message').html(text_max + ' Zeichen übrig');

$('#posting').keyup(function() {
  var text_length = $('#posting').val().length;
  var text_remaining = text_max - text_length;

$('#count_message').html(text_remaining + ' Zeichen übrig');

});
