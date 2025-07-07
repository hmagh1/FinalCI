<?php

use PHPUnit\Framework\TestCase;
use App\UserController;

class UserControllerUnitTest extends TestCase {
    public function testCanBeInstantiated() {
        $controller = $this->getMockBuilder(UserController::class)
                           ->disableOriginalConstructor()
                           ->getMock();
        $this->assertInstanceOf(UserController::class, $controller);
    }
}
