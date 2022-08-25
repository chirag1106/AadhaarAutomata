<!DOCTYPE html>
<html lang="en">

<head>
    <script>
        var BASE_URL = "{{ url('/') }}";
        var language = "en-US";
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
            <div class="modal modal-width" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- <div class="modal-header">
                            <h5 class="modal-title">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div> -->
                        <div class="modal-body text-center">
                            <p class="my-3">Choose your preffered language</p>
                            <button type="button" class="btn mx-1 px-3 rounded-pill btn-custom-col2 english" data-bs-dismiss="modal" data-lang="en-US">English</button>
                            <button type="button" class="btn mx-1 px-4 rounded-pill btn-custom-col2 hindi" data-lang="hi-IN">हिन्दी</button>
                            <p class="my-3">अपनी पसंदीदा भाषा चुनें</p>
                        </div>
                        <!-- <div class="modal-footer">
                        </div> -->
                    </div>
                </div>
            </div>
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

<<<<<<< HEAD
            <div class="beta-version text-white text-center my-auto">
=======
            <div class="beta-version text-white text-center mx-auto my-auto">
>>>>>>> 7af9b213ed11b521c11f2835357a7b08d704cccf
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
                <div class="auto-generated">Hi, I'm Autobot.</div>
                <div class="auto-generated">Before we begin, please choose one of the topics.
                    <br>What would you like to explore?
                </div>

                <div class="auto-generated">
                    <div class="typing">
                        <div class="dot"></div>
                        <div class="dot"></div>
                        <div class="dot"></div>
                    </div>
                </div>



                <!-- first menu -->
                <hr>
                <div class="first-menu col-12 my-3">
                    <ul id="menu-list">
                        <li class="bg-1">
                            <a href="{{ url('/updateAadhaar/update') }}" class="service" data-text="Update-Aadhaar">
                                {{-- <img src="" alt=""> --}}
                                <span>
                                    Update Aadhar
                                </span>
                            </a>
                        </li>
                        <li class="bg-2">
                            <a href="{{ url('/getAadhaar') }}" class="service" data-text="Get-Aadhaar">
                                {{-- <img src="" alt=""> --}}
                                <span>
                                    Get Aadhar
                                </span>
                            </a>
                        </li>
                    </ul>
                    <hr>
                </div>

                <!-- append user messege here -->

                {{-- <div class="user-msg">Hi! How are you?</div> --}}
            </div>
            <div class="msg-input px-1 mx-0">
                <form action="{{ url('/getInputQuery') }}" method="post" id="queryForm" class="w-100">
                    <div class="input-group d-flex flex-nowrap justify-content-between align-items-center">

                        <!-- language icon -->

                        <!-- <div class="languages me-1">
                            <button type="button" class="lang-btn">
                                <img src="language.png" alt="">
                            </button>
                        </div> -->



<<<<<<< HEAD
                        <input type="text" placeholder="Enter your query here..." name="input_query" id="form-input" style="overflow-x: scroll;">
                        <input type="hidden" name="query_type" value="" id="input-type">
=======
                        <input type="text" placeholder="Enter your query here..." name="input_query" id="form-input" class="ms-2">
                        <input type="hidden" name="query_type" value="" id="input-type" class="ms-2">
>>>>>>> 7af9b213ed11b521c11f2835357a7b08d704cccf
                        {{-- <input type="submit" value="Submit" class="btn btn-info"> --}}
                        <img src="{{ asset('/mic.png') }}" alt="" class="img-fluid mic" style="width:25px; height:25px">
                        <div class="formQuery-btn">
                            <button class="chat-btnx" type="submit">
                                <img class="chat-send" src="bot.png" alt="">
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="tool-bar col-12 d-flex flex-nowrap justify-content-between align-items-center align-content-center">
                <!-- <div class="powered">
                    <span style="font-size: 0.65rem">Powered-By: Ray-Of-Identity </span>
                </div> -->
                <div id="google_translate_element">
                    <div class="skiptranslate goog-te-gadget" dir="ltr">
                        <div id=":0.targetLanguage">
                        </div>
                    </div>
                </div>
                <div class="beta-version">
                    <span style="font-size: 0.65rem">
                        Powered-By: Ray-Of-Identity
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
    <script src="text2speech.js"></script>
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en'
            }, 'google_translate_element');
        }
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</body>

</html>
