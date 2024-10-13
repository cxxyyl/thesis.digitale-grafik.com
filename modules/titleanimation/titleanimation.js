document.addEventListener("DOMContentLoaded", function () { 
       
    // Animated Title  
    setTimeout(function () {
        // Get the entire HTML structure of the document as a string
        const savedText = document.documentElement.innerHTML;
        
        // Variables to manage the animation
        const displayLength = 30; // First 30 characters
        let currentIndex = 0;
        
        // Set up the FPS for the animation (3 fps)
        const fps = 3;
        const frameDuration = 1000 / fps;
        
        // Function to update the <title> with the scrolling text
        function updateText() {
            let displayText;
            
            // Check if we still have characters to display
            if (currentIndex + displayLength <= savedText.length) {
                // Get the current substring of 30 characters
                displayText = savedText.slice(currentIndex, currentIndex + displayLength);
            } else {
                // Replace remaining characters with "thesis.digitalegrafik.com"
                displayText = "thesis.digitale-grafik.com";
            }
            
            // Update the <title> element with the current substring or replacement text
            document.title = displayText;
            // console.log(displayText);
            
            // Move the index forward
            currentIndex++;
            
            // Loop the animation until the end of the string
            if (currentIndex + displayLength <= savedText.length || displayText === "thesis.digitalegrafik.com") {
                setTimeout(updateText, frameDuration);
            }
        }
        
        // Start the animation
        updateText();
    }, 60000);
    
}); // end of DOMContentLoaded