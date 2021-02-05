<?php

include_once "Pdo.php";

class ArticleManagement
{
    protected $pdo;
    protected $article_id;

    public function __construct($pdo, $article_id)
    {
        $this->setPdo($pdo);
        $this->setId($article_id);
    }
    public function setPdo(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    public function setId($article_id)
    {
        $this->$article_id = $article_id;
    }

    public function selectAllArticles()
    {
        $articles = [];
        $request = $this->pdo->query('SELECT * FROM articles ORDER BY created_at DESC');
        $articles = $request->fetchAll();
        return $articles;
    }
    public function selectArticle($id)
    {
        $select = $this->pdo->query('SELECT * FROM articles WHERE id = ' . $id);
        $donnees = $select->fetch();

        return $donnees;
    }
    public function delete($article_id)
    {
        $query = $this->pdo->prepare('SELECT * FROM articles WHERE id = :id');
        $query->execute(['id' => $article_id]);
        if ($query->rowCount() === 0) {
            die("L'article $article_id n'existe pas, vous ne pouvez donc pas le supprimer !");
        }
        $this->pdo->exec('DELETE FROM articles WHERE id = ' . $article_id);
    }
}
