<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Controllers\TriviaController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Mockery;

class TriviaControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $controller;

    protected function setUp(): void
    {
        parent::setUp();
        $this->controller = new TriviaController();
    }

    public function testStart()
    {
        $response = $this->controller->start();

        $this->assertEquals('trivia.start', $response->getName());
    }

    public function testIndex()
    {
        // Mock API response
        $mockResponse = [
            'response_code' => 0,
            'results' => [
                [
                    'category' => 'General Knowledge',
                    'type' => 'multiple',
                    'difficulty' => 'easy',
                    'question' => 'What is the capital of France?',
                    'correct_answer' => 'Paris',
                    'incorrect_answers' => ['London', 'Berlin', 'Madrid']
                ]
            ]
        ];

        // Set up mock client
        $mock = new MockHandler([
            new Response(200, [], json_encode($mockResponse))
        ]);
        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);

        // Bind mock client to service container
        $this->app->instance(Client::class, $client);

        // Create request
        $request = Request::create('/trivia', 'GET', ['category' => '9', 'amount' => '1']);

        // Call controller method
        $response = $this->controller->index($request);

        // Assert response
        $this->assertEquals('trivia.index', $response->getName());
        $this->assertArrayHasKey('triviaQuestions', $response->getData());
        $this->assertCount(1, $response->getData()['triviaQuestions']);
    }

    public function testSubmit()
    {
        $questions = [
            [
                'question' => 'What is the capital of France?',
                'correct_answer' => 'Paris',
                'answer' => 'Paris'
            ],
            [
                'question' => 'What is the largest planet in our solar system?',
                'correct_answer' => 'Jupiter',
                'answer' => 'Saturn'
            ]
        ];

        $request = new Request(['questions' => $questions]);

        $response = $this->controller->submit($request);

        $this->assertEquals('trivia.results', $response->getName());
        $this->assertEquals(1, $response->getData()['score']);
        $this->assertEquals(2, $response->getData()['total']);
        $this->assertCount(2, $response->getData()['results']);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}