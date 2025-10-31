<?php

namespace Tourze\PHPUnitAttribute;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\RunTestsInSeparateProcesses;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * 专门 for PHP8 注释进行测试的测试用例
 */
abstract class AbstractAttributeTestCase extends TestCase
{
    /**
     * 这个场景，没必要使用 RunTestsInSeparateProcesses 注解的
     */
    #[Test]
    final public function testShouldNotHaveRunTestsInSeparateProcesses(): void
    {
        $reflection = new \ReflectionClass($this);
        $this->assertEmpty($reflection->getAttributes(RunTestsInSeparateProcesses::class), get_class($this) . '这个测试用例，不应使用 RunTestsInSeparateProcesses 注解');
    }

    #[Test]
    final public function testDisallowUseMultipleCoversClass(): void
    {
        $this->assertCount(
            1,
            (new \ReflectionClass($this))->getAttributes(CoversClass::class),
            '单个测试用例必须只测试一个类，所以请删除 ' . get_class($this) . '中 重复的 CoversClass'
        );
    }
}
