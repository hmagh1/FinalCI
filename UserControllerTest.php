<?php

use PHPUnit\Framework\TestCase;
use App\UserController;

class UserControllerTest extends TestCase
{
    public function testCanBeInstantiated()
    {
        $this->assertInstanceOf(UserController::class, new UserController());
    }
}
