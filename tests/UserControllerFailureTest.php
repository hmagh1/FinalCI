<?php

use PHPUnit\Framework\TestCase;
use App\UserController;

class UserControllerFailureTest extends TestCase {
    public function testIntentionalFailure() {
        $this->assertEquals(1, 2, "This test is supposed to fail");
    }
}
