<?php

namespace Tests\Feature;

use App\Services\UserConverterService;
use App\Services\UserService;
use App\Services\XmlConverterService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RandomUserControllerTest extends TestCase
{
    use WithFaker;

    public function test_fetch_users_returns_xml()
    {
        // Mock the services
        $mockedUserService = \Mockery::mock(UserService::class);
        $mockedUserConverterService = \Mockery::mock(UserConverterService::class);
        $mockedXmlConverterService = \Mockery::mock(XmlConverterService::class);

        $mockedUserService->shouldReceive('getProcessedUsers')->andReturn([]);
        $mockedUserConverterService->shouldReceive('convertMultipleToArray')->andReturn([]);
        // Using the provided XML data as our expected response
        $mockedXmlString = <<<XML
<root>
<user>
<fullName>Úrsula Peralta</fullName>
<phone>(613) 215 2311</phone>
<email>ursula.peralta@example.com</email>
<country>Mexico</country>
</user>
<user>
<fullName>William Perez</fullName>
<phone>015394 88100</phone>
<email>william.perez@example.com</email>
<country>United Kingdom</country>
</user>
</root>
XML;
        $mockedXmlConverterService->shouldReceive('convertToXml')->andReturn($mockedXmlString);

        // Bind the mock services to the app container
        $this->app->instance(UserService::class, $mockedUserService);
        $this->app->instance(UserConverterService::class, $mockedUserConverterService);
        $this->app->instance(XmlConverterService::class, $mockedXmlConverterService);

        $response = $this->get('/api/random-users?count=2');
        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'text/xml; charset=UTF-8');
        $this->assertEquals(trim($mockedXmlString), trim($response->getContent())); // Checking the content matches exactly
    }
}
