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
 * ChecklistTemplate mapper class.
 *
 * @package Modules\Checklist\Models
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 *
 * @template T of BaseStringL11n
 * @extends DataMapperFactory<T>
 */
final class ChecklistTemplateMapper extends DataMapperFactory
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, writeonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    public const COLUMNS = [
        'checklist_checklist_template_id'          => ['name' => 'checklist_checklist_template_id',          'type' => 'int',    'internal' => 'id'],
        'checklist_checklist_template_name'        => ['name' => 'checklist_checklist_template_name',        'type' => 'string', 'internal' => 'name', 'autocomplete' => true],
        'checklist_checklist_template_description' => ['name' => 'checklist_checklist_template_description',        'type' => 'string', 'internal' => 'description'],
        'checklist_checklist_template_repeat'      => ['name' => 'checklist_checklist_template_repeat',        'type' => 'int', 'internal' => 'repeat'],
        'checklist_checklist_template_interval'    => ['name' => 'checklist_checklist_template_interval',        'type' => 'string', 'internal' => 'interval'],
        'checklist_checklist_template_start'       => ['name' => 'checklist_checklist_template_start',        'type' => 'DateTime', 'internal' => 'start'],
        'checklist_checklist_template_end'         => ['name' => 'checklist_checklist_template_end',        'type' => 'DateTime', 'internal' => 'end'],
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
            'table'    => 'checklist_checklist_template_task',
            'external' => 'checklist_checklist_template_task_task',
            'self'     => 'checklist_checklist_template_task_template',
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    public const TABLE = 'checklist_checklist_template';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    public const PRIMARYFIELD = 'checklist_checklist_template_id';
}
