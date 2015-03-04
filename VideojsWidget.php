<?php

namespace kato;

use Yii;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\base\InvalidConfigException;

/**
 * Class VideojsWidget
 * @package kato
 */
class VideojsWidget extends \yii\base\Widget
{
    /**
     * @var array
     */
    public $options = [];

    /**
     * @var array
     */
    public $jsOptions = [];

    /**
     * @var array
     */
    public $tags = [];

    /**
     * Initializes the widget
     * @throw InvalidConfigException
     */
    public function init()
    {
        parent::init();
        Yii::setAlias('@videojs', dirname(__FILE__));
        $this->registerAssets();

        if (!isset($this->options['id'])) {
            $this->options['id'] = 'videojs-' . $this->getId();
        }
    }

    public function run()
    {
        $data = '';
        $data .= Html::beginTag('video', $this->options);

        if (!empty($this->tags) && is_array($this->tags)) {

                foreach ($this->tags as $tagName => $tags) {
                    if (is_array($this->tags[$tagName])) {

                        foreach ($tags as $tagOptions) {
                            $tagContent = '';
                            if (isset($tagOptions['content'])) {
                                $tagContent = $tagOptions['content'];
                                unset($tagOptions['content']);
                            }

                            $data .= Html::tag($tagName, $tagContent, $tagOptions);
                        }

                    } else {
                        throw new InvalidConfigException("Invalid config for 'tags' property.");
                    }
                }

        }

        $data .= Html::endTag('video');

        return $data;
    }

    /**
     * Registers the needed assets
     */
    private function registerAssets()
    {
        $view = $this->getView();
        VideojsAsset::register($view);

        if (!empty($this->jsOptions)) {
            $js = 'videojs("#' . $this->options['id'] . '").ready(' . Json::encode($this->jsOptions). ');';
            $view->registerJs($js);
        }
    }
}
