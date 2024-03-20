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

/**
 * @var \phpOMS\Views\View $this
 */

echo $this->data['nav']->render(); ?>

<div class="row">
    <div class="col-xs-12 col-md-6">
        <section class="box wf-100">
            <header><h1><?= $this->getHtml('General'); ?></h1></header>
            <div class="inner">
                <form id="fChecklist" method="put" action="<?= \phpOMS\Uri\UriFactory::build('{/api}checklist/template?{?}&csrf={$CSRF}'); ?>">
                    <div class="form-group">
                        <label for="iName"><?= $this->getHtml('Name'); ?></label>
                        <input type="text" id="iName" name="name" required>
                    </div>

                    <div class="form-group">
                        <label for="iDescription"><?= $this->getHtml('Description'); ?></label>
                        <textarea id="iDescription" name="description"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="iPermission"><?= $this->getHtml('Permissions'); ?></label>
                        <span class="input"><button type="button" formaction=""><i class="g-icon">book</i></button>
                                    <input type="text" id="iPermission" name="permission"></span>
                            <button><?= $this->getHtml('Add', '0', '0'); ?></button>
                    </div>

                    <div class="form-group">
                        <label for="iFiles"><?= $this->getHtml('Files'); ?></label>
                        <input id="iFiles" name="files" type="file" multiple>
                    </div>

                        <input type="submit" name="createChecklist" value="<?= $this->getHtml('Create', '0', '0'); ?>">
                </form>
            </div>
        </section>
    </div>

    <div class="col-xs-12 col-md-6">
        <section class="portlet">
            <form>
                <div class="portlet-head"><?= $this->getHtml('Tasks'); ?></div>
                <div class="portlet-body">
                    <div class="form-group">
                        <label for="iETitle"><?= $this->getHtml('Title'); ?></label>
                        <input type="text" id="iETitle" name="eTitle" required>
                    </div>

                    <div class="form-group">
                        <label for="iEDescription"><?= $this->getHtml('Description'); ?></label>
                        <textarea id="iEDescription" name="eDescription"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="iETime"><?= $this->getHtml('TimeInMinutes'); ?></label>
                        <input type="number" min="0" step="1" id="iETime" name="eTime" value="0">
                    </div>

                    <div class="form-group">
                        <label for="iEPermission"><?= $this->getHtml('Permissions'); ?></label>
                        <span class="input"><button type="button" formaction=""><i class="g-icon">book</i></button>
                                <input type="text" id="iEPermission" name="ePermission">
                        </span>
                        <button data-action=""><?= $this->getHtml('Add', '0', '0'); ?></button>
                    </div>

                    <div class="form-group">
                        <label for="iEFiles"><?= $this->getHtml('Files'); ?></label>
                        <input id="iEFiles" name="eFiles" type="file" multiple>
                    </div>
                </div>
                <div class="portlet-foot">
                    <input type="submit" name="createChecklistElement" value="<?= $this->getHtml('Add', '0', '0'); ?>" data-action=""><td>
                </div>
            </form>
        </section>
    </div>
</div>