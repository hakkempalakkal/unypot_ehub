<?php	
    function exitJsonFormat($jsonObj) {
        $data = json_encode($jsonObj['Data']);
        header('HTTP/1.1: '.$jsonObj['Status'].'');
        header('Status: '.$jsonObj['Status'].'');
        header('Content-type: application/json');
        header('Content-Length: ' . strlen($data));
        exit($data);
    }

    function getHeader() {
        $headers = apache_request_headers();
        $auth = "";
        foreach ($headers as $header => $value) {
            if ($header == "auth") {
                $value = explode('*', $value);
                $auth = $value[1];
            }
        }
        $ret = array(
        	'auth' => $auth
        );
        return $ret;
    }    

    function sendResponse($httpcode, $msg) {
        $datax['error'] = $msg;
        $datar = array(
            'Status'    => $httpcode,
            'response'  =>  $datax
        );
        $this->exitJsonFormat($datar);
        exit($datar);
    }
	
?>