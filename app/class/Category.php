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
    private ?string $_description = null;

    public function __construct()
    {
    }

    /**
     * format properties names using field names from database
     * properties names must start by an underscore "_"
     */
    public function __set($name, $value)
    {
        if ($name[0] !== '_') {
            $this->{'_' . $name} = $value;
        }
    }

    /**
     * @return array of Category objects
     */
    public static function getAll(): array
    {
        $sql = 'SELECT * FROM categories';

        $select = DbConnection::getDb()->prepare($sql);

        $select->execute();

        return $select->fetchAll(PDO::FETCH_CLASS, 'Category');
    }

    /**
     * @return bool depending if request is successfull or not
     */
    public function create(): bool
    {
        $sql = 'INSERT INTO categories (name, description) VALUES (:name, :description)';

        $insert = DbConnection::getDb()->prepare($sql);

        $insert->bindParam(':name', $this->_name);
        $insert->bindParam(':description', $this->_description);

        return $insert->execute();
    }

    /**
     * @return bool depending if request is successfull or not
     */
    public function update(): bool
    {
        $sql = 'UPDATE categories SET name = :name, description = :description WHERE id = :id';

        $update = DbConnection::getDb()->prepare($sql);

        $update->bindParam(':name', $this->_name);
        $update->bindParam(':description', $this->_description);
        $update->bindParam(':id', $this->_id, PDO::PARAM_INT);

        return $update->execute();
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
    public function getDescription(): ?string
    {
        return $this->_description;
    }

    /**
     * Set the value of _description
     */
    public function setDescription(?string $_description): self
    {
        $this->_description = $_description;

        return $this;
    }
}