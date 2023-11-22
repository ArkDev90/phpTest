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
		$db = DB::getInstance();
		$rows = $db->select('SELECT * FROM `comment`');

		$comments = [];
		foreach($rows as $row) {
			  $comments[] = new Comment($row['id'], $row['body'], $row['created_at'], $row['news_id']);
		}

		return $comments;
	}

	public function addCommentForNews($body, $newsId)
	{


		$db = $this->getInstance();
        $sql = "INSERT INTO `comment` (`body`, `created_at`, `news_id`) VALUES(:body, :created_at, :news_id)";
        $params = [
            ':body' => $body,
            ':created_at' => date('Y-m-d'),	
            ':news_id' => $newsId,
        ];
        $db->execWithParams($sql, $params);

        return $db->lastInsertId();

	
	}

	public function deleteComment($id)
	{
		$db = DB::getInstance();
		$sql = "DELETE FROM `comment` WHERE `id`=" . $id;
		return $db->exec($sql);
	}
}