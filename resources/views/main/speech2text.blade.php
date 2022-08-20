<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

    <style>
     #transcript {
  width: 100%;
  height: 150px;
}
    </style>

    <title>Type-N-Speak</title>
</head>

<body>
<textarea type="text" name="q" id="transcript" placeholder="Speak" class="keyboardInput"></textarea>

<input  id="action" type="button" onclick="toggle()" value="Start"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        var recognition = new webkitSpeechRecognition();
recognition.continuous = true;
recognition.interimResults = true;
recognition.lang = "hi-IN";

var listening = false;

recognition.onresult = function(event) {
    var interim_transcript = '';
    var final_transcript = '';

    for (var i = event.resultIndex; i < event.results.length; ++i) {
      if (event.results[i].isFinal) {
        final_transcript += event.results[i][0].transcript;
         document.getElementById('transcript').value = final_transcript;
        toggle();
      } else {
        interim_transcript += event.results[i][0].transcript;
            document.getElementById('transcript').value = interim_transcript;
      }
    }
    console.log(interim_transcript, final_transcript);

  };

function toggle() {
  if(listening) {
    recognition.stop();  
    listening = false;
  document.getElementById('action').value = "Start";
  }
  else {
    recognition.start();
    listening = true;
  document.getElementById('action').value = "Stop";
  }
}
    </script>
</body>

</html>