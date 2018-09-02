<?php
/**
 * @link https://github.com/daixianceng/yii2-echarts
 * @copyright Copyright (c) 2016, Cosmo
 * @license http://opensource.org/licenses/BSD-3-Clause
 */
namespace daixianceng\echarts;

use yii\web\AssetBundle;

/**
 * Theme asset
 *
 * @author Cosmo <daixianceng@gmail.com>
 */
class ThemeAsset extends AssetBundle
{
    public $sourcePath = '@npm/echarts/theme';

    public $depends = [
        'daixianceng\echarts\EChartsAsset',
    ];
}