$(document).ready(function () {
    var msg = new SpeechSynthesisUtterance();


    $('.mic').on({
        click: function(){

            if ($('.mic').attr('src') === BASE_URL + '/mic.png') {
                var vartext = $(".system-msg").last();
                msg.text = vartext.text();
                msg.lang = language;
                window.speechSynthesis.speak(msg);
                console.log(msg.text);
            }
        }
    })

});