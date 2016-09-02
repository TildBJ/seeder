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
use Dennis\Seeder;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * SeederController
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
        $this->view->assign('tables', Seeder\Provider\TableConfiguration::getAllTables());
    }

    /**
     * createAction
     *
     * @param Seeder\Domain\Model\Seed $seed
     * @return void
     */
    public function createAction(Seeder\Domain\Model\Seed $seed)
    {
        /** @var Seeder\Provider\TableConfiguration $tableConfiguration */
        $tableConfiguration = GeneralUtility::makeInstance(
            Seeder\Provider\TableConfiguration::class,
            $seed->getTarget()
        );
        $properties = [];
        foreach ($tableConfiguration->getColumns() as $column) {
            $properties[$column] = $this->faker->guessProvider($column);
        }
        $seed->setProperties($properties);

        $this->seedRepository->add($seed);
        $this->message->success(LocalizationUtility::translate('createSuccessMsg', 'Seeder'));
        $this->redirect('index');
    }

    /**
     * editAction
     *
     * @param Seeder\Domain\Model\Seed $seed
     * @return void
     */
    public function editAction(Seeder\Domain\Model\Seed $seed)
    {
        $tableConfiguration = new Seeder\Provider\TableConfiguration($seed->getTarget());
        $table = \Dennis\Seeder\Factory\TableFactory::createTable($seed->getTarget(), $tableConfiguration);

        $this->view->assignMultiple([
            'seed' => $seed,
            'table' => $table,
            'providers' => $this->faker->getSupportedProviders(),
        ]);
    }

    /**
     * updateAction
     *
     * @param Seeder\Domain\Model\Seed $seed
     * @param array $properties
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\UnsupportedRequestTypeException
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException
     * @return void
     */
    public function updateAction(Seeder\Domain\Model\Seed $seed, $properties = [])
    {
        $seed->setProperties($properties);
        $this->seedRepository->update($seed);

        $this->message->success(LocalizationUtility::translate('updateSuccessMsg', 'Seeder'));
        $this->redirect('index');
    }

    /**
     * showAction
     *
     * @param Seeder\Domain\Model\Seed $seed
     * @return void
     */
    public function showAction(Seeder\Domain\Model\Seed $seed)
    {
        $tableConfiguration = new Seeder\Provider\TableConfiguration($seed->getTarget());
        $table = \Dennis\Seeder\Factory\TableFactory::createTable($seed->getTarget(), $tableConfiguration);

        $this->view->assignMultiple([
            'seed' => $seed,
            'table' => $table,
            'providers' => $this->faker->getSupportedProviders(),
        ]);
    }

    /**
     * deleteAction
     *
     * @param Seeder\Domain\Model\Seed $seed
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\UnsupportedRequestTypeException
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException
     * @return void
     */
    public function deleteAction(Seeder\Domain\Model\Seed $seed)
    {
        $this->seedRepository->remove($seed);
        $this->message->success(LocalizationUtility::translate('deleteSuccessMsg', 'Seeder'));
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

    /**
     * runAction
     *
     * @param Seeder\Domain\Model\Seed $seed
     */
    public function runAction(Seeder\Domain\Model\Seed $seed)
    {
        $properties = [];
        foreach ($seed->getProperties() as $name => $type) {
            $properties[$name] = $this->faker->get($type);
        }
        $properties['pid'] = intval(GeneralUtility::_GET('id'));
        $seed->setProperties($properties);

        /** @var Seeder\SeedCollection $seedCollection */
        $seedCollection = GeneralUtility::makeInstance(Seeder\Collection\SeedCollection::class);
        $seedCollection->attach($seed);

        if ($this->seeder->seed($seedCollection)) {
            $this->message->success(LocalizationUtility::translate('runSuccessMsg', 'Seeder', [1, $seed->getTarget()]));
        }

        $this->redirect('index');
    }
}
