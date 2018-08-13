<?php
namespace Common\Ext;

class FirePHP
{
	const VERSION = '1.0b1rc1';
	const LOG = 'LOG';
	const INFO = 'INFO';
	const WARN = 'WARN';
	const ERROR = 'ERROR';
	const DUMP = 'DUMP';
	const TRACE = 'TRACE';
	const EXCEPTION = 'EXCEPTION';
	const TABLE = 'TABLE';
	const GROUP_START = 'GROUP_START';
	const GROUP_END = 'GROUP_END';

	/**
		 * Singleton instance of FirePHP
		 * @var FirePHP
		 */
	static protected $instance;
	/**
		 * Flag whether we are logging from within the exception handler
		 * @var boolean
		 */
	protected $inExceptionHandler = false;
	/**
		 * Flag whether to throw PHP errors that have been converted to ErrorExceptions
		 * @var boolean
		 */
	protected $throwErrorExceptions = true;
	/**
		 * Flag whether to convert PHP assertion errors to Exceptions
		 * @var boolean
		 */
	protected $convertAssertionErrorsToExceptions = true;
	/**
		 * Flag whether to throw PHP assertion errors that have been converted to Exceptions
		 * @var boolean
		 */
	protected $throwAssertionExceptions = false;
	/**
		 * Wildfire protocol message index
		 * @var integer
		 */
	protected $messageIndex = 1;
	/**
		 * Options for the library
		 * @var array
		 */
	protected $options = array('maxDepth' => 10, 'maxObjectDepth' => 5, 'maxArrayDepth' => 5, 'useNativeJsonEncode' => true, 'includeLineNumbers' => true);
	/**
		 * Filters used to exclude object members when encoding
		 * @var array
		 */
	protected $objectFilters = array(
		'firephp'            => array('objectStack', 'instance', 'json_objectStack'),
		'firephp_test_class' => array('objectStack', 'instance', 'json_objectStack')
		);
	/**
		 * A stack of objects used to detect recursion during object encoding
		 * @var object
		 */
	protected $objectStack = array();
	/**
		 * Flag to enable/disable logging
		 * @var boolean
		 */
	protected $enabled = true;
	/**
		 * The insight console to log to if applicable
		 * @var object
		 */
	protected $logToInsightConsole;
	/**
		 * Keep a list of objects as we descend into the array so we can detect recursion.
		 */
	private $json_objectStack = array();

	public function __sleep()
	{
		return array('options', 'objectFilters', 'enabled');
	}

	static public function getInstance($autoCreate = false)
	{
		if (($autoCreate === true) && !self::$instance) {
			self::init();
		}

		return self::$instance;
	}

	static public function init()
	{
		return self::setInstance(new self());
	}

	static public function setInstance($instance)
	{
		return self::$instance = $instance;
	}

	public function setLogToInsightConsole($console)
	{
		if (is_string($console)) {
			if ((get_class($this) != 'FirePHP_Insight') && !is_subclass_of($this, 'FirePHP_Insight')) {
				throw new Exception('FirePHP instance not an instance or subclass of FirePHP_Insight!');
			}

			$this->logToInsightConsole = $this->to('request')->console($console);
		}
		else {
			$this->logToInsightConsole = $console;
		}
	}

	public function setEnabled($enabled)
	{
		$this->enabled = $enabled;
	}

	public function getEnabled()
	{
		return $this->enabled;
	}

	public function setObjectFilter($class, $filter)
	{
		$this->objectFilters[strtolower($class)] = $filter;
	}

	public function setOptions($options)
	{
		$this->options = array_merge($this->options, $options);
	}

	public function getOptions()
	{
		return $this->options;
	}

	public function setOption($name, $value)
	{
		if (!isset($this->options[$name])) {
		}

		$this->options[$name] = $value;
	}

	public function getOption($name)
	{
		if (!isset($this->options[$name])) {
		}

		return $this->options[$name];
	}

	public function registerErrorHandler($throwErrorExceptions = false)
	{
		$this->throwErrorExceptions = $throwErrorExceptions;
		return set_error_handler(array($this, 'errorHandler'));
	}

	public function errorHandler($errno, $errstr, $errfile, $errline, $errcontext)
	{
		if (error_reporting() == 0) {
			return NULL;
		}

		if (error_reporting() & $errno) {
			$exception = new ErrorException($errstr, 0, $errno, $errfile, $errline);

			if ($this->throwErrorExceptions) {
				throw $exception;
			}
			else {
				$this->fb($exception);
			}
		}
	}

