function showUser(username)  {

    $.ajax({
      type: "GET",
      url: 'searchfunction.php',
      data: {q: username},

      success: function(data)   {
        $('#friends').html(data);
      }
    });
  };

$("#friendSearchBox").keyup(function(e) {
    if (this.value !== ''){
        //showUser($("#friendSearchBox").val());
        showUser($("#friendSearchBox").val());
        var offset = $("#friendSearchBox").offset();
        var left = offset.left;
        $("#friendSearch").css( {
            'position': 'absolute',
            'left': left,
            'top': '50px'
        });
        $("#friendSearch").css('display','block');
    } else {
        $("#friendSearch").css('display','none');
    }
});
$("body").click(function (e) {
      $("#friendSearch").css('display','none');
      $("#friendSearchBox").val('');
});
