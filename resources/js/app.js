// import './bootstrap';

import '@tailwindplus/elements';

// Number.prototype.pad = function(size) {
//     var s = String(this);
//     while (s.length < (size || 2)) {s = "0" + s;}
//     return s;
// }

// function setCountdown(countDownDate) {
//     // Get today's date and time
//     var now = new Date().getTime();

//     // Find the distance between now and the count down date
//     var distance = countDownDate - now;

//     // Time calculations for days, hours, minutes and seconds
//     var days = Math.floor(distance / (1000 * 60 * 60 * 24));
//     var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
//     var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
//     var seconds = Math.floor((distance % (1000 * 60)) / 1000);

//     // Display the result in the element with id="demo"
//     document.getElementById("days").innerHTML = days.pad(2);
//     document.getElementById("hours").innerHTML = hours.pad(2);
//     document.getElementById("minutes").innerHTML = minutes.pad(2);
//     document.getElementById("seconds").innerHTML = seconds.pad(2);

//     // If the count down is finished, write some text
//     if (distance < 0) {
//       clearInterval(x);
//       document.getElementById("demo").innerHTML = "EXPIRED";
//     }
// }

// // Set the date we're counting down to
// var countDownDate = new Date("May 8, 2026 08:30:00").getTime();

// setCountdown(countDownDate);

// // Update the count down every 1 second
// var x = setInterval(setCountdown, 1000, countDownDate);

window.addEventListener('DOMContentLoaded', function() {
  if (!document.getElementById('countdown')) return;
  // Define the target date/time (May 8, 2026 07:30:00)
  var targetDate = new Date("May 8, 2026 07:30:00").getTime();

  // Extend the Number prototype to include a `pad` method.
  // This method converts a number to a string and adds leading zeros
  // until the string’s length reaches the specified width (default is 2).
  Number.prototype.pad = function (width) {
    // Convert the number to a string
    var str = String(this);

    // Prepend "0" until the string length is at least `width`
    var targetLength = width || 2;  // Default width: 2 digits
    while (str.length < targetLength) {
      str = "0" + str;
    }

    // Return the zero-padded string
    return str;
  };

  // Main countdown function
  // `endTime` is the timestamp (in milliseconds) of the target date/time.
  function updateCountdown(endTime) {
    // Get current timestamp
    var now = new Date().getTime();

    // Calculate the remaining time in milliseconds
    var timeRemaining = endTime - now;

    // Calculate days, hours, minutes, and seconds left
    var days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
    var hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

    // Update the HTML elements with padded values
    document.querySelector("#days").innerHTML = days.pad(2);
    document.querySelector("#hours").innerHTML = hours.pad(2);
    document.querySelector("#minutes").innerHTML = minutes.pad(2);
    document.querySelector("#seconds").innerHTML = seconds.pad(2);

    // If the countdown is finished, clear the interval
    if (timeRemaining <= 1000) {
      clearInterval(timerInterval);
    }
  }

  // Initialize the countdown immediately
  updateCountdown(targetDate);

  // Set up an interval to update the countdown every second (1000 ms)
  var timerInterval = setInterval(updateCountdown, 1000, targetDate);

})
