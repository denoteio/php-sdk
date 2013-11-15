<?php
		
class DenoteConnect{

	public $endpoint = 'https://denote.io/platform/api/v1/';
	const USER_AGENT = 'Denote.io/2.1 (+http://www.denote.io)';
	
	private $access_token;

	private $_cookies = array();
    private $_headers = array();

    public $curl;

    public $error = FALSE;
    public $error_code = 0;
    public $error_message = NULL;

    public $curl_error = FALSE;
    public $curl_error_code = 0;
    public $curl_error_message = NULL;

    public $http_error = FALSE;
    public $http_status_code = 0;
    public $http_error_message = NULL;

    public $request_headers = NULL;
    public $response_headers = NULL;
    public $response = NULL;



    public function __construct($access_token) {
    	$this->access_token = $access_token;
        if (!extension_loaded('curl')) {
            throw new ErrorException('cURL library is not loaded');
        }
        $this->curl = curl_init();
        $this->setUserAgent(self::USER_AGENT);
        $this->setopt(CURLINFO_HEADER_OUT, TRUE);
        $this->setopt(CURLOPT_HEADER, TRUE);
        $this->setopt(CURLOPT_RETURNTRANSFER, TRUE);
    }

    function get($service, $data=array()) {
    	$data['access_token'] = $this->access_token;
        $this->setopt(CURLOPT_URL, $this->endpoint.$service . '?' . http_build_query($data));
        $this->setopt(CURLOPT_HTTPGET, TRUE);
        $this->_exec();
        return json_decode($this->response);
    }

    function post($service, $json=array() ,$data=array()) {
        $this->setopt(CURLOPT_URL, $this->endpoint.$service . '?access_token='.$this->access_token);
        $this->setopt(CURLOPT_POST, TRUE);
        $this->setopt(CURLOPT_POSTFIELDS, $this->_postfields($json));
        $this->_exec();
        return json_decode($this->response);
    }

    function put($service, $json=array(), $data=array()) {
    	$data['access_token'] = $this->access_token;
        $this->setopt(CURLOPT_URL, $this->endpoint.$service . '?' . http_build_query($data));
        $this->setopt(CURLOPT_CUSTOMREQUEST, 'PUT');
        $this->setopt(CURLOPT_POSTFIELDS, $this->_postfields($json));
        $this->_exec();
        return json_decode($this->response);
    }

    function patch($service, $json=array(), $data=array()) {
    	$data['access_token'] = $this->access_token;
        $this->setopt(CURLOPT_URL, $this->endpoint.$service . '?access_token='.$this->access_token);
        $this->setopt(CURLOPT_CUSTOMREQUEST, 'PATCH');
        $this->setopt(CURLOPT_POSTFIELDS, $this->_postfields($json));
        $this->_exec();
        return json_decode($this->response);
    }

    function delete($service, $json=array(), $data=array()) {
    	$data['access_token'] = $this->access_token;
        $this->setopt(CURLOPT_URL, $this->endpoint.$service . '?' . http_build_query($data));
        $this->setopt(CURLOPT_CUSTOMREQUEST, 'DELETE');
        $this->setopt(CURLOPT_POSTFIELDS, $this->_postfields($json));
        $this->_exec();
        return json_decode($this->response);
    }

    function setBasicAuthentication($username, $password) {
        $this->setopt(CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        $this->setopt(CURLOPT_USERPWD, $username . ':' . $password);
    }

    function setHeader($key, $value) {
        $this->_headers[$key] = $key . ': ' . $value;
        $this->setopt(CURLOPT_HTTPHEADER, array_values($this->_headers));
    }

    function setUserAgent($user_agent) {
        $this->setopt(CURLOPT_USERAGENT, $user_agent);
    }

    function setReferrer($referrer) {
        $this->setopt(CURLOPT_REFERER, $referrer);
    }

    function setCookie($key, $value) {
        $this->_cookies[$key] = $value;
        $this->setopt(CURLOPT_COOKIE, http_build_query($this->_cookies, '', '; '));
    }

    function setOpt($option, $value) {
        return curl_setopt($this->curl, $option, $value);
    }

    function verbose($on=TRUE) {
        $this->setopt(CURLOPT_VERBOSE, $on);
    }

    function close() {
        curl_close($this->curl);
    }

    function http_build_multi_query($data, $key=NULL) {
        $query = array();

        foreach ($data as $k => $value) {
            if (is_string($value)) {
                $query[] = urlencode(is_null($key) ? $k : $key) . '=' . rawurlencode($value);
            }
            else if (is_array($value)) {
                $query[] = $this->http_build_multi_query($value, $k . '[]');
            }
        }

        return implode('&', $query);
    }

    function _postfields($data) {
        return json_encode($data);
    }

    function _exec() {
        $this->response = curl_exec($this->curl);
        $this->curl_error_code = curl_errno($this->curl);
        $this->curl_error_message = curl_error($this->curl);
        $this->curl_error = !($this->curl_error_code === 0);
        $this->http_status_code = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);
        $this->http_error = in_array(floor($this->http_status_code / 100), array(4, 5));
        $this->error = $this->curl_error || $this->http_error;
        $this->error_code = $this->error ? ($this->curl_error ? $this->curl_error_code : $this->http_status_code) : 0;

        $this->request_headers = preg_split('/\r\n/', curl_getinfo($this->curl, CURLINFO_HEADER_OUT), NULL, PREG_SPLIT_NO_EMPTY);
        $this->response_headers = '';
        if (!(strpos($this->response, "\r\n\r\n") === FALSE)) {
            list($response_header, $this->response) = explode("\r\n\r\n", $this->response, 2);
            if ($response_header === 'HTTP/1.1 100 Continue') {
                list($response_header, $this->response) = explode("\r\n\r\n", $this->response, 2);
            }
            $this->response_headers = preg_split('/\r\n/', $response_header, NULL, PREG_SPLIT_NO_EMPTY);
        }

        $this->http_error_message = $this->error ? (isset($this->response_headers['0']) ? $this->response_headers['0'] : '') : '';
        $this->error_message = $this->curl_error ? $this->curl_error_message : $this->http_error_message;

        return $this->error_code;
    }

    function __destruct() {
        $this->close();
    }

}

function is_array_multidim($array) {
    if (!is_array($array)) {
        return FALSE;
    }

    return !(count($array) === count($array, COUNT_RECURSIVE));
}
?>