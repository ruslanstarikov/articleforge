<?php
declare(strict_types=1);

namespace Ruslanstarikov\Articleforge;

use Ruslanstarikov\Articleforge\Request\InitiateArticleRequest;
use Ruslanstarikov\Articleforge\Response\ApiArticleResultResponse;
use Ruslanstarikov\Articleforge\Response\ArticleListResponse;
use Ruslanstarikov\Articleforge\Response\ArticleResponse;
use Ruslanstarikov\Articleforge\Response\CheckUsageResponse;
use Ruslanstarikov\Articleforge\Response\DeleteArticleResponse;
use Ruslanstarikov\Articleforge\Response\GetApiProgressResponse;
use Ruslanstarikov\Articleforge\Response\InitiateArticleResponse;

class ArticleForge
{
    public ArticleForgeClient $client;

    public function __construct(string $apiKey, ArticleForgeClient $client = null)
    {
        if(empty($client))
            $this->client = new ArticleForgeClient($apiKey);
        else
            $this->client = $client;
    }

    public function checkUsage(): CheckUsageResponse
    {
        $endpoint = 'api/check_usage';
        $response = $this->client->callApi($endpoint);

        return (new CheckUsageResponse($response));
    }

    public function viewArticles(int $limit = null): ArticleListResponse
    {
        $endpoint = 'api/view_articles';
        $payload = ['limit' => $limit];
        $response = $this->client->callApi($endpoint, $payload);

        return (new ArticleListResponse($response));
    }
    
    public function viewArticle(int $articleId, bool $spintaxView = false): ArticleResponse
    {
        $endpoint = 'api/view_article';
        $payload = [
            'article_id' => $articleId
        ];
        if(!empty($spintaxView))
            $payload['spintax_view'] = 1;
        $response = $this->client->callApi($endpoint, $payload);

        return (new ArticleResponse($response));
    }

    public function initiateArticle(
        string $keyword,
        string $length = null,
        array $subKeywords = null,
        bool $title = false,
        float $image = 0.0,
        float $video = 0.0,
        array $autoLinks = [],
        bool $turingSpinner = false,
        int $quality = null,
        int $uniqueness = null,
        bool $useSectionHeading = false,
        array $sectionHeadings = [],
        int $rewriteNum = 0,
        array $excludedTopics = null,
        string $instructions = null,
        bool $useEvade = false) : InitiateArticleResponse
    {
        $endpoint = 'api/initiate_article';
        $initiateArticleRequest = new InitiateArticleRequest($keyword, $subKeywords, $length, $title, $image, $video, $autoLinks,
            $turingSpinner, $quality, $uniqueness, $useSectionHeading, $sectionHeadings, $rewriteNum, $excludedTopics,
            $instructions, $useEvade );
        $payload = $initiateArticleRequest->jsonSerialize();
        $response = $this->client->callApi($endpoint, $payload);

        return (new InitiateArticleResponse($response));
    }

    public function getApiProgress(int $refKey): GetApiProgressResponse
    {
        $endpoint = 'api/get_api_progress';
        $payload = [
            'ref_key' => $refKey
        ];
        $response = $this->client->callApi($endpoint, $payload);
        return (new GetApiProgressResponse($response));
    }

    public function getApiArticleResult(int $refKey): ApiArticleResultResponse
    {
        $endpoint = 'api/get_api_article_result';
        $payload = [
            'ref_key' => $refKey
        ];
        $response = $this->client->callApi($endpoint, $payload);

        return (new ApiArticleResultResponse($response));
    }

    public function deleteArticle(int $refKey): DeleteArticleResponse
    {
        $endpoint = 'api/delete_article';
        $payload = [
            'ref_key' => $refKey
        ];
        $response = $this->client->callApi($endpoint, $payload);

        return (new DeleteArticleResponse($response));
    }
}