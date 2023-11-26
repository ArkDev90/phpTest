<?php

define('ROOT', __DIR__);
require_once(ROOT . '/utils/CommentManager.php');




// Add your logic to process the form submission and add news to the database

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $commentManager = CommentManager::getInstance();
    // Validate and process form data
    $body = htmlspecialchars($_POST["body"]);
    $newsId = htmlspecialchars($_POST["newsId"]);

    // Add logic to save news to the database or storage
    $commentManager->addCommentForNews($body, $newsId);

    // Redirect to the main page after adding news
    header("Location: index.php");
    exit();
}
?>
