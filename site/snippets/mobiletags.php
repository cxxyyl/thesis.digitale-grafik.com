<?php
// Initialize an empty array to hold unique tags
$tagArray = [];

// Iterate through the listed grandchildren of the site
foreach ($site->grandchildren()->listed() as $item) {
    $template = $item->template();
    $thesis = 'thesis';

    // Check if the template contains 'thesis'
    if (str_contains($template, $thesis)) {
        if ($item->thesisTags()->isNotEmpty()){
            // Iterate through the tags of the current item
            foreach ($item->thesisTags()->split() as $tag) {
                
                // Add the tag to the array if it's not already present
                if (!in_array($tag, $tagArray)) {
                    $tagArray[] = $tag;
                }
            }
        }
    }
}

// Sort tags alphabetically
sort($tagArray);
?>

<!-- This is displayed on mobile / portrait -->
<aside id="all-tags" style="display:none">
<h1 class="all-tags__researched">Researched Topics</h1>
<?php foreach ($tagArray as $tag): ?>
    <button class="tag-mobile"><?= htmlspecialchars($tag) ?></button>
<?php endforeach; ?>
<h1 class="all-tags__desktop">Sorry! This Website was made for Desktop only.</h1>
<div class="all-tags__spacer"></div>
</aside>
