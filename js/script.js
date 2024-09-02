/* Basics */
/* JS Accordion Toggle */
       
       // Function to handle search
       function searchContent() {
        const searchText = document.getElementById('search-box').value.toLowerCase();
           const searchResults = document.querySelectorAll('.search-result');        
           
           
        searchResults.forEach(result => {
            const content = result.textContent.toLowerCase();
            if (content.includes(searchText)) {
                result.style.display = 'block';
            } else {
                result.style.display = 'none';
            }
        });
    }

    // Event listener for search input
    document.getElementById('search-box').addEventListener('input', searchContent);



    // alternative with highlighting searched text
    // the problem is that i can't make it work without linebreaks for the abstract and bio
    // – cxxyyl

    //     // Function to highlight search text in content
    // function highlightText(element, searchText) {
    //     const innerHTML = element.innerHTML;
    //     const regex = new RegExp(`(${searchText})`, 'gi');
    //     const highlightedHTML = innerHTML.replace(regex, `<mark>$1</mark>`);
    //     element.innerHTML = highlightedHTML;
    // }

    // // Function to handle search and highlight text
    // function searchContent() {
    //     const searchText = document.getElementById('search-box').value.toLowerCase();
    //     const searchResults = document.querySelectorAll('.search-result');

    //     searchResults.forEach(result => {
    //         const content = result.textContent.toLowerCase();
    //         if (content.includes(searchText)) {
    //             result.style.display = 'block';

    //             // Highlight matching text
    //             const searchTexts = result.querySelectorAll('.searchText');
    //             searchTexts.forEach(searchTextElement => {
    //                 // Remove previous highlights
    //                 searchTextElement.innerHTML = searchTextElement.textContent;

    //                 // Highlight new matches
    //                 if (searchText.trim() !== '') { // Only highlight if there's actual text to search
    //                     highlightText(searchTextElement, searchText);
    //                 }
    //             });
    //         } else {
    //             result.style.display = 'none';
    //         }
    //     });
    // }

    // // Event listener for search input
    // document.getElementById('search-box').addEventListener('input', searchContent);



/* JS Add & Remove Tags */

// Select all elements with the class 'tag searchText'
document.querySelectorAll('.tag.searchText').forEach(function(element) {
    element.addEventListener('click', function() {
        // Select the target container where cloned elements will be added
        const tagContainer = document.querySelector('.searchbar__tag-container');

        // Clone the clicked element (use 'this' to refer to the clicked element)
        const clonedElement = this.cloneNode(true);

        // Update the class of the cloned element
        clonedElement.classList.remove('searchText');
        clonedElement.classList.add('tag--inverted');
        clonedElement.classList.add('tag--delete');


        // Append the modified cloned element to the target container
        tagContainer.appendChild(clonedElement);

        addedTags = document.querySelectorAll('.tag--delete'); 
    });
});


document.addEventListener('click', function(event) {
    // Check if the clicked element has the 'tag--delete' class
    if (event.target.classList.contains('tag--delete')) {
        // Remove the clicked element from the DOM
        event.target.remove();
    }
});



