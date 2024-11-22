// check if the page is loaded, ony
document.addEventListener("DOMContentLoaded", function () { 
//check if we are on the index page

if(document.getElementById("search-box")){


// _______________________________________________________________________________________________________________________________________ //


    // 🔎 SearchMode 🔍
    // ⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
 

        // Variables
        // ⎺⎺⎺⎺⎺⎺⎺⎺⎺

        // Global variable to keep track of selected tags
        let selectedTags = [];
        


        // Search Function
        // ⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
        // This is the main function of Search Mode. It does the following things:
        // It checks all content that has the class searchText for either text that was written inside of the input field
        // or a selected tag. If the search is a success it display the search result, otherwise the result is hidden. 

        function filterContent() {
            // Get the search input text and convert it to lowercase for case-insensitive comparison
            const inputText = document.getElementById('search-box').value.toLowerCase();

            // Select all elements with the class 'search-result' (these are the items we'll be filtering)
            const searchResults = document.querySelectorAll('.search-result');

            // Get all tags from the filter container and convert them to an array of lowercase text
            const selectedTags = Array.from(document.querySelectorAll('#filter-tags .filter'))
                .map(tag => tag.textContent.toLowerCase());

            // Loop through each search result element
            searchResults.forEach(result => {
                // Find all elements with class 'searchText' within the current search result
                const searchTextElements = result.querySelectorAll('.searchText');
                
                // Check if any of the searchText elements match the input text
                const matchesSearchText = Array.from(searchTextElements).some(element => {
                    // Get the visible text content of the element and convert to lowercase
                    const textContent = element.textContent.toLowerCase();
                    // Get the 'data-search' attribute value (if it exists) and convert to lowercase
                    const dataSearch = (element.getAttribute('data-search') || '').toLowerCase();
                    // Return true if either the text content or data-search includes the input text
                    return textContent.includes(inputText) || dataSearch.includes(inputText);
                });

                // Check if the search result matches all selected tags
                const matchesTags = selectedTags.length === 0 || selectedTags.every(tag => 
                    Array.from(searchTextElements).some(element => 
                        // Check if the tag is in either the text content or data-search attribute
                        element.textContent.toLowerCase().includes(tag) || 
                        (element.getAttribute('data-search') || '').toLowerCase().includes(tag)
                    )
                );

                // Show the search result if it matches both the search text and all tags, otherwise hide it
                result.style.display = (matchesSearchText && matchesTags) ? 'block' : 'none';
            });
        }


                // This is the event listener for when something is typed into the input field. 
                // It triggers everytime when the input field detects a keystroke
                document.getElementById('search-box').addEventListener('input', function() {
                    // Only filter content if the input field has the 'searchmode' class
                    if (this.classList.contains('searchmode')) {
                        filterContent(); // trigger search function
                    }
                });




        // Add and remove filter tags from the searchbar
        // ⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
    
        function TagFromInput(tagText) {
            // get the Element in which all the filter tags are
            const tagContainer = document.querySelector('#filter-tags');

            // Convert the tag text to lowercase
            const lowercaseTagText = tagText.toLowerCase();

            // Check if the tag already exists in the container
            const existingTags = Array.from(tagContainer.querySelectorAll('.filter')).map(tag => tag.textContent.toLowerCase());

            if (existingTags.includes(lowercaseTagText)) {
                console.log(`Tag "${lowercaseTagText}" is already present in #filter-tags`);
                return; // Exit if the tag already exists
            }

            // Create a new button element for the tag
            const newFilterTag = document.createElement('button');
            newFilterTag.textContent = tagText;
            newFilterTag.classList.add('filter', 'tag', 'tag--inverted', 'tag--delete');

            // Append the new tag button to the container
            tagContainer.appendChild(newFilterTag);

            // Reapply the filter to update results based on new tags
            filterContent();
        }



        // Event listener for creating tags by pressing 'Enter' in the search box
        document.querySelector('#search-box').addEventListener('keydown', function(event) {
            if (this.classList.contains('searchmode') && event.key === 'Enter') {
                event.preventDefault(); // Prevent default Enter key action
                
                // Get and trim the input value
                const inputValue = this.value.trim();

                if (inputValue !== '') {
                    // Add the input value as a tag
                    TagFromInput(inputValue);

                    // Clear the input field
                    this.value = '';
                }
            }
        });

        

        // Event listener for tag clicks
        document.querySelectorAll('.filter').forEach(element => {
            element.addEventListener('click', function() {
                const tagContainer = document.querySelector('#filter-tags');
                
                // Check if the element has the data-search attribute
                const tagText = this.hasAttribute('data-search') 
                    ? this.getAttribute('data-search').toLowerCase() 
                    : this.textContent.toLowerCase();

                // Check if the tag is already in the #filter-tags container
                const existingTags = Array.from(tagContainer.querySelectorAll('.filter')).map(tag => 
                    tag.hasAttribute('data-search') 
                        ? tag.getAttribute('data-search').toLowerCase() 
                        : tag.textContent.toLowerCase()
                );

                if (existingTags.includes(tagText)) {
                    console.log(`Tag "${tagText}" is already present in #filter-tags`);
                    return; // Exit if the tag is already present
                }

                // Create and append a new button for the tag
                const newFilterTag = document.createElement('button');
                newFilterTag.textContent = this.hasAttribute('data-search') 
                    ? this.getAttribute('data-search') 
                    : this.textContent;
                newFilterTag.classList.add('filter', 'tag', 'tag--inverted', 'tag--delete');
                tagContainer.appendChild(newFilterTag);

                // Reapply the filter to update results based on new tags
                filterContent();
            });
        });


        // Event listener for removing tags
        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('tag--delete')) {
                // Remove the clicked tag from the DOM
                event.target.remove();

                // Reapply the filter to update results after removing the tag
                filterContent();
            }
        });

    

        // 〠 Tag Counter 〠
        // ⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺⎺
                                                // ok wow I was looking for a cute symol for the tagcounter and found this 〠
                                                //        Unicode-Symbol U+3020 – Postal Mark Face
                                                //                  I am litterally in love. 
                                                // https://en.wikipedia.org/wiki/Japanese_postal_mark
                                                //              It was the offical post mascot form 1966–1996. I'm dying 
                                            
        // What should the code do:

        // get every element with .searchText.tag.filter make a const tags
        // compare:
            // check for every tags of how many elements with the same content are prestent
            // if there is at least one other element with the same content make a new variable 'otherTags' for the number of other elements
            // write the css for the element use the ::after and write as the content [otherTags]
            // else do nothing
            function tagCounter() {
                const tags = document.querySelectorAll('.searchText.tag.filter');
                const tagCounts = {};
            
                // Count occurrences of each tag content
                tags.forEach(tag => {
                    const content = tag.textContent.trim();
                    tagCounts[content] = (tagCounts[content] || 0) + 1;
                });
            
                // Process each tag
                tags.forEach(tag => {
                    const content = tag.textContent.trim();
                    if (tagCounts[content] > 1) {
                        const otherTags = tagCounts[content] - 1;
                        tag.setAttribute('data-other-tags', otherTags);
                    } else {
                        tag.removeAttribute('data-other-tags');
                    }
                });
            }
            
            // Call the function when needed
            tagCounter();

    
} // end of check for index
}); // end of DOMContentLoaded




// _______________________________________________________________________________________________________________________________________ //



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