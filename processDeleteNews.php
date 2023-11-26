<?php

define('ROOT', __DIR__);
require_once(ROOT . '/utils/NewsManager.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['news_id'])) {
    $newsManager = NewsManager::getInstance();

    // Get news ID from POST data
    $newsId = $_POST['news_id'];

    // Call the deleteNews method
    $newsManager->deleteNews($newsId);

    // Send a success response
    echo json_encode(['status' => 'success']);
} else {
    // Send an error response if the request is not valid
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>
