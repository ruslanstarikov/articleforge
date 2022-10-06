<?php
declare(strict_types=1);
namespace Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Ruslanstarikov\Articleforge\ArticleForge;
use Ruslanstarikov\Articleforge\ArticleForgeClient;
use Ruslanstarikov\Articleforge\Response\ArticleListResponse;
use Ruslanstarikov\Articleforge\Response\ArticleResponse;
use Tests\data\Article as ArticleData;

class ViewArticlesTest extends BaseArticleForgeApiTest
{
    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @dataProvider articleData
     */
    public function testViewArticleMustReturnValidResponse($input, $apiResponse, $output)
    {
        $this->articleForgeClient->method('callApi')
            ->willReturn($apiResponse);
        $articleForge = new ArticleForge($this->apiKey, $this->articleForgeClient);
        $articleRequest = $articleForge->viewArticle($input);
        $expectedResult = new ArticleResponse($output);

        $this->assertEquals($expectedResult, $articleRequest);
    }

    public function testViewArticlesMustReturnValidResponse()
    {
        $apiResponse = [
            'data' => [
                [
                    'id' => "2",
                    'title' => 'Health Benefits of Blood oranges',
                    'created_at' => "2022-10-05 16:25:00",
                    'keyword' => 'health benefits of blood oranges',
                    'sub_keywords' => 'citrus|health'
                ],
                [
                    'id' => "3",
                    'title' => 'Health Benefits of potatoes',
                    'created_at' => "2022-10-05 16:26:00",
                    'keyword' => 'health benefits of potatoes',
                    'sub_keywords' => 'potato|health'
                ]
            ],
            'status' => 'Success'
        ];
        $this->articleForgeClient->method('callApi')
            ->willReturn($apiResponse);
        $articleForge = new ArticleForge($this->apiKey, $this->articleForgeClient);
        $articleRequest = $articleForge->viewArticles(2);
        $expectedResult = new ArticleListResponse($apiResponse);

        $this->assertEquals($expectedResult, $articleRequest);
    }

    public function testViewArticleWithWrongKeyMustThrowClientError()
    {
        $jsonResponse = [
            "error_message" => "Invalid email / API key pair",
            "status" => "Fail"
        ];
        $mock = new MockHandler([
            new ClientException('401 Unauthorized', new Request('POST', 'api/view_articles'), new Response(401, [], json_encode($jsonResponse)))
        ]);
        $handlerStack = HandlerStack::create($mock);
        $guzzleClient = new Client(['handler' => $handlerStack]);

        $apiKey = "INVALID_KEY";
        $articleForgeClient = new ArticleForgeClient($apiKey, $guzzleClient);
        $articleForge = new ArticleForge($this->apiKey, $articleForgeClient);
        $articleRequest = $articleForge->viewArticles(2)->toArray();
        $expectedResult = [
            "error" => "Invalid email / API key pair",
            "data" => [],
            "status" => "Fail"
        ];

        $this->assertEquals($expectedResult, $articleRequest);
    }

    public function articleData()
    {
        return ArticleData::articleData();
    }
}