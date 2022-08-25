$("document").ready(function () {
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
            $(".modal").show();
            var msg = new SpeechSynthesisUtterance();
            var vartext = $(".system-msg").last();
            msg.text = vartext.text();
            msg.lang = language;
            window.speechSynthesis.speak(msg);

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

    $('.chat-btnx').on({
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
        }
    });

    var value = 0;
    var target = ".msg-body";
    var formName = "#queryForm";
    var msg;
    $(".service").click(function (e) {
        e.preventDefault();
        if (sessionStorage.getItem("phone") == "verified") {
            var link = $(this).attr("href");
            alert(link);
            $.ajax({
                url: link,
                data: $(this).attr("data-text"),
                type: "post",
                beforeSend: function () { },
                success: function (response) { },
                error: function (xhr, ajaxOptions, thrownErro) { },
                complete: function () { },
            });
        } else {
            msg =
                '<div class="system-msg">Please! Enter your phone number?</div>';
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
                if (input_val != "") {
                    msg =
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
                var output = JSON.parse(response);
                // console.log(output);
                msg =
                    "<div class='system-msg loading-spin'>" +
                    output.message +
                    "</div>";
                target_content(target, msg);

                if ($('#input-type').attr('value') == "phone") {
                    msg = "<div class='system-msg loading-spin'>" +
                        "Enter your OTP: " +
                        "</div>";
                    target_content(target, msg);
                }
                else if ($('#input-type').attr('value') == "otp" && output.status == "true") {
                    sessionStorage.setItem("phone", "verified")
                    firstMenu();
                }
            },
            error: function (xhr, ajaxOptions, thrownErro) {
                var error = JSON.parse(xhr.responseText);
                if (error.message != null) {
                    var msg = "<div class='system-msg'>" + 'Opps! Out of service right now.' + "</div>";
                    target_content(target, msg);
                }
                // var msg = "<div class='system-msg'>" + error.message + "</div>";

            },
            complete: function () {
                // var output = JSON.parse(response);
                form.trigger("reset");

                var user_msg_check = $('.user-msg').last();
                user_msg_check.find('.loader').removeClass('loader').addClass('fa-solid fa-check');

                if($("#input-type").attr("value") == "phone"){
                    $("#input-type").attr("value", 'otp');
                    $("#form-input").attr("type", "number");
                }
                else {
                    $("#input-type").attr("value", "normal-query");
                    $("#form-input").attr("type", "text");
                }
            },
        });
    }

    function firstMenu() {
        // msg = '<div class="first-menu col-12 my-3"><ul id="menu-list"><li class="bg-1"><a href='+"{{ url('/aadhaarService') }}"+'class="service" data-text="Aadhaar-Services"><span>Aadhaar Services</span></a></li><li class="bg-2"><a href="'+"{{ url('/getAadhaar') }}"+'class="service" data-text="Get-Aadhaar"><span>Get Addhar</span></a></li></ul><ul><li class="bg-3"><a href="'+"{{ url('/updateAadhaar') }}"+'class="service" data-text="Update-Aadhaar"><span>Update Addhar</span></a></li><li class="bg-4"><a href="'+"{{ url('/bookAppointment') }}"+'class="service" data-text="Book-Appointment"><span>Book appointment</span></a></li></ul></div>';
        // target_content(target, msg);
    }

    $(".proceed").click(function () {
        if (sessionStorage.getItem("proceed") == null) {
            sessionStorage.setItem("proceed", "toConverse");
            $(".welcome-screen").fadeOut("1000", function () {
                $(this).css({ display: "none" });
            });
        }
    });

    $('.lang-btn').click(function(){
        $('.goog-te-combo').change(function(){
            var data= $(this).val();
              alert(data);
        });
        $('.goog-te-combo')
            .val('hi')
            .trigger('change');
    });

});
