<?php

namespace App\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiControllerTest extends WebTestCase
{
    /**
     * @test
     */
    public function noPermiteElUsoAUsuariosAnonimos()
    {
        $client = static::createClient();

        $client->request('GET', '/api/peliculas');

        $this->assertTrue($client->getResponse()->isRedirect('/login'));
    }

}