	public function registerExceptionHandler()
	{
		return set_exception_handler(array($this, 'exceptionHandler'));
	}

	public function exceptionHandler($exception)
	{
		$this->inExceptionHandler = true;
		header('HTTP/1.1 500 Internal Server Error');

		try {
			$this->fb($exception);
		}
		catch (Exception $e) {
			echo 'We had an exception: ' . $e;
		}

		$this->inExceptionHandler = false;
	}

	public function registerAssertionHandler($convertAssertionErrorsToExceptions = true, $throwAssertionExceptions = false)
	{
		$this->convertAssertionErrorsToExceptions = $convertAssertionErrorsToExceptions;
		$this->throwAssertionExceptions = $throwAssertionExceptions;
		if ($throwAssertionExceptions && !$convertAssertionErrorsToExceptions) {
		}

		return assert_options(ASSERT_CALLBACK, array($this, 'assertionHandler'));
	}

	public function assertionHandler($file, $line, $code)
	{
		if ($this->convertAssertionErrorsToExceptions) {
			$exception = new ErrorException('Assertion Failed - Code[ ' . $code . ' ]', 0, null, $file, $line);

			if ($this->throwAssertionExceptions) {
				throw $exception;
			}
			else {
				$this->fb($exception);
			}
		}
		else {
			$this->fb($code, 'Assertion Failed', FirePHP::ERROR, array('File' => $file, 'Line' => $line));
		}
	}

	public function group($name, $options = NULL)
	{
		if (!$name) {
		}

		if ($options) {
			if (!is_array($options)) {
			}

			if (array_key_exists('Collapsed', $options)) {
				$options['Collapsed'] = $options['Collapsed'] ? 'true' : 'false';
			}
		}

		return $this->fb(null, $name, FirePHP::GROUP_START, $options);
	}

	public function groupEnd()
	{
		return $this->fb(null, null, FirePHP::GROUP_END);
	}

	public function log($object, $label = NULL, $options = array())
	{
		return $this->fb($object, $label, FirePHP::LOG, $options);
	}

	public function info($object, $label = NULL, $options = array())
	{
		return $this->fb($object, $label, FirePHP::INFO, $options);
	}

	public function warn($object, $label = NULL, $options = array())
	{
		return $this->fb($object, $label, FirePHP::WARN, $options);
	}

	public function error($object, $label = NULL, $options = array())
	{
		return $this->fb($object, $label, FirePHP::ERROR, $options);
	}

	public function dump($key, $variable, $options = array())
	{
		if (!is_string($key)) {
		}

		if (100 < strlen($key)) {
		}

		if (!preg_match_all('/^[a-zA-Z0-9-_\\.:]*$/', $key, $m)) {
		}

		return $this->fb($variable, $key, FirePHP::DUMP, $options);
	}

	public function trace($label)
	{
		return $this->fb($label, FirePHP::TRACE);
	}

	public function table($label, $table, $options = array())
	{
		return $this->fb($table, $label, FirePHP::TABLE, $options);
	}

	static public function to()
	{
		$instance = self::getInstance();

		if (!method_exists($instance, '_to')) {
			throw new Exception('FirePHP::to() implementation not loaded');
		}

		$args = func_get_args();
		return call_user_func_array(array($instance, '_to'), $args);
	}

	static public function plugin()
	{
		$instance = self::getInstance();

		if (!method_exists($instance, '_plugin')) {
			throw new Exception('FirePHP::plugin() implementation not loaded');
		}

		$args = func_get_args();
		return call_user_func_array(array($instance, '_plugin'), $args);
	}

	public function detectClientExtension()
	{
		if (@preg_match_all('/\\sFirePHP\\/([\\.\\d]*)\\s?/si', $this->getUserAgent(), $m) && version_compare($m[1][0], '0.0.6', '>=')) {
			return true;
		}
		else {
			if (@preg_match_all('/^([\\.\\d]*)$/si', $this->getRequestHeader('X-FirePHP-Version'), $m) && version_compare($m[1][0], '0.0.6', '>=')) {
				return true;
			}
		}

		return false;
	}

