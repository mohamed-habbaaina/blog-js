<?php

require_once 'DbConnection.php';

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
     * @var DateTime article creation date 
     */
    private DateTime $_creation_date;
    
    /**
     * @var DateTime optional, article modification date
     */
    private ?DateTime $_edit_date = null;
    
    /**
     * @var int article author / owner id, from users
     */
    public int $_user_id;
    
    /**
     * @var int category id of article, from categories
     */
    public int $_category_id;

    public function __construct()
    {
        
    }

    /**
     * save article in database
     */
    public function save()
    {

    }

    /**
     * delete article from database
     */
    public function delete()
    {

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

        $article = $select->fetch(PDO::FETCH_ASSOC);

        if ($article) {
            $this->_title = $article['title'];
            $this->_content = $article['content'];
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

    }

    /**
     * @return array of Article from database
     */
    public static function getAllArticles()
    {

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
     * Get the value of user_id //! récupération de la base de donné, probléme géré avec les $_SESSION, 
     */
    public function getUserId(): int
    {
        return $this->_user_id;
    }

    /**
     * Set the value of user_id //! setIdUser !
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