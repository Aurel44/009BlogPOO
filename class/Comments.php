<?php

include_once "Pdo.php";

class Comments
{
    protected $pdo;
    protected $article_id;
    protected $author;
    protected $content;
    protected $comment_id;


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
        $this->$article_id = (int) $article_id;
    }
    public function setAuthor($author)
    {
        $this->$author = $author;
    }

    public function selectAllComments($id)
    {
        $request = $this->pdo->query('SELECT * FROM comments WHERE article_id = ' . $id);
        $comments = $request->fetchAll();
        return $comments;
    }
    public function addComment($author, $content, $article_id)
    {
        $insert = $this->pdo->prepare('INSERT INTO comments(author, content, article_id, created_at) VALUES(?,?,?,NOW())');
        $insert->execute(array(        
                $author,
                $content,
                $article_id              
            )
        );
    }
    public function deleteCom($comment_id)
    {
        $query = $this->pdo->prepare('SELECT * FROM comments WHERE id = ?');
        $query->execute(array($comment_id));
        if ($query->rowCount() === 0) {
            die("L'article $comment_id n'existe pas, vous ne pouvez donc pas le supprimer !");
        }
        $this->pdo->exec('DELETE FROM comments WHERE id = ' . $comment_id);
    }
}
