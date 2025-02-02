<?php declare(strict_types = 1);
/**
 * This file is part of the SqlFtw library (https://github.com/sqlftw)
 *
 * Copyright (c) 2017 Vlasta Neubauer (@paranoiq)
 *
 * For the full copyright and license information read the file 'license.md', distributed with this source code
 */

namespace SqlFtw\Parser;

/**
 * Represents atomic part of SQL syntax
 */
final class Token
{

    public int $type;

    public int $position;

    public int $row;

    public string $value;

    public ?string $original;

    public ?LexerException $exception;

    public function __construct(
        int $type,
        int $position,
        int $row,
        string $value,
        ?string $original = null,
        ?LexerException $exception = null
    ) {
        $this->type = $type;
        $this->position = $position;
        $this->row = $row;
        $this->value = $value;
        $this->original = $original;
        $this->exception = $exception;
    }

}
