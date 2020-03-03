<?php


namespace CarmineOwl\Subdir\Model\Subdirectories;

/**
 * Class AbstractIndexPhpTemplate
 * @package CarmineOwl\Subdir\Model
 *
 * @example TEMPLATE
 *
 * require realpath(__DIR__) . '/../app/bootstrap.php';
 * $params = $_SERVER;
 * $params[\Magento\Store\Model\StoreManager::PARAM_RUN_CODE] = '{{$}}'; // change this with the code you chose in step. 4
 * $params[\Magento\Store\Model\StoreManager::PARAM_RUN_TYPE] = 'website'; // store or website
 * $bootstrap = \Magento\Framework\App\Bootstrap::create(BP, $params);
 *
 * $app = $bootstrap->createApplication('Magento\Framework\App\Http');
 * $bootstrap->run($app);

 */
abstract class IndexPhpTemplate
{
    const TEMPLATE = "%3C%3Fphp%0D%0Arequire+realpath%28__DIR__%29+.+%27%2F..%2Fapp%2Fbootstrap.php%27%3B%0D%0A%24params+%3D+%24_SERVER%3B%0D%0A%24params%5B%5CMagento%5CStore%5CModel%5CStoreManager%3A%3APARAM_RUN_CODE%5D+%3D+%27%7B%7B%24%7D%7D%27%3B%0D%0A%24params%5B%5CMagento%5CStore%5CModel%5CStoreManager%3A%3APARAM_RUN_TYPE%5D+%3D+%27website%27%3B%0D%0A%24bootstrap+%3D+%5CMagento%5CFramework%5CApp%5CBootstrap%3A%3Acreate%28BP%2C+%24params%29%3B%0D%0A%24app+%3D+%24bootstrap-%3EcreateApplication%28%27Magento%5CFramework%5CApp%5CHttp%27%29%3B%0D%0A%24bootstrap-%3Erun%28%24app%29%3B";

    public static function getDecodedTemplate()
    {
        return urldecode(IndexPhpTemplate::TEMPLATE);
    }
}
