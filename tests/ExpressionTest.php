<?php

use PHPUnit\Framework\TestCase;

class ExpressionTest extends TestCase{

/**  @test **/
public function it_can_find()
{
    $regex = Expression::make()->find("www");

    $this->assertRegExp($regex, "www");

        $regex = Expression::make()->then("www");

        $this->assertRegExp($regex, "www");

}
/**  @test **/
public function it_can_match_anything()
{
        $regex = Expression::make()->anything("www");

        $this->assertRegExp($regex, "www");

        $regex = Expression::make()->anything("");

        $this->assertRegExp($regex, "www");
}

/**  @test **/
public function it_allows_maybe()
{
        $regex = Expression::make()->maybe("w");

        $this->assertRegExp($regex, "w");
}

/**  @test **/
public function it_allows_chaining()
{
        $regex = Expression::make()->find("www")->maybe(".")->then("example");

        $this->assertTrue($regex->test("www.example"));

        $regex = Expression::make()->find("www")->maybe(".")->then("example");

        $this->assertFalse($regex->test("wwwXexample"));
}

/**  @test **/
public function it_can_exclude_values()
{
    $regex = Expression::make()
    ->find("foo")
    ->anythingBut("bar")
    ->then('biz');

    $this->assertTrue($regex->test("foobiz"));

    $this->assertFalse($regex->test("foobi"));

    $this->assertTrue($regex->test("foo123biz"));

    $this->assertFalse($regex->test("foobarbiz"));
}
}
