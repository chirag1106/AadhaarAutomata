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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"
        integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
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
                    <br>What would you like to explore?</div>



                <!-- first menu -->
                <hr>
                <div class="first-menu col-12">
                    {{-- <form action="/getQuery/" method="post"> --}}
                    <ul id="menu-list">
                        <li class="bg-1">
                            <a href="{{ url('/aadhaarService') }}" class="service" data-text="Aadhaar-Services">
                                <img src="" alt="">
                                <span>
                                    Aadhaar Services
                                </span>
                            </a>
                        </li>
                        <li class="bg-2">
                            <a href="{{ url('/getAadhaar') }}" class="service" data-text="Get-Aadhaar">
                                <img src="" alt="">
                                <span>
                                    Get Addhar
                                </span>
                            </a>
                        </li>
                    </ul>
                    <ul>
                        <li class="bg-3">
                            <a href="{{ url('/updateAadhaar') }}" class="service" data-text="Update-Aadhaar">
                                <img src="" alt="">
                                <span>
                                    Update Addhar
                                </span>
                            </a>
                        </li>
                        <li class="bg-4">
                            <a href="{{ url('/bookAppointment') }}" class="service" data-text="Book-Appointment">
                                <img src="" alt="">
                                <span>
                                    Book appointment
                                </span>
                            </a>
                        </li>
                    </ul>
                    {{-- </form> --}}
                </div>
                <hr>

                <!-- append user messege here -->

                {{-- <div class="user-msg">Hi! How are you?</div> --}}
            </div>
            <div class="msg-input">
                <div class="languages me-3">
                    <button>
                        <img src="language.png" alt="">
                    </button>
                </div>
                <form action="{{ url('/getInputQuery') }}" method="post" id="inputForm">
                    <input type="text" placeholder="Enter your query here..." name="input-query" id="form-input" data-key="">
                </form>
            </div>
            <div class="tool-bar col-12">

                <div class="beta-version">
                    <span>
                        Beta Version 0.1
                    </span>
                </div>
            </div>
        </div>

    </div>
</body>
<script src="app.js"></script>

</html>