	public function fb($object)
	{
		if ($this instanceof FirePHP_Insight && method_exists($this, '_logUpgradeClientMessage')) {
			if (!FirePHP_Insight::$upgradeClientMessageLogged) {
				$this->_logUpgradeClientMessage();
			}
		}

		static $insightGroupStack = array();

		if (!$this->getEnabled()) {
			return false;
		}

		if ($this->headersSent($filename, $linenum)) {
			if ($this->inExceptionHandler) {
				echo '<div style="border: 2px solid red; font-family: Arial; font-size: 12px; background-color: lightgray; padding: 5px;"><span style="color: red; font-weight: bold;">FirePHP ERROR:</span> Headers already sent in <b>' . $filename . '</b> on line <b>' . $linenum . '</b>. Cannot send log data to FirePHP. You must have Output Buffering enabled via ob_start() or output_buffering ini directive.</div>';
			}
		}

		$type = null;
		$label = null;
		$options = array();

		if (func_num_args() == 1) {
		}
		else if (func_num_args() == 2) {
			switch (func_get_arg(1)) {
			case self::LOG:
			case self::INFO:
			case self::WARN:
			case self::ERROR:
			case self::DUMP:
			case self::TRACE:
			case self::EXCEPTION:
			case self::TABLE:
			case self::GROUP_START:
			case self::GROUP_END:
				$type = func_get_arg(1);
				break;

			default:
				$label = func_get_arg(1);
				break;
			}
		}
		else if (func_num_args() == 3) {
			$type = func_get_arg(2);
			$label = func_get_arg(1);
		}
		else if (func_num_args() == 4) {
			$type = func_get_arg(2);
			$label = func_get_arg(1);
			$options = func_get_arg(3);
		}

		if (($this->logToInsightConsole !== null) && ((get_class($this) == 'FirePHP_Insight') || is_subclass_of($this, 'FirePHP_Insight'))) {
			$trace = debug_backtrace();

			if (!$trace) {
				return false;
			}

			for ($i = 0; $i < sizeof($trace); $i++) {
				if (isset($trace[$i]['class'])) {
					if (($trace[$i]['class'] == 'FirePHP') || ($trace[$i]['class'] == 'FB')) {
						continue;
					}
				}

				if (isset($trace[$i]['file'])) {
					$path = $this->_standardizePath($trace[$i]['file']);
					if ((substr($path, -18, 18) == 'FirePHPCore/fb.php') || (substr($path, -29, 29) == 'FirePHPCore/FirePHP.class.php')) {
						continue;
					}
				}

				if (isset($trace[$i]['function']) && ($trace[$i]['function'] == 'fb') && isset($trace[$i - 1]['file']) && (substr($this->_standardizePath($trace[$i - 1]['file']), -18, 18) == 'FirePHPCore/fb.php')) {
					continue;
				}

				if (isset($trace[$i]['class']) && ($trace[$i]['class'] == 'FB') && isset($trace[$i - 1]['file']) && (substr($this->_standardizePath($trace[$i - 1]['file']), -18, 18) == 'FirePHPCore/fb.php')) {
					continue;
				}

				break;
			}

			$msg = $this->logToInsightConsole->option('encoder.trace.offsetAdjustment', $i);

			if ($object instanceof Exception) {
				$type = self::EXCEPTION;
			}

			if ($label && ($type != self::TABLE) && ($type != self::GROUP_START)) {
				$msg = $msg->label($label);
			}

			switch ($type) {
			case self::DUMP:
			case self::LOG:
				return $msg->log($object);
			case self::INFO:
				return $msg->info($object);
			case self::WARN:
				return $msg->warn($object);
			case self::ERROR:
				return $msg->error($object);
			case self::TRACE:
				return $msg->trace($object);
			case self::EXCEPTION:
				return $this->plugin('error')->handleException($object, $msg);
			case self::TABLE:
				if (isset($object[0]) && !is_string($object[0]) && $label) {
					$object = array($label, $object);
				}

				return $msg->table($object[0], array_slice($object[1], 1), $object[1][0]);
			case self::GROUP_START:
				$insightGroupStack[] = $msg->group(md5($label))->open();
				return $msg->log($label);
			case self::GROUP_END:
				if (count($insightGroupStack) == 0) {
					throw new Error('Too many groupEnd() as opposed to group() calls!');
				}

				$group = array_pop($insightGroupStack);
				return $group->close();
			default:
				return $msg->log($object);
			}
		}

		if (!$this->detectClientExtension()) {
			return false;
		}

		$meta = array();
		$skipFinalObjectEncode = false;

		if ($object instanceof Exception) {
			$meta['file'] = $this->_escapeTraceFile($object->getFile());
			$meta['line'] = $object->getLine();
			$trace = $object->getTrace();
			if ($object instanceof ErrorException && isset($trace[0]['function']) && ($trace[0]['function'] == 'errorHandler') && isset($trace[0]['class']) && ($trace[0]['class'] == 'FirePHP')) {
				$severity = false;

				switch ($object->getSeverity()) {
				case E_WARNING:
					$severity = 'E_WARNING';
					break;

				case E_NOTICE:
					$severity = 'E_NOTICE';
					break;

				case E_USER_ERROR:
					$severity = 'E_USER_ERROR';
					break;

				case E_USER_WARNING:
					$severity = 'E_USER_WARNING';
					break;

				case E_USER_NOTICE:
					$severity = 'E_USER_NOTICE';
					break;

				case E_STRICT:
					$severity = 'E_STRICT';
					break;

				case E_RECOVERABLE_ERROR:
					$severity = 'E_RECOVERABLE_ERROR';
					break;

				case E_DEPRECATED:
					$severity = 'E_DEPRECATED';
					break;

				case E_USER_DEPRECATED:
					$severity = 'E_USER_DEPRECATED';
					break;
				}

				$object = array('Class' => get_class($object), 'Message' => $severity . ': ' . $object->getMessage(), 'File' => $this->_escapeTraceFile($object->getFile()), 'Line' => $object->getLine(), 'Type' => 'trigger', 'Trace' => $this->_escapeTrace(array_splice($trace, 2)));
				$skipFinalObjectEncode = true;
			}
			else {
				$object = array('Class' => get_class($object), 'Message' => $object->getMessage(), 'File' => $this->_escapeTraceFile($object->getFile()), 'Line' => $object->getLine(), 'Type' => 'throw', 'Trace' => $this->_escapeTrace($trace));
				$skipFinalObjectEncode = true;
			}

			$type = self::EXCEPTION;
		}
		else if ($type == self::TRACE) {
			$trace = debug_backtrace();

			if (!$trace) {
				return false;
			}

			for ($i = 0; $i < sizeof($trace); $i++) {
				if (isset($trace[$i]['class']) && isset($trace[$i]['file']) && (($trace[$i]['class'] == 'FirePHP') || ($trace[$i]['class'] == 'FB')) && ((substr($this->_standardizePath($trace[$i]['file']), -18, 18) == 'FirePHPCore/fb.php') || (substr($this->_standardizePath($trace[$i]['file']), -29, 29) == 'FirePHPCore/FirePHP.class.php'))) {
				}
				else {
					if (isset($trace[$i]['class']) && isset($trace[$i + 1]['file']) && ($trace[$i]['class'] == 'FirePHP') && (substr($this->_standardizePath($trace[$i + 1]['file']), -18, 18) == 'FirePHPCore/fb.php')) {
					}
					else {
						if (($trace[$i]['function'] == 'fb') || ($trace[$i]['function'] == 'trace') || ($trace[$i]['function'] == 'send')) {
							$object = array('Class' => isset($trace[$i]['class']) ? $trace[$i]['class'] : '', 'Type' => isset($trace[$i]['type']) ? $trace[$i]['type'] : '', 'Function' => isset($trace[$i]['function']) ? $trace[$i]['function'] : '', 'Message' => $trace[$i]['args'][0], 'File' => isset($trace[$i]['file']) ? $this->_escapeTraceFile($trace[$i]['file']) : '', 'Line' => isset($trace[$i]['line']) ? $trace[$i]['line'] : '', 'Args' => isset($trace[$i]['args']) ? $this->encodeObject($trace[$i]['args']) : '', 'Trace' => $this->_escapeTrace(array_splice($trace, $i + 1)));
							$skipFinalObjectEncode = true;
							$meta['file'] = isset($trace[$i]['file']) ? $this->_escapeTraceFile($trace[$i]['file']) : '';
							$meta['line'] = isset($trace[$i]['line']) ? $trace[$i]['line'] : '';
							break;
						}
					}
				}
			}
		}
		else if ($type == self::TABLE) {
			if (isset($object[0]) && is_string($object[0])) {
				$object[1] = $this->encodeTable($object[1]);
			}
			else {
				$object = $this->encodeTable($object);
			}

			$skipFinalObjectEncode = true;
		}
		else if ($type == self::GROUP_START) {
			if (!$label) {
			}
		}
		else if ($type === null) {
			$type = self::LOG;
		}

		if ($this->options['includeLineNumbers']) {
			if (!isset($meta['file']) || !isset($meta['line'])) {
				$trace = debug_backtrace();

				for ($i = 0; $i < sizeof($trace); $i++) {
					$skip = array('FirePHP' => '/FirePHP.class.php', 'FB' => '/fb.php', 'BaseModelDebug' => '/BaseModelDebug.php', 'BaseModelCommon' => '/BaseModelCommon.php', 'BaseModelDB' => '/BaseModelDB.php', 'BaseModelHttp' => '/BaseModelHttp.php');
					if (isset($trace[$i]['class']) && isset($trace[$i]['file']) && in_array($trace[$i]['class'], array_keys($skip), true) && in_array(strrchr($this->_standardizePath($trace[$i]['file']), '/'), $skip, true)) {
					}
					else {
						if (isset($trace[$i]['class']) && isset($trace[$i + 1]['file']) && in_array($trace[$i]['class'], array_keys($skip), true) && in_array(strrchr($this->_standardizePath($trace[$i + 1]['file']), '/'), $skip, true)) {
						}
						else {
							if (isset($trace[$i]['file']) && in_array(strrchr($this->_standardizePath($trace[$i]['file']), '/'), $skip, true)) {
							}
							else {
								$meta['file'] = isset($trace[$i]['file']) ? $this->_escapeTraceFile($trace[$i]['file']) : '';
								$meta['line'] = isset($trace[$i]['line']) ? $trace[$i]['line'] : '';
								break;
							}
						}
					}
				}
			}
		}
		else {
			unset($meta['file']);
			unset($meta['line']);
		}

		$this->setHeader('X-Wf-Protocol-1', 'http://meta.wildfirehq.org/Protocol/JsonStream/0.2');
		$this->setHeader('X-Wf-1-Plugin-1', 'http://meta.firephp.org/Wildfire/Plugin/FirePHP/Library-FirePHPCore/' . self::VERSION);
		$structureIndex = 1;

		if ($type == self::DUMP) {
			$structureIndex = 2;
			$this->setHeader('X-Wf-1-Structure-2', 'http://meta.firephp.org/Wildfire/Structure/FirePHP/Dump/0.1');
		}
		else {
			$this->setHeader('X-Wf-1-Structure-1', 'http://meta.firephp.org/Wildfire/Structure/FirePHP/FirebugConsole/0.1');
		}

		if ($type == self::DUMP) {
			$msg = '{"' . $label . '":' . $this->jsonEncode($object, $skipFinalObjectEncode) . '}';
		}
		else {
			$msgMeta = $options;
			$msgMeta['Type'] = $type;

			if ($label !== null) {
				$msgMeta['Label'] = $label;
			}

			if (isset($meta['file']) && !isset($msgMeta['File'])) {
				$msgMeta['File'] = $meta['file'];
			}

			if (isset($meta['line']) && !isset($msgMeta['Line'])) {
				$msgMeta['Line'] = $meta['line'];
			}

			$msg = '[' . $this->jsonEncode($msgMeta) . ',' . $this->jsonEncode($object, $skipFinalObjectEncode) . ']';
		}

		$parts = explode("\n", chunk_split($msg, 5000, "\n"));

		for ($i = 0; $i < count($parts); $i++) {
			$part = $parts[$i];

			if ($part) {
				if (2 < count($parts)) {
					$this->setHeader('X-Wf-1-' . $structureIndex . '-' . '1-' . $this->messageIndex, ($i == 0 ? strlen($msg) : '') . '|' . $part . '|' . ($i < (count($parts) - 2) ? '\\' : ''));
				}
				else {
					$this->setHeader('X-Wf-1-' . $structureIndex . '-' . '1-' . $this->messageIndex, strlen($part) . '|' . $part . '|');
				}

				$this->messageIndex++;

				if (99999 < $this->messageIndex) {
				}
			}
		}

		$this->setHeader('X-Wf-1-Index', $this->messageIndex - 1);
		return true;
	}

