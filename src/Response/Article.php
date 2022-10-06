<?php

namespace Ruslanstarikov\Articleforge\Response;
use DateTimeImmutable;

class Article
{
    public string $id;
    public string $title;
    public DateTimeImmutable $createdAt;
    public string $keyword;
    public array $subKeywords;

    /**
     * @throws \Exception
     */
    public function __construct($response)
    {
        $this->setId($response['id']);
        $this->setTitle($response['title']);
        $createdAt = (new DateTimeImmutable($response['created_at']));
        $this->setCreatedAt($createdAt);
        $this->setKeyword($response['keyword']);
        $this->setSubKeywords(explode('|', $response['sub_keywords'])) ?? null;
    }

    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'createdAt' => $this->getCreatedAt()->format('c'),
            'keyword' => $this->getKeyword(),
            'subKeywords' => $this->getSubKeywords()
        ];
    }


    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @param DateTimeImmutable $createdAt
     */
    public function setCreatedAt(DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return string
     */
    public function getKeyword(): string
    {
        return $this->keyword;
    }

    /**
     * @param string $keyword
     */
    public function setKeyword(string $keyword): void
    {
        $this->keyword = $keyword;
    }

    /**
     * @return array
     */
    public function getSubKeywords(): array
    {
        return $this->subKeywords;
    }

    /**
     * @param array $subKeywords
     */
    public function setSubKeywords(array $subKeywords): void
    {
        $this->subKeywords = $subKeywords;
    }


}