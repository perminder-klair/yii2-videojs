<?php

namespace kato;

use yii\web\AssetBundle;

/**
 * Asset bundle for DropZone Widget
 */
class VideojsAsset extends AssetBundle
{

    public $sourcePath = '@videojs/bower_components';

    public $js = [
        "video-js/dist/video-js/video.js"
    ];

    public $css = [
        "video-js/dist/video-js/video-js.css"
    ];

    /**
     * @var array
     */
    public $publishOptions = [
        'forceCopy' => true
    ];

}