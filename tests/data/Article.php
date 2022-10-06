<?php

namespace Tests\data;

class Article
{
    public static function articleData()
    {
        return [
                [
                    'input' => 1,
                    'apiResponse' => [
                        'status' => "OK",
                        'data' => "Health Benefits of bacon are endless..."
                    ],
                    'output' => [
                        'status' => "OK",
                        'data' => "Health Benefits of bacon are endless..."
                    ]
                ],
                [
                    'input' => 2,
                    'apiResponse' => [
                        'status' => "OK",
                        'data' => "Health Benefits of glazed doughnuts are endless..."
                    ],
                    'output' => [
                        'status' => "OK",
                        'data' => "Health Benefits of glazed doughnuts are endless..."
                    ]
                ],
                [
                    'input' => 3,
                    'apiResponse' => [
                        'status' => "OK",
                        'data' => "Health Benefits of pork chops are endless..."
                    ],
                    'output' => [
                        'status' => "OK",
                        'data' => "Health Benefits of pork chops are endless..."
                    ]
                ]
        ];
    }
}