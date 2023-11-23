<?php

define('ROOT', __DIR__);
require_once(ROOT . '/utils/NewsManager.php');
require_once(ROOT . '/utils/CommentManager.php');

$newsManager = NewsManager::getInstance();
$commentManager = CommentManager::getInstance();

foreach ($newsManager->listNews() as $news) {
    echo '<table border="1">';
    echo '<tr><th colspan="2">News: ' . htmlspecialchars($news->getTitle()) . '</th></tr>';
    echo '<tr><td colspan="2">' . htmlspecialchars($news->getBody()) . '</td></tr>';

    $comments = $commentManager->listComments();
    foreach ($comments as $comment) {
        if ($comment->getNewsId() == $news->getId()) {
            echo '<tr><td>Comment ' . htmlspecialchars($comment->getId()) . ':</td><td>' . htmlspecialchars($comment->getBody()) . '</td></tr>';
        }
    }

    echo '</table>';
}

?>

