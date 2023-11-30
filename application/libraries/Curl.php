<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Curl
{
	protected $response = '';
	protected $session;
	protected $options = array();
  protected $headers = array();
  public $url;
	public $error_code;
	public $error_string;
	public $info;     
  
  public function get($path, $params = array())
  {
		$query = http_build_query($params, NULL, '&');
		$query = preg_replace('/%5B(?:[0-9]|[1-9][0-9]+)%5D=/', '=', $query);
    $this->create($path . ($params ? '?' . $query : ''));
  }

  public function post($params = array(), $options = array())
	{
		if (is_array($params))
		{
			$params = http_build_query($params, NULL, '&');
		}

		$this->options($options);
		$this->http_method('post');
		$this->option(CURLOPT_POST, TRUE);
		$this->option(CURLOPT_POSTFIELDS, $params);
	}

	public function put($params = array(), $options = array())
	{
		if (is_array($params))
		{
			$params = http_build_query($params, NULL, '&');
		}

		$this->options($options);

		$this->http_method('put');
		$this->option(CURLOPT_POSTFIELDS, $params);
		$this->option(CURLOPT_HTTPHEADER, array('X-HTTP-Method-Override: PUT'));
	}

	public function patch($params = array(), $options = array())
	{
		if (is_array($params))
		{
			$params = http_build_query($params, NULL, '&');
		}

		$this->options($options);
		$this->http_method('patch');
		$this->option(CURLOPT_POSTFIELDS, $params);
		$this->option(CURLOPT_HTTPHEADER, array('X-HTTP-Method-Override: PATCH'));
	}

	public function delete($params, $options = array())
	{
		if (is_array($params))
		{
			$params = http_build_query($params, NULL, '&');
		}

		$this->options($options);

		$this->http_method('delete');

		$this->option(CURLOPT_POSTFIELDS, $params);
	}

	public function set_cookies($params = array())
	{
		if (is_array($params))
		{
			$params = http_build_query($params, NULL, '&');
		}

		$this->option(CURLOPT_COOKIE, $params);
		return $this;
	}

	public function http_header($header, $content = NULL)
	{
		$this->headers[] = $content ? $header . ': ' . $content : $header;
		return $this;
	}

	public function http_method($method)
	{
		$this->options[CURLOPT_CUSTOMREQUEST] = strtoupper($method);
		return $this;
	}

	public function http_login($username = '', $password = '', $type = 'any')
	{
		$this->option(CURLOPT_HTTPAUTH, constant('CURLAUTH_' . strtoupper($type)));
		$this->option(CURLOPT_USERPWD, $username . ':' . $password);
		return $this;
	}

	public function proxy($url = '', $port = 80)
	{
		$this->option(CURLOPT_HTTPPROXYTUNNEL, TRUE);
		$this->option(CURLOPT_PROXY, $url . ':' . $port);
		return $this;
	}

	public function proxy_login($username = '', $password = '')
	{
		$this->option(CURLOPT_PROXYUSERPWD, $username . ':' . $password);
		return $this;
	}

	public function ssl($verify_peer = TRUE, $verify_host = 2, $path_to_cert = NULL)
	{
		if ($verify_peer)
		{
			$this->option(CURLOPT_SSL_VERIFYPEER, TRUE);
			$this->option(CURLOPT_SSL_VERIFYHOST, $verify_host);
			if (isset($path_to_cert)) {
				$path_to_cert = realpath($path_to_cert);
				$this->option(CURLOPT_CAINFO, $path_to_cert);
			}
		}
		else
		{
			$this->option(CURLOPT_SSL_VERIFYPEER, FALSE);
			$this->option(CURLOPT_SSL_VERIFYHOST, $verify_host);
		}
		return $this;
	}

	public function options($options = array())
	{
		foreach ($options as $option_code => $option_value)
		{
			$this->option($option_code, $option_value);
		}

		curl_setopt_array($this->session, $this->options);

		return $this;
	}

	public function option($code, $value, $prefix = 'opt')
	{
		if (is_string($code) && !is_numeric($code))
		{
			$code = constant('CURL' . strtoupper($prefix) . '_' . strtoupper($code));
		}

		$this->options[$code] = $value;
		return $this;
	}

	public function create($path)
	{
		$this->session = curl_init($this->url . $path);

		return $this;
	}

	public function execute()
	{
		if ( ! isset($this->options[CURLOPT_TIMEOUT]))
		{
			$this->options[CURLOPT_TIMEOUT] = 30;
		}
		if ( ! isset($this->options[CURLOPT_RETURNTRANSFER]))
		{
			$this->options[CURLOPT_RETURNTRANSFER] = TRUE;
		}
		if ( ! isset($this->options[CURLOPT_FAILONERROR]))
		{
			$this->options[CURLOPT_FAILONERROR] = FALSE;
		}

		if ( ! ini_get('safe_mode') && ! ini_get('open_basedir'))
		{
			if ( ! isset($this->options[CURLOPT_FOLLOWLOCATION]))
			{
				$this->options[CURLOPT_FOLLOWLOCATION] = TRUE;
			}
		}

		if ( ! empty($this->headers))
		{
			$this->option(CURLOPT_HTTPHEADER, $this->headers);
		}

		$this->options();

		$this->response = curl_exec($this->session);
		$this->info = curl_getinfo($this->session);

		if ($this->response === FALSE)
		{
			$errno = curl_errno($this->session);
			$error = curl_error($this->session);

			curl_close($this->session);
			$this->defaults();

			$this->error_code = $errno;
			$this->error_string = $error;

			return FALSE;
		}
		else
		{
			curl_close($this->session);
			$this->last_response = $this->response;
			$this->defaults();
			return $this->last_response;
		}
	}

	public function is_enabled()
	{
		return function_exists('curl_init');
	}

	public function debug()
	{
		echo "=============================================<br/>\n";
		echo "<h2>CURL Test</h2>\n";
		echo "=============================================<br/>\n";
		echo "<h3>Response</h3>\n";
		echo "<code>" . nl2br(htmlentities($this->last_response)) . "</code><br/>\n\n";

		if ($this->error_string)
		{
			echo "=============================================<br/>\n";
			echo "<h3>Errors</h3>";
			echo "<strong>Code:</strong> " . $this->error_code . "<br/>\n";
			echo "<strong>Message:</strong> " . $this->error_string . "<br/>\n";
		}

		echo "=============================================<br/>\n";
		echo "<h3>Info</h3>";
		echo "<pre>";
		print_r($this->info);
		echo "</pre>";
	}

	public function debug_request()
	{
		return array(
			'url' => $this->url
		);
	}

	public function defaults()
	{
		$this->response = NULL;
		$this->headers = array();
		$this->options = array();
		$this->error_code = NULL;
		$this->error_string = NULL;
		$this->session = NULL;
	}
}
