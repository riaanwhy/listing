<?php
namespace app\components;

//namespace bsource\gridview;//in vendor folder
use Yii;
use Closure;
use yii\i18n\Formatter;

//..........

class ExcelGrid extends \yii\grid\GridView
{
    //..........
    public static function columnName($index)
    {
        //..........
    }

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        //..........
        parent::run();
    }

    public function init_provider()
    {
        //..........
    }

    public function init_excel_sheet()
    {
        //..........
    }

    public function initPHPExcelWriter($writer)
    {
        //..........
    }

    public function generateHeader()
    {
        //..........
    }

    public function generateBody()
    {
        //..........
    }

    public function generateRow($model, $key, $index)
    {
        //..........
    }

    public function getColumnHeader($col)
    {
        //..........
    }

    protected function setVisibleColumns()
    {
        //..........
    }

    protected function setHttpHeaders()
    {
        header("Cache-Control: no-cache");
        header("Expires: 0");
        header("Pragma: no-cache");
        header("Content-Type: application/{$this->extension}");
        header("Content-Disposition: attachment; filename={$this->filename}.{$this ->extension}");
    }
}
?>