<?php

namespace Boost\PipeOperator\Tests;

use Boost\PipeOperator\PipeOperator;
use PHPUnit\Framework\TestCase;

class PipeOperatorTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_transform_a_value()
    {
        $result = (new PipeOperator('github.com'))
            ->str_rot13()
            ->get();

        $this->assertSame('tvguho.pbz', $result);
    }

    /**
     * @test
     */
    public function it_can_transform_a_value_using_the_identifier()
    {
        $result = (new PipeOperator('github.com'))
            ->str_rot13(PIPED_VALUE)
            ->get();

        $this->assertSame('tvguho.pbz', $result);
    }

    /**
     * @test
     */
    public function it_can_operate_on_values_passed_with_the_from_static_constructor()
    {
        $result = PipeOperator::from('https://blog.github.com')
            ->parse_url()
            ->end()
            ->explode('.', PIPED_VALUE)
            ->reset()
            ->get();

        $this->assertSame('blog', $result);
    }
}
