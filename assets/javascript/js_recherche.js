$(function()
{
    $('.dateHeure').hide();
    
    $('#filtrer').on('click',function()
    {
        $('.dateHeure').show();

        $('#loupe').hide();
    });
});