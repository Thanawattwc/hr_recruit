<?php
if (!defined('BASEPATH'))
{
  exit('No direct script access allowed');
}

function limit_usage($level)
{
  if (preg_match('/(=|>|<|>=|<|<=|<>)(?:\s*)(\d+)/', _LIMIT_LEVEL_USAGE_, $matches) !== FALSE)
  {
    $operator = $matches[1];

    switch ($operator)
    {
			case '>':
				if ($level > $matches[2])
				{
					return true;
				}
				else
				{
					return false;
				}
				break;
			case '>=':
				if ($level >= $matches[2])
				{
					return true;
				}
				else
				{
					return false;
				}
				break;
			case '<':
				if ($level < $matches[2])
				{
					return true;
				}
				else
				{
					return false;
				}
				break;
			case '<=':
				if ($level <= $matches[2])
				{
					return true;
				}
				else
				{
					return false;
				}
				break;
			case '=':
				if ($level == $matches[2])
				{
					return true;
				}
				else
				{
					return false;
				}
				break;
			default:
				return false;
    }
  }
}
