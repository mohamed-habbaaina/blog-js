<?php

require_once 'DbConnection.php';

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

    public static function getAll()
    {
        $sql = 'SELECT * FROM categories';

        $select = DbConnection::getDb()->prepare($sql);

        $select->execute();

        return $select->fetchAll(PDO::FETCH_CLASS, 'Category');
    }

    public function __set($name, $value)
    {
        if ($name[0] != '_') {
            $this->{'_' . $name} = $value;
        }
    }

    public function create(): bool
    {
        $sql = 'INSERT INTO categories (name, description) VALUES (:name, :description)';

        $insert = DbConnection::getDb()->prepare($sql);

        $insert->bindParam(':name', $this->_name);
        $insert->bindParam(':description', $this->_description);

        return $insert->execute();
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