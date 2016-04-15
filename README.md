yii2-echarts
============
ECharts widget for Yii2.

See [echarts project](https://github.com/ecomfe/echarts) for details.

Installation
------------

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


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
use yii\web\JsExpression;
use daixianceng\echarts\ECharts;

// 使用全版本的echarts，默认 "ECharts::DIST_COMMON"
ECharts::$dist = ECharts::DIST_FULL;

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
