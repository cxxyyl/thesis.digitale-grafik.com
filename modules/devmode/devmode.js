// Javascript for DevMode
// ⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺


// INFO: 
// For adding additional themes and or quick commands check the handleQuickCommands() function or go to line 438.



// save css across pageload with session storage

window.addEventListener('load', function() {
  
    const savedCSS = getCookie('devModeCSS');
    const activeTheme = sessionStorage.getItem('activeTheme');


    // Function to get a cookie by name
    function getCookie(name) {
        const nameEQ = name + "=";
        const ca = document.cookie.split(';');
        for(let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) == ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) == 0) return decodeURIComponent(c.substring(nameEQ.length, c.length));
        }
        return null;
    }

    // Load the saved CSS from the cookie, if it exists
   
    if (savedCSS) {
        const styleElement = document.createElement('style');
        styleElement.className = 'devModeCSS';
        styleElement.textContent = savedCSS;
        document.head.appendChild(styleElement);
    }

    if (activeTheme) {
        const linkElement = document.createElement('link');
        linkElement.className = 'themeCSS';
        linkElement.rel = 'stylesheet';
        linkElement.href = activeTheme;
        document.head.appendChild(linkElement);
        }
    
});

// switch form devMode and back to searchMode

// check if the page is loaded
document.addEventListener("DOMContentLoaded", function () { 

//check if we are on the index page
if(document.getElementById("search-box")){


// _______________________________________________________________________________________________________________________________________ //



    // 1) Append all the elements we need form the html file 
        const slider = document.querySelector(".searchbar__input-slider"); // get the slider
        const button = document.querySelector('.slider-button'); // get the button
        const buttonText = document.querySelector('.slider-button--text'); // get the span for the text
        const searchBox = document.querySelector("#search-box") // get the input field



// _______________________________________________________________________________________________________________________________________ //


    // 2) Set Up all the important variables
    // ⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
        let isDragging = false; // checks is the button should be draggable at this moment
        let buttonClicked = false; // checks if the button was at least once interfacted with

        let mappingFactor = button.offsetLeft - slider.offsetLeft; // calculate factor to scale from 0-1
        // needs to be global 

        let lastUpdatedPosition = 1;    // keeps count of how many px to the left the button element is at any point
                                        // 1 is the state for the button beeing on the right -> search
                                        // 0 is the state for the button beeing on the right -> DevMode
    


// _______________________________________________________________________________________________________________________________________ //


    // 3) All the Helper Functions 
    // ⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
            // I decided to refactor the code after making it work for the first time. My main focus is to improve 
            // the functionaliy for resizing the window. I realized that i had to many global variables set up, 
            // so I would need whole lot of extra code just to make everything update after resizing the window. 
            // The Idea now is to modularize everything so I can call the components when I need them.                          


    // Styling
    // ⎺⎺⎺⎺⎺⎺⎺

        function switchToAbsolute() {
        // we are changing from the flexbox to position: absolute. So we need to update the button css
        // otherwise the button will be 100% of the screen, as soon as we click on it. As we want to be able to call
        // this function when the window is resized I put in all the relavant styling in this function
        
            button.style.position ='absolute';  // because we are changing the position of the button, position 
                                            // needs to be absolute. otherwise it the button won't move.

            // button.style.height = `${slider.clientHeight + 2 }px t`; // get the hight of the slider and give it to the button
            button.style.height = `${slider.clientHeight + 2 }px`; // get the hight of the slider and give it to the button
        };
        
        function enableSearch() {
           searchBox.classList.add("searchmode");
           searchBox.classList.remove("devmode");
        };

        function disableSearch(){
            searchBox.classList.remove("searchmode");
            searchBox.classList.add("devmode");
        }
    
        //hide the #search-box
        function hideSearchBox(){
            searchBox.style.opacity = 0;  
            searchBox.pointerEvents = 'none'; 
        };


        // reveal of the search box
        function revealSearchBox(){
            searchBox.style.opacity = 100;
            searchBox.pointerEvents = 'auto'; 
        };



        // set styling for button between DevMode and Search
        function buttonStylings(){

            // enable easing for the button snapping into place
            button.style.transition = 'left 300ms ease, color ease 300ms, background-color ease 300ms';
            button.style.cursor = 'grab'; 
          

            if(lastUpdatedPosition < .5){

                //change styling and text for DevMode
                buttonText.innerHTML = "DevMode"
                buttonText.style.color = 'var(--color-secondary)';
                button.style.backgroundColor = 'var(--color-DevMode)';
            };

            //Search 
            if(lastUpdatedPosition > .5){

                //change styling and text for Search
                buttonText.innerHTML = "Search"
                buttonText.style.color = 'var(--color-primary)';
                button.style.backgroundColor = 'var(--color-secondary)';
            };
        };




    // Calculations
    // ⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺    


        function checkLastButtonState(){ 
            // check what the last state was -> Search oder DevMode
            // because of the wonky way I  (cxxyyl) programmed this, a start-postion for the button needs
            // to be set. Otherwise the button will jump. 
            if(lastUpdatedPosition === 1){
                button.style.left =`${(slider.offsetLeft + slider.clientWidth) - button.clientWidth + 2 }px`;
            };

            if(lastUpdatedPosition === 0){
                button.style.left =`${slider.offsetLeft+1}px`;
            };

        };   
        


        // Function to update the button's position based on cursor position
        function moveButton(event) {

            let cursorPosition = event.clientX; // buffer for the cursor position

            // restrict the range of the cursor movement to be only within the slider
            if(event.clientX > ((slider.offsetLeft + slider.clientWidth) - button.clientWidth/2)) cursorPosition = ((slider.offsetLeft + slider.clientWidth) - button.clientWidth/2 - 1); // right boundary
            if(event.clientX < slider.offsetLeft + button.clientWidth/2) cursorPosition = (slider.offsetLeft + button.clientWidth/2 +1); // left boundary

            // Move the button with the cursor position (within the bounds of the slider)
            button.style.left = `${cursorPosition - button.clientWidth / 2}px`;
        }
        



        // general function to get the current position of the button and transform it to a scale from 0–1
        function getButtonPosition(){
            // calculate the current position of the button
            lastUpdatedPosition = (button.offsetLeft - slider.offsetLeft) / mappingFactor; 

            // restrict the position factor to 0 – 1 -> cut off anything thats smaller or bigger
            if(lastUpdatedPosition < 0) lastUpdatedPosition = 0 ;
            if(lastUpdatedPosition > 1) lastUpdatedPosition = 1 ; 

            return lastUpdatedPosition; // update lastUpdatedPosition
        }; 


        // Snap the Button to the right or left side of the slider
        function setButtonPosition(){
            if(lastUpdatedPosition < .5){

                // Snap Button into the left Position (DevMode)
                button.style.left = `${slider.offsetLeft+1}px`; 
            };

            //Search 
            if(lastUpdatedPosition > .5){

                // Snap Button into the right Position (Search)
                button.style.left = `${(slider.offsetLeft + slider.clientWidth) - button.clientWidth  + 2}px`;
            };
        };


        // Calculate and set the position and width of the input field (searchbox)
        function setSearchboxPosition(){

            // for DevMode
            if(lastUpdatedPosition < .5){
                
                //reposition searchbox
                searchBox.style.marginLeft =`calc(${button.clientWidth}px + var(--spacing-xs))`;
                searchBox.style.width = `calc(${slider.clientWidth}px - ${button.clientWidth}px - var(--spacing-xs))`;
            };

            // for Search 
            if(lastUpdatedPosition > .5){

                //reposition searchbox
                searchBox.style.marginLeft = 'var(--spacing-xs)';
                searchBox.style.width = `calc(${slider.clientWidth}px - ${button.clientWidth}px - (3 * var(--spacing-xs)))`;
            };
        };



// _______________________________________________________________________________________________________________________________________ //



    // 4) Mouse related event listener
    // ⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺

        // Eventlistener for what happens if the mouse is pressed
        button.addEventListener('mousedown', function(){

            isDragging = true; // the button is now allowed to be dragged
            buttonClicked = true; 

            button.style.transition = 'left 0ms ease, color ease 0ms, background-color ease 0ms'; //reset easing
            button.style.cursor = 'grabbing'; 

            switchToAbsolute(); // switch the button style to position: absolute                           
            checkLastButtonState(); // check what the last stat of the button was DevMode <-> Search
            hideSearchBox(); // hide the searchbox while moving the button
        });



         // Eventlistener for what happens if the mouse is moved
        button.addEventListener('mousemove', function(event) {
            if (isDragging) { // We don't want the function to run all the time. It's only allowed to run if the button is allowed to be dragged.
                moveButton(event); // move (drag) the Button by using the cursor
                getButtonPosition(); // Update lastUpdatedPosition while moving the button
            }
        });



        // Eventlistener for what happens if the mouse button is not clicked anymore
        button.addEventListener('mouseup', function(){
            if(isDragging) {    
                isDragging = false;

                revealSearchBox(); 
                buttonStylings(); 
                setButtonPosition();
                setSearchboxPosition(); 
          
                // set position state for DevMode
                if(lastUpdatedPosition < .5){
                    lastUpdatedPosition = 0; 
                    disableSearch();
                }   

                // set position state for Search 
                if(lastUpdatedPosition > .5){
                    lastUpdatedPosition = 1; 
                    enableSearch();
                }   
            };     
        });


        // Event listener for leaving the button, while dragging
        button.addEventListener('mouseleave', function(){
            if(isDragging) {    
                isDragging = false;

                revealSearchBox(); 
                buttonStylings(); 
                setButtonPosition();
                setSearchboxPosition(); 

        
               // set position state for DevMode
               if(lastUpdatedPosition < .5){
                    lastUpdatedPosition = 0; 
                    disableSearch();
                }   

                // set position state for Search 
                if(lastUpdatedPosition > .5){
                    lastUpdatedPosition = 1; 
                    enableSearch();
                }   
            };     
        }); 


// _______________________________________________________________________________________________________________________________________ //



    // 5) Page Resize related event listener
    // ⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺


    // Resize all the elements once the Window is rezsized

    window.addEventListener('resize', function(){
        if(buttonClicked){

            //update mapping factor
            mappingFactor = button.offsetLeft - slider.offsetLeft; // calculate factor to scale from 0-1

            //reset easing for instant transition on resize
            button.style.transition = 'left 0ms ease, color ease 0ms, background-color ease 0ms'; 

            switchToAbsolute()
            setButtonPosition();
            setSearchboxPosition(); 
        };
    }); 
    



// _______________________________________________________________________________________________________________________________________ //





    // Write CSS


    // Function to set a cookie
    function setCookie(name, value, days) {
        const date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000)); // Expires in 'days'
        const expires = "expires=" + date.toUTCString();
        document.cookie = name + "=" + encodeURIComponent(value) + ";" + expires + ";path=/";
    }

    // Function to get a cookie by name
    function getCookie(name) {
        const nameEQ = name + "=";
        const ca = document.cookie.split(';');
        for(let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) == ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) == 0) return decodeURIComponent(c.substring(nameEQ.length, c.length));
        }
        return null;
    }


    // Check if a <style> element with the id 'devModeCSS' already exists
    let styleElement = document.getElementById('devModeCSS');

    // If not, create the <style> element and add it to the head
    if (!styleElement) {
        styleElement = document.createElement('style');
        styleElement.id = 'devModeCSS'; // Assign an id to the style element
        document.head.appendChild(styleElement);
    }

    // Load the saved CSS from the cookie, if it exists
    const savedCSS = getCookie('devModeCSS');
    if (savedCSS) {
        styleElement.textContent = savedCSS; // Load the CSS into the style element
    }





    // Handle Commands & handleCSS

    document.getElementById('search-box').addEventListener('keydown', function (event) {
        // Check if Enter key is pressed and the input has the 'devmode' class
        if (event.key === 'Enter' && this.classList.contains('devmode')) {
            
            // Normalize input
            const command = this.value.trim().toLowerCase(); 
            
            // Handle quick commands or CSS input
            if (!handleQuickCommands(command)) {
                processCSSInput(this.value);
            }

            // Clear the input field after applying the CSS
            this.value = '';
        }
    });

    // Function to handle quick commands
    // If other quick commands should be added, add them here
    function handleQuickCommands(command) {
        
        if (command === "darkmode") {
            removeThemeCSS(); // Remove any existing stylesheets before adding new ones
            // Add darkmode stylesheets
            addStylesheetThemes("./modules/devmode/darkmode.css");
            addStylesheetThemes("../modules/devmode/darkmode.css");
            return true; // Command was handled
        } 

        if (command === "cozygray") {
            removeThemeCSS(); // Remove any existing stylesheets before adding new ones
            // Add cozy gray stylesheets
            addStylesheetThemes("./modules/devmode/cozygray.css");
            addStylesheetThemes("../modules/devmode/cozygray.css");
            return true; // Command was handled
        } 

        if (command === "solarized") {
            removeThemeCSS(); // Remove any existing stylesheets before adding new ones
            // Add solarized stylesheets
            addStylesheetThemes("./modules/devmode/solarized.css");
            addStylesheetThemes("../modules/devmode/solarized.css");
            return true; // Command was handled
        }

        if (command === "lightmode") {
            // Remove all additional CSS links
            removeThemeCSS();
            return true; // Command was handled
        }

        if (command === "markthesis"){
            addStylesheetHighlights("./modules/devmode/markthesis.css");
            addStylesheetHighlights("../modules/devmode/markthesis.css");
            return true;
        }

        if (command === "markauthor"){
            addStylesheetHighlights("./modules/devmode/markauthor.css");
            addStylesheetHighlights("../modules/devmode/markauthor.css");
            return true;
        }

        if (command === "nocss"){
            noCSS();
            return true;
        }

        if (command === "resetmark"){
            removeMarkCSS();
            return true;
        }

        if (command === "resetall"){
            removeThemeCSS();
            removeMarkCSS();
            removeDevModeCSS();
            deleteDevModeCSSCookie();
            window.location.reload();
            return true;
        }

        return false; // Command was not handled
    }


    // Function to process CSS input
    function processCSSInput(cssInput) {
        const devModeCSS = cssInput;

        // Append new CSS to the existing <style> element
        styleElement.textContent += devModeCSS;

        // Save the updated CSS to a cookie (expires in 365 days)
        setCookie('devModeCSS', styleElement.textContent, 365);
    }


    // Function to add a stylesheet for a theme link to the <head>
    function addStylesheetThemes(href) {
        const linkElement = document.createElement('link');
        linkElement.className = 'themeCSS';
        linkElement.rel = 'stylesheet';
        linkElement.href = href;
        document.head.appendChild(linkElement);

        // Save the active theme href in session storage
        sessionStorage.setItem('activeTheme', href);
    }

    // Function to add a stylesheet for a highlight link to the <head>
    function addStylesheetHighlights(href) {
        const linkElement = document.createElement('link');
        linkElement.className = 'markCSS';
        linkElement.rel = 'stylesheet';
        linkElement.href = href;
        document.head.appendChild(linkElement);
    }

    // Function to delete all css
    function noCSS() {
        const allCSS = document.querySelectorAll("link");
        allCSS.forEach(link => link.remove());
        removeDevModeCSS();
    }


    // resets

    // Function to remove all <link> elements with the class 'themeCSS'
    function removeThemeCSS() {
        const additionalCSSLinks = document.querySelectorAll('link.themeCSS');
        additionalCSSLinks.forEach(link => link.remove());

        sessionStorage.removeItem('activeTheme');
    }

    function removeMarkCSS() {
        const additionalCSSLinks = document.querySelectorAll('link.markCSS');
        additionalCSSLinks.forEach(link => link.remove());
    }

    function removeDevModeCSS() {
        const additionalCSSLinks = document.getElementById('devModeCSS');
        additionalCSSLinks.remove();

        }

    // Function to delete the 'devModeCSS' cookie
    function deleteDevModeCSSCookie() {
        document.cookie = 'devModeCSS=;expires=Thu, 01 Jan 1970 00:00:00 UTC;path=/;';
    }


} // end of check if we are on index