	protected function _standardizePath($path)
	{
		return preg_replace('/\\\\+/', '/', $path);
	}

	protected function _escapeTrace($trace)
	{
		if (!$trace) {
			return $trace;
		}

		for ($i = 0; $i < sizeof($trace); $i++) {
			if (isset($trace[$i]['file'])) {
				$trace[$i]['file'] = $this->_escapeTraceFile($trace[$i]['file']);
			}

			if (isset($trace[$i]['args'])) {
				$trace[$i]['args'] = $this->encodeObject($trace[$i]['args']);
			}
		}

		return $trace;
	}

	protected function _escapeTraceFile($file)
	{
		if (strpos($file, '\\')) {
			$file = preg_replace('/\\\\+/', '\\', $file);
			return $file;
		}

		return $file;
	}

	protected function headersSent(&$filename, &$linenum)
	{
		return headers_sent($filename, $linenum);
	}

	protected function setHeader($name, $value)
	{
		return @header($name . ': ' . $value);
	}

	protected function getUserAgent()
	{
		if (!isset($_SERVER['HTTP_USER_AGENT'])) {
			return false;
		}

		return $_SERVER['HTTP_USER_AGENT'];
	}

	static public function getAllRequestHeaders()
	{
		static $_cachedHeaders = false;

		if ($_cachedHeaders !== false) {
			return $_cachedHeaders;
		}

		$headers = array();

		if (function_exists('getallheaders')) {
			foreach (getallheaders() as $name => $value) {
				$headers[strtolower($name)] = $value;
			}
		}
		else {
			foreach ($_SERVER as $name => $value) {
				if (substr($name, 0, 5) == 'HTTP_') {
					$headers[strtolower(str_replace(' ', '-', str_replace('_', ' ', substr($name, 5))))] = $value;
				}
			}
		}

		return $_cachedHeaders = $headers;
	}

