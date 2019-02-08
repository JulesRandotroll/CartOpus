$(function() {
    

    $('#toggle-one').bootstrapToggle();
    
    $('[data-toggle="popover"]').popover();

    $('input[type=checkbox] ').change(function() 
    {
        if(this.id == 'transition')
        {
            if(this.checked)
            {
                location.href='sInscrireVisiteur';
            }
            else
            {
                location.href='SInscrire';
            }
        }
        
    })
});