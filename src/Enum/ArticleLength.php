<?php
declare(strict_types=1);
namespace Ruslanstarikov\Articleforge\Enum;
use MyCLabs\Enum\Enum;

final class ArticleLength extends Enum
{
    public const VERY_SHORT = 'very_short';
    public const SHORT = 'short';
    public const MEDIUM = 'medium';
    public const LONG = 'long';
}