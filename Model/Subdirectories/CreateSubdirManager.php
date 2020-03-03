<?php

namespace CarmineOwl\Subdir\Model\Subdirectories;

use Magento\Framework\App\Filesystem\DirectoryList;

/**
 * Class CreateSubdirManager
 * @package CarmineOwl\Subdir\Model
 */
class CreateSubdirManager
{
    /**
     * @var DirectoryList
     */
    private $directoryList;
    /**
     * @var FileBuilder
     */
    private $fileBuilder;
    /**
     * @var ValidateFactory
     */
    private $validateFactory;

    public function __construct(
        DirectoryList $directoryList,
        FileBuilder $fileBuilder,
        ValidateFactory $validateFactory,
        LanguageCodesRepository $languageCodesRepository
    ) {
        $this->directoryList = $directoryList;
        $this->fileBuilder = $fileBuilder;
        $this->validateFactory = $validateFactory;
        $this->languageCodeRepository = $languageCodesRepository;
    }

    /**
     * @param string $code
     */
    public function execute(string $code)
    {
        $_directory = substr($code, -2, 2);
        try {
            $this->languageCodeRepository->getByCode($_directory);
        } catch (\Exception $e) {
            // TODO add an error message of some kind.
        }
        $this->createFiles($code, $_directory);
        $this->addEntryToDatabase($_directory);
    }

    /**
     * @param $code
     * @param $directory
     */
    public function createFiles($code, $directory)
    {
        $_absoluteFolderPath = $this->directoryList->getRoot() . DIRECTORY_SEPARATOR . $directory;
        if (!Directories::exists($_absoluteFolderPath)) {

            $_template = IndexPhpTemplate::getDecodedTemplate();
            $_root = $this->directoryList->getRoot();

            $this->fileBuilder->execute(
                $_template,
                $code,
                $_absoluteFolderPath,
                $_root
            );
        }
    }

    /**
     * @param $directory
     */
    public function addEntryToDatabase($directory)
    {
        $_template = $this->fileBuilder->template ?: $this->fileBuilder->buildTemplate($directory, IndexPhpTemplate::getDecodedTemplate());

        $_data = [
            'folder' => '\'' . $directory . '\'',
            'index_php' => '\'' . $_template . '\''
        ];

        /** @var Validate $this */
        $_connection = ($_validate = $this->validateFactory->create())->getConnection();
        try {
            $_connection->beginTransaction();
            $_connection->insertMultiple(Validate::CACHE_TAG, $_data);
            $_connection->commit();
        } catch (\Exception $e) {
            $_connection->rollBack();
        }
    }
}
