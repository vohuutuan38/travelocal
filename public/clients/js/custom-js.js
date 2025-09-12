$(document).ready(function(){
    $('#sign-in').click(function(){
        $('.sign-in').hide();
        $('.signup').show(1500);
    })

     $('#sign-up').click(function(){
        $('.sign-in').show(1500);
        $('.signup').hide();
    })






    $("#start_date , #end_date").datetimepicker({
        format: "d/m/Y",

        
        timepicker: false,
    });

    $('#userDropdown').click(function(){
        $('#dropdownMenu').toggle(500);
    })
});

