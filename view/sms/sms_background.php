<?php
    date_default_timezone_set("Asia/Dhaka");
    require "../../model/app.php";
    $app = new app();
    if(isset($_POST['send']))
    {
        $number_code    = $_POST['group'];
        $message        = $_POST['msg_value'];
        $title          = $_POST['why'];
        $admin          = $_POST['admin_id'];
        $receiver       = $app->receiver_name($number_code);
        $number         = $getSmsNumberByGroup = $app->getSmsNumberByGroup($number_code);
        $cost           = $_POST['cost'];
        $numbers = explode(',',$getSmsNumberByGroup);
        $count_number = count($numbers);
        $date_time= time();





         $inset = "INSERT INTO `sms_data`(`receiver_name`, `message`, `number`, `cost`, `msg_title`, `admin`,`time`) 
                            VALUES ('$receiver','$message','$number','$cost','$title','$admin','$date_time')";


        function pay_sms($smessage,$snumbers,$title)	{
            $user = '01770430605';
            $pass = 'shaifulmac';
            try{
                $soapClient = new SoapClient("https://api2.onnorokomSMS.com/sendSMS.asmx?wsdl");
                $paramArray = array(
                    'userName' => $user,
                    'userPassword' => $pass,
                    'messageText' => $smessage,
                    'numberList' => $snumbers,
                    'smsType' => "TEXT",
                    'maskName' => '',
                    'campaignName' => $title,
                );
                $value = $soapClient->__call("OneToMany", array($paramArray));
                return $value->OneToManyResult;
            } catch (Exception $e) {
                return $e->getMessage();
            }


        }






       $result_status=  pay_sms($message,"01521430941",$title);

        //echo $result_status;
        $ss = explode("||",$result_status);



         $app->insert($inset);
        echo $ss[0];
    }


    if(isset($_POST['pre_preview']))
    {
        $group_id = $_POST['group_id'];

        $group_name = $app->receiver_name($group_id);
        $all_numbers = $app->getSmsNumberByGroup($group_id);
        $filtered_number = $app->filterNumber($all_numbers);
        //number count-------
        $arrye = explode(",",$filtered_number);
        $count = count($arrye);
        $return = array($group_name,$count);
        echo $count.",".$group_name;


    }

