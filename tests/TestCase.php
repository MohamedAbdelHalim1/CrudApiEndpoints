<?php
namespace Tests;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use DatabaseMigrations;
abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
}