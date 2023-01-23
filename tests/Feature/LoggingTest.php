<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

use function PHPUnit\Framework\assertTrue;

class LoggingTest extends TestCase
{
    public function testLogging()
    {
        Log::info("Hello Info");
        Log::warning("Hello Warning");
        Log::error("Hello Error");
        Log::critical("Hello Critical");

        assertTrue(true);
    }

    public function testContext()
    {
        Log::info("Hello Info", ["user" => "Evan"]);
        Log::info("Hello Info", ["user" => "Evan"]);
        Log::info("Hello Info", ["user" => "Evan"]);

        assertTrue(true);
    }

    // With context digunakan agar jika terdapat user yang sama tidak akan double
    public function testWithContext()
    {
        Log::withContext(["user" => "Evan"]);

        Log::info("Hello Info");
        Log::info("Hello Info");
        Log::info("Hello Info");

        assertTrue(true);
    }

    public function testChannel()
    {
        $slackLogger = Log::channel("slack");
        $slackLogger->error("Hello Slack"); // krim ke channel slack

        // jika tidak menggunakan channel maka akan mengirimkan ke channel default logging
        Log::info("Hello Laravel"); // kirim ke default channel

        assertTrue(true);
    }

    public function testFileHandler()
    {
        $fileLogger = Log::channel('file');

        $fileLogger->info("Hello File Logger");
        $fileLogger->warning("Hello File Logger");
        $fileLogger->error("Hello File Logger");
        $fileLogger->critical("Hello File Logger");

        assertTrue(true);
    }
}