// _______________________________________________________________________________________________________________________________________ //



});












// _______________________________________________________________________________________________________________________________________ //
// _______________________________________________________________________________________________________________________________________ //


//First Iteration
// ⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺

// document.addEventListener("DOMContentLoaded", function () {
//     const slider = document.querySelector(".searchbar__input-slider");
//     const button = document.querySelector('.slider-button');
//     const buttonText = document.querySelector('.slider-button--text');
//     const searchBox = document.querySelector("#search-box")

//     let isDragging = false; // checks is the button should be draggable at this moment
   
//     let sliderWidth = slider.clientWidth;  // Width of slider
//     let sliderOffsetLeft = slider.offsetLeft; // Where (from left) does the slider element begin 
//     let buttonOffsetLeft = button.offsetLeft; // Where (from left) does the Button element begin 
//     let sliderRight = sliderOffsetLeft + sliderWidth; //Where (from left) does the slider element end
    
//     let mappingFactor = button.offsetLeft - slider.offsetLeft; // calculate factor to scale from 0-1

//     let lastUpdatedPosition = 1;    // keeps count of how many px to the left the button element is at any point
//                                     // 1 is the state for the button beeing on the right -> search
//                                     // 0 is the state for the button beeing on the right -> DevMode
    
//     function updateAllSizes() {
//         sliderWidth = slider.clientWidth;  // Width of slider
//         sliderOffsetLeft = slider.offsetLeft; // Where (from left) does the slider element begin 
//         buttonOffsetLeft = button.offsetLeft; // Where (from left) does the Button element begin 
//         sliderRight = sliderOffsetLeft + sliderWidth; //Where (from left) does the slider element end
//         mappingFactor = button.offsetLeft - slider.offsetLeft; // calculate factor to scale from 0-1
//     };
    

