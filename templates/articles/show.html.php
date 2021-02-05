<h1><?= $article['title'] ?></h1>
<small>Ecrit le <?= $article['created_at'] ?></small>
<p><?= $article['introduction'] ?></p>
<hr>
<?= $article['content'] ?>

<?php if (count($commentaires) === 0) : ?>
    <h2>Il n'y a pas encore de commentaires pour cet article ... SOYEZ LE PREMIER ! :D</h2>
<?php else : ?>
    <h2>Il y a déjà <?= count($commentaires) ?> réactions : </h2>
    <?php foreach ($commentaires as $commentaire) : ?>
        <form action="" method="POST">
            <h3>Commentaire de <?= $commentaire['author'] ?></h3>
            <small>Le <?= $commentaire['created_at'] ?></small>
            <blockquote>
                <em><?= $commentaire['content'] ?></em>
            </blockquote>
            <button type="submit" name="deleteCom" value="deleteCom">Delete</button>
            <input type="hidden" name="commentId" value="<?= $commentaire['id'] ?>">
        </form>
    <?php endforeach ?>
<?php endif ?>

<form action="" method="POST">
    <h3>Vous voulez réagir ? N'hésitez pas les bros !</h3>
    <input type="text" name="author" placeholder="Votre pseudo !">
    <textarea name="content" id="" cols="30" rows="10" placeholder="Votre commentaire ..."></textarea>
    <input type="hidden" name="articleId" value="<?= $article_id ?>">
    <button type="submit" name="addComment" value="addComment">Commenter !</button>
</form>