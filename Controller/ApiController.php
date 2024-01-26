<?php
/**
 * Jingga
 *
 * PHP Version 8.1
 *
 * @package   Modules\Checklist
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\Checklist\Controller;

use Modules\Checklist\Models\Checklist;
use Modules\Checklist\Models\ChecklistMapper;
use Modules\Checklist\Models\ChecklistTemplate;
use Modules\Checklist\Models\ChecklistTemplateMapper;
use Modules\Checklist\Models\ChecklistTemplateTask;
use Modules\Checklist\Models\ChecklistTemplateTaskMapper;
use Modules\Tasks\Models\TaskType;
use phpOMS\Message\Http\RequestStatusCode;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;

/**
 * Checklist api controller class.
 *
 * @package Modules\Checklist
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 */
final class ApiController extends Controller
{
    /**
     * Api method to create an checklist
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiChecklistTemplateCreate(RequestAbstract $request, ResponseAbstract $response, array $data = []) : void
    {
        if (!empty($val = $this->validateChecklistTemplateCreate($request))) {
            $response->header->status = RequestStatusCode::R_400;
            $this->createInvalidCreateResponse($request, $response, $val);

            return;
        }

        $checklist = $this->createChecklistTemplateFromRequest($request);
        $this->createModel($request->header->account, $checklist, ChecklistTemplateMapper::class, 'checklist_template', $request->getOrigin());
        $this->createStandardCreateResponse($request, $response, $checklist);
    }

    /**
     * Validate checklist create request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool>
     *
     * @since 1.0.0
     */
    private function validateChecklistTemplateCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['name'] = !$request->hasData('name'))
        ) {
            return $val;
        }

        return [];
    }

    /**
     * Method to create checklist from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return ChecklistTemplate
     *
     * @since 1.0.0
     */
    private function createChecklistTemplateFromRequest(RequestAbstract $request) : ChecklistTemplate
    {
        $checklist              = new ChecklistTemplate();
        $checklist->name        = (string) $request->getData('name');
        $checklist->description = $request->getDataString('description') ?? '';
        $checklist->repeat      = 0;
        $checklist->interval    = $request->getDataString('interval') ?? '';
        $checklist->start       = $request->getDataDateTime('start') ?? new \DateTime('now');
        $checklist->end         = $request->getDataDateTime('end');

        return $checklist;
    }

    /**
     * Api method to create an checklist
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiChecklistTemplateTaskCreate(RequestAbstract $request, ResponseAbstract $response, array $data = []) : void
    {
        if (!empty($val = $this->validateChecklistTemplateTaskCreate($request))) {
            $response->header->status = RequestStatusCode::R_400;
            $this->createInvalidCreateResponse($request, $response, $val);

            return;
        }

        $checklist = $this->createChecklistTemplateTaskFromRequest($request);
        $this->createModel($request->header->account, $checklist, ChecklistTemplateTaskMapper::class, 'checklist_template_task', $request->getOrigin());
        $this->createStandardCreateResponse($request, $response, $checklist);
    }

    /**
     * Validate checklist create request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool>
     *
     * @since 1.0.0
     */
    private function validateChecklistTemplateTaskCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['template'] = !$request->hasData('template'))
        ) {
            return $val;
        }

        return [];
    }

    /**
     * Method to create checklist from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return ChecklistTemplateTask
     *
     * @since 1.0.0
     */
    private function createChecklistTemplateTaskFromRequest(RequestAbstract $request) : ChecklistTemplateTask
    {
        $request->setData('type', TaskType::TEMPLATE, true);

        $checklistTask           = new ChecklistTemplateTask();
        $checklistTask->template = (int) $request->getData('template');
        $checklistTask->task     = $this->app->moduleManager->get('Tasks', 'Api')->createTaskFromRequest($request);

        return $checklistTask;
    }

    /**
     * Api method to create an checklist
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiChecklistCreateFromTemplate(RequestAbstract $request, ResponseAbstract $response, array $data = []) : void
    {
        if (!empty($val = $this->validateChecklistCreate($request))) {
            $response->header->status = RequestStatusCode::R_400;
            $this->createInvalidCreateResponse($request, $response, $val);

            return;
        }

        $checklist = $this->createChecklistFromRequest($request);
        $this->createModel($request->header->account, $checklist, ChecklistMapper::class, 'checklist', $request->getOrigin());
        $this->createStandardCreateResponse($request, $response, $checklist);
    }

    /**
     * Validate checklist create request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool>
     *
     * @since 1.0.0
     */
    private function validateChecklistCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['id'] = !$request->hasData('id'))
        ) {
            return $val;
        }

        return [];
    }

    /**
     * Method to create checklist from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return Checklist
     *
     * @since 1.0.0
     */
    private function createChecklistFromRequest(RequestAbstract $request) : Checklist
    {
        /** @var ChecklistTemplate $template */
        $template = ChecklistTemplateMapper::get()
            ->with('tasks')
            ->where('id', (int) $request->getData('id'))
            ->execute();

        $checklist           = new Checklist();
        $checklist->template = $template->id;
        $checklist->name     = $template->name;

        foreach ($template->tasks as $task) {
            $task->id   = 0;
            $task->type = TaskType::SINGLE;

            $checklist->tasks[] = $task;
        }

        return $checklist;
    }
}
