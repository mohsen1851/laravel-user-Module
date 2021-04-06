<?php


namespace Mohsen\User\Tests\Unit;


use Mohsen\User\Services\VerifyCodeService;
use Tests\TestCase;

class VerifyCodeTest extends TestCase
{
    public function test_generated_code_has_6_character()
    {
        $code=VerifyCodeService::generate();
        $this->assertIsNumeric($code);
        $this->assertLessThanOrEqual(999999,$code,'Generated code is more than 999999');
        $this->assertGreaterThanOrEqual(100000,$code,'Generated code is less than 100000');
}


    public function test_verify_code_can_store()
    {
        $code=VerifyCodeService::generate();
        VerifyCodeService::store(1,$code,now()->addDay());
        $this->assertEquals($code,cache()->get('verify_code_1'));
}
}
