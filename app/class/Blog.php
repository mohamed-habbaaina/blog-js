<?php

require_once 'DbConnection.php';
require_once 'Article.php';

class Blog extends Article
{
    /**
     * Get data 6 `articles` with the name of the author and the category of the article, OFFSET Paging
     * @return array
     */
    public function getBlog($offset){
        $reqBlog = "SELECT username, articles.id, title, content, image, creation_date , name FROM users INNER JOIN articles ON users.id = articles.user_id INNER JOIN categories ON articles.category_id = categories.id  ORDER BY `articles`.`creation_date` DESC LIMIT 6 OFFSET $offset";

        $selectBlog = DbConnection::getDb()->prepare($reqBlog);

        $selectBlog->execute();

        return $selectBlog->fetchAll(PDO::FETCH_ASSOC);
    }
}

