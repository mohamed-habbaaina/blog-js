<?php

require_once 'DbConnection.php';
require_once 'Article.php';

class Home extends Article
{
    public function __construct()
    {}
    /**
     * Get data 3 `articles` with the name of the author and the category of the article.
     * @return array
     */
    public function getArticlHome(): ?array
    {
        $reqBlog = "SELECT username, articles.id, title, image, creation_date , name FROM users INNER JOIN articles ON users.id = articles.user_id INNER JOIN categories ON articles.category_id = categories.id  ORDER BY `articles`.`creation_date` DESC LIMIT 3";

        $selectBlog = DbConnection::getDb()->prepare($reqBlog);

        $selectBlog->execute();
        $articles= $selectBlog->fetchAll(PDO::FETCH_ASSOC);

        return $articles;
    }

    /**
     * Get article like $request.
     */
    public function getSearchArticle($request): ?array
    {
        $req = "SELECT * FROM `articles` WHERE title LIKE '%{$request}%' LIMIT 10";
        $reqSearch = DbConnection::getDb()->prepare($req);
        $reqSearch->execute();
        return $reqSearch->fetchAll(PDO::FETCH_ASSOC);
    }
}
