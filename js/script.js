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