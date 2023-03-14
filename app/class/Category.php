<?php

class Category
{
    /**
     * @var int article id
     */
    private int $_id;

    /**
     * @var string category name
     */
    private string $_name;
    
    /**
     * @var string category description
     */
    private string $_description;

    public function getAll()
    {
        // get all articles from database
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
     * Get the value of _name
     */
    public function getName(): string
    {
        return $this->_name;
    }

    /**
     * Set the value of _name
     */
    public function setName(string $_name): self
    {
        $this->_name = $_name;

        return $this;
    }

    /**
     * Get the value of _description
     */
    public function getDescription(): string
    {
        return $this->_description;
    }

    /**
     * Set the value of _description
     */
    public function setDescription(string $_description): self
    {
        $this->_description = $_description;

        return $this;
    }
}