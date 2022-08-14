$('doument').ready(function () {
    // $(".chat-btn").hover( function(){
    //     if($(this).hasattr("src","bot.png")){
    //         $(this).attr("src","send.png")
    //     }
    //     if($(this).hasattr("src","send.png")){
    //         $(this).attr("src","bot.png")
    //     }

    // });

    $('.chat-btn').on({
        'mouseenter': function () {
            var bg = ($(this).css('background-color') === 'white')
                ? '#622ae8'
                : 'white';
            $(this).css('background-color', bg);
        },

        'mouseleave': function () {
            var bg1 = ($(this).css('background-color') === '#622ae8')
                ? 'white'
                : '#622ae8';
            $(this).css('background-color', bg1);
        },


        'click': function () {
            var src = ($('.chat-send').attr('src') === 'bot.png')
                ? 'send.png'
                : 'send.png';
            $('.chat-send').attr('src', src);
            $('.welcome-screen').slideDown('slow');
            $('#autobot-body').slideDown('slow');
        }
    });

    $('.btn-wel-close').on({
        'click': function () {
            $('.welcome-screen').fadeOut('1000', function(){
                $(this).css({display:"none"});
            });
        }
    });

    $('.down-arrow').on({
        'click': function () {
            $('#autobot-body').fadeOut('1000', function(){
                $(this).css({display:"none"});
                $('.chat-send').attr('src','bot.png')
            });
        }
    });




});