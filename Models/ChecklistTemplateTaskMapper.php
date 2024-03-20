<?php
/**
 * Jingga
 *
 * PHP Version 8.2
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
 * ChecklistTemplateTask mapper class.
 *
 * @package Modules\Checklist\Models
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 *
 * @template T of ChecklistTemplateTask
 * @extends DataMapperFactory<T>
 */
final class ChecklistTemplateTaskMapper extends DataMapperFactory
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, writeonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    public const COLUMNS = [
        'checklist_template_task_id'       => ['name' => 'checklist_template_task_id',          'type' => 'int',    'internal' => 'id'],
        'checklist_template_task_order'    => ['name' => 'checklist_template_task_order',        'type' => 'int', 'internal' => 'order'],
        'checklist_template_task_template' => ['name' => 'checklist_template_task_template',        'type' => 'int', 'internal' => 'template'],
        'checklist_template_task_task'     => ['name' => 'checklist_template_task_task',        'type' => 'int', 'internal' => 'task'],
    ];

    /**
     * Has one relation.
     *
     * @var array<string, array{mapper:class-string, external:string, by?:string, column?:string, conditional?:bool}>
     * @since 1.0.0
     */
    public const OWNS_ONE = [
        'task' => [
            'mapper'   => TaskMapper::class,
            'external' => 'checklist_template_task_task',
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    public const TABLE = 'checklist_template_task';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    public const PRIMARYFIELD = 'checklist_template_task_id';
}
