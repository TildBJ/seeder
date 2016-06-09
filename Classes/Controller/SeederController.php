<?php
namespace Dennis\Seeder\Controller;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2016 Dennis Römmich <dennis@roemmich.eu>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/
use Dennis\Seeder\Domain\Model\Seed;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * TestClass
 *
 * @author Dennis Römmich<dennis@roemmich.eu>
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class SeederController extends AbstractSeederController
{
    /**
     * indexAction
     *
     * @return void
     */
    public function indexAction()
    {
        $seeds = $this->seedRepository->findAll();

        $this->view->assign('seeds', $seeds);
    }

    /**
     * newAction
     *
     * @return void
     */
    public function newAction()
    {
        $tableConfiguration = new \Dennis\Seeder\Utility\TableConfiguration('fe_users');
        $this->view->assign('tables', $tableConfiguration->getAllTables());
    }

    /**
     * createAction
     *
     * @param Seed $seed
     * @return void
     */
    public function createAction(Seed $seed)
    {
        $this->seedRepository->add($seed);
        $this->addFlashMessage(
            LocalizationUtility::translate('createSuccessMsg', 'Seeder'),
            '',
            AbstractMessage::OK
        );
        $this->redirect('index');
    }

    /**
     * editAction
     *
     * @param Seed $seed
     * @return void
     */
    public function editAction(Seed $seed)
    {
        $this->view->assign('seed', $seed);
    }

    /**
     * updateAction
     *
     * @param Seed $seed
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\UnsupportedRequestTypeException
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException
     * @return void
     */
    public function updateAction(Seed $seed)
    {
        $this->seedRepository->update($seed);
        $this->addFlashMessage(
            LocalizationUtility::translate('updateSuccessMsg', 'Seeder'),
            '',
            AbstractMessage::OK
        );
        $this->redirect('index');
    }

    /**
     * showAction
     *
     * @param Seed $seed
     * @return void
     */
    public function showAction(Seed $seed)
    {
        $this->view->assign('seed', $seed);
    }

    /**
     * deleteAction
     *
     * @param Seed $seed
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\UnsupportedRequestTypeException
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException
     * @return void
     */
    public function deleteAction(Seed $seed)
    {
        $this->seedRepository->remove($seed);
        $this->addFlashMessage(
            LocalizationUtility::translate('deleteSuccessMsg', 'Seeder'),
            '',
            AbstractMessage::OK
        );
        $this->redirect('index');
    }

    /**
     * A template method for displaying custom error flash messages, or to
     * display no flash message at all on errors. Override this to customize
     * the flash message in your action controller.
     *
     * @return string The flash message or FALSE if no flash message should be set
     */
    protected function getErrorFlashMessage()
    {
        return LocalizationUtility::translate('errorMsg', 'Seeder');
    }
}
