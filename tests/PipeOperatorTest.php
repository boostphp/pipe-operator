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
        $result = PipeOperator::from('github.com')
            ->str_rot13()
            ->get();

        $this->assertSame('tvguho.pbz', $result);
    }

    /**
     * @test
     */
    public function it_can_transform_a_value_using_the_identifier()
    {
        $result = PipeOperator::from('github.com')
            ->str_rot13(PIPED_VALUE)
            ->get();

        $this->assertSame('tvguho.pbz', $result);
    }
}
