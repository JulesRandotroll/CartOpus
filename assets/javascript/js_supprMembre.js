$(function()
{
    $('.trash_Supprimer').on('click',function()
    {
        noActeur=this.id;

        $.confirm(
        {
            icon: 'glyphicon glyphicon-alert',
            title: 'Attention',
            content: 'Voulez vous vraiment supprimer ce membre',
            type: 'red',
            typeAnimated: true,
            autoClose:"non|10000",
            buttons: 
            {
                oui:
                {
                    action: function () 
                    {
                        location.href = $('#form_suppr').attr('action')+'/'+noActeur;
                    }
                },
                non: 
                {
                    btnClass:"btn-red",
                },
            }   
        });

    });

    $('p').hide();


    $('.option').hover(
        function()
        {
            //$(this).attr('class','option active');
            $(this).attr('style','background-color:#139CBC;border-radius: 10px;');
            id=this.id;
            $(this).find('span').eq(0).hide();
            $('#txt_'+id).show();
        },
        function()
        {
            $(this).find('span').eq(0).show();
            $(this).attr('style','background-color:#B64F53;border-radius: 10px');
            $('p').hide();
        }
    );
});

