<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>News and Comments</title>

  <!-- Link to the external stylesheet -->
  <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>

  <!-- Header -->
  <header>
    <h1>Minimalist News</h1>
  </header>

  <!-- News Container -->
  <div class="news-container">
    <div class="add-news-button">
      <a href="add_news.php" class="btn">+ Add  News</a>
    </div>
    <?php
    define('ROOT', __DIR__);
    require_once(ROOT . '/utils/NewsManager.php');
    require_once(ROOT . '/utils/CommentManager.php');

    $newsManager = NewsManager::getInstance();
    $commentManager = CommentManager::getInstance();

    foreach ($newsManager->listNews() as $news) {
      echo '<table class="news-table">';
      echo '<tr>';
      echo '<th colspan="2" >';
      echo 'News: ' . htmlspecialchars($news->getTitle());
      echo '<button  class="btn smaller-btn delete-news-button" onclick="deleteNews(' . $news->getId() . ')">Delete</button>';
      echo '</th>';
      echo '</tr>';
      echo '<tr><td colspan="2">' . htmlspecialchars($news->getBody()) . '</td></tr>';

 

      printCommentsRows($news->getId(), $commentManager);

      echo '<tr><td colspan="2" class="comment-form-container">';
      echo '<form id="commentForm_' . $news->getId() . '" class="comment-form">';
      echo '<label for="comment_' . $news->getId() . '">Your Comment:</label>';
      echo '<textarea id="comment_' . $news->getId() . '" name="comment" rows="4" cols="50"></textarea>';
      echo '<br>';
      echo '<button type="button" onclick="submitComment(' . $news->getId() . ')">Submit Comment</button>';
      echo '</form>';
      echo '</td></tr>';

      echo '</table>';
    }

    function printCommentsRows($newsId, $commentManager)
    {
      $comments = $commentManager->listComments();

      foreach ($comments as $comment) {
        if ($comment->getNewsId() == $newsId) {
          echo '<tr>
                  <td class="comment-info">Comment ' . htmlspecialchars($comment->getId()) . ':</td>
                  <td class="comment-body">' . htmlspecialchars($comment->getBody()) . '</td>
                </tr>';
        }
      }
    }
    ?>

  </div>

  <script>
     function deleteNews(newsId) {
        // Confirm before deleting
        if (confirm("Are you sure you want to delete this news?")) {
            // Send AJAX request to delete news
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Optionally handle the response from the server
                    console.log('News deleted successfully');
                    // Reload the page or update the UI as needed
                    location.reload();
                }
            };
            xhr.open("POST", "processDeleteNews.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("news_id=" + newsId);
        }
    }

    // Function to submit a new comment
    function submitComment(newsId) {
      // Retrieve the comment from the textarea
      var comment = document.getElementById('comment_' + newsId).value;

      // Send an AJAX request to submit the comment
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
          // Optionally handle the response from the server
          console.log(xhr.responseText);

          // Reload the page or update the UI as needed
          location.reload();
        }
      };
      xhr.open("POST", "processAddComment.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.send("newsId=" + newsId + "&body=" + encodeURIComponent(comment));
    }
  </script>

</body>

</html>
