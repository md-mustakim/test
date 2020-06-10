<?php
    if(isset($_POST['check']))
    {
        $msg ="";
        try{
            $soapClient = new SoapClient("https://api2.onnorokomSMS.com/sendSMS.asmx?wsdl");
            $paramArray = array(
                'userName' => "01770430605",
                'userPassword' => "shaifulmac",
            );
            $value = $soapClient->__call("GetBalance", array($paramArray));
            $msg .= $value->GetBalanceResult;
        } catch (Exception $e) {
            $msg .= $e->getMessage();
        }

        $msg= rtrim($msg,'0');
        echo "\n\r Current SMS Balance: $msg TK";
    }
?>