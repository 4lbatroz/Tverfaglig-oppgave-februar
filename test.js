const chatInput = document.getElementById("message");
const result = document.getElementById("result");

// Base64 Encryption
function encrypt() {
    // Encryption
    var decodedStringBtoA = chatInput.value();
  
    var encodedStringBtoA = btoa(decodedStringBtoA);
  
    console.log(encodedStringBtoA);
  }