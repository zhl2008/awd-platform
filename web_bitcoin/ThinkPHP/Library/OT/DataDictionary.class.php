<?php

namespace OT;
class DataDictionary{

    public function __construct($table){
        $this->headers = $table['header'];
        $this->rows = $table['rows'];
        $this->crossingChar = '+';
        $this->horizontalBorderChar = '-';
        $this->verticalBorderChar = '|';
        $this->borderFormat = '%s';
        $this->cellHeaderFormat = '%s';
        $this->cellRowFormat = '%s';
        $this->paddingChar = ' ';
        $this->padType = STR_PAD_RIGHT;
    }
    /**
     * Renders table to output.
     *
     * Example:
     * +---------------+-----------------------+------------------+
     * | ISBN          | Title                 | Author           |
     * +---------------+-----------------------+------------------+
     * | 99921-58-10-7 | Divine Comedy         | Dante Alighieri  |
     * | 9971-5-0210-0 | A Tale of Two Cities  | Charles Dickens  |
     * | 960-425-059-0 | The Lord of the Rings | J. R. R. Tolkien |
     * +---------------+-----------------------+------------------+
     *
     */
    public function render($out = true){
        if(!$this->rows)
            exit('invalid table content');
        //获得表头行首 +---------------+-----------------------+------------------+
        $output = $this->renderRowSeparator();
        //获取头部输出| ISBN          | Title                 | Author           |
        $output .= $this->renderRow($this->headers, $this->cellHeaderFormat);
        //header存在的话再输出行分割符
        if ($this->headers) {
            $output .= $this->renderRowSeparator();
        }
        //渲染每一行
        foreach ($this->rows as $row) {
            $output .= $this->renderRow($row, $this->cellRowFormat);
        }
        if ($this->rows) {
            $output .= $this->renderRowSeparator();
        }
        if($out){
            exit($output);
        }else{
            $this->cleanup();
            return $output;
        }
    }

    public function renderWitoutHeadTail($out = true){
        if(!$this->rows)
            exit('invalid table content');
        //获取头部输出| ISBN          | Title                 | Author           |
        $output .= $this->renderRow($this->headers, $this->cellHeaderFormat);
        //header存在的话再输出行分割符
        if ($this->headers) {
            $output .= $this->renderRowSeparator();
        }
        //渲染每一行
        foreach ($this->rows as $row) {
            $output .= $this->renderRow($row, $this->cellRowFormat);
        }
        if($out){
            print($output);
        }else{
            $this->cleanup();
            return $output;
        }
    }

    //渲染表格行起始分割行
    private function renderRowSeparator(){
        if (0 === $count = $this->getNumberOfColumns()) {
            return;
        }

        $markup = $this->crossingChar;
        for ($column = 0; $column < $count; $column++) {
            $markup .= str_repeat($this->horizontalBorderChar, $this->getColumnWidth($column))
                    .$this->crossingChar
            ;
        }

        return sprintf($this->borderFormat, $markup).PHP_EOL;
    }

    /**
     * 渲染表格行.
     *
     * Example: | 9971-5-0210-0 | A Tale of Two Cities  | Charles Dickens  |
     *
     * @param array  $row
     * @param string $cellFormat
     */
    private function renderRow(array $row, $cellFormat){
        if (empty($row)) {
            return;
        }

        $output = $this->renderColumnSeparator();
        for ($column = 0, $count = $this->getNumberOfColumns(); $column < $count; $column++) {
            $output .= $this->renderCell($row, $column, $cellFormat);
            $output .= $this->renderColumnSeparator();
        }
        $output .= $this->writeln('');
        return $output;
    }

     /**
     * 带边距的渲染单元格.
     *
     * @param array   $row
     * @param integer $column
     * @param string  $cellFormat
     */
    private function renderCell(array $row, $column, $cellFormat){
        $cell = isset($row[$column]) ? $row[$column] : '';
        return sprintf(
            $cellFormat,
            $this->str_pad(
                $this->paddingChar.$cell.$this->paddingChar,
                $this->getColumnWidth($column),
                $this->paddingChar,
                $this->padType
            )
        );
    }

