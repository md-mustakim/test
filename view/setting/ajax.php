<?php
    require "../../model/app.php";
    $app = new app();
    if(isset($_POST['create']))
    {
        $name = $_POST['name'];
        $insert_query = "INSERT INTO `shift`(`shift_name`) VALUES ('$name')";
        $r = $app->insert($insert_query);
        if($r === true)
        {
            echo "Successfully created";
        }else{
            echo "Failed to create";
        }
    }
    if(isset($_POST['shift']))
    {
        $name = $_POST['name'];
        $shift = $_POST['shift'];

        $insert_query = "INSERT INTO `class_list`(`class_name`, `shift`) VALUES  ('$name','$shift')";
        $r = $app->insert($insert_query);
        if($r === true)
        {
            echo "Successfully created";
        }else{
            echo "Failed to create";
        }
    }
    if(isset($_POST['delete']))
    {
        $r = false;
        $id = $_POST['id'];
        $shift = $_POST['shift_id'];
         $class = $_POST['class'];
        if($class === 1) // if post class
        {
            $insert_query = "DELETE FROM `class_list` WHERE class_id=  $id";
            $r = $app->insert($insert_query);
        }
        if($shift === '1') // if post shift
        {
            $insert_query = "DELETE FROM `shift` WHERE shift_id = $id";
            $r = $app->insert($insert_query);
        }

        if($r === true)
        {
            echo "Successfully deleted";
        }else{
            echo "Failed to deleted";
        }
    }

    if(isset($_POST['reset_pass']))
    {
        $new_pass = $_POST['new_pass'];
        $new_pass = md5($new_pass);
        $old_pass = $_POST['old_pass'];
        $old_pass = md5($old_pass);
        $userid = $_POST['userid'];
        $uq = "SELECT * FROM `teacher_info` where $userid";
        $udata = $app->view_single($uq);
         $pass_db_old = $udata['pass'];

        if($pass_db_old == $old_pass) {
            $update_query = "UPDATE `teacher_info` SET `pass` = '$new_pass' WHERE `teacher_info`.`id` = $userid;";
            $r = $app->insert($update_query);
           if($r === true)
              {
                  echo "<div class='bg-success p-2 text-light'>Password change successfully</div>";
              }else
              {
                  echo "<div class='bg-danger p-2 text-light'>Password change Failed</div>";
              }
          } else
          {
              echo "<div class='bg-success p-2 text-light'>Old Password not match</div>";
          }



    }

?>