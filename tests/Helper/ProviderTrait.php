<?php

namespace Tests\Helper;

use App\Models\Provider;

trait ProviderTrait
{
    private Provider $googleProvider;
    private Provider $facebookProvider;
    private Provider $githubProvider;

    private function mockGoogleProvider(): void
    {
        $this->googleProvider = Provider::factory()->create(['name' => 'google']);
    }

    private function mockProviders(): void
    {
        $this->mockGoogleProvider();
    }
}
