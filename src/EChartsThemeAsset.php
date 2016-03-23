<?php
/**
 * @link https://github.com/daixianceng/yii2-echarts
 * @copyright Copyright (c) 2016, Cosmo
 * @license http://opensource.org/licenses/BSD-3-Clause
 */
namespace daixianceng\echarts;

use yii\web\AssetBundle;

/**
 * ECharts theme asset
 *
 * @author Cosmo <daixianceng@gmail.com>
 */
class EChartsThemeAsset extends AssetBundle
{
    public $sourcePath = '@bower/echarts/theme';

    public $depends = [
        'daixianceng\echarts\EChartsAsset',
    ];
}