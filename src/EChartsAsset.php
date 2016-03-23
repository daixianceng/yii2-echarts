<?php
/**
 * @link https://github.com/daixianceng/yii2-echarts
 * @copyright Copyright (c) 2016, Cosmo
 * @license http://opensource.org/licenses/BSD-3-Clause
 */
namespace daixianceng\echarts;

use yii\web\AssetBundle;

/**
 * ECharts asset
 *
 * @author Cosmo <daixianceng@gmail.com>
 */
class EChartsAsset extends AssetBundle
{
    const VERSION_FULL = 'full';
    const VERSION_COMMON = 'common';
    const VERSION_SIMPLE = 'simple';
    
    /**
     * @var string|null the version of echarts to be used. The possible options are:
     * - "full" : A full version of echarts.
     * - "common" : A common version of echarts.
     * - "simple" : A simple version of echarts.
     * You can also set it an another string. For example, "custom" will generate "echarts.custom.js".
     * If it is not set, means a full version of echarts will be used.
     * @see setVersion()
     */
    protected static $version;
    
    /**
     * @inheritdoc
     */
    public $sourcePath = '@bower/echarts/dist';

    /**
     * Initializes the bundle.
     */
    public function init()
    {
        if (empty($this->js)) {
            switch (self::$version) {
                case null:
                case self::VERSION_FULL:
                    $this->js = YII_DEBUG ? ['echarts.js'] : ['echarts.min.js'];
                    break;
                case self::VERSION_COMMON:
                    $this->js = YII_DEBUG ? ['echarts.common.js'] : ['echarts.common.min.js'];
                    break;
                case self::VERSION_SIMPLE:
                    $this->js = YII_DEBUG ? ['echarts.simple.js'] : ['echarts.simple.min.js'];
                    break;
                default:
                    $this->js = ['echarts.' . self::$version . '.js'];
            }
        }
        
        parent::init();
    }
    
    /**
     * Set the version of echarts.
     * 
     * @param string $version
     * @see $version
     */
    public static function setVersion($version)
    {
        if ($version !== null) {
            $version = (string) $version;
        }
        self::$version = $version;
    }
}