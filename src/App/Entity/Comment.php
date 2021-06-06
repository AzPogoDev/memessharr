<?php


namespace App\Entity;


class Comment
{
    private string $author;
    private string $content;
    private ?int $memeId;

    public function __construct(string $author, string $content, int $memeId)
    {
        $this->content = $content;
        $this->author = $author;
        $this->memeId = $memeId;
    }

    static public function createFromData(array $data): Meme
    {
        $meme = new Meme();

        $fieldsMap = [
            'id' => 'id',
            'img' => 'img',
            'author' => 'author',
        ];

        foreach ($fieldsMap as $propertyName => $fieldName) {
            if (isset($data[$fieldName])) {
                $meme->{$propertyName} = $data[$fieldName];
            }
        }

        return $meme;
    }

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * @param string $author
     */
    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return int|null
     */
    public function getMemeId(): ?int
    {
        return $this->memeId;
    }

    /**
     * @param int|null $memeId
     */
    public function setMemeId(?int $memeId): void
    {
        $this->memeId = $memeId;
    }

}