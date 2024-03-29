<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   Modules\Checklist
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\Checklist\Controller;

use Modules\Checklist\Models\ChecklistMapper;
use Modules\Checklist\Models\ChecklistTemplateMapper;
use phpOMS\Contract\RenderableInterface;
use phpOMS\DataStorage\Database\Query\OrderType;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Views\View;

/**
 * Calendar controller class.
 *
 * @package Modules\Checklist
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 * @codeCoverageIgnore
 */
final class BackendController extends Controller
{
    /**
     * Routing end-point for application behavior.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewChecklistList(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/Checklist/Theme/Backend/checklist-list');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1003601001, $request, $response);

        $view->data['checklists'] = ChecklistMapper::getAll()
            ->sort('id', OrderType::DESC)
            ->execute();

        return $view;
    }

    /**
     * Routing end-point for application behavior.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewChecklistView(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/Checklist/Theme/Backend/checklist-view');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1003601001, $request, $response);

        $view->data['template'] = ChecklistMapper::get()
            ->with('tasks')
            ->with('tasks/taskElements')
            ->with('tasks/taskElements/accRelation')
            ->with('tasks/taskElements/accRelation/relation')
            ->with('tasks/taskElements/grpRelation')
            ->with('tasks/taskElements/grpRelation/relation')
            ->where('id', (int) $request->getData('id'))
            ->sort('tasks/due', OrderType::ASC)
            ->execute();

        return $view;
    }

    /**
     * Routing end-point for application behavior.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewChecklistTemplateList(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/Checklist/Theme/Backend/checklist-template-list');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1003601001, $request, $response);

        $view->data['templates'] = ChecklistTemplateMapper::getAll()
            ->sort('id', OrderType::DESC)
            ->execute();

        return $view;
    }

    /**
     * Routing end-point for application behavior.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewChecklistTemplateCreate(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/Checklist/Theme/Backend/checklist-template');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1003601001, $request, $response);

        return $view;
    }

    /**
     * Routing end-point for application behavior.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewChecklistTemplateView(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/Checklist/Theme/Backend/checklist-template');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1003601001, $request, $response);

        $view->data['template'] = ChecklistTemplateMapper::get()
            ->with('tasks')
            ->with('tasks/taskElements')
            ->with('tasks/taskElements/accRelation')
            ->with('tasks/taskElements/accRelation/relation')
            ->with('tasks/taskElements/grpRelation')
            ->with('tasks/taskElements/grpRelation/relation')
            ->where('id', (int) $request->getData('id'))
            ->sort('tasks/due', OrderType::ASC)
            ->execute();

        return $view;
    }

    /**
     * Routing end-point for application behavior.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewChecklistTemplateTaskView(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        return $this->app->moduleManager->get('Tasks', 'Backend')->viewTaskView($request, $response, $data);
    }
}
