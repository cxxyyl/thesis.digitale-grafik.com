// check if the page is loaded, ony
document.addEventListener("DOMContentLoaded", function () { 

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

            // Retrieve the text that was written into the input field.
            const inputText = document.getElementById('search-box').value.toLowerCase();

            // Get all Elementns with the class search-result. These are single rows that make up the table. 
            const searchResults = document.querySelectorAll('.search-result');

            // Retrieve all tags from the #filter-tags container.
            const tagsInFilterContainer = document.querySelectorAll('#filter-tags .filter'); // append the tags
            selectedTags = Array.from(tagsInFilterContainer).map(tag => tag.textContent.toLowerCase()); // convert each tag to text

            // Iterate through each row of the table
            searchResults.forEach(result => {

                // Constrain the searched elements only to elements with the class searchtext
                const searchTextElements = result.querySelectorAll('.searchText');
                
                // Check if any of the elements with the class searchText match text written into the input field.
                const matchesSearchText = Array.from(searchTextElements).some(element => {
                
                    // Convert the text content of the element to lowercase for case-insensitive comparison
                    const textContent = element.textContent.toLowerCase();

                    // Retrieve the value of the 'data-search' attribute, if it exists, and convert it to lowercase
                    const dataSearch = element.getAttribute('data-search') ? element.getAttribute('data-search').toLowerCase() : '';

                    // Check if the searchText is included in either the text content or the data-search attribute value
                    return dataSearch.includes(inputText) || textContent.includes(inputText);
                });

                // Get the content of the result and convert it to lowercase
                const content = result.textContent.toLowerCase();

                // Check if the result matches all selected tags
                const matchesTags = Array.isArray(selectedTags) && (selectedTags.length === 0 || selectedTags.every(tag => content.includes(tag)));

                // Show or hide the result based on matches
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