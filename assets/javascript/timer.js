// function for countdown timer when activation code is request
function timer() {
    
    // variable instantiation
    var time = 30;

    // disapperaring resend link activation code
    document.getElementById('resend').style.display = 'none';

    // setting time continue decresing value of time
    setInterval(function () {  

        // when time is not zero, it will showing in the p element
        if (time >= 0) {
            
            // instantiation variable minutes, seconds and countdown
            var minutes = parseInt(time / 60);
            var seconds = parseInt(time % 60);

            var countdown = '';

            // when minutes is not zero, it will put minutes and seconds to countdown
            if(minutes != 0){

                countdown = minutes + ' menit ' + seconds + ' detik lagi';
            
            // when minutes is zero, it will put seconds to countdown            
            }else{

                countdown = seconds + ' detik lagi';

            }
            
            // then showing countdown to p element
            document.getElementById('timer').innerHTML = countdown;

            // decressing time value
            time--;
        
        // when time not zero, it will showing the resend link and disable input text activation_code, button submit and the p element
        }else{

            document.getElementById("activation_code").disabled = true; 
            document.getElementById("submit").disabled = true; 
            document.getElementById('timer').style.display = 'none';
            document.getElementById('resend').style.display = 'inline';
        }


    }, 1000);
}