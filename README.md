yii2-echarts
============
[![Latest Stable Version](https://poser.pugx.org/daixianceng/yii2-echarts/v/stable)](https://packagist.org/packages/daixianceng/yii2-echarts) [![Total Downloads](https://poser.pugx.org/daixianceng/yii2-echarts/downloads)](https://packagist.org/packages/daixianceng/yii2-echarts) [![Latest Unstable Version](https://poser.pugx.org/daixianceng/yii2-echarts/v/unstable)](https://packagist.org/packages/daixianceng/yii2-echarts) [![License](https://poser.pugx.org/daixianceng/yii2-echarts/license)](https://packagist.org/packages/daixianceng/yii2-echarts)

ECharts widget for Yii2.

See the [echarts project](https://github.com/ecomfe/echarts) for details.

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist daixianceng/yii2-echarts "*"
```

or add

```
"daixianceng/yii2-echarts": "*"
```

to the require section of your `composer.json` file.


## Usage

### Example

```php
<?php
use yii\web\JsExpression;
use daixianceng\echarts\ECharts;
?>

<?= ECharts::widget([
    'responsive' => true,
    'options' => [
        'style' => 'height: 400px;'
    ],
    'pluginEvents' => [
        'click' => [
            new JsExpression('function (params) {console.log(params)}'),
            new JsExpression('function (params) {console.log("ok")}')
        ],
        'legendselectchanged' => new JsExpression('function (params) {console.log(params.selected)}')
    ],
    'pluginOptions' => [
        'option' => [
            'title' => [
                'text' => '折线图堆叠'
            ],
            'tooltip' => [
                'trigger' => 'axis'
            ],
            'legend' => [
                'data' => ['邮件营销', '联盟广告', '视频广告', '直接访问', '搜索引擎']
            ],
            'grid' => [
                'left' => '3%',
                'right' => '4%',
                'bottom' => '3%',
                'containLabel' => true
            ],
            'toolbox' => [
                'feature' => [
                    'saveAsImage' => []
                ]
            ],
            'xAxis' => [
                'name' => '日期',
                'type' => 'category',
                'boundaryGap' => false,
                'data' => ['周一', '周二', '周三', '周四', '周五', '周六', '周日']
            ],
            'yAxis' => [
                'type' => 'value'
            ],
            'series' => [
                [
                    'name' => '邮件营销',
                    'type' => 'line',
                    'stack' => '总量',
                    'data' => [120, 132, 101, 134, 90, 230, 210]
                ],
                [
                    'name' => '联盟广告',
                    'type' => 'line',
                    'stack' => '总量',
                    'data' => [220, 182, 191, 234, 290, 330, 310]
                ],
                [
                    'name' => '视频广告',
                    'type' => 'line',
                    'stack' => '总量',
                    'data' => [150, 232, 201, 154, 190, 330, 410]
                ],
                [
                    'name' => '直接访问',
                    'type' => 'line',
                    'stack' => '总量',
                    'data' => [320, 332, 301, 334, 390, 330, 320]
                ],
                [
                    'name' => '搜索引擎',
                    'type' => 'line',
                    'stack' => '总量',
                    'data' => [820, 932, 901, 934, 1290, 1330, 1320]
                ]
            ]
        ]
    ]
]); ?>
```

### Using themes

```php
<?php
use daixianceng\echarts\ECharts;

// Registers the theme JS files.
ECharts::registerTheme('dark');
?>

<?= ECharts::widget([
    'theme' => 'dark',
    'responsive' => true,
    'options' => [
        'style' => 'height: 400px;'
    ],
    'pluginOptions' => [
        'option' => []
    ]
]); ?>
```

### Using maps

```php
<?php
use daixianceng\echarts\ECharts;

// 引用地图必须使用完整版的echarts
ECharts::$dist = ECharts::DIST_FULL;
ECharts::registerMap(['china', 'province/beijing']);
?>

<?= ECharts::widget([
    'responsive' => true,
    'options' => [
        'style' => 'height: 400px;'
    ],
    'pluginOptions' => [
        'option' => [
            'series' => [
                [
                    'name' => 'China map',
                    'type' => 'map',
                    'map' => 'china',
                    'data' => [
                        ['name' => '广东', 'selected' => true]
                    ]
                ]
            ]
        ]
    ]
]); ?>

<?= ECharts::widget([
    'responsive' => true,
    'options' => [
        'style' => 'height: 400px;'
    ],
    'pluginOptions' => [
        'option' => [
            'geo' => [
                'map' => '北京'
            ]
        ]
    ]
]); ?>
```

### Configure CDN

```php
<?php
return [
    'components' => [
        'assetManager' => [
            'class' => 'yii\web\AssetManager',
            'bundles' => [
                'daixianceng\echarts\EChartsAsset' => [
                    'sourcePath' => null,
                    'baseUrl' => 'https://cdn.jsdelivr.net/npm/echarts@4.7.0/dist'
                ]
            ],
        ],
    ],
];
?>
```

## License

**yii2-echarts** is released under the BSD-3-Clause License. See the bundled `LICENSE` for details.
