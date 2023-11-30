<?php
/**
 * Class and Function List:
 * Function list:
 * - __construct()
 * - export()
 * - encode()
 * - decode()
 * - _convert_null()
 * Classes list:
 * - Json
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Json
{
	public $data;

	public function __construct()
	{
		$this->data = NULL;
	}

	public function export()
	{
		$this->data = $this->_convert_null($this->data);
		$this->data = $this->encode($this->data);
		$result = NULL;
		$level = 0;
		$prev_char = NULL;
		$in_quotes = false;
		$ends_line_level = NULL;
		$json_length = strlen($this->data);

		for ($i = 0; $i < $json_length; $i++)
		{
			$char = $this->data[$i];
			$new_line_level = NULL;
			$post = NULL;

			if ($ends_line_level !== NULL)
			{
				$new_line_level = $ends_line_level;
				$ends_line_level = NULL;
			}

			if ($char === '"' && $prev_char != '\\')
			{
				$in_quotes = !$in_quotes;
			}
			else if (!$in_quotes)
			{
				switch ($char)
				{
					case '}':
					case ']':
						$level--;
						$ends_line_level = NULL;
						$new_line_level = $level;
						break;

					case '{':
					case '[':
						$level++;
					case ',':
						$ends_line_level = $level;
						break;

					case ':':
						$post = " ";
						break;

					case " ":
					case "\t":
					case "\n":
					case "\r":
						$char = NULL;
						$ends_line_level = $new_line_level;
						$new_line_level = NULL;
						break;
				}
			}

			if ($new_line_level !== NULL)
			{
				$result.= "\n" . str_repeat("\t", $new_line_level);
			}

			$result.= $char . $post;
			$prev_char = $char;
		}

		return $result;
	}

	public function encode($data = Array())
	{
		if (is_null($data))
		{
			return '""';
		}
		if ($data === FALSE)
		{
			return 'false';
		}
		if ($data === TRUE)
		{
			return 'true';
		}
		if (is_scalar($data))
		{
			if (is_float($data))
			{
				return floatval(str_replace(",", ".", strval($data)));
			}

			if (is_string($data))
			{
				static $jsonReplaces = array(
					array(
						"\\",
						"/",
						"\t",
						"\n",
						"\r",
						"\b",
						"\f",
						'"'
					) ,
					array(
						'\\\\',
						'\/',
						'',
						'',
						'',
						'\\b',
						'\\f',
						'\"'
					)
				);
				return '"' . str_replace($jsonReplaces[0], $jsonReplaces[1], $data) . '"';
			}
			else
			{
				return $data;
			}
		}
		$isList = TRUE;
		for ($i = 0, reset($data); $i < count($data); $i++, next($data))
		{
			if (key($data) !== $i)
			{
				$isList = FALSE;
				break;
			}
		}
		$result = array();
		if ($isList)
		{
			foreach ($data as $value) $result[] = $this->encode($value);
			return '[' . join(',', $result) . ']';
		}
		else
		{
			foreach ($data as $key => $value) $result[] = $this->encode($key) . ':' . $this->encode($value);
			return '{' . join(',', $result) . '}';
		}
	}

	public function decode($data, $assoc = TRUE)
	{
		return json_decode($data, $assoc);
	}

	private function _convert_null($obj)
	{
		$arrObj = is_object($obj) ? get_object_vars($obj) : $obj;
		foreach ($arrObj as $key => $val)
		{
			$val = (is_array($val) || is_object($val)) ? $this->_convert_null($val) : $val;
			if (is_array($obj))
			{
				$obj[$key] = $val;
			}
			else
			{
				$obj->$key = $val;
			}
		}
		return $obj;
	}
}
