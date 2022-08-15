$("doument").ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    // $(".chat-btn").hover( function(){
    //     if($(this).hasattr("src","bot.png")){
    //         $(this).attr("src","send.png")
    //     }
    //     if($(this).hasattr("src","send.png")){
    //         $(this).attr("src","bot.png")
    //     }

    // });

    $(".chat-btn").on({
        mouseenter: function () {
            var bg =
                $(this).css("background-color") === "white"
                    ? "#622ae8"
                    : "white";
            $(this).css("background-color", bg);
        },

        mouseleave: function () {
            var bg1 =
                $(this).css("background-color") === "#622ae8"
                    ? "white"
                    : "#622ae8";
            $(this).css("background-color", bg1);
        },

        click: function () {
            var src =
                $(".chat-send").attr("src") === "bot.png"
                    ? "send.png"
                    : "send.png";
            $(".chat-send").attr("src", src);
            if(sessionStorage.getItem('proceed')){
                $(".welcome-screen").fadeOut("1000", function () {
                $(this).css({ display: "none" });
            });
            }
            else{
                $(".welcome-screen").slideDown("slow");
            }
            $("#autobot-body").slideDown("slow");
            // if()
        },
    });

    $(".btn-wel-close").on({
        click: function () {
            // $(".welcome-screen").fadeOut("1000", function () {
            //     $(this).css({ display: "none" });
            // });
            $("#autobot-body").fadeOut("1000", function () {
                $(this).css({ display: "none" });
                $(".chat-send").attr("src", "bot.png");
            });
        },
    });

    $(".down-arrow").on({
        click: function () {
            $("#autobot-body").fadeOut("1000", function () {
                $(this).css({ display: "none" });
                $(".chat-send").attr("src", "bot.png");
            });
        },
    });

    var value = 0;
    $(".service").click(function (e) {
        e.preventDefault();
        if (sessionStorage.getItem("verified")) {
            var link = $(this).attr("href");
            $.ajax({
                url: link + "/" + $(this).attr("data-text"),
                type: "post",
                beforeSend: function () {},
                success: function (response) {},
                error: function (xhr, ajaxOptions, thrownErro) {},
                complete: function () {},
            });
        } else {
            var $target = $(".msg-body");
            $target.animate({ scrollTop: $target.height() }, 1000);
            var msg =
                '<div class="system-msg">Please! Enter you phone number?</div>';
            if (value == 0) {
                $(".msg-body").append(msg);
                value = value + 1;
                $('#form-input').attr('data-key', 'phone').attr('type', 'number');
            }
        }
    });
    $(function processInput() {
        var form = $("#inputForm");
        $.ajax({
            url: $(this).attr("action"),
            type: "post",
            data: $(this).serialize(),
            beforeSend: function () {

            },
            success: function (response) {},
            error: function (xhr, ajaxOptions, thrownErro) {},
            complete: function () {},
        });
    });

    $('.proceed').click(function(){
        if(sessionStorage.getItem('proceed') == null){
            sessionStorage.setItem('proceed','toConverse');
            $(".welcome-screen").fadeOut("1000", function () {
                $(this).css({ display: "none" });
            });
        }
    });


});
