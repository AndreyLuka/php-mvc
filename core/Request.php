<?php

namespace Core;

/**
 * Class Request.
 */
class Request
{
    /**
     * The GET parameters.
     * @var array
     */
    private $query;

    /**
     * The POST parameters.
     * @var array
     */
    private $request;

    /**
     * The SERVER parameters.
     * @var array
     */
    private $server;

    /**
     * The FILES parameters.
     * @var array
     */
    private $files;

    /**
     * Request constructor.
     * @param array $query The GET parameters
     * @param array $request The POST parameters
     * @param array $server The SERVER parameters
     * @param array $files The FILES parameters
     */
    public function __construct($query = [], $request = [], $server = [], $files = [])
    {
        $this->query = !empty($query) ? $query : $_GET;
        $this->request = !empty($request) ? $request : $_POST;
        $this->server = !empty($server) ? $server : $_SERVER;
        $this->files = !empty($files) ? $files : $_FILES;
    }

    /**
     * Validate request data.
     * @param string $data
     * @return string
     */
    private function clean($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }

    /**
     * Get parameter from GET.
     * @param string $param
     * @return mixed|null
     */
    public function getQueryParam($param)
    {
        if (!isset($this->query[$param])) {
            return null;
        }

        return $this->clean($this->query[$param]);
    }

    /**
     * Get parameter from POST.
     * @param string $param
     * @return mixed|null
     */
    public function getRequestParam($param)
    {
        if (!isset($this->request[$param])) {
            return null;
        }

        return $this->clean($this->request[$param]);
    }

    /**
     * Get parameter from SERVER.
     * @param string $param
     * @return mixed|null
     */
    public function getServerParam($param)
    {
        if (!isset($this->server[$param])) {
            return null;
        }

        return $this->clean($this->server[$param]);
    }

    /**
     * Get file from FILES.
     * @param string $file
     * @return mixed|null
     */
    public function getFile($file)
    {
        if (!isset($this->files[$file])) {
            return null;
        }

        return $this->files[$file];
    }

    /**
     * Get Query string.
     * @param array $unsetParams Params to remove
     * @return null|string
     */
    public function getQueryString($unsetParams = [])
    {
        if (!$queryString = $this->getServerParam('QUERY_STRING')) {
            return null;
        }

        if (!empty($unsetParams)) {
            $queryString = str_replace('&amp;', '&', $queryString);
            parse_str($queryString, $queryString);

            foreach ($unsetParams as $param) {
                unset($queryString[$param]);
            }

            $queryString = http_build_query($queryString);
        }

        return $queryString ? $queryString . '&' : null;
    }

    /**
     * Check if file was uploaded.
     * @param string $file
     * @return bool
     */
    public function isFile($file)
    {
        return is_uploaded_file($this->getFile($file)['tmp_name']);
    }

    /**
     * @return bool
     */
    public function isPost()
    {
        return $this->server['REQUEST_METHOD'] == 'POST' ? true : false;
    }
}
