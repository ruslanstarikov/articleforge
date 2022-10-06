<?php
declare(strict_types=1);
namespace Tests;

use PHPUnit\Framework\TestCase;
use Ruslanstarikov\Articleforge\ArticleForgeClient;

abstract class BaseArticleForgeApiTest extends TestCase
{
    protected $apiKey = 'TEST_KEY';

    protected ArticleForgeClient $articleForgeClient;

    protected function setUp(): void
    {
        parent::setUp();
        $this->articleForgeClient = $this->createMock(ArticleForgeClient::class);
    }
}