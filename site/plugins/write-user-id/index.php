<?php

Kirby::plugin('cxxyyl/write-user-id', [
    'hooks' => [

        // save author ID after page creation
        'page.create:after' => function ($page) {
            $user = kirby()->user(); // Get the current user
            if ($user) {  // Ensure the user is valid
                $page->update([
                    'authorID' => $user->id(),    // Store the author's unique ID
                    'authorDummy' => $user->id()
                ]);
            }
        },

        // Bug-fix 6 Nov 2025 -> now deletes the user:// string so the ID works
        'page.update:after' => function ($newPage, $oldPage) {
            // Check if authorDummy contains 'user'
            $authorDummy = $newPage->authorDummy()->value();
            $authorID = $newPage->authorID()->value();
            
            // if authorDummy exists and contains user
            if ($authorDummy && strpos($authorDummy, 'user') !== false) {
                // Clean up the ID
                $newID = str_replace('- user://', '', $authorDummy);
                
                // Only update if the authorID is different to avoid infinite loops
                if ($authorID !== $newID) {
                    kirby()->impersonate('kirby', function() use ($newPage, $newID) {
                        $newPage->update([
                            'authorID' => $newID
                        ]);
                    });
                }
            }
        }
        
    ]
]);







?>

