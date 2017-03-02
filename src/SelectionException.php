<?php

namespace Enum;

use InvalidArgumentException;

class SelectionException extends InvalidArgumentException
{
    public static function invalid($selection, array $available)
    {
        throw new static(
            sprintf(
                '"%s" is not a valid selection. Available values are: %s.',
                $selection,
                implode(', ', $available)
            )
        );
    }
}
