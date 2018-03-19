<?php
namespace TildBJ\Seeder\Message;

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
use TildBJ\Seeder;

/**
 * FlashMessage
 *
 * @author Dennis Römmich<dennis@roemmich.eu>
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class FlashMessage implements Seeder\Message, \TYPO3\CMS\Core\SingletonInterface
{
    /**
     * error
     *
     * @param string $message
     * @return void
     */
    public function error($message)
    {
        $this->addFlashMessage($message, \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
    }

    /**
     * info
     *
     * @param string $message
     * @return void
     */
    public function info($message)
    {
        $this->addFlashMessage($message, \TYPO3\CMS\Core\Messaging\AbstractMessage::INFO);
    }

    /**
     * notice
     *
     * @param string $message
     * @return void
     */
    public function notice($message)
    {
        $this->addFlashMessage($message, \TYPO3\CMS\Core\Messaging\AbstractMessage::NOTICE);
    }

    /**
     * success
     *
     * @param string $message
     * @return void
     */
    public function success($message)
    {
        $this->addFlashMessage($message, \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
    }

    /**
     * warning
     *
     * @param string $message
     * @return void
     */
    public function warning($message)
    {
        $this->addFlashMessage($message, \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
    }

    /**
     * addFlashMessage
     *
     * @param $message
     * @param $severity
     * @return void
     */
    protected function addFlashMessage($message, $severity)
    {
        if (!is_string($message)) {
            throw new \InvalidArgumentException(
                'The message body must be of type string, "' . gettype($message) . '" given.',
                1243258395
            );
        }
        /* @var \TYPO3\CMS\Core\Messaging\FlashMessage $flashMessage */
        $flashMessage = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
            \TYPO3\CMS\Core\Messaging\FlashMessage::class,
            $message,
            '',
            $severity,
            true
        );

        /** @var \TYPO3\CMS\Core\Messaging\FlashMessageService $flashMessageService */
        $flashMessageService = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
            \TYPO3\CMS\Core\Messaging\FlashMessageService::class
        );
        $messageQueue = $flashMessageService->getMessageQueueByIdentifier(
            'extbase.flashmessages.tx_seeder_web_seederseedermod'
        );
        $messageQueue->addMessage($flashMessage);
    }
}
