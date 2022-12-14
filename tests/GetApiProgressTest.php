<?php
declare(strict_types=1);
namespace Tests;

use Ruslanstarikov\Articleforge\ArticleForge;
use Ruslanstarikov\Articleforge\Response\GetApiProgressResponse;

class GetApiProgressTest extends BaseArticleForgeApiTest
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function testApiProgressMustReturnValidResult()
    {
        $apiResponse = [
            'api_status'   => 200,
            'progress' => 0.45,
            'status'    => "Success",
        ];
        $this->articleForgeClient->method('callApi')
            ->willReturn($apiResponse);
        $articleForge = new ArticleForge($this->apiKey, $this->articleForgeClient);
        $articleRequest = $articleForge->getApiProgress(2);
        $expectedResult = new GetApiProgressResponse($apiResponse);

        $this->assertEquals($expectedResult, $articleRequest);
    }
}