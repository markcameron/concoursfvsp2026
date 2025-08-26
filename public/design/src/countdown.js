
window.addEventListener('DOMContentLoaded', function() {
 

  // Define the target date/time (May 8, 2026 08:30:00)
  var targetDate = new Date("May 8, 2026 08:30:00").getTime();

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
