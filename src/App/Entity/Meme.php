<?php


namespace App\Entity;


class Meme
{
    private string $author;
    private string $content;
    private ?int $id;

    public function __construct(string $author, string $content)
    {
        $this->content = $content;
        $this->author = $author;
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
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

}