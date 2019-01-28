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
});