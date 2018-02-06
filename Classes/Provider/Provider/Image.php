<?php

namespace Dennis\Seeder\Provider\Provider;

/**
 * Class Image
 *
 * @package Dennis\Seeder\Provider\Provider
 */
class Image implements \Dennis\Seeder\Provider
{

    /**
     * @var \Dennis\Seeder\Faker $faker
     */
    protected $faker;

    /**
     * Image constructor.
     * @param \Dennis\Seeder\Faker $faker
     */
    public function __construct(\Dennis\Seeder\Faker $faker)
    {
        $this->faker = $faker;
    }

    /**
     * @return string
     * @throws \Exception
     * @throws \TYPO3\CMS\Core\Resource\Exception\ExistingTargetFileNameException
     * @throws \TYPO3\CMS\Core\Resource\Exception\ExistingTargetFolderException
     * @throws \TYPO3\CMS\Core\Resource\Exception\InsufficientFolderAccessPermissionsException
     * @throws \TYPO3\CMS\Core\Resource\Exception\InsufficientFolderWritePermissionsException
     */
    public function generate()
    {
        /** @var \TYPO3\CMS\Core\Resource\StorageRepository $storageRepository */
        $storageRepository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
            \TYPO3\CMS\Core\Resource\StorageRepository::class
        );

        /** @var $storage \TYPO3\CMS\Core\Resource\ResourceStorage */
        $storage = reset($storageRepository->findAll());

        if (!is_dir(PATH_site . 'typo3temp/import/')) {
            mkdir(PATH_site . 'typo3temp/import/');
        }

        try {
            $folder = $storage->getFolder($storage->getDefaultFolder()->getIdentifier() . 'import');
        } catch (\TYPO3\CMS\Core\Resource\Exception\FolderDoesNotExistException $exception) {
            $folder = $storage->createFolder($storage->getDefaultFolder()->getIdentifier() . 'import');
        }

        $url = $this->faker->getImageUrl();
        $fileName = time() . '.jpg';
        if ($storage->hasFile($folder->getIdentifier() . $fileName)) {
            $file = $storage->getFile($folder->getIdentifier() . $fileName);
        } else {
            $img = PATH_site . 'typo3temp/import/' . $fileName;
            file_put_contents($img, file_get_contents($url));

            $file = $storage->addFile($img, $folder, $fileName);
        }

        /** @var \TYPO3\CMS\Core\Resource\ResourceFactory $resourceFactory */
        $resourceFactory = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
            \TYPO3\CMS\Core\Resource\ResourceFactory::class
        );
        $falFileReference = $resourceFactory->createFileReferenceObject(
            [
                'uid_local' => $file->getUid(),
                'uid_foreign' => uniqid('NEW_'),
                'uid' => uniqid('NEW_'),
                'crop' => null,
            ]
        );
        /** @var \TYPO3\CMS\Extbase\Domain\Model\FileReference $fileReference */
        $fileReference = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
            \TYPO3\CMS\Extbase\Domain\Model\FileReference::class
        );
        $fileReference->setOriginalResource($falFileReference);
        return $file->getProperty('uid');
    }
}
