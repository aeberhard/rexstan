<?php

namespace RexSqlGetValue;

use rex_sql;
use rex;

use function PHPStan\Testing\assertType;

function preparedQuery(int $id):void
{
    $sql = rex_sql::factory();
    $sql->setQuery('
            SELECT  name
            FROM    ' . rex::getTable('cronjob') . '
            WHERE   id = ?
            LIMIT   1
        ', [$id]);

    assertType('string', $sql->getValue('name'));
}

function regularQuery():void
{
    $sql = rex_sql::factory();
    $sql->setQuery('
            SELECT  name
            FROM    ' . rex::getTable('cronjob') . '
            WHERE   id = 1
            LIMIT   1
        ');

    assertType('string', $sql->getValue('name'));
}

