<?php

namespace Enum;

use ReflectionClass;

/**
 * Class Enum
 * @package Enum
 */
abstract class Enum
{
    /**
     * An array of cached constants.
     *
     * @var array
     */
    private static $constants = [];
    /**
     * The selected value.
     *
     * @var mixed
     */
    protected $selected;


    /**
     * Enum constructor.
     * @param $value
     */
    public function __construct($value = null)
    {
        if ($value) {
            $this->validateSelection($value);
            $this->selected = $value;
        }
    }

    /**
     * Select a value
     *
     * @param mixed $selection
     *
     * @return Enum
     */
    public static function select($selection) : Enum
    {
        $instance = new static;
        $instance->validateSelection($selection);
        $instance->selected = $selection;

        return $instance;
    }

    /**
     * Get the selected option name (the constant).
     *
     * @return string
     */
    public function selectedKey() : string
    {
        $constants = static::constants();
        return array_flip($constants)[$this->selected];
    }

    /**
     * Return the selected value.
     *
     * @return mixed
     */
    public function selectedValue()
    {
        return $this->selected;
    }

    /**
     * Is the current selected value equal to the provided value?
     *
     * @param $compare
     * @return bool
     */
    public function isSelected($compare) : bool
    {
        return $this->selected === $compare;
    }

    /**
     * Is the provided value a valid selection?
     *
     * @param $value
     * @return bool
     */
    public static function isValid($value) : bool
    {
        return in_array($value, static::constants());
    }

    /**
     * Get a list of available selections.
     *
     * @return array
     */
    public static function keys() : array
    {
        $constants = self::constants();

        return array_keys($constants);
    }

    /**
     * Get a list of the available values.
     *
     * @return static[]
     */
    public static function values() : array
    {
        $constants = self::constants();

        return array_map(function ($value) {
            return new static($value);
        }, $constants);
    }

    /**
     * Basic equality check.
     *
     * @param Enum $enum
     *
     * @return bool
     */
    public function equals(Enum $enum) : bool
    {
        return $this->selectedValue() === $enum->selectedValue();
    }

    /**
     * Get the value as an array.
     *
     * @return array
     */
    public function toArray() : array
    {
        return self::constants();
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return (string) $this->selectedValue();
    }

    /**
     * Select a value by calling its constant name as a method.
     * @example Enum::FOO()
     *
     * @param string $method
     * @param null   $_
     * @return Enum
     */
    public static function __callStatic($method, $_) : Enum
    {
        $instance = new static;
        return $instance->select($instance->constants()[strtoupper($method)]);
    }

    /**
     * Ensure selection is a valid option.
     *
     * @param string $value
     */
    protected function validateSelection($value)
    {
        $constants = self::constants();
        if (! static::isValid($value)) {
            SelectionException::invalid($value, $constants);
        }
    }

    /**
     * Get a cached list of class constants
     *
     * @return array
     */
    private static function constants() : array
    {

        if (! array_key_exists(static::class, self::$constants)) {
            $reflection = new ReflectionClass(static::class);

            self::$constants[static::class] = $reflection->getConstants();
        }

        return self::$constants[static::class];
    }
}