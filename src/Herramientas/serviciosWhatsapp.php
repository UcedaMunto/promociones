<?php

namespace App\Herramientas;

trait serviciosWhatsapp{

    function sendWhatsapp($to, $msg) {
        //define ('$this->WHATS_APP_TOKEN', 'f09397fd719d25299bc9ac2cdc00cf715f68c5a0db27b');
        //define('$this->WHATS_APP_NUMERO', '50377459717');
        $to = filter_var($to, FILTER_SANITIZE_NUMBER_INT);
        if (empty($to)) return false;
        $msg = urlencode($msg);
        $url = "https://www.waboxapp.com/api/send/chat?token=".$this->getParameter('WHATS_APP_TOKEN')."&uid=".$this->getParameter('WHATS_APP_NUMERO') ."&to=".$to."&text=".$msg;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($curl);
        curl_close($curl);
        if ($result) return json_decode($result);
        return false;
    }
    
    
    function sendImage($to, $urlimg, $caption ='', $desc=''){
        $to = filter_var($to, FILTER_SANITIZE_NUMBER_INT);
        if (empty($to)) return false;
        $urlimg = str_replace(' ', '%20', $urlimg);
        $urlimg = urlencode($urlimg);
        $caption = urlencode($caption);
        $desc = urlencode($desc);
        $url = "https://www.waboxapp.com/api/send/media?token=".$this->getParameter('WHATS_APP_TOKEN')."&uid=".$this->getParameter('WHATS_APP_NUMERO') ."&to=".$to."&url=$urlimg&caption".$caption."&description=".$desc;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($curl);
        curl_close($curl);
        if ($result) return json_decode($result);
        return false;
    }
    
    
    function sendImagePrew($to, $urlimg, $caption ='', $desc=''){
        $to = filter_var($to, FILTER_SANITIZE_NUMBER_INT);
        if (empty($to)) return false;
        $urlimg = urlencode($urlimg);
        $caption = urlencode($caption);
        $desc = urlencode($desc);
        $url = "https://www.waboxapp.com/api/send/media?token=".$this->getParameter('WHATS_APP_TOKEN')."&uid=".$this->getParameter('WHATS_APP_NUMERO')."&to=".$to."&url=".$urlimg."&description=".$desc."&url_thumb=".$urlimg;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($curl);
        curl_close($curl);
        if ($result) return json_decode($result);
        return false;
    }
    
}