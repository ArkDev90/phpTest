<?php

class CommentManager
{
	private static $instance = null;

	private function __construct()
	{
		require_once(ROOT . '/utils/DB.php');
		require_once(ROOT . '/class/Comment.php');
	}

	public static function getInstance()
	{
		if (null === self::$instance) {
			$c = __CLASS__;
			self::$instance = new $c;
		}
		return self::$instance;
	}

	public function listComments()
	{
		$db = $this->getDatabaseInstance();
		$rows = $db->select('SELECT * FROM `comment`');

		//Extracted the code for creating comment objects into a separate method.
		return $this->createCommentObjects($rows);
	
	}

	public function addCommentForNews($body, $newsId)
	{


		$db = $this->getDatabaseInstance();

		$sql = "INSERT INTO `comment` (`body`, `created_at`, `news_id`) VALUES(:body, :created_at, :news_id)";
		$stmt = $db->prepare($sql);
	
		// Bind parameters
		$stmt->bindParam(':body', $body, PDO::PARAM_STR);
		$stmt->bindParam(':created_at',  date('Y-m-d'), PDO::PARAM_STR);
		$stmt->bindParam(':news_id', $newsId, PDO::PARAM_STR);
	
		// Execute the statement
		$stmt->execute();

        return $db->getLastInsertId();

	
	}

	public function deleteComment($id)
	{
		$db = $this->getDatabaseInstance();

		

		$sql = "DELETE FROM `comment` WHERE `id`=:id";
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

	//Moved database instance creation to a separate method for better modularity.
	private function createCommentObjects(array $rows)
    {
        $comments = [];
        foreach ($rows as $row) {
            $comments[] = new Comment($row['id'], $row['body'], $row['created_at'], $row['news_id']);
        }

        return $comments;
    }
}