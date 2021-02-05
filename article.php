<?php

include_once "class/Pdo.php";
include_once "class/ArticleManagement.php";
include_once "class/Comments.php";


$article_id = null;

if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
    $article_id = $_GET['id'];
}

if (!$article_id) {
    die("Vous devez préciser un paramètre `id` dans l'URL !");
}

$article = new ArticleManagement($pdo, $article_id);
$article = $article->selectArticle($article_id);

$author = htmlspecialchars(@$_POST['author']);
$content = htmlspecialchars(@$_POST['content']);
$article_id = @$_GET['id'];
$comment_id = @$_POST["commentId"];
$insert = new Comments($pdo, $article_id, $author, $content);

if (@$_POST["addComment"]) {

    $insert->addComment($author, $content, $article_id);
    header("Location: article.php?id=" . $article_id);
}
if (@$_POST["deleteCom"]) {
    $delCom = new Comments($pdo, $comment_id);
    $delCom = $delCom->deleteCom($comment_id);
    header("Location: article.php?id=" . $article_id);
}

$comments = new Comments($pdo, $article_id);
$commentaires = $comments->selectAllComments($article_id);



/**
 * 5. On affiche 
 */
$pageTitle = $article['title'];
ob_start();
require('templates/articles/show.html.php');
$pageContent = ob_get_clean();

require('templates/layout.html.php');
