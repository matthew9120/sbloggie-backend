<?php

namespace AppBundle\Service;

class Http
{
    public function makeRequestUsingPost($url, $data)
    {
        $curl = \curl_init();
        \curl_setopt($curl, \CURLOPT_URL, $url);
        \curl_setopt($curl, \CURLOPT_POST, true);
        \curl_setopt($curl, \CURLOPT_POSTFIELDS, $data);
        
        return \curl_exec($curl);
    }
}
