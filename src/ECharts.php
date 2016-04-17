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
 * @property string $clientId
 */
class ECharts extends Widget
{
    const DIST_FULL = 'full';
    const DIST_COMMON = 'common';
    const DIST_SIMPLE = 'simple';

    /**
     * @var string the client ID of the echarts.
     * @see getClientId()
     */
    private $_clientId;

    /**
     * @var array list of the theme JS files.
     */
    protected static $_themeJsFiles = [];

    /**
     * @var array list of the map JS files.
     */
    protected static $_mapJsFiles = [];

    /**
     * @var string the dist of echarts to be used. The possible options are:
     * - "full" : A full dist of echarts.
     * - "common" : A common dist of echarts.
     * - "simple" : A simple dist of echarts.
     * Defaults to "common", means a common dist of echarts will be used.
     * 
     * Note that if you are using maps in echarts, you must set it a full dist.
     */
    public static $dist = self::DIST_COMMON;

    /**
     * @var boolean whether resize the chart when the container size is changed.
     */
    public $responsive = false;

    /**
     * @var string the theme name to be used for styling the chart.
     */
    public $theme;

    /**
     * @var array the HTML attributes for the widget container tag.
     */
    public $options = [];

    /**
     * @var array the options for the echarts plugin.
     * See [its documentation](http://echarts.baidu.com/option.html) or [api](http://echarts.baidu.com/api.html) for details.
     */
    public $pluginOptions = [];

    /**
     * @var array the attached event handlers for the echarts plugin (event name => handlers)
     */
    public $pluginEvents = [];

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
     * Registers the required js files and script to initialize echarts plugin.
     */
    protected function registerClientScript()
    {
        $id = $this->options['id'];
        $view = $this->getView();
        $option = !empty($this->pluginOptions['option']) ? Json::encode($this->pluginOptions['option']) : '{}';

        if ($this->theme) {
            static::registerTheme($this->theme);
            $js = "var {$this->clientId} = echarts.init(document.getElementById('{$id}'), " . $this->quote($this->theme) . ");";
        } else {
            $js = "var {$this->clientId} = echarts.init(document.getElementById('{$id}'));";
        }
        $js .= "{$this->clientId}.setOption({$option});";
        if (isset($this->pluginOptions['group'])) {
            $js .= "{$this->clientId}.group = " . $this->quote($this->pluginOptions['group']) . ";";
        }
        if ($this->responsive) {
            $js .= "$(window).resize(function () {{$this->clientId}.resize()});";
        }
        foreach ($this->pluginEvents as $name => $handlers) {
            $handlers = (array) $handlers;
            foreach ($handlers as $handler) {
                $js .= "{$this->clientId}.on(" . $this->quote($name) . ", $handler);";
            }
        }

        EChartsAsset::register($view);
        if (static::$_themeJsFiles) {
            ThemeAsset::register($view)->js = static::$_themeJsFiles;
        }
        if (static::$_mapJsFiles) {
            MapAsset::register($view)->js = static::$_mapJsFiles;
        }
        $view->registerJs($js);
    }

    /**
     * Quotes a string for use in JavaScript.
     *
     * @param string $string
     * @return string the quoted string
     */
    private function quote($string)
    {
        return "'" . addcslashes($string, "'") . "'";
    }

    /**
     * Returns the client ID of the echarts.
     *
     * @return string
     */
    public function getClientId()
    {
        $id = $this->options['id'];

        if ($this->_clientId === null) {
            $this->_clientId = "echarts_{$id}";
        }

        return $this->_clientId;
    }

    /**
     * Registers the JS files of the given themes.
     *
     * @param string|array $theme
     */
    public static function registerTheme($theme)
    {
        $themes = (array) $theme;
        array_walk($themes, function (&$name) {
            $name .= '.js';
        });
        static::$_themeJsFiles = array_unique(array_merge(static::$_themeJsFiles, $themes));
    }

    /**
     * Registers the JS files of the given maps.
     *
     * @param string|array $map
     */
    public static function registerMap($map)
    {
        $maps = (array) $map;
        array_walk($maps, function (&$name) {
            $name = 'js/' . $name . '.js';
        });
        static::$_mapJsFiles = array_unique(array_merge(static::$_mapJsFiles, $maps));
    }
}