	protected function getRequestHeader($name)
	{
		$headers = self::getAllRequestHeaders();

		if (isset($headers[strtolower($name)])) {
			return $headers[strtolower($name)];
		}

		return false;
	}

	protected function newException($message)
	{
	}

	public function jsonEncode($object, $skipObjectEncode = false)
	{
		if (!$skipObjectEncode) {
			$object = $this->encodeObject($object);
		}

		if (function_exists('json_encode') && ($this->options['useNativeJsonEncode'] != false)) {
			return json_encode($object);
		}
		else {
			return $this->json_encode($object);
		}
	}

	protected function encodeTable($table)
	{
		if (!$table) {
			return $table;
		}

		$newTable = array();

		foreach ($table as $row) {
			if (is_array($row)) {
				$newRow = array();

				foreach ($row as $item) {
					$newRow[] = $this->encodeObject($item);
				}

				$newTable[] = $newRow;
			}
		}

		return $newTable;
	}

	protected function encodeObject($object, $objectDepth = 1, $arrayDepth = 1, $maxDepth = 1)
	{
		if ($this->options['maxDepth'] < $maxDepth) {
			return '** Max Depth (' . $this->options['maxDepth'] . ') **';
		}

		$return = array();

		if (is_resource($object)) {
			return '** ' . (string) $object . ' **';
		}
		else if (is_object($object)) {
			if ($this->options['maxObjectDepth'] < $objectDepth) {
				return '** Max Object Depth (' . $this->options['maxObjectDepth'] . ') **';
			}

			foreach ($this->objectStack as $refVal) {
				if ($refVal === $object) {
					return '** Recursion (' . get_class($object) . ') **';
				}
			}

			array_push($this->objectStack, $object);
			$return['__className'] = $class = get_class($object);
			$classLower = strtolower($class);
			$reflectionClass = new ReflectionClass($class);
			$properties = array();

			foreach ($reflectionClass->getProperties() as $property) {
				$properties[$property->getName()] = $property;
			}

			$members = (array) $object;

			foreach ($properties as $plainName => $property) {
				$name = $rawName = $plainName;

				if ($property->isStatic()) {
					$name = 'static:' . $name;
				}

				if ($property->isPublic()) {
					$name = 'public:' . $name;
				}
				else if ($property->isPrivate()) {
					$name = 'private:' . $name;
					$rawName = "\x00" . $class . "\x00" . $rawName;
				}
				else if ($property->isProtected()) {
					$name = 'protected:' . $name;
					$rawName = "\x00" . '*' . "\x00" . $rawName;
				}

				if (!(isset($this->objectFilters[$classLower]) && is_array($this->objectFilters[$classLower]) && in_array($plainName, $this->objectFilters[$classLower]))) {
					if (array_key_exists($rawName, $members) && !$property->isStatic()) {
						$return[$name] = $this->encodeObject($members[$rawName], $objectDepth + 1, 1, $maxDepth + 1);
					}
					else if (method_exists($property, 'setAccessible')) {
						$property->setAccessible(true);
						$return[$name] = $this->encodeObject($property->getValue($object), $objectDepth + 1, 1, $maxDepth + 1);
					}
					else if ($property->isPublic()) {
						$return[$name] = $this->encodeObject($property->getValue($object), $objectDepth + 1, 1, $maxDepth + 1);
					}
					else {
						$return[$name] = '** Need PHP 5.3 to get value **';
					}
				}
				else {
					$return[$name] = '** Excluded by Filter **';
				}
			}

			foreach ($members as $rawName => $value) {
				$name = $rawName;

				if ($name[0] == "\x00") {
					$parts = explode("\x00", $name);
					$name = $parts[2];
				}

				$plainName = $name;

				if (!isset($properties[$name])) {
					$name = 'undeclared:' . $name;
					if (!(isset($this->objectFilters[$classLower]) && is_array($this->objectFilters[$classLower]) && in_array($plainName, $this->objectFilters[$classLower]))) {
						$return[$name] = $this->encodeObject($value, $objectDepth + 1, 1, $maxDepth + 1);
					}
					else {
						$return[$name] = '** Excluded by Filter **';
					}
				}
			}

			array_pop($this->objectStack);
		}
		else if (is_array($object)) {
			if ($this->options['maxArrayDepth'] < $arrayDepth) {
				return '** Max Array Depth (' . $this->options['maxArrayDepth'] . ') **';
			}

			foreach ($object as $key => $val) {
				if (($key == 'GLOBALS') && is_array($val) && array_key_exists('GLOBALS', $val)) {
					$val['GLOBALS'] = '** Recursion (GLOBALS) **';
				}

				if (!$this->is_utf8($key)) {
					$key = utf8_encode($key);
				}

				$return[$key] = $this->encodeObject($val, 1, $arrayDepth + 1, $maxDepth + 1);
			}
		}
		else if ($this->is_utf8($object)) {
			return $object;
		}
		else {
			return utf8_encode($object);
		}

		return $return;
	}

