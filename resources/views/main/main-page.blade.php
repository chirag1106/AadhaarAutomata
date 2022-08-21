<!DOCTYPE html>
<html lang="en">

<head>
    <script>
        var BASE_URL = "{{ url('/') }}";
    </script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name='csrf-token' content="{{ csrf_token() }}">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" />
    <title>Aadhaar Service</title>
</head>

<body>

    <!-- button start -->

    <div class="auto-launcher row">
        <button class="chat-btn ">
            <img class="chat-send" src="bot.png" alt="">
        </button>
    </div>

    <!-- button end -->
    <div id="autobot-body" class="container">


        <!-- welcome screem -->


        <div class="welcome-screen row flex justify-content-evenly">
            <div class="col-12 close ms-0 me-auto">
                <button class="btn btn-wel-close inv">
                    <img src="./close.png" alt="">
                </button>
            </div>
            <div class="col-12 hello text-center">
                <Span>Hello</Span><br><span>I'm Autobot</span>
            </div>
            <div class="col-12 text-center mx-auto">
                <div class="circle-outer mx-auto">
                    <div class="circle-inner">
                        <img src="bot.png" alt="">
                    </div>
                </div>
            </div>
            <div class="col-12 hello text-center">
                <span>How can I help</span><br>
                <span>you?</span>
            </div>
            <div class="col-12 text-center">
                <button class="btn hvr btn-lg border rounded-pill hello-2 px-5 proceed">Let me know!</button>
            </div>

            <div class="beta-version text-white text-center my-auto">
                <span>
                    Beta Version 0.1
                </span>
            </div>
        </div>


        <!-- welcome screen end -->



        <div class="chatbot row">
            <div class="bot-header col-12">
                <div class="bot-hi">
                    <div class="bot-id">
                        <img src="bot.png" alt="">
                    </div>
                    <div class="hi-text ms-3">
                        Hi there!
                    </div>
                    <div class="hi-emo ps-1">
                        <img src="hi.png" alt="">
                    </div>
                </div>
                <div class="down-arrow me-3">
                    <button>
                        <img src="d-arrow.png" alt="">
                    </button>
                </div>
            </div>
            <div class="msg-body">
                <div class="system-msg">Hi, I'm Autobot.</div>
                <div class="system-msg">Before we begin, please choose one of the topics.
                    <br>What would you like to explore?
                </div>



                <!-- first menu -->
                {{-- <hr> --}}
                <div class="first-menu col-12 my-3">
                    {{-- <form action="/getQuery/" method="post"> --}}
                    <ul id="menu-list">
                        <li class="bg-1">
                            <a href="{{ url('/aadhaarService') }}" class="service" data-text="Aadhaar-Services">
                                {{-- <img src="" alt=""> --}}
                                <span>
                                    Aadhaar Services
                                </span>
                            </a>
                        </li>
                        <li class="bg-2">
                            <a href="{{ url('/getAadhaar') }}" class="service" data-text="Get-Aadhaar">
                                {{-- <img src="" alt=""> --}}
                                <span>
                                    Get Addhar
                                </span>
                            </a>
                        </li>
                    </ul>
                    <ul>
                        <li class="bg-3">
                            <a href="{{ url('/updateAadhaar') }}" class="service" data-text="Update-Aadhaar">
                                {{-- <img src="" alt=""> --}}
                                <span>
                                    Update Addhar
                                </span>
                            </a>
                        </li>
                        <li class="bg-4">
                            <a href="{{ url('/bookAppointment') }}" class="service" data-text="Book-Appointment">
                                {{-- <img src="" alt=""> --}}
                                <span>
                                    Book appointment
                                </span>
                            </a>
                        </li>
                    </ul>
                    {{-- </form> --}}
                </div>
                {{-- <hr> --}}

                <!-- append user messege here -->

                {{-- <div class="user-msg">Hi! How are you?</div> --}}
            </div>
            <div class="msg-input px-1 mx-0">
                <form action="{{ url('/getInputQuery') }}" method="post" id="queryForm" class="w-100">
                    <div class="input-group d-flex flex-nowrap justify-content-between align-items-center">
                        <div class="languages me-1">
                            <button>
                                <img src="language.png" alt="">
                            </button>
                        </div>



                        <input type="text" placeholder="Enter your query here..." name="input_query" id="form-input">
                        <input type="hidden" name="query_type" value="" id="input-type">
                        {{-- <input type="submit" value="Submit" class="btn btn-info"> --}}
                        <img src="{{ asset('/mic.png') }}" alt="" class="img-fluid mic"
                            style="width:25px; height:25px">
                        <div class="formQuery-btn">
                            <button class="chat-btnx" type="submit">
                                <img class="chat-send" src="bot.png" alt="">
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div
                class="tool-bar col-12 d-flex flex-nowrap justify-content-between align-items-center align-content-center">
                <div class="powered">
                    <span style="font-size: 0.65rem">Powered-By: Ray-Of-Identity </span>
                </div>
                <div class="beta-version">
                    <span style="font-size: 0.65rem">
                        Beta Version 0.1
                    </span>
                </div>
            </div>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="app.js"></script>
    <script src="speechToText.js"></script>
</body>

</html>
