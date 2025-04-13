<?php

declare(strict_types=1);

namespace MartinGeorgiev\Doctrine\ORM\Query\AST\Functions;

use Doctrine\ORM\Query\AST\Node;
use MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\Exception\InvalidArgumentForVariadicFunctionException;
use MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\Traits\BooleanValidationTrait;

/**
 * Implementation of PostgreSQL ARRAY_TO_JSON().
 *
 * Returns the array as a JSON array. A PostgreSQL multidimensional array becomes a JSON array of arrays.
 * Line feeds will be added between dimension-1 elements if pretty_bool is true.
 *
 * @see https://www.postgresql.org/docs/16/functions-json.html
 * @since 0.10
 *
 * @author Martin Georgiev <martin.georgiev@gmail.com>
 *
 * @example Using it in DQL: "SELECT ARRAY_TO_JSON(e.array1) FROM Entity e"
 * @example Using it in DQL with pretty_bool: "SELECT ARRAY_TO_JSON(e.array1, 'true') FROM Entity e"
 */
class ArrayToJson extends BaseVariadicFunction
{
    use BooleanValidationTrait;

    protected function customizeFunction(): void
    {
        $this->setFunctionPrototype('array_to_json(%s)');
    }

    protected function validateArguments(Node ...$arguments): void
    {
        $argumentCount = \count($arguments);
        if ($argumentCount < 1 || $argumentCount > 2) {
            throw InvalidArgumentForVariadicFunctionException::between('array_to_json', 1, 2);
        }

        // Validate that the second parameter is a valid boolean if provided
        if ($argumentCount === 2) {
            $this->validateBoolean($arguments[1], 'ARRAY_TO_JSON');
        }
    }
}