    /**
     * 渲染水平列分隔符.
     */
    private function renderColumnSeparator(){
        return(sprintf($this->borderFormat, $this->verticalBorderChar));
    }

     /**
     * 获取表格的列数.
     *
     * @return int
     */
    private function getNumberOfColumns() {
        if (null !== $this->numberOfColumns) {
            return $this->numberOfColumns;
        }

        $columns = array(0);
        $columns[] = count($this->headers);
        foreach ($this->rows as $row) {
            $columns[] = count($row);
        }

        return $this->numberOfColumns = max($columns);
    }

     /**
     * 获取列宽.
     *
     * @param integer $column
     *
     * @return int
     */
    private function getColumnWidth($column) {
        if (isset($this->columnWidths[$column])) {
            return $this->columnWidths[$column];
        }

        $lengths = array(0);
        $lengths[] = $this->getCellWidth($this->headers, $column);
        foreach ($this->rows as $row) {
            $lengths[] = $this->getCellWidth($row, $column);
        }

        return $this->columnWidths[$column] = max($lengths) + 2;
    }

    /**
     * 获取单元格宽度.
     *
     * @param array   $row
     * @param integer $column
     *
     * @return int
     */
    private function getCellWidth(array $row, $column) {
        if ($column < 0) {
            return 0;
        }

        if (isset($row[$column])) {
            return $this->strlen($row[$column]);
        }

        return $this->getCellWidth($row, $column - 1);
    }

    /**
     * Returns the length of a string, using mb_strlen if it is available.
     *
     * @param string $string The string to check its length
     *
     * @return integer The length of the string
     */
    protected function strlen($string) {
        // if (!function_exists('mb_strlen')) {
            return (strlen($string) + mb_strlen($string,'UTF8')) / 2;
        // }

        // if (false === $encoding = mb_detect_encoding($string)) {
        //     return strlen($string);
        // }

        // return mb_strlen($string, $encoding);
    }

     /**
     * Called after rendering to cleanup cache data.
     */
    private function cleanup(){
        $this->columnWidths = array();
        $this->numberOfColumns = null;
    }

    public function writeln($line=''){
        return $line.PHP_EOL;
    }

    public function str_pad($input , $pad_length ,$pad_string , $pad_type){
        $strlen = $this->strlen($input);
        if($strlen < $pad_length){
            $difference = $pad_length - $strlen;
            switch ($pad_type) {
                case STR_PAD_RIGHT:
                    return $input . str_repeat($pad_string, $difference);
                    break;
                case STR_PAD_LEFT:
                    return str_repeat($pad_string, $difference) . $input;
                    break;
                default:
                    $left = $difference / 2;
                    $right = $difference - $left;
                    return str_repeat($pad_string, $left) . $input . str_repeat($pad_string, $right);
                    break;
            }
        }else{
            return $input;
        }
    }

    //生成当前数据库指定表的数据字典（字符串）
    public function generate($tableName=''){
    	$this->crossingChar = '|';
    	$out_array = array();
    	$output = '';
    	if($tableName){
    		echo substr($tableName, strlen(C('DB_PREFIX'))).PHP_EOL;
    		$rows = array();
    		$array = M()->query('SHOW FULL COLUMNS FROM '.$tableName);
    		foreach ($array as $key => $value) {
    			$rows[] = array($value['Field'], $value['Type'], $value['Comment']);
    		}

			$this->headers = array('字段','类型','注释');
    		$this->rows = $rows;
    		$this->renderWitoutHeadTail();
    	}
    	echo PHP_EOL;
    }

    public function generateAll(){
    	$tables = M()->query('SHOW TABLE STATUS;');
		$tables = array_column($tables,'Name');
		foreach ($tables as $value) {
			$this->generate($value);
			$this->cleanup();
		}
    }
}