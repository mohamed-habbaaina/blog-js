<?php

require_once('./../class/Blog.php');


$blog = new Blog();
$dataBlog = $blog->getBlog();
echo (json_encode($dataBlog));
