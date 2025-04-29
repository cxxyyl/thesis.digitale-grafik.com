<script src="/modules/searchmode/searchmode.js" type="text/javascript"></script>
<script src="/modules/devmode/devmode.js" type="text/javascript"></script>
<script src="/modules/titleanimation/titleanimation.js" type="text/javascript"></script>
<script>

// JS for open accordion with click

// get all .accordion elements
document.querySelectorAll('.accordion').forEach(element => {

   // Check for mousedown event
   element.addEventListener("mousedown", (event) => {

      // In this state the eventlistener is enabled for .accordion and all elements inside .accordion
      // If I click on a text or a button, the .accordion would close again. To prevent this we have
      // the follwing if(...)

      // this is for only closing the acordion
      // if the .accordion is .openend -> this checks all child elements. the one I'm currently 
      // trying to click on has the .no-close the fuction gets canceled -> so the accordion won't close
      if(element.classList.contains('opened') && (event.target.closest('.no-close'))) {
         return;
      }

   // Otherwise opening and closing works with this toggle  
   element.classList.toggle('opened');
   });
});






</script>