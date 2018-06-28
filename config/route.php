<?php

use \Anax\Route\Router;

/**
 * Configuration file for routes.
 */
return [
    "routeFiles" => [
        [
            // To read flat file content in Markdown from content/
            "mount" => null,
            "file" => __DIR__ . "/route2/comment.php",
        ],
        [
            // Add routes from userController and mount on user/
            "mount" => "user",
            "file" => __DIR__ . "/route2/userController.php",
        ],
    ],

];
