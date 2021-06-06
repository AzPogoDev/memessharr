<?php

namespace App\Repository;

use App\Aware\PdoAware;
use App\Entity\Meme;
use PDO;
use App\Entity\Comment;

class MemeRepository implements PdoAware
{

    private ?PDO $pdo = null;

    public function setPdo(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAll()
    {
        $query = $this->pdo->prepare('SELECT * FROM `meme`');
        $query->execute();
        $memes = [];

        return $query->fetchAll();
    }

    public function getRecentsArticles(int $number)
    {

        $query = $this->pdo->prepare('SELECT * FROM `meme` LIMIT :limitnumber');

        $query->bindParam('limitnumber', $number, PDO::PARAM_INT);

        $query->execute();

        return $query->fetchAll();
    }

    public function getById(int $number)
    {

        $query = $this->pdo->prepare('SELECT * FROM `meme` WHERE id = :id');

        $query->bindParam('id', $number, PDO::PARAM_INT);

        $query->execute();

        return $query->fetch();
    }

    public function GetComments(int $memeId)
    {
        $query = $this->pdo->prepare('SELECT * FROM `comment` WHERE memeId = :memeid');

        $query->bindParam('memeid', $memeId, PDO::PARAM_INT);

        $query->execute();

        return $query->fetchAll();
    }

    public function addComment(Comment $comment)
    {
        $query = $this->pdo->prepare('INSERT INTO `comment`( `author`, `content`, `memeId`) VALUES (:author , :content, :memeid)');

        $query->execute([
            'author' => $comment->getAuthor(),
            'content' => $comment->getContent(),
            'memeid' => $comment->getMemeId()
        ]);

        return $query->fetchAll();
    }

    public function addMeme(Meme $meme)
    {
        $query = $this->pdo->prepare('INSERT INTO `meme`( `author`, `img`) VALUES ( :author, :memecontent)');

        $query->execute([
            'author' => $meme->getAuthor(),
            'memecontent' => $meme->getContent(),
        ]);

        return $query->fetchAll();
    }

    public function searchMeme(string $search)
    {

        $sth = $this->pdo->prepare("SELECT * FROM `meme` WHERE author = :author");

        $sth->setFetchMode(PDO:: FETCH_OBJ);
        $sth->execute([
            'author' => $search,
        ]);
        return $sth->fetchAll();
    }
}