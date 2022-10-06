<?php
declare(strict_types=1);
namespace Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Ruslanstarikov\Articleforge\ArticleForge;
use Ruslanstarikov\Articleforge\ArticleForgeClient;
use Ruslanstarikov\Articleforge\Response\ApiArticleResultResponse;

class GetApiArticleResultTest extends BaseArticleForgeApiTest
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function testGetApiArticleMustGetValidResult()
    {
        $apiResponse = [
            'article'   => "Hamburgers are good for you, science says",
            'article_id' => 2,
            'status'    => "OK",
        ];
        $this->articleForgeClient->method('callApi')
            ->willReturn($apiResponse);
        $articleForge = new ArticleForge($this->apiKey, $this->articleForgeClient);
        $articleRequest = $articleForge->getApiArticleResult(2);
        $expectedResult = new ApiArticleResultResponse($apiResponse);

        $this->assertEquals($expectedResult, $articleRequest);
    }

    public function testGetApiArticleMustThrowError()
    {
        $jsonResponse = [
            'error_message' => "Article Forge is currently processing the maximum number of concurrent requests",
            'status' => "Fail"
        ];
        $mock = new MockHandler([
            new ServerException('500 Internal Server Error', new Request('POST', 'api/get_api_article_result'), new Response(500, [], json_encode($jsonResponse)))
        ]);
        $handlerStack = HandlerStack::create($mock);
        $guzzleClient = new Client(['handler' => $handlerStack]);

        $apiKey = "VALID_KEY";
        $articleForgeClient = new ArticleForgeClient($apiKey, $guzzleClient);
        $articleForge = new ArticleForge($this->apiKey, $articleForgeClient);
        $articleRequest = $articleForge->getApiArticleResult(1)->toArray();
        $expectedResult = [
            "error" => "Article Forge is currently processing the maximum number of concurrent requests",
            "article" => null,
            "articleId" => null,
            "status" => "Fail"
        ];

        $this->assertEquals($expectedResult, $articleRequest);
    }
}