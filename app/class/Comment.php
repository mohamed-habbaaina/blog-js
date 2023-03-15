<?php

class Comment
{
    /**
     * @var int comment id
     */
    private int $_id;
    
    /**
     * @var string comment content
     */
    private string $_content;
    
    /**
     * @var DateTime comment creation date 
     */
    private DateTime $_creation_date;
    
    /**
     * @var DateTime optional, comment modification date
     */
    private ?DateTime $_edit_date = null;
    
    /**
     * @var int comment author / owner id, from users
     */
    public int $_user_id;
    
    /**
     * @var int article id of comment, from articles table
     */
    public int $_article_id;    

    public function __construct()
    {

    }

    /**
     * Get the value of _id
     */
    public function getId(): int
    {
        return $this->_id;
    }

    /**
     * Set the value of _id
     */
    public function setId(int $_id): self
    {
        $this->_id = $_id;

        return $this;
    }

    /**
     * Get the value of _content
     */
    public function getContent(): string
    {
        return $this->_content;
    }

    /**
     * Set the value of _content
     */
    public function setContent(string $_content): self
    {
        $this->_content = $_content;

        return $this;
    }

    /**
     * Get the value of _creation_date
     */
    public function getCreationDate(): DateTime
    {
        return $this->_creation_date;
    }

    /**
     * Set the value of _creation_date
     */
    public function setCreationDate(DateTime $_creation_date): self
    {
        $this->_creation_date = $_creation_date;

        return $this;
    }

    /**
     * Get the value of _edit_date
     */
    public function getEditDate(): ?DateTime
    {
        return $this->_edit_date;
    }

    /**
     * Set the value of _edit_date
     */
    public function setEditDate(?DateTime $_edit_date): self
    {
        $this->_edit_date = $_edit_date;

        return $this;
    }

    /**
     * Get the value of _user_id
     */
    public function getUserId(): int
    {
        return $this->_user_id;
    }

    /**
     * Set the value of _user_id
     */
    public function setUserId(int $_user_id): self
    {
        $this->_user_id = $_user_id;

        return $this;
    }

    /**
     * Get the value of _article_id
     */
    public function getArticleId(): int
    {
        return $this->_article_id;
    }

    /**
     * Set the value of _article_id
     */
    public function setArticleId(int $_article_id): self
    {
        $this->_article_id = $_article_id;

        return $this;
    }
}