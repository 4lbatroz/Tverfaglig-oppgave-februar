// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

//printer ut
function print(){
   var userInput = document.getElementById("inputField").value

   document.getElementById("displayInput").innerText = "Input value: " + userInput;

}

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

// sjekker om skriften når enden av siden og hvis den gjør putte det på en ny linje
var tekstområde = document.getElementsByClassName("resultat");
var inputFelt = document.getElementById("inputField");

inputFelt.addEventListener("input", function() {
    var tekst = this.value;
    var nyTekst = tekstområde.innerText + tekst;
    tekstområde.innerText = nyTekst;
    
    // Sjekk om teksten har nådd slutten av DIV-elementet
    var tekstområdeHøyde = tekstområde.clientHeight;
    var tekstområdeScrollHøyde = tekstområde.scrollHeight;
    
    if (tekstområdeScrollHøyde > tekstområdeHøyde) {
        // Legg til linjeskift
        tekstområde.innerText += "\n";
    }
});
