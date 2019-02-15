$(document).ready(function(){
    $("#myInput").on("keyup", function() 
    {
        var value = $(this).val().toLowerCase();
        
        $("#myTable tr").filter(function() 
        {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
        $("#myTable td").filter(function() 
        {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    $(".supprMotCle").on('click',function()
    {
        motcle = (this.id).replace("#", "");
        
        //alert(motcle);
       
         
        $.confirm(
        {
            icon: 'glyphicon glyphicon-alert',
            title: 'Attention',
            content: 'Voulez vous vraiment supprimer ce mot clé ?',
            type: 'red',
            typeAnimated: true,
            autoClose:"non|10000",
            buttons: 
            {
                oui:
                {
                    action: function () 
                    {
                        location.href = $('#form_supprMotcle').attr('action')+'/'+motcle;
                    }
                },
                non: 
                {
                    btnClass:"btn-red",
                    action: function () 
                    {
                        location.href = $('#form_supprMotcle').attr('action')+'/0';
                    }
                },
            }   
        });
    });

    $(document).ready(function(){
        $('[data-toggle="popover"]').popover(); 
    });

  });