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

/**
 * @var \phpOMS\Views\View $this
 */

$footerView = new \phpOMS\Views\PaginationView($this->l11nManager, $this->request, $this->response);
$footerView->setTemplate('/Web/Templates/Lists/Footer/PaginationBig');

$footerView->setPages(25);
$footerView->setPage(1);
$footerView->setResults(1);

echo $this->data['nav']->render(); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="portlet">
            <div class="portlet-head"><?= $this->getHtml('Checklists'); ?><i class="lni lni-download download btn end-xs"></i></div>
            <div class="slider">
            <table class="default sticky">
                <thead>
                <tr>
                    <td><?= $this->getHtml('ID', '0', '0'); ?>
                    <td><?= $this->getHtml('Status'); ?>
                    <td class="wf-100"><?= $this->getHtml('Name'); ?>
                    <td><?= $this->getHtml('Creator'); ?>
                    <td><?= $this->getHtml('Created'); ?>
                <tbody>
                <?php $c = 0; foreach ([] as $key => $value) : ++$c;
                $url     = \phpOMS\Uri\UriFactory::build('checklist/single?{?}&id=' . $value->id); ?>
                <tr>
                    <td data-label="<?= $this->getHtml('ID', '0', '0'); ?>"><a href="<?= $url; ?>"><?= $value->id; ?></a>
                    <td data-label="<?= $this->getHtml('Status'); ?>"><a href="<?= $url; ?>"><?= $this->printHtml($value->name); ?></a>
                    <td data-label="<?= $this->getHtml('Name'); ?>"><a href="<?= $url; ?>"><?= $this->printHtml($value->parent); ?></a>
                    <td data-label="<?= $this->getHtml('Creator'); ?>"><a href="<?= $url; ?>"><?= $this->printHtml($value->getUnit()); ?></a>
                    <td data-label="<?= $this->getHtml('Created'); ?>"><a href="<?= $url; ?>"><?= $this->printHtml($value->getUnit()); ?></a>
                        <?php endforeach; ?>
                        <?php if ($c === 0) : ?>
                <tr>
                    <td colspan="5" class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
                        <?php endif; ?>
            </table>
            </div>
        </div>
    </div>
</div>
