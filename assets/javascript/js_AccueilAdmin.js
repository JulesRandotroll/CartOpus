$(function() 
{
    $('.info').hide();    

    $('.lienInfo').on('click',function()
    {
        id = this.id;
        $('.info').hide();
        //alert('#info'+id); 
        $('#info'+id).show();
    });

    $('.backUp').on('click',function()
    {
        //alert('back up');
        $('.info').hide(); 
    });
});