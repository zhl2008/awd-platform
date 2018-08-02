<?php if(!defined('IN_GS')){ die('you cannot load this page directly.'); }


 
class GS_Logging_Class {

        private $_xml;
        private $_xmlfile;
        private $_entry;
  
        function __construct($filename,$logdefaults=true) {
                // check filename, must be .log
                
                if($this->validFilename($filename)){
                    $this->_xmlfile = GSDATAOTHERPATH.'logs/'.$filename;
                    if ( file_exists($this->_xmlfile) )  {
                        $xml = file_get_contents($this->_xmlfile);
                        if($xml) $this->_xml = simplexml_load_string($xml, 'SimpleXMLExtended', LIBXML_NOCDATA);
                        else $this->_xml = new SimpleXMLExtended('<?xml version="1.0" encoding="UTF-8"?><channel></channel>');
                    } else {
                        $this->_xml = new SimpleXMLExtended('<?xml version="1.0" encoding="UTF-8"?><channel></channel>');
                    }
                    
                    // create entry and add date
                    $thislog = $this->_xml->addChild('entry');
                    $thislog->addChild('date', date('r'));                
                    $this->_entry = $thislog;
                    
                    if($logdefaults==true) $this->defaults();  
                }
                else return false;
        }

         /* 
         * Checks valid filenames
         * Filename must have extension .log and not have path info
         *
         * @thows Exception
         * @returns bool success
         * 
         */   
        private static function validFilename($filename){
                $pathinfo=pathinfo($filename);
                if(!isset($pathinfo['extension']) || strtolower($pathinfo['extension']) != 'log' || $pathinfo['dirname']!='.'){
                  throw new Exception("Filename is not valid in GS_Logging_Class");                 
                }  else {
                  return true;
                }
        }
        
        /* 
         * Add default fields to log
         * Adds Username(If logged in),IP Address
         * 
         */   
        private function defaults(){
                GLOBAL $USR;
                
                if(isset($USR)){
                  $cdata = $this->_entry->addChild('Username');
                  $cdata->addCData(htmlentities($USR, ENT_QUOTES));
                }
                
                $cdata = $this->_entry->addChild('IP_Address');
                $ip = getenv("REMOTE_ADDR"); 
                $cdata->addCData(htmlentities($ip, ENT_QUOTES));  
        }

        /* 
         * Save Log Record
         * Writes file
         * 
         * @return success
         */    
        public function save(){
                return XMLsave($this->_xml, $this->_xmlfile);
        }

        /* 
         * Clear Log File
         * Deletes Log File
         * 
         * @return success
         */    
        public function clear(){
                if (is_file($this->_xmlfile)) {
                        $res = unlink($this->_xmlfile);
                        exec_action('logfile_delete');
                        return $res;
                }
        }
        
        /* 
         * Add Log Record Field
         * 
         * @param string $field
         * @param string $value
         *
         * @return success
         */    
        public function add($field,$value){
                if(isset($field) && isset($value) && isset($this->_entry)){
                      $cdata = $this->_entry->addChild(htmlentities($field, ENT_QUOTES));
                      $cdata->addCData(safe_slash_html($value));
                }  
        }
  
} // end of class                   

?>