//     // general function to get the current position of the button and transform it to a scale from 0–1
//     function buttonPosition(){
//         // calculate the current position of the button
//         lastUpdatedPosition = (button.offsetLeft - slider.offsetLeft) / mappingFactor; 

//         // restrict the position factor to 0 – 1 -> cut off anything thats smaller or bigger
//         if(lastUpdatedPosition < 0) lastUpdatedPosition = 0 ;
//         if(lastUpdatedPosition > 1) lastUpdatedPosition = 1 ; 

//         return lastUpdatedPosition; // update lastUpdatedPosition
//     }; 


//     function switchToAbsolute() {
//     // we are changing from the flexbox to position: absolute. So we need to update the button css
//     // otherwise the button will be 100% of the screen, as soon as we click on it. As we want to be able to call
//     // this function when the window is resized I put in all the relavant styling in this function
       
//         button.style.position ='absolute';  // because we are changing the position of the button, position 
//                                            // needs to be absolute. otherwise it the button won't move.

//         // button.style.height = `${slider.clientHeight + 2 }px t`; // get the hight of the slider and give it to the button
//         button.style.height = `${slider.clientHeight + 2 }px`; // get the hight of the slider and give it to the button

//     };
    
//     // Eventlistener for what happens if the mouse is pressed
//     button.addEventListener('mousedown', function (event){

