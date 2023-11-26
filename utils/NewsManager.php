<?php

class NewsManager
{
	private static $instance = null;

	private function __construct()
	{
		require_once(ROOT . '/utils/DB.php');
		require_once(ROOT . '/utils/CommentManager.php');
		require_once(ROOT . '/class/News.php');
	}

	public static function getInstance()
	{
		if (null === self::$instance) {
			$c = __CLASS__;
			self::$instance = new $c;
		}
		return self::$instance;
	}

	/**
	* list all news
	*/
	public function listNews()
	{
		$db = $this->getDatabaseInstance();
		$rows = $db->select('SELECT * FROM `news`');

		return $this->createNewsObjects($rows);
	
	}

	/**
	* add a record in news table
	*/
	public function addNews($title, $body)
{
    $db = DB::getInstance();

    // Use prepared statements to prevent SQL injection
    $sql = "INSERT INTO `news` (`title`, `body`, `created_at`) VALUES(:title, :body, :created_at)";
    $stmt = $db->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':title', $title, PDO::PARAM_STR);
    $stmt->bindParam(':body', $body, PDO::PARAM_STR);
    $stmt->bindParam(':created_at', date('Y-m-d'), PDO::PARAM_STR);

    // Execute the statement
    $stmt->execute();

    // Return the last inserted ID
    return $db->getLastInsertId();
}


	/**
	* deletes a news, and also linked comments
	*/
	public function deleteNews($id)
	{
		$comments = CommentManager::getInstance()->listComments();
		$idsToDelete = [];

		foreach ($comments as $comment) {
			if ($comment->getNewsId() == $id) {
				$idsToDelete[] = $comment->getId();
			}
		}

		foreach($idsToDelete as $id) {
			CommentManager::getInstance()->deleteComment($id);
		}

		
	


		$db = DB::getInstance();
		$sql = "DELETE FROM `news` WHERE `id`=:id";
		$stmt = $db->prepare($sql);
	
		// Bind parameters
		$stmt->bindParam(':id', $id, PDO::PARAM_STR);
	
		// Execute the statement
		return $stmt->execute();


	}

	private function getDatabaseInstance()
    {
        return DB::getInstance();
    }


	private function createNewsObjects(array $rows)
    {
        $news = [];
        foreach ($rows as $row) {
            $news[] = new News($row['id'], $row['title'], $row['body'], $row['created_at']);
        }

        return $news;
    }

}