<?php

Kirby::plugin('cxxyyl/write-user-id', [
    'hooks' => [
        'page.create:after' => function ($page) {
            $user = kirby()->user(); // Get the current user
            if ($user) {  // Ensure the user is valid
                $page->update([
                    //'author'   => $user->name(), // Store the author's name
                    'authorID' => $user->id()    // Store the author's unique ID
                ]);
            }
        }
    ]
]);

?>