document.addEventListener("DOMContentLoaded", function () { 
    

    // Variables
    // ⎺⎺⎺⎺⎺⎺⎺⎺⎺


    const hints = [ 
        'Have you tried darkmode?',
        '⌘ ⌥ u',
        'ctrl + alt + u', 
        ':root{--color-primary: #c1ff04;--color-secondary: #92999f;--color-DevMode: #c1ff04;--font-primary: fantasy;--font-md: 0.9rem;}',
        ':root{--color-primary: #a66be6;--color-secondary: #f1f1f1;--color-DevMode: #2e2c31;--font-primary: cursive;}',
        '<-- Want to use your own fonts? --> @font-face {font-family: "ComicSans"; src: local("Comic Sans MS");} :root{  --font-primary: "ComicSans";}',
        'DevMode?', 
        'Do you know about the Solarized Theme?',
        'I will remember this...',
        'view-source: ?',
        '<!DOCTYPE html>',
        '✧ ✦ ✧ ✦ ✧ ✦ ✧ ✦ ✧ ✦ ✧ ✦ ✧ ✦ ✧ ✦ ✧ ✦ ✧ ✦ ✧ ✦ ✧ ✦ ✧ ✦ ✧ ✦ ✧ ✦ ✧ ✦ ✧ ✦ Version 1.0 – the birthday of this website is on Okt. 16, 2024 ✧ ✦ ✧ ✦ ✧ ✦ ✧ ✦ ✧ ✦ ✧ ✦ ✧ ✦ ✧ ✦ ✧ ✦ ✧ ✦ ✧ ✦ ✧ ✦ ✧ ✦ ✧ ✦ ✧ ✦ ✧ ✦ ✧ ✦ ', 
        '.∙°∙..∙°∙.∙°∙.∙°∙.∙°∙.∙°∙.∙°∙.∙°∙.∙°∙.∙°∙.∙°∙.∙°∙.∙°∙.∙°∙.∙°∙.∙°∙.∙°∙.∙°∙.∙°∙.∙°∙.∙°∙.∙°∙.∙°∙.∙°∙.∙°∙.∙°∙.∙°∙.∙°∙.∙°∙.∙°∙.∙°∙.∙°∙.', 
        'Hey!            Glad you´re here!',
        'Is it a pointer yet?',
        'You should click on everything', 
        'The hidden world of filters is big',
        'I understand css',
        'Have you tried any quick commands already?',
        'This website uses cookies',
        'Submit a theme',
        'You can contribute a module, if you want to',
        'Have you seen me without css?',
        'Don`t like the design? You can change it if you want.'
        ];


    // buffer so the animation does not start with the hint
    const thesisBuffer = 'thesis.digitale-grafik.com                              ';
    
    let selectedHint; // Random hint hat got chosen


    // Variables to manage the animation
    const displayLength = 30; // Display 30 characters

    // Set up the FPS for the animation
    const fps = 5;
    const frameDuration = 1000 / fps;


    let updateFramesIsRunning = false; 


    // Select Random hint on startup
    selectRandomHint();


    setTimeout(updateFrames, 60000); // first hint after 60s 



    function randomStart() {
        if(updateFramesIsRunning === false){
            setTimeout(updateFrames, (Math.floor(Math.random() * 300000))) // 6min 
        } 
    }

    function updateFrames() {
        // Get the entire HTML structure of the document as a string
        // const savedText = document.documentElement.innerHTML;

        let i = 0;
        updateFramesIsRunning = true; 

        const interval = setInterval(() => {
            let displayText = selectedHint.slice(i, i + displayLength);
            document.title = displayText;

            i++; // Move the index forward

            // Stop the interval when the animation completes
            if (i + displayLength > selectedHint.length + displayLength + 1) {
                clearInterval(interval); // stop animation
                document.title = "thesis.digitale-grafik.com";
                updateFramesIsRunning = false; 
                selectRandomHint(); // generate a new random hint
                randomStart(); //start new (random) animation cycle
                
            }
        }, frameDuration);
    }
    

    function selectRandomHint() { 
        randomHint = Math.floor(Math.random() * hints.length);
        selectedHint = thesisBuffer + hints[randomHint];
        console.log(hints[randomHint]);
    }


    
}); // end of DOMContentLoaded