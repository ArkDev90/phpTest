<?php

class Comment
{
	private $id; 
	private $body; 
	private $createdAt;
	private $newsId;


	public function __construct($id, $body, $createdAt, $newsId)
    {
        $this->id = $id;
        $this->body = $body;
        $this->createdAt = $createdAt;
        $this->newsId = $newsId;
    }



	public function getId()
	{
		return $this->id;
	}

	public function getBody()
	{
		return $this->body;
	}


	public function getCreatedAt()
	{
		return $this->createdAt;
	}

	public function getNewsId()
	{
		return $this->newsId;
	}

}