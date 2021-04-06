<?php

namespace Mohsen\User\Tests\Unit;

use Mohsen\User\Rules\ValidPassword;
use PHPUnit\Framework\TestCase;

class passwordValidationTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_that_password_have_to_be_more_than_5_character()
    {
        $result=(new ValidPassword())->passes('','!aA15');
        $this->assertEquals(0,$result);
    }
    public function test_that_password_should_have_digit_character()
    {
        $result=(new ValidPassword())->passes('','!aAaaaaa');
        $this->assertEquals(0,$result);
    }
    public function test_that_password_should_have_big_character()
    {
        $result=(new ValidPassword())->passes('','!aaaaa1a');
        $this->assertEquals(0,$result);
    }
    public function test_that_password_should_have_small_character()
    {
        $result=(new ValidPassword())->passes('','!AAAAA1A');
        $this->assertEquals(0,$result);
    }
    public function test_that_password_should_have_sign_character()
    {
        $result=(new ValidPassword())->passes('','aAaAAA1A');
        $this->assertEquals(0,$result);
    }
}
