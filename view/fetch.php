<?php
require "../Controller/search.php";
$search = new search();

$output = '';
    if(isset($_POST["query"]))
    {
        $search->keyword = $_POST['query'];




    }
$result = $search->liveSearch();
    if($result == null)
    {
        echo "No data Found";
    }else
    {
        ?>
        <table class='table table-responsive-md table-hover'>
        <thead class="thead-light">
            <tr>
                <th>Name</th>
                <th>Roll</th>
                <th>Class</th>
                <th>Shift</th>
                <th>Number-1</th>
                <th>Number-2</th>
                <th>Action</th>
            </tr>

        </thead>
        <?php
        foreach ($result as $i => $v)
        {
            ?>
            <tr>
                <td> <?php echo $v->name;?> </td>
                <td> <?php echo $v->class_roll; ?> </td>
                <td> <?php echo $v->class;?> </td>
                <td> <?php echo $v->shift;?> </td>

                <td> <?php echo $v->fname;?> </td>
                <td> <?php echo $v->mnumber;?> </td>
                <td>
                    <a target="_blank" href="edit_student.php?student_id=<?php echo $v->id;?>"><i class="fas fa-edit"></i></a>
                    <a target="_blank" href="payment/payment.php?unique_id=<?php echo $v->id;?>"><i class="fas fa-dollar-sign"></i></a>
                </td>

            </tr>
            <?php

        }
        echo "</table>";

    }


