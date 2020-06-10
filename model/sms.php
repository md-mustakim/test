<?php
require 'app.php';
    class sms extends app {
        function student_number($query)
        {
            $this->view($query);
            $numbers= "";
            foreach($a as $item => $value)
            {
                $numbers .=  $value['mnumber'].",";
            }
            return $numbers;
        }
    }
//=================================================================================================================================


?>