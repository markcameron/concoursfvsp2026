// import './bootstrap';

Number.prototype.pad = function(size) {
    var s = String(this);
    while (s.length < (size || 2)) {s = "0" + s;}
    return s;
}

function setCountdown(countDownDate) {
    // Get today's date and time
    var now = new Date().getTime();

    // Find the distance between now and the count down date
    var distance = countDownDate - now;

    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Display the result in the element with id="demo"
    document.getElementById("days").innerHTML = days.pad(2);
    document.getElementById("hours").innerHTML = hours.pad(2);
    document.getElementById("minutes").innerHTML = minutes.pad(2);
    document.getElementById("seconds").innerHTML = seconds.pad(2);

    // If the count down is finished, write some text
    if (distance < 0) {
      clearInterval(x);
      document.getElementById("demo").innerHTML = "EXPIRED";
    }
}

// Set the date we're counting down to
var countDownDate = new Date("May 8, 2026 08:30:00").getTime();

setCountdown(countDownDate);

// Update the count down every 1 second
var x = setInterval(setCountdown, 1000, countDownDate);
