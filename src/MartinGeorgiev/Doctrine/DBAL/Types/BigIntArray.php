<?php

declare(strict_types=1);

namespace MartinGeorgiev\Doctrine\DBAL\Types;

/**
 * Implementation of PostgreSQL BIGINT[] data type.
 *
 * @see https://www.postgresql.org/docs/9.4/static/arrays.html
 * @since 0.1
 *
 * @author Martin Georgiev <martin.georgiev@gmail.com>
 */
class BigIntArray extends BaseIntegerArray
{
    /**
     * @var string
     */
    protected const TYPE_NAME = 'bigint[]';

    protected function getMinValue(): int
    {
        return PHP_INT_MIN;
    }

    protected function getMaxValue(): int
    {
        return PHP_INT_MAX;
    }
}
