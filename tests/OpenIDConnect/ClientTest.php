<?php

namespace Tests\OpenIDConnect;

use OpenIDConnect\Client;
use Tests\TestCase;

class ClientTest extends TestCase
{
    /**
     * @var Client
     */
    private $target;

    protected function setUp(): void
    {
        $this->target = new Client(
            $this->createProviderMetadata(),
            $this->createClientMetadata()
        );
    }

    protected function tearDown(): void
    {
        $this->target = null;
    }

    /**
     * @test
     */
    public function shouldReturnAuthorizationUrlWhenCallSame(): void
    {
        $actual = $this->target->getAuthorizationUri();

        $this->assertStringStartsWith('https://somewhere/auth', (string)$actual);
        $this->assertStringContainsStringIgnoringCase('state=', (string)$actual);
        $this->assertStringContainsStringIgnoringCase('response_type=code', (string)$actual);
        $this->assertStringContainsStringIgnoringCase('redirect_uri=', (string)$actual);
        $this->assertStringContainsStringIgnoringCase('client_id=some_id', (string)$actual);
    }

    /**
     * @test
     */
    public function shouldReturnAuthorizationPostFormWhenCallSame(): void
    {
        $actual = $this->target->getAuthorizationPost();

        $this->assertStringContainsStringIgnoringCase('<form method="post" action="https://somewhere/auth">', $actual);
        $this->assertStringContainsStringIgnoringCase('name="state"', $actual);
        $this->assertStringContainsStringIgnoringCase('name="response_type" value="code"', $actual);
        $this->assertStringContainsStringIgnoringCase('name="redirect_uri" value="https://someredirect"', $actual);
        $this->assertStringContainsStringIgnoringCase('name="client_id" value="some_id"', $actual);
    }
}
