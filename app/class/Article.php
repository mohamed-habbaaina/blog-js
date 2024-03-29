<?php

require_once 'DbConnection.php';
require_once 'Comment.php';

class Article
{
    /**
     * @var int article id
     */
    private int $_id;

    /**
     * @var string article title
     */
    private string $_title;

    /**
     * @var string article content
     */
    private string $_content;

    /**
     * @var ?string article image, blob
     */
    private ?string $_image = null;

    /**
     * @var DateTime article creation date 
     */
    private DateTime $_creation_date;

    /**
     * @var ?DateTime optional, article modification date
     */
    private ?DateTime $_edit_date = null;

    /**
     * @var ?int article author / owner id, from users, stays null if user is deleted
     */
    public ?int $_user_id = null;

    /**
     * @var int category id of article, from categories
     */
    public int $_category_id;

    public function __construct()
    {
    }

    /**
     * @return bool depending if request is successfull or not
     */
    public function create(): bool
    {
        $sql = 'INSERT INTO articles (title, content, image, creation_date, user_id, category_id) VALUES (:title, :content, :image, NOW(), :user_id, :category_id)';

        $insert = DbConnection::getDb()->prepare($sql);

        $insert->bindParam(':title', $this->_title);
        $insert->bindParam(':content', $this->_content);
        $insert->bindParam(':image', $this->_image);
        $insert->bindParam(':user_id', $this->_user_id);
        $insert->bindParam(':category_id', $this->_category_id);

        return $insert->execute();
    }

    /**
     * @return bool depending if request is successfull or not
     */
    public function update(): bool
    {
        $sql = 'UPDATE articles SET title = :title, content = :content, image = :image, edit_date = NOW(), category_id = :category_id WHERE id = :id';

        $update = DbConnection::getDb()->prepare($sql);

        $update->bindParam(':id', $this->_id, PDO::PARAM_INT);
        $update->bindParam(':title', $this->_title);
        $update->bindParam(':content', $this->_content);
        $update->bindParam(':image', $this->_image);
        $update->bindParam(':category_id', $this->_category_id, PDO::PARAM_INT);

        return $update->execute();
    }

    /**
     * @return bool depending if request is successfull or not
     */
    public function delete():bool
    {
        $sql = 'DELETE FROM articles WHERE id = :id';

        $delete = DbConnection::getDb()->prepare($sql);

        $delete->bindParam(':id', $this->_id, PDO::PARAM_INT);

        return $delete->execute();
    }

    /**
     * @return void
     * set instance properties with retrieved data using $_id property
     */
    public function get(): void
    {
        $sql = 'SELECT * FROM articles WHERE id = :id';

        $select = DbConnection::getDb()->prepare($sql);

        $select->bindParam(':id', $this->_id);

        $select->execute();

        $article = $select->fetch(PDO::FETCH_ASSOC); // use PDO::FETCH_CLASS to hydrate instance?

        if ($article) {
            $this->_title = $article['title'];
            $this->_content = $article['content'];
            $this->_image = $article['image'];
            $this->_creation_date = new DateTime($article['creation_date']);
            $this->_edit_date = isset($article['edit_date']) ? new DateTime($article['edit_date']) : null;
            $this->_user_id = $article['user_id'];
            $this->_category_id = $article['category_id'];
        } else {
            throw new Exception('Article introuvable.');
        }        
    }

    /**
     * @return array author infos using $_user_id property
     */
    public function getAuthor()
    {
        $sql = 'SELECT id, email, username, register_date, role FROM users WHERE id = :id';

        $select = DbConnection::getDb()->prepare($sql);

        $select->bindParam(':id', $this->_user_id);

        $select->execute();

        return $select->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * @return string article category from db using $_category_id property
     */
    public function getCategoryName()
    {
        $sql = 'SELECT name FROM categories WHERE id = :id';

        $select = DbConnection::getDb()->prepare($sql);

        $select->bindParam(':id', $this->_category_id);

        $select->execute();

        return $select->fetchColumn();
    }

    /**
     * @return string short article excerpt
     */
    public function getExcerpt()
    {
        return substr($this->_content, 0, 200);
    }

    /**
     * @return array of Article from database
     */
    public static function getAllArticles()
    {

    }

    public function getComments()
    {
        try {
            return Comment::getCommentsByArticle($this->_id);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @param int $id representing user id
     * @return int id of last article created, by user id
     * used to link article to thumbnail image
     */
    public static function getLastIdByUserId($user_id) {
        $sql = 'SELECT id FROM articles WHERE creation_date = (SELECT MAX(creation_date) FROM articles WHERE user_id = :user_id)';

        $select = DbConnection::getDb()->prepare($sql);

        $select->bindParam(':user_id', $user_id, PDO::PARAM_INT);

        if ($select->execute()) {
            return $select->fetchColumn();
        }
    }

    /**
     * Get the value of id
     */
    public function getId(): int
    {
        return $this->_id;
    }

    /**
     * Set the value of id
     */
    public function setId(int $id): self
    {
        $this->_id = $id;

        return $this;
    }

    /**
     * Get the value of title
     */
    public function getTitle(): string
    {
        return $this->_title;
    }

    /**
     * Set the value of title
     */
    public function setTitle(string $title): self
    {
        if (empty(trim($title))) {
            throw new Exception('Le titre ne peut pas être vide.');
        }

        $this->_title = $title;

        return $this;
    }

    /**
     * Get the value of content
     */
    public function getContent(): string
    {
        return $this->_content;
    }

    /**
     * Set the value of content
     */
    public function setContent(string $content): self
    {
        $this->_content = $content;

        return $this;
    }

    /**
     * Get the value of image
     */
    public function getImage(): ?string
    {
        return $this->_image;
    }

    /**
     * Set the value of image
     */
    public function setImage(?string $image): self
    {
        $this->_image = $image;

        return $this;
    }

    /**
     * Get the value of creation_date
     */
    public function getCreationDate(): DateTime
    {
        return $this->_creation_date;
    }

    /**
     * Set the value of creation_date
     */
    public function setCreationDate(DateTime $creation_date): self
    {
        $date_compare = new DateTime();

        if ($creation_date > $date_compare) {
            throw new Exception('La date de création de l\'article ne peut pas être dans le futur.');
        }

        $this->_creation_date = $creation_date;

        return $this;
    }

    /**
     * Get the value of edit_date
     */
    public function getEditDate(): ?DateTime
    {
        return $this->_edit_date;
    }

    /**
     * Set the value of edit_date
     */
    public function setEditDate(?DateTime $edit_date): self
    {
        $date_compare = new DateTime();

        if ($edit_date > $date_compare) {
            throw new Exception('La date de modification de l\'article ne peut pas être dans le futur.');
        }

        $this->_edit_date = $edit_date;

        return $this;
    }

    /**
     * Get the value of user_id
     */
    public function getUserId(): int
    {
        return $this->_user_id;
    }

    /**
     * Set the value of user_id
     */
    public function setUserId(int $user_id): self
    {
        $this->_user_id = $user_id;

        return $this;
    }

    /**
     * Get the value of category_id
     */
    public function getCategoryId(): int
    {
        return $this->_category_id;
    }

    /**
     * Set the value of category_id
     */
    public function setCategoryId(int $category_id): self
    {
        $this->_category_id = $category_id;

        return $this;
    }
}