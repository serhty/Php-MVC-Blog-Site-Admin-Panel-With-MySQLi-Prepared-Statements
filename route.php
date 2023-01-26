<?php

class Route
{

    public static function parse_url()
    {
        $dirname = dirname($_SERVER['SCRIPT_NAME']);
        $dirname = $dirname != '/' ? $dirname : null;
        $basename = basename($_SERVER['SCRIPT_NAME']);
        $request_uri = str_replace([$dirname, $basename], null, $_SERVER['REQUEST_URI']);
        return $request_uri;
    }

    public static function run($url, $callback, $method = 'get')
    {
        $method = explode('|', strtoupper($method));
        if (in_array($_SERVER['REQUEST_METHOD'], $method)) {
            $patterns = [
                '{url}' => '([0-9a-zA-Z-_/]+)',
                '{detail}' => '([0-9a-zA-Z-_/]+)',
                '{id}' => '([0-9]+)'
            ];

            $url = str_replace(array_keys($patterns), array_values($patterns), $url);
            $request_uri = self::parse_url();
            if (preg_match('@^' . $url . '$@', $request_uri, $parameters)) {
                unset($parameters[0]);
                if (is_callable($callback)) {
                    call_user_func_array($callback, $parameters);
                } else {
                    $controller = explode('@', $callback);
                    $className = explode('/', $controller[0]);
                    $className = end($className);
                    $controllerFile = __DIR__ . '/controller/' . strtolower($controller[0]) . '.php';
                    if (file_exists($controllerFile)) {
                        require $controllerFile;
                        call_user_func_array([new $className, $controller[1]], $parameters);
                    }
                }
            }
        }

    }
	
	public static function the_url($server, $use_forwarded_host = false)
	{
		$ssl = (!empty( $server['HTTPS'] ) && $server['HTTPS'] == 'on');
		$protocol = substr(strtolower($server['SERVER_PROTOCOL']), 0, strpos(strtolower($server['SERVER_PROTOCOL']), '/')) . (($ssl) ? 's' : '');
		$host = ($use_forwarded_host && isset($server['HTTP_X_FORWARDED_HOST'])) ? $server['HTTP_X_FORWARDED_HOST'] : (isset($server['HTTP_HOST']) ? $server['HTTP_HOST'] : null);
		$host = isset($host) ? $host : $server['SERVER_NAME'];
		$urlprotocol = $protocol . '://' . $host;
		return ($urlprotocol);
	}


}
