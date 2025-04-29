<script src="/modules/searchmode/searchmode.js" type="text/javascript"></script>
<script src="/modules/devmode/devmode.js" type="text/javascript"></script>
<script src="/modules/titleanimation/titleanimation.js" type="text/javascript"></script>
<script>

// Hover -> to click
// document.querySelectorAll('.accordion').forEach(element => {
//    element.addEventListener('click', function(){
//     element.classList.toggle('opened');
//    });
// });


// Hover -> to click
// document.querySelectorAll('.accordion').forEach(element => {

// const blocklist = [".no-close", "button", "input"]; 

// // .accordion-content__thesis__title
// // 

//    element.addEventListener("click", (event) => {
//       const accordion = event.target.closest(".accordion");

//       element.classList.toggle('opened');

//        Check if the clicked element or its ancestors are in the blocklist
//       if (accordion && !blocklist.some(selector => event.target.closest(selector))) {
//          element.classList.toggle('opened');
//       }
//    });

// });

document.querySelectorAll('.accordion').forEach(element => {

element.addEventListener("mousedown", (event) => {

   if(element.classList.contains('opened') && (event.target.closest('.no-close'))) {
      return;
   }

  element.classList.toggle('opened');
});

});






</script>