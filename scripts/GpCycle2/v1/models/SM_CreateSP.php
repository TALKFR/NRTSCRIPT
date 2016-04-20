<?php

/**
 * Class to import SP
 *
 * @internal servicemagic : AFF-1795
 * @internal servicemagic : AFF-1805
 * @internal servicemagic : AFF-1577
 *
 */

namespace app\scripts\Travaux\v1\models;

class SM_CreateSP {

    private $idaff = 0;
    private $token = '';
    private $env = 'prod';
    private $lng = 'fr';

    /**
     * Construct
     *
     * @param string $lng
     * @param string $env
     */
    public function __construct($lng, $env = 'prod') {
        $this->lng = $lng;
        $this->env = $env;
    }

    /**
     * Call the API
     *
     * @param string	$service	action to sent at the API
     * @param array		$param		list params
     * @param array		$header		headers to send
     * @return unknown
     */
    private function http($service, $param, $header = array()) {
        $prefix = 'dev-';
        if ($this->env == 'prod') {
            $prefix = '';
        }

        $handle = curl_init();

        $url = sprintf('https://api.servicemagic.eu/%s%s/%s/0.4/%s', $prefix, $this->lng, $this->idaff, $service);
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle, CURLOPT_HEADER, true);

        curl_setopt($handle, CURLOPT_NOBODY, false);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_FORBID_REUSE, false);
        curl_setopt($handle, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($handle, CURLOPT_TIMEOUT, 30);
        curl_setopt($handle, CURLOPT_POST, true);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($handle, CURLOPT_HTTPHEADER, $header);

        curl_setopt($handle, CURLOPT_POSTFIELDS, http_build_query($param, '', '&'));

        $response = curl_exec($handle);
        if ($response !== false) {
            $header_size = curl_getinfo($handle, CURLINFO_HEADER_SIZE);
            $result['header'] = substr($response, 0, $header_size);
            $result['body'] = substr($response, $header_size);
            $result['data'] = json_decode($result['body']);
            $result['http_code'] = curl_getinfo($handle, CURLINFO_HTTP_CODE);
            $result['last_url'] = curl_getinfo($handle, CURLINFO_EFFECTIVE_URL);
        } else {
            $result['error'] = curl_error($handle);
        }
        return $result;
    }

    /**
     * Authentification
     *
     * @param string $login
     * @param string $password
     * @return object
     */
    public function auth($login, $password) {
        $this->idaff = 0;
        $res = $this->http('account/validate', array('sm_username' => $login, 'sm_password' => $password));
        return $res['data'];
    }

    /**
     * Get list activities
     *
     * @param	int		$idaff		id affiliate
     * @param	string	$token		token
     * @param	int		$kwid		tracking code
     * @return	array				list activities
     */
    public function getListAct($idaff, $token, $kwid) {
        $this->idaff = $idaff;
        $data['KWID'] = $kwid;
        $return = $this->http('sp/interview', $data, array('x-sm-token:' . $token));
        return $return['data']->questions[0]->options;
    }

    /**
     * Send new SP
     *
     * @param int		$idaff		id affiliate
     * @param string	$token		token
     * @param int		$kwid		tracking code
     * @param array		$data		sp datas
     * @return array				result of sending
     */
    public function newSP($idaff, $token, $kwid, $data) {
        $this->idaff = $idaff;
        $data['KWID'] = $kwid;
        return $this->http('sp/create', $data, array('x-sm-token:' . $token));
    }

}

?>