//         isDragging = true; // the button is now allowed to be dragged

//         switchToAbsolute(); // switch the button to absolute                           

//         // check what the last state was -> Search oder DevMode
//         // because of the wonky way I  (cxxyyl) programmed this, a start-postion for the button needs
//         // to be set. Otherwise the button will jump. 
//             if(lastUpdatedPosition === 1){
//                 button.style.left =`${buttonOffsetLeft}px`;
//             };

//             if(lastUpdatedPosition === 0){
//                 button.style.left =`${sliderOffsetLeft+1}px`;
//             };

//         //reset easing
//         button.style.transition = 'all 0ms ease';

//         //disable the #search-box
//         searchBox.style.opacity = 0;  
//         searchBox.pointerEvents = 'none'; 

//     });

//     // Eventlistener for what happens if the mouse is moved
//     button.addEventListener('mousemove', function (event){
//         if(isDragging) { // we don't want the function to run all the time. so it's only allowd to run, if the button is allowed to be dragged.
            
//             let cursorPosition = event.clientX; // buffer for the cursor position

//                 // restrict the range of the cursor movement to be only within the slider
//                 if(event.clientX > (sliderRight - button.clientWidth/2)) cursorPosition = (sliderRight - button.clientWidth/2 - 1); // right boundary
//                 if(event.clientX < sliderOffsetLeft + button.clientWidth/2) cursorPosition = (sliderOffsetLeft + button.clientWidth/2 +1); // left boundary
           
