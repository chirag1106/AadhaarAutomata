<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Type-N-Speak</title>

    <style>
        body {
            backgound: #141414;
        }
    </style>
</head>

<body class="text-white">
    <div class="container text-cneter">
        <img src="img/speech.png" alt="" class="mb-5">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <form>
                    <div class="form-group mb-3">
                        <textarea name="" id="text-input" class="form-control form-control-lg" placeholder="Type anything..."></textarea>
                    </div>
                    <div class="form-group">
                        <label for="rate" class="text-dark">
                            Rate
                            <span id="rate-value" class="badge badge-primary float-right">1</span>
                        </label>
                        <input type="range" id="rate" class="custom-range" min="0.5" max="2" value="1" step="0.1">
                    </div>
                    <div class="form-group mb-3">
                        <label for="pitch" class="text-dark">Pitch <span id="pitch-value" class="badge badge-primary float-right">1</span> </label>
                        <input type="range" id="pitch" class="custom-range" min="0" max="2" value="1" step="0.1">
                    </div>
                    <div class="form-group mb-3">
                        <select id="voice-select" class="form-control form-control-lg form-select"></select>
                    </div>
                    <button class="btn btn-light btn-lg btn-block">Speak It</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('/voice_system.js') }}"></script>
</body>

</html>
