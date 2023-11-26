<?php

define('ROOT', __DIR__);
require_once(ROOT . '/utils/NewsManager.php');
require_once(ROOT . '/utils/CommentManager.php');

$newsManager = NewsManager::getInstance();


// Add your logic to process the form submission and add news to the database

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validate and process form data
    $title = htmlspecialchars($_POST["title"]);
    $body = htmlspecialchars($_POST["body"]);

    // Add logic to save news to the database or storage
    $newsManager->addNews($title, $body);

    // Redirect to the main page after adding news
    header("Location: index.php");
    exit();
}
?>
