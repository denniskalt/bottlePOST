$(document).ready(function() {
    $('.thumbnail').click(function(){

        $('#IMGbody').empty();
        var title = $(this).parent('a').attr("title");
        var $form = $('#form_deleteIMG');

        $('#hiddenID').val(title);

        $('#IMGtitle').html(title);
        $($(this).parents('div').html()).appendTo('#IMGbody');
        $('#imgModal').modal({show:true});

    });
});
