// const { get } = require("lodash");

$("document").ready(function () {
    // "use strict";
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
            // var msg = new SpeechSynthesisUtterance();
            // var vartext = $(".system-msg").last();
            // msg.text = vartext.text();
            // msg.lang = language;
            // window.speechSynthesis.speak(msg);
            // console.log(msg.text);
        },
    });

    // $(".goog-te-combo").val().change();

    $(".hindi").on({
        click: function () {
            language = $(".hindi").attr("data-lang");
            console.log(language);
            // setSelect('hi');
        },
    });

    $(".english").on({
        click: function () {
            language = $(".english").attr("data-lang");
            console.log(language);
            // setSelect('en');
        },
    });

    // function setSelect(val) {
    //     document.getElementByClass("goog-te-combo").value = val;
    // }

    $(".btn-custom-col2").on({
        click: function () {
            $(".modal").hide();
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

    $(".chat-btnx").on({
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
    });

    var value = 0;
    var target = ".msg-body";
    var formName = "#queryForm";
    var msg;
    var clickedService;
    var paymentButton =
        '<button id="rzp-button1" class="btn btn-outline-dark"><i class="fas fa-money-bill"></i>Pay Rs.50</button>';

    $(".service").click(function (e) {
        e.preventDefault();
        if (sessionStorage.getItem("phone") != "verified") {
            // } else {
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
        else {
            // $("#queryForm").submit(function (e) {
            //     e.preventDefault();
            //     processInput(formName);
            // });
        }
    });

    function target_content(target_body, msg) {
        $(target_body).animate({ scrollTop: $(target_body).height() }, 1000);
        $(target_body).after($('.main-list')).append(msg);
        $('.main-list').appendTo(target_body);
        // $(target_body).insertbefore($('.main-list')).append(msg);
    }

    $(".service").on({
        click: function () {
            clickedService = $(this).attr("href");
            // console.log(clickedService);
            $(".hr-menu").css("display", "none");
            $(".first-menu").fadeOut(300);
        },
    });

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
                if (output.status == "true") {
                    msg =
                        "<div class='system-msg loading-spin'>" +
                        output.message +
                        "</div>";
                    target_content(target, msg);
                } else {
                    msg =
                        "<div class='system-msg error-border loading-spin'>" +
                        output.message +
                        "</div>";
                    target_content(target, msg);
                }

                if ($("#input-type").attr("value") == "phone") {
                    if (output.status == "true") {
                        msg =
                            "<div class='system-msg loading-spin'>" +
                            "Enter your OTP: " +
                            "</div>";
                        target_content(target, msg);
                        $("#input-type").attr("value", "otp");
                        $("#form-input").attr("type", "number");
                    } else {
                        msg =
                            '<div class="system-msg">Please! Enter your phone number?</div>';
                        target_content(target, msg);
                        $("#form-input").attr("type", "number");
                        $("#input-type").attr("value", "phone");
                    }
                } else if ($("#input-type").attr("value") == "otp") {
                    if (output.status == "true") {
                        sessionStorage.setItem("phone", "verified");
                        // var menu_msg = '<div class="system-msg-2 update-menu-list"><ul class="ps-0"><li class="btn pb-1 d-block menu-li u-name text-capitalize" style="text-decoration: none; text-align: left;">update name</li><li class="btn pb-1 d-block menu-li u-fname text-capitalize" style="text-decoration: none; text-align: left;">update father-name</li><li class="btn pb-1 d-block menu-li u-dob text-capitalize" style="text-decoration: none; text-align: left;">update date-of-birth</li><li class="btn pb-1 d-block menu-li u-gender text-capitalize" style="text-decoration: none; text-align: left;">update gender</li><li class="btn pb-1 d-block menu-li u-address text-capitalize" style="text-decoration: none; text-align: left;">update address</li></ul></div>';

                        // console.log(clickedService);
                        $.ajax({
                            url: clickedService,
                            type: "post",
                            beforeSend: function () { },
                            success: function (response) {
                                // console.log(response);
                                var response2 = JSON.parse(response);
                                var value = response2.menu["value1"];
                                var split_array = value.split(",");
                                var main_menu;
                                var main_menu_array = new Array();
                                var j = 0;
                                // console.log(split_array.length);
                                for (var i = 0; i < split_array.length; i++) {
                                    main_menu = split_array[i].replace(
                                        "-",
                                        " "
                                    );
                                    main_menu_array[j] = main_menu;
                                    j++;
                                }

                                // var menu_msg = '<div class="system-msg-2 update-menu-list"><ul class="ps-0"><li class="btn pb-1 d-block menu-li u-name text-capitalize" style="text-decoration: none; text-align: left;">update name</li><li class="btn pb-1 d-block menu-li u-fname text-capitalize" style="text-decoration: none; text-align: left;">update father-name</li><li class="btn pb-1 d-block menu-li u-dob text-capitalize" style="text-decoration: none; text-align: left;">update date-of-birth</li><li class="btn pb-1 d-block menu-li u-gender text-capitalize" style="text-decoration: none; text-align: left;">update gender</li><li class="btn pb-1 d-block menu-li u-address text-capitalize" style="text-decoration: none; text-align: left;">update address</li></ul></div>';
                                // var menu_msg = "<div class='system-msg>";
                                // for (
                                //     var i = 0;
                                //     i < main_menu_array.length;
                                //     i++
                                // ) {
                                //     menu_msg +=
                                //         "<p class='pb-1 d-block menu-li u-name text-capitalize' style='text-decoration: none; text-align: left;'>" +
                                //         main_menu_array[i] +
                                //         "</p>";
                                // menu_msg += list;
                                // }
                                // var list = "<button type='submit' class='btn pb-1 d-block menu-li u-name text-capitalize' style='text-decoration: none; text-align: left;'>" + main_menu_array[0] + "</button>";
                                // menu_msg += list;
                                // var list = "<button type='submit' class='btn pb-1 d-block menu-li u-fname text-capitalize' style='text-decoration: none; text-align: left;'>" + main_menu_array[1] + "</button>";
                                // menu_msg += list;
                                // var list = "<button type='submit' class='btn pb-1 d-block menu-li u-dob text-capitalize' style='text-decoration: none; text-align: left;'>" + main_menu_array[2] + "</button>";
                                // menu_msg += list;
                                // var list = "<button type='submit' class='btn pb-1 d-block menu-li u-gender text-capitalize' style='text-decoration: none; text-align: left;'>" + main_menu_array[3] + "</button>";
                                // menu_msg += list;
                                // var list = "<button type='submit' class='btn pb-1 d-block menu-li u-address text-capitalize' style='text-decoration: none; text-align: left;'>" + main_menu_array[4] + "</button>";
                                // menu_msg += list;

                                // menu_msg += "</div>";

                                // console.log(menu_msg);

                                // $('.msg-body').last().append(menu_msg);
                            },
                            error: function () { },
                            complete: function () {
                                // $('.msg-body').html('<div class="system-msg-2 update-menu-list"><ul class="ps-0"><li class="btn pb-1 d-block menu-li u-name text-capitalize" style="text-decoration: none; text-align: left;">update name</li><li class="btn pb-1 d-block menu-li u-fname text-capitalize" style="text-decoration: none; text-align: left;">update father-name</li><li class="btn pb-1 d-block menu-li u-dob text-capitalize" style="text-decoration: none; text-align: left;">update date-of-birth</li><li class="btn pb-1 d-block menu-li u-gender text-capitalize" style="text-decoration: none; text-align: left;">update gender</li><li class="btn pb-1 d-block menu-li u-address text-capitalize" style="text-decoration: none; text-align: left;">update address</li></ul></div>');
                                // $('.update-menu-list').css("display", "block");

                                // sendSMS("Your phone number is verified.");
                                // $(".msg-body")
                                //     .last()
                                //     .append(
                                //         '<div class="system-msg-2 update-menu-list">'+
                                //         '<ul class="ps-0">'+
                                //         '<li class="pb-1 menu-li text-capitalize" style="list-style-type: none; text-align: left;"><button id="u-name" onclick= document.getElementById("modal-name").style.display= "block">update name</button></li>'+
                                //         '<li class="pb-1 menu-li u-fname text-capitalize" style="list-style-type: none; text-align: left;"><button id="u-fname" onclick= document.getElementById("modal-fname").style.display= "block">update father-name</button></li>'+
                                //         '<li class="pb-1 menu-li u-dob text-capitalize" style="list-style-type: none; text-align: left;"><button id="u-dob" onclick= document.getElementById("modal-dob").style.display= "block">update date-of-birth</button></li>'+
                                //         '<li class="pb-1 menu-li u-gender text-capitalize" style="list-style-type: none; text-align: left;"><button id="u-gender" onclick= document.getElementById("modal-gender").style.display= "block">update gender</button></li>'+
                                //         '<li class="pb-1 menu-li u-address text-capitalize" style="list-style-type: none; text-align: left;"><button id="u-address" onclick= document.getElementById("modal-address").style.display= "block">update address</button></li>'+
                                //         '</ul></div>'

                                //         );
                                $('.main-list').css('display', 'block').addBack();
                            }
                        });
                        $("#input-type").attr("value", "normal-query");
                        $("#form-input").attr("type", "text");
                    } else {
                        $("#input-type").attr("value", "otp");
                        $("#form-input").attr("type", "number");
                    }
                }
            },
            error: function (xhr, ajaxOptions, thrownErro) {
                var error = JSON.parse(xhr.responseText);
                if (error.message != null) {
                    var msg =
                        "<div class='system-msg'>" +
                        "Opps! Out of service right now." +
                        "</div>";
                    target_content(target, msg);
                }
                // var msg = "<div class='system-msg'>" + error.message + "</div>";
            },
            complete: function () {
                // var output = JSON.parse(response);
                form.trigger("reset");

                var user_msg_check = $(".user-msg").last();
                user_msg_check
                    .find(".loader")
                    .removeClass("loader")
                    .addClass("fa-solid fa-check");

                // if ($("#input-type").attr("value") == "phone") {
                //     // $("#input-type").attr("value", 'otp');
                //     // $("#form-input").attr("type", "number");
                // }
                // else {
                //     $("#input-type").attr("value", "normal-query");
                //     $("#form-input").attr("type", "text");
                // }
            },
        });
    }


    $('#form-name').submit(function (e) {
        e.preventDefault();
        var link = $(this).attr('action');
        //         var fd = new FormData();
        // fd.append( 'file', input.files[0] );
        $.ajax({
            url: link,
            type: 'post',
            data: $('#form-name').serialize(),
            beforeSend: function () {
                console.log(new FormData($('#form-name').get(0)));
            },
            success: function (response) {

            },
            complete: function () {

                // $(paymentButton).appendTo('#form-name');
                // $('.btn-cus-1').css('display','none');
                // $('.btn-cus-2').css('display','none');

            }
        });
        // $('.btn-cus-1').css('display','none');
        // $('.btn-cus-2').css('display','none');
        // $('#form-name').append('<button id="rzp-button1" class="btn btn-outline-dark"><i class="fas fa-money-bill"></i>Pay Rs.50</button>');
    });

    // $('.updateQueryname').click(function (e) {
    //     e.preventDefault();
    //     var link = $('#form-name').attr('action');
    //     alert(link);
    // });

    $('.u-names').click(function () {
        $('#modal-name').css('display', 'block').animate({ scrollTop: $("#myID").scrollTop() }, 1000);
        $('.update-list-menu').css('display', 'none');
    });
    $('.u-gen').click(function () {
        $('#modal-gender').css('display', 'block').css('display', 'block').animate({ scrollTop: $("#myID").scrollTop() }, 1000);
        $('.update-list-menu').css('display', 'none');
    });
    $('.u-dob').click(function () {
        $('#modal-dob').css('display', 'block').css('display', 'block').animate({ scrollTop: $("#myID").scrollTop() }, 1000);
        $('.update-list-menu').css('display', 'none');
    });
    $('.u-add').click(function () {
        $('#modal-address').css('display', 'block').css('display', 'block').animate({ scrollTop: $("#myID").scrollTop() }, 1000);
        $('.update-list-menu').css('display', 'none');
    });
    $('.u-fname').click(function () {
        $('#modal-fname').css('display', 'block').css('display', 'block').animate({ scrollTop: $("#myID").scrollTop() }, 1000);
        $('.update-list-menu').css('display', 'none');
    });

    function sendSMS($msg) {
        $.ajax({
            url: BASE_URL + "/sendSMS/" + $msg,
            type: "post",
            beforeSend: function () { },
            success: function (response) {
                console.log(response);
            },
            error: function () { },
            complete: function () { },
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

    $(".lang-btn").click(function () {
        $(".goog-te-combo").change(function () {
            var data = $(this).val();
            alert(data);
        });
        $(".goog-te-combo").val("hi").trigger("change");
    });

    // $("#queryForm").submit(function (e) {
    //     e.preventDefault();
    //     // $("#form-input").attr("type", "text");
    //     // $("#input-type").attr("value", "normal-query");
    //     processInput(formName);
    // });

    setInterval(function () {
        $("body").css("top", 0);
    }, 1000);

    var options = {
        key: "rzp_test_uKovlltaWXyGkI",
        amount: "5000",
        currency: "INR",
        description: "Aadhaar Services",
        image: "https://s3.amazonaws.com/rzp-mobile/images/rzp.jpg",
        handler: function (response) {
            console.log(response);
            // if (response.status_code == "200") {
            var status;
            if (response.razorpay_payment_id != null) {
                status = "true";
                msg ='<div class="system-msg">Payment Successfully done.</div> <div class="system-msg">Your details will be updated with 8 - 10 working days. </div>';
                sendSMS(msg);
            } else {
                status = "false";
                msg = '<div class="system-msg">Payment Failed </div>';
            }

            $.ajax({
                url: BASE_URL + "/updatePayment",
                type: "post",
                data:
                    "paymentID=" +
                    response.razorpay_payment_id +
                    "&status=" +
                    status,
                success: function (response) {
                    target_content(target, msg);
                },
            });
        },
    };

    var rzp1 = new Razorpay(options);
    document.getElementById("rzp-button1").onclick = function (e) {
        rzp1.open();
        e.preventDefault();
    };

    function sendSMS($msg) {
        $.ajax({
            url: BASE_URL + "/sendSMS/" + $msg,
            type: "post",
            beforeSend: function () { },
            success: function (response) {
                console.log(response);
            },
            error: function () { },
            complete: function () { },
        });
    }

    // $("menu-li").click(function(e){
    //     e.preventDefault();
    //     alert('chirag');
    // });

    // $('.u-name').delegate('.logout-link','click',function() {

    // $("#u-name").click(function (e) {
    //     e.preventDefault();
    //     $("#modal-form").css("display", "block");
    //     $(".update-menu-list").css("display", "none");
    //     console.log("chirag");
    // });



    // $(".u-fname").on({
    //     click: function () {
    //         $(".m-fname").css("display", "block");
    //         $(".update-menu-list").css("display", "none");
    //     },
    // });
    // $(".u-address").click(function () {
    //     $(".m-address").css("display", "block");
    //     $(".update-menu-list").css("display", "none");
    // });
    // $(".u-gender").click(function () {
    //     alert("chirag");
    //     $(".m-gender").css("display", "block");
    //     $(".update-menu-list").css("display", "none");
    // });
    // $(".u-dob").on({
    //     click: function () {
    //         $(".m-dob").css("display", "block");
    //         $(".update-menu-list").css("display", "none");
    //     },
    // });

    // $('.update-menu-list').click(function(){
    //     console.log('chirag');
    // });

    // function showNameForm(){
    //     document.getElementById('modal-name').style.display= 'block';
    //     formName.style.display= 'block';
    // }

    // $(document.body).on('click', '#u-name' ,function(){
    //     alert('chirag');
    // });


});
