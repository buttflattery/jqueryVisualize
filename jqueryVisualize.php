<?php

/**
 * Wrapper Widget to use jQuery Visualize in Yii application.
 *
 * @author Muhammad Omer Aslam <buttflattery@hotmail.com>
 * @copyright Copyright &copy; 2014 omaraslam.com
 * @package extensions
 * @subpackage jqueryVisualize
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 * @version 3.4.3 rev.0
 *
 * @see http://www.filamentgroup.com/lab/update-to-jquery-visualize-accessible-charts-with-html5-from-designing-with.html
 */
class jqueryVisualize extends CWidget
{
    /** @var string Path to assets directory published in init() */
    private $assetsDir;
    public $type = 'bar'; //also available: area, pie, line
    public $width = 420; //width of the canvas
    public $height = 'default'; //height of canvas - defaults to table height
    public $appendTitle = TRUE; //table caption text is added to chart
    public $title = 'null'; //grabs from table caption if null
    public $appendKey = TRUE; //color key is added to chart
    public $rowFilter = '*';
    public $colFilter = '*';
    public $colors = array('#be1e2d', '#666699', '#92d5ea', '#ee8310', '#8d10ee', '#5a3b16', '#26a4ed', '#f45a90', '#e9e744');
    public $textColors = array(); //corresponds with colors array. null/undefined items will fall back to CSS
    public $parseDirection = 'x'; //which direction to parse the table data
    public $pieMargin = 20; //pie charts only - spacing around pie
    public $pieLabelsAsPercent = TRUE;
    public $pieLabelPos = 'inside';
    public $lineWeight = 4; //for line and area - stroke weight
    public $barGroupMargin = 10;
    public $barMargin = 1; //space around bars in bar chart (added to both sides of bar)
    public $yLabelInterval = 30; //distance between y labels
    public $selector = '';
    public $hideContainer   =   FALSE;

    protected function publishAssets()
    {
        $dir = dirname(__FILE__) . '/assets';
        $this->assetsDir = Yii::app()->assetManager->publish($dir);
    }

    public function init()
    {
        $cs = Yii::app()->getClientScript();

        /*publish assets directory*/
        $this->publishAssets();

        //uncomment the following line if you want to include core jquery script
        //$cs->registerCoreScript('jquery');
        $cs->registerScriptFile($this->assetsDir . '/js/enhance.js', CClientScript::POS_HEAD);
        $cs->registerScript('CAPABILITY-TEST', '
            enhance({
                loadScripts: [
                    {
                    src:\'' . $this->assetsDir . '/js/excanvas.js\',
                    iecondition: \'all\'
                    },
                    \'' . $this->assetsDir . '/js/visualize.jQuery.js\',
                ],
                loadStyles: [
                    \'' . $this->assetsDir . '/css/visualize.css\',
                    \'' . $this->assetsDir . '/css/visualize-dark.css\'
                ]
            });
        ');
    }

    /*RENDER  THE WIDGETS GRAPH */
    public function run()
    {
        $cs = Yii::app()->getClientScript();

        if ($this->selector == '') {
            $cs->registerScript('error', 'alert("Please provide id for the target table")');
        }
        $cs->registerScript('initialize_' . md5($this->selector . time()),
            '
            $(document).ready(function(){
                $("' . $this->selector . '").visualize(
                    {
                        type: "' . $this->type . '",
                        width: "' . $this->width . 'px",
                        ' . (($this->height != 'default') ? 'height: ' . $this->height . ',' : "") . '
                        appendTitle: ' . $this->appendTitle . ',
                        '.(($this->title!='null')?'title: "' . $this->title . '",':"").'
                        appendKey: ' . $this->appendKey . ',
                        rowFilter: "' . $this->rowFilter . '",
                        colFilter: \'' . $this->colFilter . '\',
                        colors: ' . CJSON::encode($this->colors) . ',
                        textColors: ' . CJSON::encode($this->textColors) . ',
                        parseDirection: \'' . $this->parseDirection . '\',
                        pieMargin: ' . $this->pieMargin . ',
                        pieLabelsAsPercent: ' . $this->pieLabelsAsPercent . ',
                        pieLabelPos: \'' . $this->pieLabelPos . '\',
                        lineWeight: ' . $this->lineWeight . ',
                        barGroupMargin: ' . $this->barGroupMargin . ',
                        barMargin: ' . $this->barMargin . ',
                        yLabelInterval: ' . $this->yLabelInterval . '
                    }
                    );
                });
                console.log("script called");

                    ', CClientScript::POS_LOAD);
        if($this->hideContainer===TRUE){
            $cs->registerScript('hide-container-'. md5($this->selector . time()),'$("'.$this->selector.'").css(\'display\',\'none\')',CClientScript::POS_READY);
        }
        //$this->render('graph',array('caption'=>$this->caption));
    }
}