<?php
declare(strict_types=1);
namespace Ruslanstarikov\Articleforge\Request;

use JsonSerializable;

class InitiateArticleRequest implements JsonSerializable
{
    /** @var string|null */
    private $keyword, $length;

    /** @var array|null */
    private $subKeywords, $sectionHeadings, $autoLinks;

    /** @var bool|null  */
    private $title, $turingSpinner, $useSectionHeading;

    /** @var float|null */
    private $image, $video;

    /** @var int|null  */
    private $rewriteNum, $quality, $uniqueness;

    /**
     * @param string $keyword
     * @param array|null $subKeywords
     * @param string|null $length
     * @param bool|null $title
     * @param float|null $image
     * @param float|null $video
     * @param array|null $autoLinks
     * @param bool|null $turingSpinner
     * @param int|null $quality
     * @param int|null $uniqueness
     * @param bool|null $useSectionHeading
     * @param array|null $sectionHeadings
     * @param int|null $rewriteNum
     */
    public function __construct(
        string $keyword,
        ?array $subKeywords = [],
        ?string $length = null,
        ?bool $title = false,
        ?float $image = 0.0,
        ?float $video = 0.0,
        ?array $autoLinks = [],
        ?bool $turingSpinner = false,
        ?int $quality = null,
        ?int $uniqueness = null,
        ?bool $useSectionHeading = false,
        ?array $sectionHeadings = [],
        ?int $rewriteNum = null,
    )
    {
        $this->setKeyword($keyword);
        $this->setSubKeywords($subKeywords);
        $this->setLength($length);
        $this->setTitle($title);
        $this->setImage($image);
        $this->setVideo($video);
        $this->setAutoLinks($autoLinks);
        $this->setTuringSpinner($turingSpinner);
        $this->setQuality($quality);
        $this->setUniqueness($uniqueness);
        $this->setUseSectionHeading($useSectionHeading);
        $this->setSectionHeadings($sectionHeadings);
        $this->setRewriteNum($rewriteNum);
    }

    public function jsonSerialize(): mixed
    {
        // Mandatory argument
        $payload = [
            'keyword' => $this->getKeyword(),
        ];

        // Optional arguments
        if(!empty($this->getLength()))
            $payload['length'] = $this->getLength();
        if(!empty($this->getTitle()))
            $payload['title'] = (int)$this->getTitle();
        if(!empty($this->getImage()))
            $payload['image'] = $this->getImage();
        if(!empty($this->getVideo()))
            $payload['video'] = $this->getVideo();
        if(!empty($this->getTuringSpinner()))
            $payload['turing_spinner'] = (int)$this->getTuringSpinner();
        if(!empty($this->getQuality()))
            $payload['quality'] = $this->getQuality();
        if(!empty($this->getAutoLinks()))
        {
            foreach($this->getAutoLinks() as $autoLink)
            {
                $payload['auto_links'][] = $autoLink['keyword'];
                $payload['auto_links'][] = $autoLink['link'];
                $payload['auto_links'][] = $autoLink['allOccurrence'];
            }
        }
        if(!empty($this->getRewriteNum()))
            $payload['rewrite_num'] = $this->getRewriteNum();
        if(!empty($this->getSubKeywords()))
            $payload['sub_keywords'] = implode(',', $this->getSubKeywords());
        if(!empty($this->getUniqueness()))
            $payload['uniqueness'] = $this->getUniqueness();
        if(!empty($this->getUseSectionHeading()))
            $payload['use_section_heading'] = (int)$this->getUseSectionHeading();
        if(!empty($this->getSectionHeadings())) {
            $payload['section_headinds'] = implode(',', $this->getSectionHeadings());
        }

        return $payload;
    }

    /**
     * @return string|null
     */
    public function getKeyword(): ?string
    {
        return $this->keyword;
    }

    /**
     * @param string|null $keyword
     */
    public function setKeyword(?string $keyword): void
    {
        $this->keyword = $keyword;
    }

    /**
     * @return string|null
     */
    public function getLength(): ?string
    {
        return $this->length;
    }

    /**
     * @param string|null $length
     */
    public function setLength(?string $length): void
    {
        $this->length = $length;
    }

    /**
     * @return array|null
     */
    public function getSubKeywords(): ?array
    {
        return $this->subKeywords;
    }

    /**
     * @param array|null $subKeywords
     */
    public function setSubKeywords(?array $subKeywords): void
    {
        $this->subKeywords = $subKeywords;
    }

    /**
     * @return array|null
     */
    public function getSectionHeadings(): ?array
    {
        return $this->sectionHeadings;
    }

    /**
     * @param array|null $sectionHeadings
     */
    public function setSectionHeadings(?array $sectionHeadings): void
    {
        $this->sectionHeadings = $sectionHeadings;
    }

    /**
     * @return array|null
     */
    public function getAutoLinks(): ?array
    {
        return $this->autoLinks;
    }

    /**
     * @param array|null $autoLinks
     */
    public function setAutoLinks(?array $autoLinks): void
    {
        $this->autoLinks = $autoLinks;
    }

    /**
     * @return bool|null
     */
    public function getTitle(): ?bool
    {
        return $this->title;
    }

    /**
     * @param bool|null $title
     */
    public function setTitle(?bool $title): void
    {
        $this->title = $title;
    }

    /**
     * @return bool|null
     */
    public function getTuringSpinner(): ?bool
    {
        return $this->turingSpinner;
    }

    /**
     * @param bool|null $turingSpinner
     */
    public function setTuringSpinner(?bool $turingSpinner): void
    {
        $this->turingSpinner = $turingSpinner;
    }

    /**
     * @return bool|null
     */
    public function getUseSectionHeading(): ?bool
    {
        return $this->useSectionHeading;
    }

    /**
     * @param bool|null $useSectionHeading
     */
    public function setUseSectionHeading(?bool $useSectionHeading): void
    {
        $this->useSectionHeading = $useSectionHeading;
    }

    /**
     * @return float|null
     */
    public function getImage(): ?float
    {
        return $this->image;
    }

    /**
     * @param float|null $image
     */
    public function setImage(?float $image): void
    {
        $this->image = $image;
    }

    /**
     * @return float|null
     */
    public function getVideo(): ?float
    {
        return $this->video;
    }

    /**
     * @param float|null $video
     */
    public function setVideo(?float $video): void
    {
        $this->video = $video;
    }

    /**
     * @return int|null
     */
    public function getRewriteNum(): ?int
    {
        return $this->rewriteNum;
    }

    /**
     * @param int|null $rewriteNum
     */
    public function setRewriteNum(?int $rewriteNum): void
    {
        $this->rewriteNum = $rewriteNum;
    }

    /**
     * @return int|null
     */
    public function getQuality(): ?int
    {
        return $this->quality;
    }

    /**
     * @param int|null $quality
     */
    public function setQuality(?int $quality): void
    {
        $this->quality = $quality;
    }

    /**
     * @return int|null
     */
    public function getUniqueness(): ?int
    {
        return $this->uniqueness;
    }

    /**
     * @param int|null $uniqueness
     */
    public function setUniqueness(?int $uniqueness): void
    {
        $this->uniqueness = $uniqueness;
    }
}