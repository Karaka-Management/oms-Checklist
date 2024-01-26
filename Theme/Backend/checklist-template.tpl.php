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
                    <td><?= $this->getHtml('Due/Priority', 'Tasks', 'Backend'); ?>
                    <td class="wf-100"><?= $this->getHtml('Title', 'Tasks', 'Backend'); ?>
                    <td class="wf-100"><?= $this->getHtml('For', 'Tasks', 'Backend'); ?>
                <tbody>
                <?php $c = 0;
                foreach ($this->data['template']->tasks as $key => $task) : ++$c;
                    $url = \phpOMS\Uri\UriFactory::build('{/base}/checklist/template/task?{?}&id=' . $task->id);
                ?>
                <tr data-href="<?= $url; ?>">
                    <td><?php if ($task->priority === TaskPriority::NONE) : ?>
                            <?= SmartDateTime::formatDuration($task->due?->getTimestamp() - $task->createdAt?->getTimestamp()); ?>
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
