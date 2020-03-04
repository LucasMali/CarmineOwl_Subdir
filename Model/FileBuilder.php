<?php

namespace CarmineOwl\Subdir\Model;

/**
 * Class FileBuilder
 * @package CarmineOwl\Subdir\Model
 */
class FileBuilder
{
    const PARAM_RUN_CODE_PATTERN = '{{$}}';

    /**
     * @var string $template
     */
    public $template;

    /**
     * @param string $template
     * @param string $absoluteFolderPath
     * @param string $rootPath
     * @param string $code
     * @return FileBuilder
     */
    public function execute(
        string $template,
        string $code,
        string $absoluteFolderPath,
        string $rootPath
    ) {
        $this->template = $this->buildTemplate($code, $template);

        if (!Directories::exists($absoluteFolderPath)) {
            Directories::create($absoluteFolderPath);
        }

        file_put_contents(
            $absoluteFolderPath . DIRECTORY_SEPARATOR . 'index.php',
            $this->template
        );

        copy(
            $rootPath . DIRECTORY_SEPARATOR . 'pub' . DIRECTORY_SEPARATOR . '.htaccess',
            $absoluteFolderPath . DIRECTORY_SEPARATOR . '.htaccess'
        );
    }

    public function buildTemplate($code, $template)
    {
        return str_replace(self::PARAM_RUN_CODE_PATTERN, $code, $template);
    }
}
