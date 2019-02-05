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

    $(".supprrole").on('click',function()
    {
        noRole = this.id;
        
       
         
        $.confirm(
        {
            icon: 'glyphicon glyphicon-alert',
            title: 'Attention',
            content: 'Voulez vous vraiment supprimer ce rôle ?',
            type: 'red',
            typeAnimated: true,
            autoClose:"non|10000",
            buttons: 
            {
                oui:
                {
                    action: function () 
                    {
                        location.href = $('#form_supprRole').attr('action')+'/0/'+noRole;
                    }
                },
                non: 
                {
                    btnClass:"btn-red",
                    action: function () 
                    {
                        location.href = $('#form_supprRole').attr('action')+'/0/0';
                    }
                },
            }   
        });
    });

    $(".supprrole1").on('click',function()
    {
        noRole = this.id;
        
       
         
        $.confirm(
        {
            icon: 'glyphicon glyphicon-alert',
            title: 'Attention',
            content: 'Voulez vous vraiment supprimer ce rôle ?',
            type: 'red',
            typeAnimated: true,
            autoClose:"non|10000",
            buttons: 
            {
                oui:
                {
                    action: function () 
                    {
                        location.href = $('#form_supprRole').attr('action')+'/1/'+noRole;
                    }
                },
                non: 
                {
                    btnClass:"btn-red",
                    action: function () 
                    {
                        location.href = $('#form_supprRole').attr('action')+'/1/0';
                    }
                },
            }   
        });
    });

    $(document).ready(function(){
        $('[data-toggle="popover"]').popover(); 
    });


  });