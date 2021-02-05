<?php
include_once "class/Pdo.php";
include_once "class/ArticleManagement.php";

$id = '';
$articles = [];
$articles = new ArticleManagement($pdo, $id);
$articles = $articles->selectAllArticles();
$article_id = @$_POST["articleId"];

if (@$_POST["deleteArticle"]) {
    $delArt = new ArticleManagement($pdo, $article_id);
    $delArt = $delArt->delete($article_id);
    header("Location: index.php");
}

?>

<h1>Nos articles</h1>

<?php foreach ($articles as $article) { ?>
    <form action="" method="POST">
        <h2><?= $article['title'] ?></h2>
        <small>Ecrit le <?= $article['created_at'] ?></small>
        <p><?= $article['introduction'] ?></p>
        <a href="article.php?id=<?= $article['id'] ?>">Lire la suite</a>
        <button type="submit" name="deleteArticle" value="deleteArticle">Delete</button>
        <input type="hidden" name="articleId" value="<?= $article['id'] ?>">
    </form>
<?php } ?>