	protected function is_utf8($str)
	{
		if (function_exists('mb_detect_encoding')) {
			return (mb_detect_encoding($str, 'UTF-8', true) == 'UTF-8') && (($str === null) || ($this->jsonEncode($str, true) !== 'null'));
		}

		$c = 0;
		$b = 0;
		$bits = 0;
		$len = strlen($str);

		for ($i = 0; $i < $len; $i++) {
			$c = ord($str[$i]);

			if (128 < $c) {
				if (254 <= $c) {
					return false;
				}
				else if (252 <= $c) {
					$bits = 6;
				}
				else if (248 <= $c) {
					$bits = 5;
				}
				else if (240 <= $c) {
					$bits = 4;
				}
				else if (224 <= $c) {
					$bits = 3;
				}
				else if (192 <= $c) {
					$bits = 2;
				}
				else {
					return false;
				}

				if ($len < ($i + $bits)) {
					return false;
				}

				while (1 < $bits) {
					$i++;
					$b = ord($str[$i]);
					if (($b < 128) || (191 < $b)) {
						return false;
					}

					$bits--;
				}
			}
		}

		return ($str === null) || ($this->jsonEncode($str, true) !== 'null');
	}

	private function json_utf82utf16($utf8)
	{
		if (function_exists('mb_convert_encoding')) {
			return mb_convert_encoding($utf8, 'UTF-16', 'UTF-8');
		}

		switch (strlen($utf8)) {
		case 1:
			return $utf8;
		case 2:
			return chr(7 & (ord($utf8[0]) >> 2)) . chr((192 & (ord($utf8[0]) << 6)) | (63 & ord($utf8[1])));
		case 3:
			return chr((240 & (ord($utf8[0]) << 4)) | (15 & (ord($utf8[1]) >> 2))) . chr((192 & (ord($utf8[1]) << 6)) | (127 & ord($utf8[2])));
		}

		return '';
	}

