<?php
/**
 * Jingga
 *
 * PHP Version 8.1
 *
 * @package   Modules
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

use Modules\Checklist\Controller\BackendController;
use Modules\Checklist\Models\PermissionCategory;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^.*/checklist/list(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Checklist\Controller\BackendController:viewChecklistList',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::CHECKLIST,
            ],
        ],
    ],
    '^.*/checklist/view(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Checklist\Controller\BackendController:viewChecklistView',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::CHECKLIST,
            ],
        ],
    ],
    '^.*/checklist/template/list(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Checklist\Controller\BackendController:viewChecklistTemplateList',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::TEMPLATE,
            ],
        ],
    ],
    '^.*/checklist/template/create(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Checklist\Controller\BackendController:viewChecklistTemplateCreate',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::CREATE,
                'state'  => PermissionCategory::TEMPLATE,
            ],
        ],
    ],
    '^.*/checklist/template/view(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Checklist\Controller\BackendController:viewChecklistTemplateView',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::TEMPLATE,
            ],
        ],
    ],
    '^.*/checklist/template/task(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Checklist\Controller\BackendController:viewChecklistTemplateTaskView',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::TEMPLATE,
            ],
        ],
    ],
];
