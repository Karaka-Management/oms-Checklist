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

use Modules\Tasks\Models\TaskPriority;
use phpOMS\Stdlib\Base\SmartDateTime;

/**
 * @var \phpOMS\Views\View $this
 */

echo $this->data['nav']->render(); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="portlet">
            <div class="portlet-head"><?= $this->getHtml('Tasks'); ?><i class="g-icon download btn end-xs">download</i></div>
            <div class="slider">
            <table class="default sticky">
                <thead>
                <tr>
                    <td><?= $this->getHtml('Status', 'Tasks', 'Backend'); ?><i class="sort-asc g-icon">expand_less</i><i class="sort-desc g-icon">expand_more</i>
                    <td><?= $this->getHtml('Due/Priority', 'Tasks', 'Backend'); ?>
                    <td class="wf-100"><?= $this->getHtml('Title', 'Tasks', 'Backend'); ?>
                    <td><?= $this->getHtml('For', 'Tasks', 'Backend'); ?>
                <tbody>
                <?php $c = 0;
                foreach ($this->data['template']->tasks as $key => $task) : ++$c;
                    $url = \phpOMS\Uri\UriFactory::build('{/base}/checklist/template/task?{?}&id=' . $task->id);
                ?>
                <tr data-href="<?= $url; ?>">
                    <td data-label="<?= $this->getHtml('Status', 'Tasks', 'Backend'); ?>">
                    <a href="<?= $url; ?>">
                        <span class="tag <?= $this->printHtml('task-status-' . $task->status, 'Tasks', 'Backend'); ?>">
                            <?= $this->getHtml('S' . $task->status, 'Tasks', 'Backend'); ?>
                        </span>
                    </a>
                    <td><?php if ($task->priority === TaskPriority::NONE) : ?>
                            <?= $this->printHtml($task->due->format('Y-m-d H:i')); ?>
                        <?php else : ?>
                            <?= $this->getHtml('P' . $task->priority, 'Tasks', 'Backend'); ?>
                        <?php endif; ?>
                    <td><a href="<?= $url; ?>"><?= $this->printHtml($task->title); ?></a>
                    <td><?php
                    $element = \reset($task->taskElements);
                    foreach ($element->accRelation as $rel): ?>
                        <?= $this->printHtml(
                                \sprintf('%3$s %2$s %1$s', $rel->relation->name1, $rel->relation->name2, $rel->relation->name3)
                            ); ?>
                    <?php endforeach; ?>
                <?php endforeach; ?>
                <?php if ($c === 0) : ?>
                <tr>
                    <td colspan="2" class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
                <?php endif; ?>
            </table>
            </div>
        </div>
    </div>
</div>
