<div class="col-md-2 m-0 p-0">
    <div class="mt-1 mr-1">
        <div class="h-100 w-100 bg-info">


            <div class="btn-light p-2 border-bottom bg-info text-light m-pointer font-weight-bold" data-toggle="collapse" data-target="#drop"> Student
                <i class="fas fa-angle-down float-right p-1"></i>
            </div>

            <div class="collapse text-light p-0 m-0 text-light" id="drop">
                <ul class="list-group list-group-flush p-0 m-0">
                    <li class="list-group-item bg-secondary m-pointer"> <a href="new_student.php" class="text-decoration-none text-light">Add Student</a> </li>
                    <li class="list-group-item bg-secondary m-pointer"> <a href="search.php" class="text-decoration-none text-light">Search Student</a> </li>
                    <li class="list-group-item bg-secondary m-pointer"> <a href="search_by_class.php" class="text-decoration-none text-light">Search By Class</a> </li>
                    <li class="list-group-item bg-secondary m-pointer"> <a href="" class="text-decoration-none text-light">Student Attendance</a> </li>
                </ul>
            </div>


            <div class="btn-light p-2 border-bottom bg-info text-light m-pointer font-weight-bold" data-toggle="collapse" data-target="#result"> Result
                <i class="fas fa-angle-down float-right p-1"></i>
            </div>

            <div class="collapse text-light p-0 m-0 text-light" id="result">
                <ul class="list-group list-group-flush p-0 m-0">
                    <li class="list-group-item bg-secondary m-pointer"> <a href="result/second_index.php?semester=1" class="text-decoration-none text-light">1st Semester</a> </li>
                    <li class="list-group-item bg-secondary m-pointer"> <a href="result/second_index.php?semester=2" class="text-decoration-none text-light">2nd Semester</a> </li>
                    <li class="list-group-item bg-secondary m-pointer"> <a href="result/second_index.php?semester=3" class="text-decoration-none text-light">2nd Semester</a> </li>
                </ul>
            </div>


            <div class="btn-light p-2 border-bottom bg-info text-light m-pointer font-weight-bold" data-toggle="collapse" data-target="#teacher"> Teacher
                <i class="fas fa-angle-down float-right p-1"></i>
            </div>

            <div class="collapse text-light p-0 m-0 text-light" id="teacher">
                <ul class="list-group list-group-flush p-0 m-0">
                    <li class="list-group-item bg-secondary m-pointer"> <a href="reg.php" class="text-decoration-none text-light">Add Teacher</a> </li>
                    <li class="list-group-item bg-secondary m-pointer"> <a href="teacher/teacher_list.php" class="text-decoration-none text-light">View All Teacher</a> </li>
                </ul>
            </div>



            <div class="btn-light p-2 border-bottom bg-info text-light m-pointer font-weight-bold" data-toggle="collapse" data-target="#sms"> Sms
                <i class="fas fa-angle-down float-right p-1"></i>
            </div>

            <div class="collapse text-light p-0 m-0 text-light" id="sms">
                <ul class="list-group list-group-flush p-0 m-0">
                    <li class="list-group-item bg-secondary m-pointer"> <a href="sms/send_sms.php" class="text-decoration-none text-light">Send SMS</a> </li>
                    <li class="list-group-item bg-secondary m-pointer"> <a href="sms/sms_history.php" class="text-decoration-none text-light">View send SMS</a> </li>
                </ul>
            </div>




            <div class="btn-light p-2 border-bottom bg-info text-light m-pointer font-weight-bold" data-toggle="collapse" data-target="#setting"> Setting
                <i class="fas fa-angle-down float-right p-1"></i>
            </div>

            <div class="collapse text-light p-0 m-0 text-light" id="setting">
                <ul class="list-group list-group-flush p-0 m-0">
                    <li class="list-group-item bg-secondary m-pointer"> <a href="setting/class.php" class="text-decoration-none text-light">Class</a> </li>
                    <li class="list-group-item bg-secondary m-pointer"> <a href="setting/shift.php" class="text-decoration-none text-light">Shift</a> </li>
                </ul>
            </div>



            <div class="btn-light p-2 border-bottom bg-info text-light m-pointer font-weight-bold" onclick="window.location.href='search.php'">
                <a class="text-decoration-none text-light">Payment</a>
                <i class="fas fa-eye float-right p-1"></i>
            </div>



            <div class="btn-light p-2 border-bottom bg-info text-light m-pointer font-weight-bold" onclick="checkBalance()">
                <a class="text-decoration-none text-light">Balance check</a>
                <i class="fas fa-eye float-right p-1"></i>
            </div>


            <div class="btn-light p-2 border-bottom bg-info text-light m-pointer font-weight-bold">
                <a href="logout.php" class="text-decoration-none text-light">Logout</a>
                <i class="fas fa-sign-out-alt float-right p-1"></i>
            </div>
        </div>
    </div>
</div>