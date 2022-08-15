$("doument").ready(function () {
    "use strict";
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
            if (sessionStorage.getItem("proceed")) {
                $(".welcome-screen").fadeOut("1000", function () {
                    $(this).css({ display: "none" });
                });
            } else {
                $(".welcome-screen").slideDown("slow");
            }
            $("#autobot-body").slideDown("slow");
            $(".auto-launcher").css("display", "none");
            $(".formQuery-btn").css("display", "block");
        },
    });

    $(".btn-wel-close").on({
        click: function () {
            $("#autobot-body").fadeOut("1000", function () {
                $(this).css({ display: "none" });
                $(".chat-send").attr("src", "bot.png");
                $(".auto-launcher").css("display", "block");
            });
        },
    });

    $(".down-arrow").on({
        click: function () {
            $("#autobot-body").fadeOut("1000", function () {
                $(this).css({ display: "none" });
                $(".chat-send").attr("src", "bot.png");
                $(".auto-launcher").css("display", "block");
            });
        },
    });

    var value = 0;
    var target = ".msg-body";
    var formName = "#queryForm";

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
            var msg =
                '<div class="system-msg">Please! Enter you phone number?</div>';
            if (value == 0) {
                target_content(target, msg);
                value = value + 1;
                $("#form-input").attr("type", "number");
                $("#input-type").attr("value", "phone");
                $("#queryForm").submit(function (e) {
                    e.preventDefault();
                    processInput(formName);
                });
            }
        }
    });

    function target_content(target_body, msg) {
        $(target_body).animate({ scrollTop: $(target_body).height() }, 1000);
        $(target_body).append(msg);
    }

    function processInput(formClass) {
        var form = $(formClass);
        $.ajax({
            url: form.attr("action"),
            type: "post",
            data: form.serialize(),
            beforeSend: function () {
                var input_val = $("#form-input").val();
                if (input_val != '') {
                    var msg =
                        "<div class='user-msg loading-spin'>" +
                        input_val +
                        "<div class='loader'></div></div>";
                        target_content(target, msg);
                }
                // } else {
                //     var msg =
                //         "<div class='user-msg loading-spin'>" +
                //         input_val +
                //         "</div>";
                // }
            },
            success: function (response) {
                form.trigger("reset");
            },
            error: function (xhr, ajaxOptions, thrownErro) {
                var error = JSON.parse(xhr.responseText);
                var msg = "<div class='user-msg'>" + error.message + "</div>";
                target_content(target, msg);
            },
            complete: function () {},
        });
    }

    $(".proceed").click(function () {
        if (sessionStorage.getItem("proceed") == null) {
            sessionStorage.setItem("proceed", "toConverse");
            $(".welcome-screen").fadeOut("1000", function () {
                $(this).css({ display: "none" });
            });
        }
    });
});
