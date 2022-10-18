# ArticleForge
PHP Implementation of [ArticleForge](https://articleforge.com) API.
## Installation
Install via composer

``` composer require ruslanstarikov/articleforge```
## Usage
```php
<?php
declare(strict_types=1);
use Ruslanstarikov\Articleforge;

$apiKey = 'FAKE-ARTICLE-FORGE-KEY';

// initiate ArticleForge class
$articleForge = new ArticleForge($apiKey);

// create a new article
$initArticleResponse = $articleForge->initiateArticle($keywords); 

// Get the reference key for the new article
$referenceKey = $initArticleResponse->getRefKey();
// Also
$referenceKey = $initArticleResponse->toArray()['refKey'];
```
## Official Documentation
Official API documentation can be accessed here: https://af.articleforge.com/api_info 
[Last accessed on 05/10/2022]

## Methods
### checkUsage
Arguments: none
Example: 
```php
$initArticleResponse = $articleForge->checkUsage(); 
```
Response: CheckUsageResponse object. toArray method returns the following output
```php
return [
            'status' => $this->getStatus(),
            'apiRequests' => $this->getApiRequests(),
            'monthlyWordsRemaining' => $this->getMonthlyWordsRemaining(),
            'overuseProtection' => $this->getOveruseProtection(),
            'prepaidAmount' => $this->getPrepaidAmount(),
            'prepaidWordsAvailable' => $this->getPrepaidWordsAvailable(),
            'overageUsageCharge' => $this->getOverageUsageCharge(),
            'error' => $this->getErrorMessage()
];
```


### viewArticles
Arguments:

limit - integer, optional
Example:
```php
$initArticleResponse = $articleForge->viewArticles(10); 
```
Response: ArticleListResponse object. toArray method returns the following output
```php
return [
        'data' => [
            [
                'id' => $this->getId(),
                'title' => $this->getTitle(),
                'createdAt' => $this->getCreatedAt()->format('c'),
                'keyword' => $this->getKeyword(),
                'subKeywords' => $this->getSubKeywords()
            ],
        ],
        'status' => $this->getStatus(),
        'error' => $this->getErrorMessage()
];
```

### viewArticle
Arguments: 

articleId - integer, required
spintaxView - boolean, false

Example:
```php
$initArticleResponse = $articleForge->viewArticle(123); 
```
Response: ArticleResponse Object. toArray method returns the following:
```php
return [
        $this->setData($response['data']);
        $this->setStatus($response['status']);
]
```

### initiateArticle
Arguments:
keyword - string, mandatory

length - string, articleLength, optional. Refer to ArticleLength enum

subKeywords - string, optional

title - boolean, optional

image - float from 0.0 to 1.0, optional

video - float from 0.0 to 1.0, optional

autoLinks - array, optional

turingSpinner - boolean, optional,

quality - integer, optional

uniqueness - integer, optional,

useSectionHeading - boolean, optional

sectionHeadings - array of strings, optional

rewriteNum - integer, optional

Example:
```php
$title = "Health benefits of bacon";
$length = ArticleLength::MEDIUM;

$initArticleResponse = $articleForge->initiateArticle($title, $length); 
```

Response: InitiateArticleResponse object. toArray method returns the following structure
```php
        return [
            'refKey' => $this->getRefKey(),
            'status' => $this->getStatus(),
            'error' => $this->getErrorMessage()
        ];
```

### getApiProgress
Arguments:

RefKey: integer, mandatory

```php
$articleId = 213;

$initArticleResponse = $articleForge->getApiProgress($articleId); 
```

Response: GetApiProgressResponse object. toArray method returns the following structure
```php
        return [
            'apiStatus' => $this->getApiStatus(),
            'progress' => $this->getProgress(),
            'status' => $this->getStatus(),
            'error' => $this->getErrorMessage()
        ];
```

### getApiArticleResult
Arguments:

RefKey: integer, mandatory

```php
$articleId = 213;

$initArticleResponse = $articleForge->getApiArticleResult($articleId); 
```

Response: ApiArticleResultResponse object. toArray method returns the following structure
```php
 return [
            'article' => $this->getArticle(),
            'articleId'=> $this->getArticleId(),
            'status' => $this->getStatus(),
            'error' => $this->getErrorMessage()
];
```
### deleteArticle
Arguments:

RefKey: integer, mandatory

```php
$articleId = 213;

$initArticleResponse = $articleForge->deleteArticle($articleId); 
```

Response: DeleteArticleResponse object. toArray method returns the following structure
```php
        return [
            'status' => $this->getStatus(),
            'errorMessage' => $this->getErrorMessage()
        ];
```
