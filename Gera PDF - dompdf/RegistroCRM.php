<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RegistroCRM
 *
 * @author Pedro Miranda
 */
class RegistroCRM {
       
    public function procurarCRM($token, $record_id, $modulo) {
        $url = "https://crm.zoho.com/crm/private/json/" . $modulo . "/getRecordById";
        $query = "authtoken=" . $token . "&scope=crmapi&newFormat=2&id=" . $record_id;
        $info = array();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
        $resultado = curl_exec($ch);
        curl_close($ch);
        
        
        //print_r($resultado);
        return $resultado;
    }
    
    
    public function procurarCrmRelacionados($token, $record_id, $parent_module, $modulo){
        $url = "https://crm.zoho.com/crm/private/json/" . $parent_module . "/getRelatedRecords";
        $query = "authtoken=" . $token . "&scope=crmapi&id=" . $record_id . "&parentModule=" . $modulo;
        $info = array();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
        $resultado = curl_exec($ch);
        curl_close($ch);
        
        
        return $resultado;
    }
}
