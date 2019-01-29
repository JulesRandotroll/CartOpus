
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

$(function()
{
    $('.cbx').on('click',function()
    {
        noAction = $(this).val();
        
        if($(this).prop('checked'))
        {
            favoris = true;
        }
        else
        {
            favoris = false;
        }

        location.href = $('#form_favoris').attr('action')+'/'+noAction+'/'+favoris;
    });

    $('#filActu').hide();
    
    $('#affichActu').on('click',function()
    {
        $('#filActu').show();
    });

    $('#enHaut').on('click',function()
    {
        $('#filActu').hide();
    });
});