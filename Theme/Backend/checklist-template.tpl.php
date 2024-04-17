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

use Modules\Checklist\Models\NullChecklistTemplate;
use Modules\Tasks\Models\TaskPriority;
use phpOMS\Stdlib\Base\SmartDateTime;
use phpOMS\Uri\UriFactory;

/**
 * @var \phpOMS\Views\View $this
 */

$template = $this->data['template'] ?? new NullChecklistTemplate();

$isNew = $template->id === 0;

echo $this->data['nav']->render(); ?>

<div class="row">
    <div class="col-xs-12 col-md-6">
        <section class="portlet">
            <form id="fTemplate" method="<?= $isNew ? 'PUT' : 'POST'; ?>" action="<?= UriFactory::build('{/api}checklist/template?{?}&csrf={$CSRF}'); ?>">
            <div class="portlet-head"><?= $this->getHtml('Template'); ?></div>
            <div class="portlet-body">
                <div class="form-group">
                    <label for="iId"><?= $this->getHtml('ID', '0', '0'); ?></label>
                    <input type="text" name="id" id="iId" value="<?= $template->id; ?>" disabled>
                </div>

                <div class="form-group">
                    <label for="iName"><?= $this->getHtml('Name'); ?></label>
                    <input type="text" id="iName" name="name" value="<?= $this->printHtml($template->name); ?>" required>
                </div>

                <div class="flex-line">
                    <div>
                        <div class="form-group">
                            <label for="iStart"><?= $this->getHtml('Start'); ?></label>
                            <input type="datetime-local" id="iStart" name="start" value="<?= $this->printHtml($template->start->format('Y-m-d\TH:i:s')); ?>">
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <label for="iEnd"><?= $this->getHtml('End'); ?></label>
                            <input type="datetime-local" id="iEnd" name="end" value="<?= $this->printHtml($template->end?->format('Y-m-d\TH:i:s')); ?>">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="iDescription"><?= $this->getHtml('Description'); ?></label>
                    <textarea id="iDescription" name="desc"><?= $this->printTextarea($template->description); ?></textarea>
                </div>

                <?php if ($isNew) : ?>
                <div class="form-group">
                </div>
                <?php endif; ?>
            </div>
            <div class="portlet-foot">
                <?php if ($isNew) : ?>
                    <input id="iCreateSubmit" type="Submit" value="<?= $this->getHtml('Create', '0', '0'); ?>">
                <?php else : ?>
                    <input id="iSaveSubmit" type="Submit" value="<?= $this->getHtml('Save', '0', '0'); ?>">
                    <form id="iChecklistCreate" action="<?= \phpOMS\Uri\UriFactory::build('{/api}checklist?{?}&csrf={$CSRF}'); ?>" method="POST">
                        <input id="iId" type="hidden" name="id" value="<?= $this->data['template']->id; ?>">
                        <input type="submit" class="end-xs save" value="<?= $this->getHtml('Create', '0', '0'); ?>">
                    </form>
                <?php endif; ?>
            </div>
            </form>
        </section>
    </div>
</div>

<?php if (!$isNew) : ?>
<div class="row">
    <div class="col-xs-12">
        <section class="portlet">
            <div class="portlet-head">
                <?= $this->getHtml('Tasks'); ?>
                <span class="end-xs">
                    <a class="button" href="<?= \phpOMS\Uri\UriFactory::build('{/base}/checklist/template/task/create?{?}&csrf={$CSRF}'); ?>"><?= $this->getHtml('Add', '0', '0'); ?></a>
                </span>
            </div>
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
                    $url = \phpOMS\Uri\UriFactory::build('{/base}/checklist/template/task/view?{?}&id=' . $task->id);
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
        </section>
    </div>
</div>
<?php endif; ?>