	private function json_encode($var)
	{
		if (is_object($var)) {
			if (in_array($var, $this->json_objectStack)) {
				return '"** Recursion **"';
			}
		}

		switch (gettype($var)) {
		case 'boolean':
			return $var ? 'true' : 'false';
		case 'NULL':
			return 'null';
		case 'integer':
			return (int) $var;
		case 'double':
		case 'float':
			return (double) $var;
		case 'string':
			$ascii = '';
			$strlen_var = strlen($var);

			for ($c = 0; $c < $strlen_var; ++$c) {
				$ord_var_c = ord($var[$c]);

				switch (true) {
				case $ord_var_c == 8:
					$ascii .= '\\b';
					break;

				case $ord_var_c == 9:
					$ascii .= '\\t';
					break;

				case $ord_var_c == 10:
					$ascii .= '\\n';
					break;

				case $ord_var_c == 12:
					$ascii .= '\\f';
					break;

				case $ord_var_c == 13:
					$ascii .= '\\r';
					break;

				case $ord_var_c == 34:
				case $ord_var_c == 47:
				case $ord_var_c == 92:
					$ascii .= '\\' . $var[$c];
					break;

				case $ord_var_c <= 127:
					$ascii .= $var[$c];
					break;

				case ($ord_var_c & 224) == 192:
					$char = pack('C*', $ord_var_c, ord($var[$c + 1]));
					$c += 1;
					$utf16 = $this->json_utf82utf16($char);
					$ascii .= sprintf('\\u%04s', bin2hex($utf16));
					break;

				case ($ord_var_c & 240) == 224:
					$char = pack('C*', $ord_var_c, ord($var[$c + 1]), ord($var[$c + 2]));
					$c += 2;
					$utf16 = $this->json_utf82utf16($char);
					$ascii .= sprintf('\\u%04s', bin2hex($utf16));
					break;

				case ($ord_var_c & 248) == 240:
					$char = pack('C*', $ord_var_c, ord($var[$c + 1]), ord($var[$c + 2]), ord($var[$c + 3]));
					$c += 3;
					$utf16 = $this->json_utf82utf16($char);
					$ascii .= sprintf('\\u%04s', bin2hex($utf16));
					break;

				case ($ord_var_c & 252) == 248:
					$char = pack('C*', $ord_var_c, ord($var[$c + 1]), ord($var[$c + 2]), ord($var[$c + 3]), ord($var[$c + 4]));
					$c += 4;
					$utf16 = $this->json_utf82utf16($char);
					$ascii .= sprintf('\\u%04s', bin2hex($utf16));
					break;

				case ($ord_var_c & 254) == 252:
					$char = pack('C*', $ord_var_c, ord($var[$c + 1]), ord($var[$c + 2]), ord($var[$c + 3]), ord($var[$c + 4]), ord($var[$c + 5]));
					$c += 5;
					$utf16 = $this->json_utf82utf16($char);
					$ascii .= sprintf('\\u%04s', bin2hex($utf16));
					break;
				}
			}

			return '"' . $ascii . '"';
		case 'array':
			if (is_array($var) && count($var) && (array_keys($var) !== range(0, sizeof($var) - 1))) {
				$this->json_objectStack[] = $var;
				$properties = array_map(array($this, 'json_name_value'), array_keys($var), array_values($var));
				array_pop($this->json_objectStack);

				foreach ($properties as $property) {
					if ($property instanceof Exception) {
						return $property;
					}
				}

				return '{' . join(',', $properties) . '}';
			}

			$this->json_objectStack[] = $var;
			$elements = array_map(array($this, 'json_encode'), $var);
			array_pop($this->json_objectStack);

			foreach ($elements as $element) {
				if ($element instanceof Exception) {
					return $element;
				}
			}

			return '[' . join(',', $elements) . ']';
		case 'object':
			$vars = self::encodeObject($var);
			$this->json_objectStack[] = $var;
			$properties = array_map(array($this, 'json_name_value'), array_keys($vars), array_values($vars));
			array_pop($this->json_objectStack);

			foreach ($properties as $property) {
				if ($property instanceof Exception) {
					return $property;
				}
			}

			return '{' . join(',', $properties) . '}';
		default:
			return null;
		}
	}

	private function json_name_value($name, $value)
	{
		if (($name == 'GLOBALS') && is_array($value) && array_key_exists('GLOBALS', $value)) {
			$value['GLOBALS'] = '** Recursion **';
		}

		$encodedValue = $this->json_encode($value);

		if ($encodedValue instanceof Exception) {
			return $encodedValue;
		}

		return $this->json_encode(strval($name)) . ':' . $encodedValue;
	}

	public function setProcessorUrl($URL)
	{
		trigger_error('The FirePHP::setProcessorUrl() method is no longer supported', E_USER_DEPRECATED);
	}

	public function setRendererUrl($URL)
	{
		trigger_error('The FirePHP::setRendererUrl() method is no longer supported', E_USER_DEPRECATED);
	}
}

if (!defined('E_STRICT')) {
	define('E_STRICT', 2048);
}

if (!defined('E_RECOVERABLE_ERROR')) {
	define('E_RECOVERABLE_ERROR', 4096);
}

if (!defined('E_DEPRECATED')) {
	define('E_DEPRECATED', 8192);
}

if (!defined('E_USER_DEPRECATED')) {
	define('E_USER_DEPRECATED', 16384);
}

?>
