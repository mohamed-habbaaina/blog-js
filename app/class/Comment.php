<?php

require_once 'DbConnection.php';

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
     * @var ?int comment author / owner id, from users, stays null if user is deleted
     */
    public ?int $_user_id = null;

    /**
     * @var int article id of comment, from articles table
     */
    public int $_article_id;

    public function __construct()
    {
    }

    /**
     * format properties names using field names from database
     * properties names must start by an underscore "_"
     * if DateTime() values are not null in database, they are parsed with DateTime class before being defined as properties
     */
    public function __set($name, $value): void
    {
        if ($name === 'creation_date' || $name === 'edit_date' && $value !== null) {
            $value = new DateTime($value);
        }

        if ($name[0] != '_') {
            $this->{'_' . $name} = $value;
        }
    }

    /**
     * @return bool depending if request is successfull or not
     */
    public function create(): bool
    {
        $sql = 'INSERT INTO comments (content, creation_date, user_id, article_id) VALUES (:content, NOW(), :user_id, :article_id)';

        $insert = DbConnection::getDb()->prepare($sql);

        $insert->bindParam(':content', $this->_content);
        $insert->bindParam(':user_id', $this->_user_id, PDO::PARAM_INT);
        $insert->bindParam(':article_id', $this->_article_id, PDO::PARAM_INT);

        return $insert->execute();
    }

    /**
     * @return bool depending if request is successfull or not
     */
    public function update(): bool
    {
        $sql = 'UPDATE comments SET content = :content, edit_date = NOW() WHERE id = :id';

        $update = DbConnection::getDb()->prepare($sql);

        $update->bindParam(':content', $this->_content);
        $update->bindParam(':id', $this->_id, PDO::PARAM_INT);

        return $update->execute();
    }

    /**
     * @param int $article_id used used in Article class with its $_id property
     * @return array of Comment objects
     */
    public static function getCommentsByArticle(int $article_id)
    {
        $sql = 'SELECT * FROM comments WHERE article_id = :article_id ORDER BY creation_date DESC';

        $select = DbConnection::getDb()->prepare($sql);

        $select->bindParam(':article_id', $article_id, PDO::PARAM_INT);

        if ($select->execute()) {
            return $select->fetchAll(PDO::FETCH_CLASS, 'Comment');
        } else {
            throw new Exception('Erreur dans la récupération des commentaires');
        }
    }

    /**
     * @return array author name & role using $_user_id property
     */
    public function getAuthor()
    {
        $sql = 'SELECT id, username, role FROM users WHERE id = :id';

        $select = DbConnection::getDb()->prepare($sql);

        $select->bindParam(':id', $this->_user_id);

        $select->execute();

        return $select->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * find article id in database using $_id property
     * @return int article_id found in database
     */
    public function findArticleId()
    {
        $sql = 'SELECT article_id FROM comments WHERE id = :id';

        $select = DbConnection::getDb()->prepare($sql);

        $select->bindParam(':id', $this->_id);

        $select->execute();

        return $select->fetchColumn();
    }

    public function delete(): bool
    {
        $sql = 'DELETE FROM comments WHERE id = :id';

        $delete = DbConnection::getDb()->prepare($sql);

        $delete->bindParam(':id', $this->_id, PDO::PARAM_INT);

        return $delete->execute();
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