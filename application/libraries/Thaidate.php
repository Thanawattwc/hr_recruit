<?php
/**
 * Class and Function List:
 * Function list:
 * - __construct()
 * - date()
 * Classes list:
 * - Thaidate
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Thaidate
{
	private $_en_month_long;
	private $_en_month_short;
	private $_th_month_long;
	private $_th_month_short;
	private $_en_day_long;
	private $_en_day_short;
	private $_th_day_long;
	private $_th_day_short;

	public function __construct()
	{
		$this->_en_month_long = Array(
			'January',
			'February',
			'March',
			'April',
			'May',
			'June',
			'July',
			'August',
			'September',
			'October',
			'November',
			'December'
		);
		$this->_en_month_short = Array(
			'Jan',
			'Feb',
			'Mar',
			'Apr',
			'May',
			'Jun',
			'Jul',
			'Aug',
			'Sep',
			'Oct',
			'Nov',
			'Dec'
		);
		$this->_th_month_long = Array(
			'มกราคม',
			'กุมภาพันธ์',
			'มีนาคม',
			'เมษายน',
			'พฤษภาคม',
			'มิถุนายน',
			'กรกฎาคม',
			'สิงหาคม',
			'กันยายน',
			'ตุลาคม',
			'พฤศจิกายน',
			'ธันวาคม'
		);
		$this->_th_month_short = Array(
			'ม.ค.',
			'ก.พ.',
			'มี.ค.',
			'เม.ย.',
			'พ.ค.',
			'มิ.ย.',
			'ก.ค.',
			'ส.ค.',
			'ก.ย.',
			'ต.ค.',
			'พ.ย.',
			'ธ.ค.'
		);

		$this->_en_day_long = Array(
			'Sunday',
			'Monday',
			'Tuesday',
			'Wednesday',
			'Thursday',
			'Friday',
			'Saturday'
		);
		$this->_en_day_short = Array(
			'Sun',
			'Mon',
			'Tue',
			'Wed',
			'Thu',
			'Fri',
			'Sat'
		);
		$this->_th_day_long = Array(
			'อาทิตย์',
			'จันทร์',
			'อังคาร',
			'พุธ',
			'พฤหัสบดี',
			'ศุกร์',
			'เสาร์'
		);
		$this->_th_day_short = Array(
			'อา.',
			'จ.',
			'อ.',
			'พ.',
			'พฤ.',
			'ศ.',
			'ส.'
		);
	}

	public function date($format = '', $timestamp = '', $be = TRUE)
	{
		if ($timestamp == NULL)
		{
			$timestamp = time();
		}

		if ($be == TRUE)
		{
			if (mb_strpos($format, 'o') !== FALSE)
			{
				$year = (date('o', $timestamp) + 543);
				$format = str_replace('o', $year, $format);
			}
			else if (mb_strpos($format, 'Y') !== FALSE)
			{
				$year = (date('Y', $timestamp) + 543);
				$format = str_replace('Y', $year, $format);
			}
			else if (mb_strpos($format, 'y') !== FALSE)
			{
				$year = (date('y', $timestamp) + 43);
				$format = str_replace('y', $year, $format);
			}
		}

		$thaidate = date($format, $timestamp);

		if (mb_strpos($format, 'F') !== FALSE)
		{
			$thaidate = str_replace($this->_en_month_long, $this->_th_month_long, $thaidate);
		}
		else
		{
			$thaidate = str_replace($this->_en_month_short, $this->_th_month_short, $thaidate);
		}

		$thaidate = str_replace($this->_en_day_long, $this->_th_day_long, $thaidate);
		$thaidate = str_replace($this->_en_day_short, $this->_th_day_short, $thaidate);

		return $thaidate;
	}

	public function backward($format = 'Y-m-d H:i:s', $strdate = '', $from_format = '')
	{
		if (mb_strpos($from_format, 'F') !== FALSE)
		{
			$strdate = str_replace($this->_th_month_long, $this->_en_month_long, $strdate);
		}
		else
		{
			$strdate = str_replace($this->_th_month_short, $this->_en_month_short, $strdate);
		}

		$strdate = str_replace($this->_th_day_long, $this->_en_day_long, $strdate);
		$strdate = str_replace($this->_th_day_short, $this->_en_day_short, $strdate);

		$date = date_create_from_format($from_format, $strdate);
		$time = strtotime(date_format($date, 'Y-m-d H:i:s') . ' - 543 year');

		return date($format, $time);
	}
}
