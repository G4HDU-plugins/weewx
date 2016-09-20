//
$(document).ready(function(){
    $('.thumbnail').click(function(){
        $('.modal-body').empty();

        var title = $(this).attr("alt");


   	    $('.modal-title').html(title);
   	    $($(this).parents('div').html()).appendTo('.modal-body');
   	    $('#myModal').modal({show:true});
    });
});