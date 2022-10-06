<?php
declare(strict_types=1);
namespace Tests;

use Ruslanstarikov\Articleforge\ArticleForge;
use Ruslanstarikov\Articleforge\ArticleForgeClient;
use Ruslanstarikov\Articleforge\Enum\ArticleLength;
use Ruslanstarikov\Articleforge\Response\InitiateArticleResponse;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Exception\ServerException;

class InitiateArticleTest extends BaseArticleForgeApiTest
{
    public function testInitiateArticleMustReturnValidResponseObject()
    {
        $articleTitle = "Health Benefits of Bacon";
        $apiResponse = ['ref_key' => 123, 'status' => 'OK', 'error_message' => null];
        $this->articleForgeClient->method('callApi')
            ->willReturn($apiResponse);
        $articleForge = new ArticleForge($this->apiKey, $this->articleForgeClient);
        $articleRequest = $articleForge->initiateArticle($articleTitle);
        $expectedResult = new InitiateArticleResponse($apiResponse);

        $this->assertEquals($expectedResult, $articleRequest);
    }

    public function testInitiateArticleWithAllArgumentsMustReturnValidResponseObject()
    {
        $apiResponse = ['ref_key' => 123, 'status' => 'OK', 'error_message' => null];
        $this->articleForgeClient->method('callApi')
            ->willReturn($apiResponse);
        $articleForge = new ArticleForge($this->apiKey, $this->articleForgeClient);
        $subKeywords = ["Ice cream"];
        $articleTitle = "Health benefits of Vanilla Ice cream";
        $length = ArticleLength::MEDIUM;
        $title = true;
        $image = 0.4;
        $video = 0.0;
        $autoLinks[] = [
            'keyword' => 'Icecream',
            'link' => 'https://ice.cream',
            'allOccurrence' => true
        ];
        $turingSpinner = false;
        $quality = 3;
        $uniqueness = 1;
        $useSectionHeadings = true;
        $sectionHeadings = ["Protein", "Fats", "Sugar"];
        $rewriteNum = 1;
        $articleRequest = $articleForge->initiateArticle(
            $articleTitle, $length, $subKeywords, $title, $image, $video, $autoLinks, $turingSpinner, $quality, $uniqueness,
            $useSectionHeadings, $sectionHeadings, $rewriteNum );
        $expectedResult = new InitiateArticleResponse($apiResponse);
        $this->assertEquals($expectedResult, $articleRequest);
    }

    public function testInitiateArticleWithWrongKeyMustThrowClientError()
    {
        $articleTitle = "Health Benefits of Avocados";
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
        $articleRequest = $articleForge->initiateArticle($articleTitle)->toArray();
        $expectedResult = [
            "error" => "Invalid email / API key pair",
            "ref_key" => null,
            "status" => "Fail"
        ];

        $this->assertEquals($expectedResult, $articleRequest);
    }

    public function testInitiateArticleMustThrowServerError()
    {
        $articleTitle = "Health Benefits of Cucumbers";
        $jsonResponse = [
            'error_message' => "Article Forge is currently processing the maximum number of concurrent requests",
            'status' => "Fail"
        ];
        $mock = new MockHandler([
            new ServerException('500 Internal Server Error', new Request('POST', 'api/initiate_article'), new Response(500, [], json_encode($jsonResponse)))
        ]);
        $handlerStack = HandlerStack::create($mock);
        $guzzleClient = new Client(['handler' => $handlerStack]);

        $apiKey = "INVALID_KEY";
        $articleForgeClient = new ArticleForgeClient($apiKey, $guzzleClient);
        $articleForge = new ArticleForge($this->apiKey, $articleForgeClient);
        $articleRequest = $articleForge->initiateArticle($articleTitle)->toArray();
        $expectedResult = [
            "error" => "Article Forge is currently processing the maximum number of concurrent requests",
            "ref_key" => null,
            "status" => "Fail"
        ];

        $this->assertEquals($expectedResult, $articleRequest);
    }
}