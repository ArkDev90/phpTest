<?php

class News
{

	private $id;
	private $title;
	private $body;
	private $createdAt;

	
	public function __construct($id, $title, $body, $createdAt)
    {
        $this->id = $id;
        $this->title = $title;
        $this->body = $body;
        $this->createdAt = $createdAt;
    }


	public function getId()
	{
		return $this->id;
	}



	public function getTitle()
	{
		return $this->title;
	}



	public function getBody()
	{
		return $this->body;
	}

	public function getCreatedAt()
	{
		return $this->createdAt;
	}
}