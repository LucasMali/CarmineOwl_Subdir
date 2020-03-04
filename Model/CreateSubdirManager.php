<?php

namespace CarmineOwl\Subdir\Model;

use Magento\Framework\App\Filesystem\DirectoryList;
use CarmineOwl\Subdir\Model\ResourceModel\Validate as ValidateResource;
use Magento\Framework\DB\Adapter\Pdo\Mysql\Interceptor;

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
     * @var Validate
     */
    private $validate;
    /**
     * @var LanguageCodesRepository
     */
    private $languageCodeRepository;

    /**
     * CreateSubdirManager constructor.
     * @param DirectoryList $directoryList
     * @param FileBuilder $fileBuilder
     * @param LanguageCodesRepository $languageCodesRepository
     * @param ValidateResource $validate
     */
    public function __construct(
        DirectoryList $directoryList,
        FileBuilder $fileBuilder,
        LanguageCodesRepository $languageCodesRepository,
        ValidateResource $validate
    ) {
        $this->directoryList = $directoryList;
        $this->fileBuilder = $fileBuilder;
        $this->languageCodeRepository = $languageCodesRepository;
        $this->validate = $validate;
    }

    /**
     * @param string $code
     * @throws \Exception
     */
    public function execute(string $code)
    {
        $_directory = substr($code, -2, 2);
        try {
            $this->languageCodeRepository->getByCode($_directory);
        } catch (\Exception $e) {
            throw new \UnexpectedValueException(sprintf(
                'There is no language with code %s',
                $code
            ));
        }
        $this->createFiles($code, $_directory);
        $this->addEntryToDatabase($code, $_directory);
    }

    /**
     * @param $code
     * @param $directory
     */
    public function createFiles($code, $directory)
    {
        $_absoluteFolderPath = $this->directoryList->getRoot() . DIRECTORY_SEPARATOR . $directory;
        $_template = IndexPhpTemplate::getDecodedTemplate();
        $_root = $this->directoryList->getRoot();

        $this->fileBuilder->execute(
            $_template,
            $code,
            $_absoluteFolderPath,
            $_root
        );

    }

    /**
     * @param $code
     * @param $directory
     * @throws \Exception
     */
    public function addEntryToDatabase($code, $directory)
    {
        $_template = $this->fileBuilder->template ?: $this->fileBuilder->buildTemplate(
            $code,
            IndexPhpTemplate::getDecodedTemplate()
        );

        $_data = [
            'folder' => '\'' . $directory . '\'',
            'index_php' => '\'' . $_template . '\''
        ];

        /** @var ValidateResource $_validate */
        if (!$_validate = $this->validate) {
            throw new \Exception(sprintf('Unable to get validateFactory to instantiate.'));
        }

        /** @var Interceptor $_connection */
        if (!$_connection = $_validate->getConnection()) {
            throw new \Exception(sprintf('Unable to get create a database connection to instantiate.'));
        }

        try {
            $_connection->beginTransaction();
            $_connection->insertMultiple(Validate::CACHE_TAG, $_data);
            $_connection->commit();
        } catch (\Exception $e) {
            $_connection->rollBack();
        }
    }
}
