<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * Build an absolute URL on the public site domain (APP_DOMAIN).
     */
    protected function publicUrl(string $path = ''): string
    {
        return 'http://'.env('APP_DOMAIN', 'my-profile.test').$path;
    }

    /**
     * Build an absolute URL on the admin panel domain (ADMIN_DOMAIN).
     */
    protected function adminUrl(string $path = ''): string
    {
        return 'http://'.env('ADMIN_DOMAIN', 'admin.my-profile.test').$path;
    }
}
