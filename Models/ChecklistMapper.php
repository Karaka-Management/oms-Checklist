<?php
/**
 * Jingga
 *
 * PHP Version 8.1
 *
 * @package   Modules\Checklist\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\Checklist\Models;

use Modules\Tasks\Models\TaskMapper;
use phpOMS\DataStorage\Database\Mapper\DataMapperFactory;

/**
 * Checklist mapper class.
 *
 * @package Modules\Checklist\Models
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 *
 * @template T of BaseStringL11n
 * @extends DataMapperFactory<T>
 */
final class ChecklistMapper extends DataMapperFactory
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, writeonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    public const COLUMNS = [
        'checklist_id'        => ['name' => 'checklist_id',          'type' => 'int',    'internal' => 'id'],
        'checklist_name'      => ['name' => 'checklist_name',        'type' => 'string', 'internal' => 'name', 'autocomplete' => true],
        'checklist_template'  => ['name' => 'checklist_template',        'type' => 'int', 'internal' => 'template'],
        'checklist_createdat' => ['name' => 'checklist_createdat',        'type' => 'DateTimeImmutable', 'internal' => 'createdAt'],
    ];

    /**
     * Has many relation.
     *
     * @var array<string, array{mapper:class-string, table:string, self?:?string, external?:?string, column?:string}>
     * @since 1.0.0
     */
    public const HAS_MANY = [
        'tasks' => [
            'mapper'   => TaskMapper::class,
            'table'    => 'checklist_task',
            'self'     => 'checklist_task_template',
            'external' => 'checklist_task_task',
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    public const TABLE = 'checklist';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    public const PRIMARYFIELD = 'checklist_id';
}
