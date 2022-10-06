<?php
declare(strict_types=1);
namespace Tests;

use Ruslanstarikov\Articleforge\ArticleForge;
use Ruslanstarikov\Articleforge\Response\CheckUsageResponse;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Ruslanstarikov\Articleforge\ArticleForgeClient;
use GuzzleHttp\Client;

class CheckUsageTest extends BaseArticleForgeApiTest
{

    public function testUsageMustReturnValidResponse()
    {
        $apiResponse = [
            "status" => "OK",
            "API Requests" => 200,
            "Monthly Words Remaining" => 30000,
            "Overuse Protection" => 'NO',
            "Prepaid Amount" => "$20.00",
            "Prepaid Words Available" => 25000,
            "Overage Usage Charge" => 30.2
        ];
        $this->articleForgeClient->method('callApi')
            ->willReturn($apiResponse);
        $articleForge = new ArticleForge($this->apiKey, $this->articleForgeClient);
        $articleRequest = $articleForge->checkUsage();
        $expectedResult = new CheckUsageResponse($apiResponse);

        $this->assertEquals($expectedResult, $articleRequest);
    }

    public function testUsageMustReturnUnauthorized()
    {
        $jsonResponse = [
            "error_message" => "Invalid email / API key pair",
            "status" => "Fail"
        ];
        $mock = new MockHandler([
            new ClientException('401 Unauthorized', new Request('POST', 'api/initiate_article'), new Response(401, [], json_encode($jsonResponse)))
        ]);
        $handlerStack = HandlerStack::create($mock);
        $guzzleClient = new Client(['handler' => $handlerStack]);

        $apiKey = "INVALID_KEY";
        $articleForgeClient = new ArticleForgeClient($apiKey, $guzzleClient);
        $articleForge = new ArticleForge($this->apiKey, $articleForgeClient);
        $articleRequest = $articleForge->checkUsage()->toArray();
        $expectedResult = (new CheckUsageResponse(["error" => "Invalid email / API key pair", "status" => "Fail"]))->toArray();

        $this->assertEquals($expectedResult, $articleRequest);
    }
}