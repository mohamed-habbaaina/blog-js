<?php

require_once 'DbConnection.php';
require_once 'Article.php';

class Blog extends Article
{
    public function getBlog(){
        $reqBlog = 'SELECT username, title,	content, image, creation_date	, name  FROM users INNER JOIN articles ON users.id = articles.user_id INNER JOIN categories ON articles.category_id = categories.id LIMIT 6';

        // SELECT username, title, content, creation_date, name FROM users INNER JOIN articles ON users.id = articles.user_id INNER JOIN categories ON articles.category_id = categories.id;

        $selectBlog = DbConnection::getDb()->prepare($reqBlog);

        $selectBlog->execute();

        return $selectBlog->fetchAll(PDO::FETCH_ASSOC);
    }
}

