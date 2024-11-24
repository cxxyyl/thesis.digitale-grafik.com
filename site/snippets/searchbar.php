
    <!-- 

        ________
        ✦ Searchbar ✦
        ‾‾‾‾‾‾‾‾‾‾‾‾‾

        The Searchbar is home to the SearchMode and DevMode features.
        Both are dependant on the input field #search-box
 
    -->

    <div class="searchbar">

        <!-- 

        Originally this was a filter where you could choose
        the degree and year/semester. With SearchMode working 
        really well and beeing acutally faster than clicking and
        selecting this feature no longer needed. 





                                ☗ Rest In Peace dear Filter View ☗
                                ‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾
                                You were once so full of promice, 
                                an integral part to navigating
                                this site, but you were taken
                                away from us before you could even
                                fully delevop into a full feature. 
                                I am mourning you, for you have 
                                been replaced by a simple search. 
                                May you find yourself used and
                                enjoyed on other sites and tables.

                                ⚘ ⚘ ⚘ ⚘ ⚘ ⚘ ⚘ ⚘ ⚘ ⚘ ⚘ ⚘ ⚘ ⚘ ⚘ ⚘ ⚘ ⚘
                                 ⚘ ⚘ ⚘ ⚘ ⚘ ⚘ ⚘ ⚘ ⚘ ⚘ ⚘ ⚘ ⚘ ⚘ ⚘ ⚘ ⚘ 
                                ⚘ ⚘ ⚘ ⚘ ⚘ ⚘ ⚘ ⚘ ⚘ ⚘ ⚘ ⚘ ⚘ ⚘ ⚘ ⚘ ⚘ ⚘

                                
                                


        <div class="searchbar__dropdowns">
            <select name="baMaDropdown" id="baMaDropdown">
                <option value="ba+ma">BA+MA</option>
                <option value="ba">BA</option>
                <option value="ma">MA</option>
            </select>
            <select name="semesterDropdown" id="semesterDropdown">
                <option value="SuSe2024">All Semesters</option>
                <option value="SuSe2024">SuSe2024</option>
                <option value="WiSe2023/24">WiSe2023/24</option>
            </select>
        </div> 
        
        -->

        <div class="searchbar__search-container">

            <!-- Tags are added here by Javascript -->
            <!-- <button class="tag tag--inverted">TagName</button> -->
            <div id="filter-tags" class="searchbar__tag-container">

            </div>

            <!-- Search Box -->
            <!-- This is where the js is interfacing with this site -->
            <div class="searchbar__input-slider">
                <input type="text" class="searchmode" id="search-box" placeholder="Type here...">
                <div class="slider-button button-primary"><span class="slider-button--text">Search</span></div>
            </div>
        </div>
    </div>


    