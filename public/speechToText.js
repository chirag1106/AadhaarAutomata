$(document).ready(function(){
    $('.mic').click(function(e){
        // e.preventDefault();
        console.log(BASE_URL);
        $(this).attr('src', BASE_URL+'/mic-listen.png');

    });
});
