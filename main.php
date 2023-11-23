<?php

// Define interfaces for News and Comment repositories
interface NewsRepository {
    public function listNews();
}

interface CommentRepository {
    public function listComments();
}

// Concrete implementation of NewsRepository
class NewsManager implements NewsRepository {
    // Implementation details for listing news
    public function listNews() {
        // Your existing implementation here
    }
}

// Concrete implementation of CommentRepository
class CommentManager implements CommentRepository {
    // Implementation details for listing comments
    public function listComments() {
        // Your existing implementation here
    }
}

// New class that uses the repositories to display news and comments
class NewsCommentViewer {
    private $newsRepository;
    private $commentRepository;

    public function __construct(NewsRepository $newsRepository, CommentRepository $commentRepository) {
        $this->newsRepository = $newsRepository;
        $this->commentRepository = $commentRepository;
    }

    public function displayNewsAndComments() {
        foreach ($this->newsRepository->listNews() as $news) {
            echo '<table border="1">';
            echo '<tr><th colspan="2">News: ' . htmlspecialchars($news->getTitle()) . '</th></tr>';
            echo '<tr><td colspan="2">' . htmlspecialchars($news->getBody()) . '</td></tr>';

            $comments = $this->commentRepository->listComments();
            foreach ($comments as $comment) {
                if ($comment->getNewsId() == $news->getId()) {
                    echo '<tr><td>Comment ' . htmlspecialchars($comment->getId()) . ':</td><td>' . htmlspecialchars($comment->getBody()) . '</td></tr>';
                }
            }

            echo '</table>';
        }
    }
}

// Usage
$newsManager = new NewsManager();
$commentManager = new CommentManager();

$viewer = new NewsCommentViewer($newsManager, $commentManager);
$viewer->displayNewsAndComments();

?>
