<?php
declare(strict_types=1);
namespace Tests;

use Ruslanstarikov\Articleforge\ArticleForge;
use Ruslanstarikov\Articleforge\Response\DeleteArticleResponse;

class DeleteArticleTest extends BaseArticleForgeApiTest
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function testDeleteArticleMustReturnValidResponse()
    {
        $apiResponse = [
            'status'    => "OK",
        ];
        $this->articleForgeClient->method('callApi')
            ->willReturn($apiResponse);
        $articleForge = new ArticleForge($this->apiKey, $this->articleForgeClient);
        $articleRequest = $articleForge->deleteArticle(2);
        $expectedResult = new DeleteArticleResponse($apiResponse);

        $this->assertEquals($expectedResult, $articleRequest);
    }
}