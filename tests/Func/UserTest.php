<?php

declare(strict_types=1);

namespace App\Tests\Func;

use Symfony\Component\HttpFoundation\Request;
use App\Tests\Func\AbstractEndPoint;
use Faker\Factory;
use Symfony\Component\HttpFoundation\Response;

class UserTest extends AbstractEndPoint
{
    private $userPayload = '{"email": "%s","password": "password"}';
    public function testGetUsers(): void
    {

        $response = $this->getResponseFromRequest(Request::METHOD_GET, '/api/users');
        // dd($response->isServerError());

        $responseContent = $response->getContent();
        $responseDecode = json_decode($responseContent, true);
        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
        self::assertJson($responseContent);
        self::assertNotEmpty($responseDecode);
        
    }

    public function testPostUser(): void
    {
        //dd($this->getPayload());
        $response = $this->getResponseFromRequest(
            Request::METHOD_POST,
             '/api/users',
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

        return sprintf($this->userPayload,$faker->email());
    }
}
