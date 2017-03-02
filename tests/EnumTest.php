<?php

namespace Enum;

use PHPUnit\Framework\TestCase;

class AbstractEnumTest extends TestCase
{
    /** @test */
    public function itCanBeInstantiatedWithAnOptionalSelection()
    {
        $enum = $this->enum();

        $this->assertInstanceOf(Enum::class, new $enum);

        $this->assertEquals('foo', (new $enum('foo'))->selectedValue());
    }

    /** @test */
    public function itCanSelectAValue()
    {
        $enum = $this->enum();

        $enum = $enum::select('foo');
        $this->assertEquals('foo', $enum->selectedValue());
    }

    /** @test */
    public function itThrowsAnExceptionIfInstantiatedWithAnInvalidSelection()
    {
        $this->expectException(SelectionException::class);
        $this->expectExceptionMessage(
            '"baz" is not a valid selection. Available values are: foo, bar.'
        );

        new class('baz') extends Enum
        {
            const FOO = 'foo';
            const BAR = 'bar';
        };
    }

    /** @test */
    public function itReturnsTheSelectedKey()
    {
        $enum = $this->enum();
        $foo = $enum::FOO();

        $this->assertSame('FOO', $foo->selectedKey());
    }

    /** @test */
    public function itReturnsTheSelectedValue()
    {
        $enum = $this->enum();
        $foo = $enum::NUM();

        $this->assertSame(123, $foo->selectedValue());
    }

    /** @test */
    public function itChecksIfTheSelectedValueMatchesAProvidedValue()
    {
        $enum = $this->enum();
        $foo  = $enum::NUM();

        $this->assertFalse($foo->isSelected($enum::FOO));
        $this->assertTrue($foo->isSelected($enum::NUM));
    }

    /** @test */
    public function itChecksIfAProvidedValueIsAValidSelection()
    {
        $enum = $this->enum();

        $this->assertFalse($enum::isValid('invalid'));
        $this->assertTrue($enum::isValid('foo'));
    }

    /** @test */
    public function itReturnsAnArrayOfAvailableKeys()
    {
        $enum = $this->enum();

        $this->assertSame(['FOO', 'BAR', 'NUM'], $enum::keys());
    }

    /** @test */
    public function itReturnsAnArrayOfAvailableValues()
    {
        $enum = $this->enum();

        $expected = [
            'FOO' => $enum::FOO(),
            'BAR' => $enum::BAR(),
            'NUM' => $enum::NUM()
        ];
        $this->assertEquals($expected, $enum::values());
    }

    /** @test */
    public function itChecksThatTwoEnumInstancesAreEqual()
    {
        $enum = $this->enum();
        $foo  = $enum::FOO();
        $foo2 = $enum::FOO();
        $bar  = $enum::BAR();

        $this->assertFalse($foo->equals($bar));
        $this->assertTrue($foo->equals($foo2));
        $this->assertNotSame($foo, $foo2);
    }

    /** @test */
    public function itReturnsTheSelectedValueWhenCastToAString()
    {
        $enum = $this->enum();

        $foo = $enum::select('foo');
        $this->assertSame('foo', (string) $foo);

        $number = $enum::NUM();
        $this->assertSame(123, $number->selectedValue());
        $this->assertSame('123', (string) $number);
    }

    /** @test */
    public function itCanBeCastToAnArray()
    {
        $enum = $this->enum();
        $expected = [
            'FOO' => 'foo',
            'BAR' => 'bar',
            'NUM' => 123
        ];
        $this->assertSame($expected, (new $enum)->toArray());
    }

    /** @test */
    public function itCanUseADefinedConstantAsAStaticCallToSelectTheValue()
    {
        $enum = $this->enum();

        $enum = $enum::FOO();
        $this->assertEquals('foo', (string) $enum);
    }

    /**
     * Enum stub.
     *
     * @return Enum
     */
    private function enum()
    {
        return new class extends Enum
        {
            const FOO = 'foo';
            const BAR = 'bar';
            const NUM = 123;
        };
    }
}
