<?php

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Bind Pest to Laravel's TestCase for all tests,
 * and opt-in some helpful traits/globals.
 */
uses(TestCase::class)->in('Feature', 'Unit');

/**
 * Choose ONE of the database strategies below:
 *
 * 1) Full schema refresh between tests (safer, slower):
 */
uses(RefreshDatabase::class)->in('Feature');
// If you prefer transactions for speed (and you're not using multiple DBs/queues), you can use:
// use Illuminate\Foundation\Testing\DatabaseTransactions;
// uses(DatabaseTransactions::class)->in('Feature');

/**
 * Custom expectations (optional)
 */
expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});

/**
 * Global helper functions for tests (optional)
 */
function something(): void
{
    // ..
}
