<?php
/**
 * @link https://github.com/daixianceng/yii2-echarts
 * @copyright Copyright (c) 2016, Cosmo
 * @license http://opensource.org/licenses/BSD-3-Clause
 */
namespace daixianceng\echarts;

use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Json;

/**
 * ECharts widget
 * 
 * @author Cosmo <daixianceng@gmail.com>
 */
class ECharts extends Widget
{
    const DIST_FULL = 'full';
    const DIST_COMMON = 'common';
    const DIST_SIMPLE = 'simple';

    /**
     * @var string the dist of echarts to be used. The possible options are:
     * - "full" : A full dist of echarts.
     * - "common" : A common dist of echarts.
     * - "simple" : A simple dist of echarts.
     * Defaults to "common", means a common dist of echarts will be used.
     */
    public static $dist = 'common';

    /**
     * @var boolean whether resize the chart when the container size is changed.
     */
    public $responsive = false;

    /**
     * @var array the HTML attributes for the widget container tag.
     */
    public $options = [];

    /**
     * @var array the options for the echarts plugin.
     * See [its documentation](http://echarts.baidu.com/option.html) for details.
     */
    public $pluginOptions = [];

    /**
     * Initializes the widget.
     */
    public function init()
    {
        parent::init();
        if (!isset($this->options['id'])) {
            $this->options['id'] = $this->getId();
        }
    }

    /**
     * Renders the widget.
     */
    public function run()
    {
        echo Html::tag('div', '', $this->options);
        $this->registerClientScript();
    }

    /**
     * Registers the required js files and script to initialize echarts plugin
     */
    protected function registerClientScript()
    {
        $id = $this->options['id'];
        $view = $this->getView();
        $options = !empty($this->pluginOptions) ? Json::encode($this->pluginOptions) : '{}';
        
        EChartsAsset::register($view);
    
        $js = "var echarts_{$id} = echarts.init(document.getElementById('{$id}'));echarts_{$id}.setOption({$options});";
        if ($this->responsive) {
            $js .= "$(window).resize(function () {echarts_{$id}.resize()})";
        }
        $view->registerJs($js);
    }
}
