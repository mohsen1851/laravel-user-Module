<?php

namespace Mohsen\User\Tests\Unit;

use Mohsen\User\Rules\ValidMobile;
use PHPUnit\Framework\TestCase;

class mobileValidationTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_that_mobile_have_to_be_more_then_9_character()
    {
        $result=(new ValidMobile())->passes('','911111111');
        $this->assertEquals(0,$result);
    }
    public function test_that_mobile_have_to_be_less_then_11_character()
    {
        $result=(new ValidMobile())->passes('','91111111111');
        $this->assertEquals(0,$result);
    }
    public function test_that_mobile_have_to_be_start_with_9()
    {
        $result=(new ValidMobile())->passes('','6125332986');
        $this->assertEquals(0,$result);
    }
    public function test_that_mobile_have_to_be_number()
    {
        $result=(new ValidMobile())->passes('','9fgjf32986');
        $this->assertEquals(0,$result);
    }
}
