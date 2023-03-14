<?php

require_once dirname(__DIR__) . '/class/Article.php';

$article = new Article();

// $article->setId(2);
$article->setTitle('monbeautitre')
    ->setContent('testsave')
    ->setUserId(1)
    ->setCategoryId(1);

$article->save();
