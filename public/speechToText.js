$(document).ready(function () {
    // const searchForm = document.querySelector("#queryForm");
    // const searchFormInput = searchForm.querySelector("input");
    // const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
    // const recognition = new SpeechRecognition();
    // recognition.continuous = true;

    // language change

    $(".mic").click(function (e) {
        e.preventDefault();
        console.log(BASE_URL);
        var src = $(this).attr("src");
        // , BASE_URL+'/mic-listen.png');
        const searchForm = document.querySelector("#queryForm");
        const searchFormInput = searchForm.querySelector("input");
        const SpeechRecognition =
            window.SpeechRecognition || window.webkitSpeechRecognition;
        const recognition = new SpeechRecognition();
        recognition.continuous = true;

        recognition.lang = "en-US";
        if (src === BASE_URL + "/mic.png") {
            recognition.start();
            $(this).attr("src", BASE_URL + "/mic-listen.png");
        }
        // else if(src === BASE_URL + '/mic-listen.png'){
        //     recognition.stop();
        // }
        else {
            $(".mic").attr("src", BASE_URL + "/mic.png");
            recognition.stop();
        }

        recognition.addEventListener("start", startSpeechRecognition);
        function startSpeechRecognition() {
            searchFormInput.focus();
            console.log("Voice activated, SPEAK");
        }

        recognition.addEventListener("end", endSpeechRecognition);
        function endSpeechRecognition() {
            // $('.mic').attr('src', BASE_URL + '/mic.png');
            searchFormInput.focus();
            console.log("Speech recognition service disconnected");
        }

        recognition.addEventListener("result", resultOfSpeechRecognition);
        function resultOfSpeechRecognition(event) {
            const current = event.resultIndex;
            const transcript = event.results[current][0].transcript;
            if (transcript.toLowerCase().trim() === "stop recording") {
                recognition.stop();
            } else if (!searchFormInput.value) {
                searchFormInput.value = transcript;
            } else {
                if (transcript.toLowerCase().trim() === "go") {
                    searchForm.submit();
                } else if (transcript.toLowerCase().trim() === "reset input") {
                    searchFormInput.value = "";
                } else {
                    searchFormInput.value += transcript;
                }
            }
        }
    });

    jQuery.fn.putCursorAtEnd = function () {
        return this.each(function () {
            // Cache references
            var $el = $(this),
                el = this;

            // Only focus if input isn't already
            if (!$el.is(":focus")) {
                $el.focus();
            }

            // If this function exists... (IE 9+)
            if (el.setSelectionRange) {
                // Double the length because Opera is inconsistent about whether a carriage return is one character or two.
                var len = $el.val().length * 2;

                // Timeout seems to be required for Blink
                setTimeout(function () {
                    el.setSelectionRange(len, len);
                }, 1);
            } else {
                // As a fallback, replace the contents with itself
                // Doesn't work in Chrome, but Chrome supports setSelectionRange
                $el.val($el.val());
            }

            // Scroll to the bottom, in case we're in a tall textarea
            // (Necessary for Firefox and Chrome)
            this.scrollTop = 999999;
        });
    };

    var searchInput = $("#form-input");

    searchInput
        .putCursorAtEnd() // should be chainable
        .on("focus", function () {
            // could be on any event
            searchInput.putCursorAtEnd();
        });
});
