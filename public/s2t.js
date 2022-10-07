// Import stylesheets

// Write Javascript code!
var button = document.getElementById("talk");

var grammar =
    "#JSGF V1.0; grammar colors; public <color> = aqua | azure | beige | bisque | black | blue | brown | chocolate | coral | crimson | cyan | fuchsia | ghostwhite | gold | goldenrod | gray | green | indigo | ivory | khaki | lavender | lime | linen | magenta | maroon | moccasin | navy | olive | orange | orchid | peru | pink | plum | purple | red | salmon | sienna | silver | snow | tan | teal | thistle | tomato | turquoise | violet | white | yellow ;";
var SpeechRecognition =
    window.SpeechRecognition || window.webkitSpeechRecognition;
var SpeechGrammarList =
    window.SpeechGrammarList || window.webkitSpeechGrammarList;
var recognition = new SpeechRecognition();
var speechRecognitionList = new SpeechGrammarList();
speechRecognitionList.addFromString(grammar, 1);
recognition.grammars = speechRecognitionList;
recognition.continuous = true;
recognition.lang = "en-US";
recognition.interimResults = false;
recognition.maxAlternatives = 1;

// var diagnostic = document.getElementById(".form-input");
const searchForm = document.querySelector("#queryForm");
const diagnostic = searchForm.querySelector("input");
button.onclick = function () {
    recognition.start();
    diagnostic.focus();
    diagnostic.text = "Please speak something.";
    console.log("working");
};

recognition.onresult = function (event) {
    var color = event.results[0][0].transcript;
    diagnostic.value = "Result received: " + color;
    console.log(color);
};