//             // move the button with the cursor position (within the bounds of slider)
//             const buttonDriver = cursorPosition - button.clientWidth/2; 
//             button.style.left = `${buttonDriver}px`;
            
//             //update lastUpdatedPosition while moving the button
//             buttonPosition(); 
//         }; 
//     });

//     // Eventlistener for what happens if the mouse button is not clicked anymore
//     button.addEventListener('mouseup', function (event){
//         if(isDragging) {    
//             isDragging = false;

//             // enable easing for the button snapping into place
//             button.style.transition = 'all 300ms ease';

//             // Reappearing of the search box
//             searchBox.style.opacity = 100;
//             searchBox.pointerEvents = 'auto'; 


//             // DevMode
//             if(lastUpdatedPosition < .5){

//                 //change styling and text for DevMode
//                 button.classList.add(); 
//                 buttonText.innerHTML = "DevMode"
//                 buttonText.style.color = 'var(--color-secondary)';
//                 button.style.backgroundColor = 'var(--color-DevMode)';

//                 //reposition searchbox
//                 searchBox.style.marginLeft =`calc(${button.clientWidth}px + var(--spacing-xs))`;
//                 searchBox.style.width = `calc(${sliderWidth}px - ${button.clientWidth}px - var(--spacing-xs))`;

//                 //
//                 button.style.left = `${sliderOffsetLeft+1}px`; 
//                 lastUpdatedPosition = 0; 

//                 return lastUpdatedPosition; 
                
//             };

//             //Search 
//             if(lastUpdatedPosition > .5){

//                  //change styling and text for Search
//                 buttonText.innerHTML = "Search"
//                 buttonText.style.color = 'var(--color-primary)';
//                 button.style.backgroundColor = 'var(--color-secondary)';

//                 // 
//                 searchBox.style.marginLeft = 'var(--spacing-xs)';
//                 searchBox.style.width = `calc(${sliderWidth}px - ${button.clientWidth}px - (3 * var(--spacing-xs)))`;

//                 button.style.left = `${buttonOffsetLeft + 2 }px`;
//                 lastUpdatedPosition = 1; 

//                 return lastUpdatedPosition; 
//             }; 

        
//         };  
        
//     });




//     // Resize all the elements once the Window is rezsized

//     window.addEventListener('resize', function(){

//         updateAllSizes(); //first update all the variables



//     }); 
    

// });