<?php

declare(strict_types=1);

namespace App\Tests\Func;

use Symfony\Component\HttpFoundation\Request;
use App\Tests\Func\AbstractEndPoint;
use Faker\Factory;
use Symfony\Component\HttpFoundation\Response;

class ArticleTest extends AbstractEndPoint
{
    private $userPayload = '{"name": "%s","content": "%s", "author": "/api/users/10"}';
    public function testGetArticles(): void
    {

        $response = $this->getResponseFromRequest(Request::METHOD_GET, '/api/articles');
        //dd($response->isServerError());

        $responseContent = $response->getContent();
        $responseDecode = json_decode($responseContent, true);
        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
        self::assertJson($responseContent);
        self::assertNotEmpty($responseDecode);
        
    }

    public function testPostArticle(): void
    {

        $response = $this->getResponseFromRequest(
            Request::METHOD_POST,
             '/api/articles',
            $this->getPayload()
            );

        $responseContent = $response->getContent();
        $responseDecode = json_decode($responseContent, true);

        self::assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
        self::assertJson($responseContent);
        self::assertNotEmpty($responseDecode);
        
    }

    private function getPayload(): string
    {
        $faker = Factory::create();

        return sprintf($this->userPayload,$faker->firstName(),$faker->text(30));
    }

 
}
