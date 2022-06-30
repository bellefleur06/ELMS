<?php include 'config.php';

// admin login

if (isset($_POST['admin_login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    try {

        $query = "SELECT * FROM users WHERE username=:username";
        $statement = $conn->prepare($query);
        $data = [':username' => $username];

        $statement->execute($data);
        $result = $statement->fetch();

        if ($result && password_verify($password, $result['password'])) {

            $_SESSION['username'] = $_POST['username'];
            $_SESSION['access-admin'] = $_POST['username'];
            header("Location: ../admin/dashboard.php");
            exit(0);
        } else {

            $_SESSION['login-failed'] = "Incorrect Password!";
            header("Location: ../index.php");
            exit(0);
        }
    } catch (PDOException $e) {
        $e->getMessage();
    }
}

// employee login

if (isset($_POST['employee_login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    try {

        $query = "SELECT * FROM employees WHERE username=:username";
        $statement = $conn->prepare($query);
        $data = [':username' => $username];

        $statement->execute($data);
        $result = $statement->fetch();

        if ($result && password_verify($password, $result['password'])) {

            $_SESSION['username'] = $_POST['username'];
            $_SESSION['access-employee'] = $_POST['username'];
            header("Location: ../employee/dashboard.php");
            exit(0);
        } else {

            $_SESSION['login-failed'] = "Incorrect Password!";
            header("Location: ../index.php");
            exit(0);
        }
    } catch (PDOException $e) {
        $e->getMessage();
    }
}

// add department

if (isset($_POST['add_department'])) {

    $acronym = $_POST['acronym'];
    $name = $_POST['name'];

    $query = "INSERT INTO departments (department_acronym, department_name) VALUES (:acronym, :name)";
    $statement = $conn->prepare($query);

    $data = [
        ':acronym' => $acronym,
        ':name' => $name
    ];

    $result = $statement->execute($data);

    if ($result) {

        $_SESSION['add-department-success'] = "Department Added Successfully!";
        header("Location: ../admin/manage_department.php");
        exit(0);
    } else {

        $_SESSION['add-department-failed'] = "Something Went Wrong! Failed To Add Department.";
        header("Location: ../admin/add_department.php");
        exit(0);
    }
}

// add designation

if (isset($_POST['add_designation'])) {

    $name = $_POST['name'];
    $description = $_POST['description'];

    $query = "INSERT INTO designations (designation_name, designation_description) VALUES (:name, :description)";
    $statement = $conn->prepare($query);

    $data = [
        ':name' => $name,
        ':description' => $description
    ];

    $result = $statement->execute($data);

    if ($result) {

        $_SESSION['add-designation-success'] = "Designation Added Successfully!";
        header("Location: ../admin/manage_designation.php");
        exit(0);
    } else {

        $_SESSION['add-designation-failed'] = "Something Went Wrong! Failed To Add Designation.";
        header("Location: ../admin/add_designation.php");
        exit(0);
    }
}

// if (isset($_POST['add_employee'])) {

//     $id = $_POST['id'];
//     $gender = $_POST['gender'];
//     $first_name = $_POST['first_name'];
//     $middle_name = $_POST['middle_name'];
//     $last_name = $_POST['last_name'];
//     $age = $_POST['age'];
//     $email_address = $_POST['email_address'];
//     $contact_number = $_POST['contact_number'];
//     $department = $_POST['department'];
//     $designation = $_POST['designation'];
//     $username = $_POST['username'];
//     $password = $_POST['password'];
//     $account_status = 1;

//     try {

//         if (empty($_POST['gender']) or empty($_POST['department'] or empty($_POST['designation']))) {

//             $_SESSION['employee-details-required'] = "All Fields Are Required.";
//             header("Location: ../admin/add_employee.php");
//             exit(0);
//         } else {

//             $query = "SELECT * FROM employees WHERE last_name=:last_name AND first_name=:first_name AND middle_name=:middle_name";
//             $statement = $conn->prepare($query);

//             $data = [
//                 ':last_name' => $last_name,
//                 ':first_name' => $first_name,
//                 ':middle_name' => $middle_name
//             ];

//             $statement->execute($data);
//             $result = $statement->rowCount();

//             if ($result > 0) {

//                 $_SESSION['employee-already-exist'] = "Employee Already Exist.";
//                 header("Location: ../admin/add _employee.php");
//                 exit(0);
//             } else {

//                 $query = "SELECT * FROM employees WHERE email_address=:email_address";
//                 $statement = $conn->prepare($query);
//                 $data = [':email_address' => $email_address];

//                 $statement->execute($data);
//                 $result = $statement->rowCount();

//                 if ($result > 0) {

//                     $_SESSION['email-already-used'] = "Email Already Used.";
//                     header("Location: ../admin/add_employee.php");
//                     exit(0);

//                     $query = "SELECT * FROM employees WHERE username=:username";
//                     $statement = $conn->prepare($query);
//                     $data = [':username' => $username];

//                     $statement->execute($data);
//                     $result = $statement->rowCount();

//                     if ($result > 0) {

//                         $_SESSION['username-already-used'] = "Username Already Used.";
//                         header("Location: ../admin/add_employee.php");
//                         exit(0);
//                     } else {

//                         $query = "INSERT INTO employees (employee_id, last_name, first_name, middle_name, age, gender, email_address, contact_number, department_id, designation_id, username, password, account_status) VALUES (:id, :last_name, :first_name, :middle_name, :age, :gender, :email_address, :contact_number, :department, :designation, :username, :password, :account_status)";
//                         $statement = $conn->prepare($query);

//                         $data = [
//                             ':id' => $id,
//                             ':last_name' => $last_name,
//                             ':first_name' => $first_name,
//                             ':middle_name' => $middle_name,
//                             ':age' => $age,
//                             ':gender' => $gender,
//                             ':email_address' => $email_address,
//                             ':contact_number' => $contact_number,
//                             ':department' => $department,
//                             ':designation' => $designation,
//                             ':username' => $username,
//                             ':password' => $password,
//                             ':account_status' => $account_status
//                         ];

//                         $result = $statement->execute($data);

//                         if ($result) {

//                             $_SESSION['add-employee-success'] = "Employee Added Successfully!";
//                             header("Location: ../admin/manage_employee.php");
//                             exit(0);
//                         } else {

//                             $_SESSION['add-employee-failed'] = "Something Went Wrong! Failed To Add Employee.";
//                             header("Location: ../admin/add_employee.php");
//                             exit(0);
//                         }
//                     }
//                 }
//             }
//         }
//     } catch (PDOException $e) {
//         $e->getMessage();
//     }
// }

// add employee

if (isset($_POST['add_employee'])) {

    $id = $_POST['id'];
    $gender = $_POST['gender'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $age = $_POST['age'];
    $email_address = $_POST['email_address'];
    $contact_number = $_POST['contact_number'];
    $department = $_POST['department'];
    $designation = $_POST['designation'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password = password_hash($password, PASSWORD_BCRYPT);
    $account_status = 1;

    $file_name = $_FILES['avatar']['name'];
    $file_temp = $_FILES['avatar']['tmp_name'];
    $allowed_ext = array("jpeg", "jpg", "gif", "png");
    $exp = explode(".", $file_name);
    $ext = end($exp);
    $path = "../images/" . $file_name;

    if (in_array($ext, $allowed_ext)) {

        if (move_uploaded_file($file_temp, $path)) {

            try {

                if (empty($_POST['gender']) or empty($_POST['department'] or empty($_POST['designation']))) {

                    $_SESSION['employee-details-required'] = "All Fields Are Required.";
                    header("Location: ../admin/add_employee.php");
                    exit(0);
                } else {

                    $query = "INSERT INTO employees (employee_id, last_name, first_name, middle_name, age, gender, email_address, contact_number, department_id, designation_id, username, password, avatar, account_status) VALUES (:id, :last_name, :first_name, :middle_name, :age, :gender, :email_address, :contact_number, :department, :designation, :username, :password, :avatar, :account_status)";
                    $statement = $conn->prepare($query);

                    $data = [
                        ':id' => $id,
                        ':last_name' => $last_name,
                        ':first_name' => $first_name,
                        ':middle_name' => $middle_name,
                        ':age' => $age,
                        ':gender' => $gender,
                        ':email_address' => $email_address,
                        ':contact_number' => $contact_number,
                        ':department' => $department,
                        ':designation' => $designation,
                        ':username' => $username,
                        ':password' => $password,
                        ':avatar' => $file_name,
                        ':account_status' => $account_status
                    ];

                    $result = $statement->execute($data);

                    if ($result) {

                        $_SESSION['add-employee-success'] = "Employee Added Successfully!";
                        header("Location: ../admin/manage_employee.php");
                        exit(0);
                    } else {

                        $_SESSION['add-employee-failed'] = "Something Went Wrong! Failed To Add Employee.";
                        header("Location: ../admin/add_employee.php");
                        exit(0);
                    }
                }
            } catch (PDOException $e) {
                $e->getMessage();
            }
        }
    } else {

        $_SESSION['invalid-file-format'] = "Invalid File Format";
        header("Location: ../admin/add_employee.php");
        exit(0);
    }
}

// add leave type

if (isset($_POST['add_leave_type'])) {

    $type = $_POST['type'];
    $description = $_POST['description'];
    $days_allowed = $_POST['days_allowed'];

    $query = "INSERT INTO leave_types (leave_type, description, days_allowed) VALUES (:type, :description, :days_allowed)";
    $statement = $conn->prepare($query);

    $data = [
        ':type' => $type,
        ':description' => $description,
        ':days_allowed' => $days_allowed
    ];

    $result = $statement->execute($data);

    if ($result) {

        $_SESSION['add-leave_type-success'] = "Leave Type Added Successfully!";
        header("Location: ../admin/manage_leave_type.php");
        exit(0);
    } else {

        $_SESSION['add-leave_type-failed'] = "Something Went Wrong! Failed To Add Leave Type.";
        header("Location: ../admin/add_leave_type.php");
        exit(0);
    }
}

// add user (admin)

if (isset($_POST['add_user'])) {

    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password = password_hash($password, PASSWORD_BCRYPT);
    $user_category = $_POST['user_category'];
    $status = 1;

    $file_name = $_FILES['avatar']['name'];
    $file_temp = $_FILES['avatar']['tmp_name'];
    $allowed_ext = array("jpeg", "jpg", "gif", "png");
    $exp = explode(".", $file_name);
    $ext = end($exp);
    $path = "../images/" . $file_name;

    if (in_array($ext, $allowed_ext)) {

        if (move_uploaded_file($file_temp, $path)) {

            try {

                if (empty($_POST['user_category'])) {

                    $_SESSION['user-details-required'] = "All Fields Are Required.";
                    header("Location: ../admin/add_user.php");
                    exit(0);
                } else {

                    $query = "INSERT INTO users (username, password, avatar, fullname, contact, email, user_category, status) VALUES (:username, :password, :avatar, :fullname, :contact, :email, :user_category, :status)";
                    $statement = $conn->prepare($query);


                    $data = [
                        ':username' => $username,
                        ':password' => $password,
                        ':avatar' => $file_name,
                        ':fullname' => $fullname,
                        ':contact' => $contact,
                        ':email' => $email,
                        ':user_category' => $user_category,
                        ':status' => $status
                    ];

                    $result = $statement->execute($data);

                    if ($result) {

                        $_SESSION['add-user-success'] = "User Added Successfully!";
                        header("Location: ../admin/manage_user.php");
                        exit(0);
                    } else {

                        $_SESSION['add-user-failed'] = "Something Went Wrong! Failed To Add User.";
                        header("Location: ../admin/add_user.php");
                        exit(0);
                    }
                }
            } catch (PDOException $e) {
                $e->getMessage();
            }
        }
    } else {

        $_SESSION['invalid-file-format'] = "Invalid File Format";
        header("Location: ../admin/add_user.php");
        exit(0);
    }
}

// employee apply for a leave

if (isset($_POST['apply_leave'])) {

    $employee_id = $_POST['id'];
    $reference_number = $_POST['reference_number'];
    $leave_type = $_POST['leave_type'];
    $start_date = $_POST['starting_date'];
    $end_date = $_POST['end_date'];
    $notification_status = 0;
    $leave_status = 0;
    $remarks = "Waiting For Approval";

    try {

        if (empty($_POST['leave_type'])) {

            $_SESSION['leave-application-details-required'] = "All Fields Are Required.";
            header("Location: ../employee/apply_leave.php");
            exit(0);
        } else {

            $query = "INSERT INTO leave_applications (reference_number, employee_id, leave_type_id, start_date, end_date, notification_status, leave_status, remarks) VALUES (:reference_number, :employee_id, :leave_type, :start_date, :end_date, :notification_status, :leave_status, :remarks)";
            $statement = $conn->prepare($query);

            $data = [
                ':reference_number' => $reference_number,
                ':employee_id' => $employee_id,
                ':leave_type' => $leave_type,
                ':start_date' => $start_date,
                ':end_date' => $end_date,
                ':notification_status' => $notification_status,
                ':leave_status' => $leave_status,
                ':remarks' => $remarks
            ];

            $result = $statement->execute($data);

            if ($result) {

                $_SESSION['apply-leave-success'] = "Leave Applied Successfully!";
                header("Location: ../employee/leave_status.php");
                exit(0);
            } else {

                $_SESSION['apply-leave-failed'] = "Something Went Wrong! Failed To Add Leave.";
                header("Location: ../employee/add_leave.php");
                exit(0);
            }
        }
    } catch (PDOException $e) {
        $e->getMessage();
    }
}

// edit department

if (isset($_POST['edit_department'])) {

    $department_id = $_POST['id'];
    $acronym = $_POST['acronym'];
    $name = $_POST['name'];

    try {

        $query = "UPDATE departments SET department_name=:name, department_acronym=:acronym WHERE id =:dept_id LIMIT 1";
        $statement = $conn->prepare($query);

        $data = [
            ':acronym' => $acronym,
            ':name' => $name,
            ':dept_id' => $department_id
        ];

        $result = $statement->execute($data);

        if ($result) {

            $_SESSION['edit-department-success'] = "Department Updated Successfully!";
            header("Location: ../admin/edit_department.php?edit_id=$department_id");
            exit(0);
        } else {

            $_SESSION['edit-department-failed'] = "Something Went Wrong! Failed To Update Department.";
            header("Location: ../admin/edit_department.php?edit_id=$department_id");
            exit(0);
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

// edit designation

if (isset($_POST['edit_designation'])) {

    $designation_id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];

    try {

        $query = "UPDATE designations SET designation_name=:name, designation_description=:description WHERE id =:desg_id LIMIT 1";
        $statement = $conn->prepare($query);

        $data = [
            ':name' => $name,
            ':description' => $description,
            ':desg_id' => $designation_id
        ];

        $result = $statement->execute($data);

        if ($result) {

            $_SESSION['edit-designation-success'] = "Designation Updated Successfully!";
            header("Location: ../admin/edit_designation.php?edit_id=$designation_id");
            exit(0);
        } else {

            $_SESSION['edit-designation-failed'] = "Something Went Wrong! Failed To Update Designation.";
            header("Location: ../admin/edit_designation.php?edit_id=$designation_id");
            exit(0);
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

// edit employee

if (isset($_POST['edit_employee'])) {

    $id = $_POST['id'];
    $gender = $_POST['gender'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $age = $_POST['age'];
    $email_address = $_POST['email_address'];
    $contact_number = $_POST['contact_number'];
    $department = $_POST['department'];
    $designation = $_POST['designation'];
    $account_status = $_POST['account_status'];
    $profile = $_POST['profile'];

    $file_name = $_FILES['avatar']['name'];
    $file_temp = $_FILES['avatar']['tmp_name'];
    $allowed_ext = array("jpeg", "jpg", "gif", "png");
    $exp = explode(".", $file_name);
    $ext = end($exp);
    $path = "../images/" . $file_name;


    if ($file_name == "") {

        try {

            $query = "UPDATE employees SET last_name=:last_name, first_name=:first_name, middle_name=:middle_name, age=:age, gender=:gender, email_address=:email_address, contact_number=:contact_number, department_id=:department_id, designation_id=:designation_id, avatar=:avatar, account_status=:account_status WHERE id =:emp_id LIMIT 1";
            $statement = $conn->prepare($query);

            $data = [
                ':last_name' => $last_name,
                ':first_name' => $first_name,
                ':middle_name' => $middle_name,
                ':age' => $age,
                ':gender' => $gender,
                ':email_address' => $email_address,
                ':contact_number' => $contact_number,
                ':department_id' => $department,
                ':designation_id' => $designation,
                ':avatar' => $profile,
                ':account_status' => $account_status,
                ':emp_id' => $id
            ];

            $result = $statement->execute($data);

            if ($result) {

                $_SESSION['edit-employee-success'] = "Employee Updated Successfully!";
                header("Location: ../admin/edit_employee.php?edit_id=$id");
                exit(0);
            } else {

                $_SESSION['edit-employee-failed'] = "Something Went Wrong! Failed To Update Employee.";
                header("Location: ../admin/edit_employee.php?edit_id=$id");
                exit(0);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    } else {

        if (in_array($ext, $allowed_ext)) {

            if (move_uploaded_file($file_temp, $path)) {

                try {

                    $query = "UPDATE employees SET last_name=:last_name, first_name=:first_name, middle_name=:middle_name, age=:age, gender=:gender, email_address=:email_address, contact_number=:contact_number, department_id=:department_id, designation_id=:designation_id, avatar=:avatar, account_status=:account_status WHERE id =:emp_id LIMIT 1";
                    $statement = $conn->prepare($query);

                    $data = [
                        ':last_name' => $last_name,
                        ':first_name' => $first_name,
                        ':middle_name' => $middle_name,
                        ':age' => $age,
                        ':gender' => $gender,
                        ':email_address' => $email_address,
                        ':contact_number' => $contact_number,
                        ':department_id' => $department,
                        ':designation_id' => $designation,
                        ':avatar' => $file_name,
                        ':account_status' => $account_status,
                        ':emp_id' => $id
                    ];

                    $result = $statement->execute($data);

                    if ($result) {

                        $_SESSION['edit-employee-success'] = "Employee Updated Successfully!";
                        header("Location: ../admin/edit_employee.php?edit_id=$id");
                        exit(0);
                    } else {

                        $_SESSION['edit-employee-failed'] = "Something Went Wrong! Failed To Update Employee.";
                        header("Location: ../admin/edit_employee.php?edit_id=$id");
                        exit(0);
                    }
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
            }
        } else {

            $_SESSION['invalid-file-format'] = "Invalid File Format";
            header("Location: ../admin/edit_employee.php?edit_id=$id");
            exit(0);
        }
    }
}

// edit leave type

if (isset($_POST['edit_leave_type'])) {

    $leave_type_id = $_POST['id'];
    $type = $_POST['type'];
    $description = $_POST['description'];
    $days_allowed = $_POST['days_allowed'];

    try {

        $query = "UPDATE leave_types SET leave_type=:type, description=:description, days_allowed=:days_allowed WHERE id =:lt_id LIMIT 1";
        $statement = $conn->prepare($query);

        $data = [
            ':type' => $type,
            ':description' => $description,
            ':days_allowed' => $days_allowed,
            ':lt_id' => $leave_type_id
        ];

        $result = $statement->execute($data);

        if ($result) {

            $_SESSION['edit-leave_type-success'] = "Leave Type Updated Successfully!";
            header("Location: ../admin/edit_leave_type.php?edit_id=$leave_type_id");
            exit(0);
        } else {

            $_SESSION['edit-leave_type-failed'] = "Something Went Wrong! Failed To Update Leave Type.";
            header("Location: ../admin/edit_leave_type.php?edit_id=$leave_type_id");
            exit(0);
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

// edit user (admin)

if (isset($_POST['edit_user'])) {

    $user_id = $_POST['id'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $user_category = $_POST['user_category'];
    $status = $_POST['status'];

    try {

        $query = "UPDATE users SET fullname=:fullname, email=:email, contact=:contact, user_category=:user_category, status=:status WHERE id =:usr_id LIMIT 1";
        $statement = $conn->prepare($query);

        $data = [
            ':fullname' => $fullname,
            ':email' => $email,
            ':contact' => $contact,
            ':user_category' => $user_category,
            ':status' => $status,
            ':usr_id' => $user_id
        ];

        $result = $statement->execute($data);

        if ($result) {

            $_SESSION['edit-user-success'] = "User Updated Successfully!";
            header("Location: ../admin/edit_user.php?edit_id=$user_id");
            exit(0);
        } else {

            $_SESSION['edit-user-failed'] = "Something Went Wrong! Failed To Update User.";
            header("Location: ../admin/edit_user.php?edit_id=$user_id");
            exit(0);
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

// delete department

if (isset($_GET['delete_department'])) {

    $department_id = $_GET['delete_department'];

    try {

        $query =  "DELETE FROM departments WHERE id=:dept_id";
        $statement = $conn->prepare($query);
        $data = [':dept_id' => $department_id];
        $result = $statement->execute($data);

        if ($result) {

            $_SESSION['delete-department-success'] = "Department Deleted Successfully!";
            header("Location: ../admin/manage_department.php");
            exit(0);
        } else {

            $_SESSION['delete-department-failed'] = "Something Went Wrong! Failed To Delete Department.";
            header("Location: ../admin/manage_department.php");
            exit(0);
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

// delete designation

if (isset($_GET['delete_designation'])) {

    $designation_id = $_GET['delete_designation'];

    try {

        $query =  "DELETE FROM designations WHERE id=:desg_id";
        $statement = $conn->prepare($query);
        $data = [':desg_id' => $designation_id];
        $result = $statement->execute($data);

        if ($result) {

            $_SESSION['delete-designation-success'] = "Designation Deleted Successfully!";
            header("Location: ../admin/manage_designation.php");
            exit(0);
        } else {

            $_SESSION['delete-designation-failed'] = "Something Went Wrong! Failed To Delete Designation.";
            header("Location: ../admin/manage_designation.php");
            exit(0);
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

// delete employee

if (isset($_GET['delete_employee'])) {

    $employee_id = $_GET['delete_employee'];

    try {

        $query =  "DELETE FROM employees WHERE id=:emp_id";
        $statement = $conn->prepare($query);
        $data = [':emp_id' => $employee_id];
        $result = $statement->execute($data);

        if ($result) {

            $_SESSION['delete-employee-success'] = "Employee Deleted Successfully!";
            header("Location: ../admin/manage_employee.php");
            exit(0);
        } else {

            $_SESSION['delete-employee-failed'] = "Something Went Wrong! Failed To Delete Employee.";
            header("Location: ../admin/manage_employee.php");
            exit(0);
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

// delete leave type

if (isset($_GET['delete_leave_type'])) {

    $leave_type_id = $_GET['delete_leave_type'];

    try {

        $query =  "DELETE FROM leave_types WHERE id=:lt_id";
        $statement = $conn->prepare($query);
        $data = [':lt_id' => $leave_type_id];
        $result = $statement->execute($data);

        if ($result) {

            $_SESSION['delete-leave_type-success'] = "Leave Type Deleted Successfully!";
            header("Location: ../admin/manage_leave_type.php");
            exit(0);
        } else {

            $_SESSION['delete-leave_type-failed'] = "Something Went Wrong! Failed To Delete Leave Type.";
            header("Location: ../admin/manage_leave_type.php");
            exit(0);
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

// delete user (admin)

if (isset($_GET['delete_user'])) {

    $user_id = $_GET['delete_user'];

    try {

        $query =  "DELETE FROM users WHERE id=:usr_id";
        $statement = $conn->prepare($query);
        $data = [':usr_id' => $user_id];
        $result = $statement->execute($data);

        if ($result) {

            $_SESSION['delete-user-success'] = "User Deleted Successfully!";
            header("Location: ../admin/manage_user.php");
            exit(0);
        } else {

            $_SESSION['delete-user-failed'] = "Something Went Wrong! Failed To Delete User.";
            header("Location: ../admin/manage_user.php");
            exit(0);
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

// admin approve employee's leave application

if (isset($_POST['approve_leave_application'])) {

    $leave_id = $_POST['leave_id'];
    $leave_status = 1;
    $remarks = "Approved";
    $date_approved = date('Y-m-d h:i:s');
    $user_id = $_POST['user_id'];

    try {

        $query = "UPDATE leave_applications SET leave_status=:leave_status, remarks=:remarks, date_approved=:date_approved, user_id=:user_id WHERE id =:leave_id LIMIT 1";
        $statement = $conn->prepare($query);

        $data = [
            ':leave_status' => $leave_status,
            ':remarks' => $remarks,
            ':date_approved' => $date_approved,
            ':user_id' => $user_id,
            ':leave_id' => $leave_id
        ];

        $result = $statement->execute($data);

        if ($result) {

            $_SESSION['approve-leave-application-success'] = "Leave Application Approved Successfully!";
            header("Location: ../admin/leave_details.php?view_id=$leave_id");
            exit(0);
        } else {

            $_SESSION['approve-leave-application-failed'] = "Something Went Wrong! Failed To Approve Leave Application.";
            header("Location: ../admin/leave_details.php?view_id=$leave_id");
            exit(0);
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

// admin decline employee's leave application

if (isset($_POST['decline_leave_application'])) {

    $leave_id = $_POST['leave_id'];
    $leave_status = 2;
    $remarks = $_POST['reason'];
    $date_declined = date('Y-m-d h:i:s');
    $user_id = $_POST['user_id'];

    try {

        $query = "UPDATE leave_applications SET leave_status=:leave_status, remarks=:remarks, date_declined=:date_declined, user_id=:user_id WHERE id =:leave_id LIMIT 1";
        $statement = $conn->prepare($query);

        $data = [
            ':leave_status' => $leave_status,
            ':remarks' => $remarks,
            ':date_declined' => $date_declined,
            ':user_id' => $user_id,
            ':leave_id' => $leave_id
        ];

        $result = $statement->execute($data);

        if ($result) {

            $_SESSION['decline-leave-application-success'] = "Leave Application Declined Successfully!";
            header("Location: ../admin/leave_details.php?view_id=$leave_id");
            exit(0);
        } else {

            $_SESSION['decline-leave-application-failed'] = "Something Went Wrong! Failed To Decline Leave Application.";
            header("Location: ../admin/decline_leave_application.php?view_id=$leave_id");
            exit(0);
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

// update user (admin) profile

if (isset($_POST['update_user_profile'])) {

    $user_id = $_POST['id'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $password = $_POST['password'];
    $profile = $_POST['profile'];

    $file_name = $_FILES['avatar']['name'];
    $file_temp = $_FILES['avatar']['tmp_name'];
    $allowed_ext = array("jpeg", "jpg", "gif", "png");
    $exp = explode(".", $file_name);
    $ext = end($exp);
    $path = "../images/" . $file_name;

    if ($file_name == "") {

        try {

            $query = "SELECT * FROM users WHERE id=:usr_id";
            $statement = $conn->prepare($query);
            $data = [':usr_id' => $user_id];

            $statement->execute($data);
            $result = $statement->fetch();

            if ($result && password_verify($password, $result['password'])) {


                $query = "UPDATE users SET fullname=:fullname, email=:email, contact=:contact, avatar=:avatar WHERE id =:usr_id LIMIT 1";
                $statement = $conn->prepare($query);

                $data = [
                    ':fullname' => $fullname,
                    ':email' => $email,
                    ':contact' => $contact,
                    ':avatar' => $profile,
                    ':usr_id' => $user_id
                ];

                $result = $statement->execute($data);

                if ($result) {

                    $_SESSION['update-user-profile-success'] = "Profile Updated Successfully!";
                    header("Location: ../admin/update.php?edit_id=$user_id");
                    exit(0);
                } else {

                    $_SESSION['update-user-profile-failed'] = "Something Went Wrong! Failed To Update Profile.";
                    header("Location: ../admin/update.php?edit_id=$user_id");
                    exit(0);
                }
            } else {

                $_SESSION['incorrect-password'] = "Incorrect Password!";
                header("Location: ../admin/update.php?edit_id=$user_id");
                exit(0);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    } else {

        if (in_array($ext, $allowed_ext)) {

            if (move_uploaded_file($file_temp, $path)) {

                try {

                    $query = "SELECT * FROM users WHERE id=:usr_id";
                    $statement = $conn->prepare($query);
                    $data = [':usr_id' => $user_id];

                    $statement->execute($data);
                    $result = $statement->fetch();

                    if ($result && password_verify($password, $result['password'])) {


                        $query = "UPDATE users SET fullname=:fullname, email=:email, contact=:contact, avatar=:avatar WHERE id =:usr_id LIMIT 1";
                        $statement = $conn->prepare($query);

                        $data = [
                            ':fullname' => $fullname,
                            ':email' => $email,
                            ':contact' => $contact,
                            ':avatar' => $file_name,
                            ':usr_id' => $user_id
                        ];

                        $result = $statement->execute($data);

                        if ($result) {

                            $_SESSION['update-user-profile-success'] = "Profile Updated Successfully!";
                            header("Location: ../admin/update.php?edit_id=$user_id");
                            exit(0);
                        } else {

                            $_SESSION['update-user-profile-failed'] = "Something Went Wrong! Failed To Update Profile.";
                            header("Location: ../admin/update.php?edit_id=$user_id");
                            exit(0);
                        }
                    } else {

                        $_SESSION['incorrect-password'] = "Incorrect Password!";
                        header("Location: ../admin/update.php?edit_id=$user_id");
                        exit(0);
                    }
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
            }
        } else {
            $_SESSION['invalid-file-format'] = "Invalid File Format!";
            header("Location: ../admin/update.php?edit_id=$user_id");
            exit(0);
        }
    }
}

// update employee profile

if (isset($_POST['update_employee_profile'])) {

    $employee_id = $_POST['id'];
    $gender = $_POST['gender'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $age = $_POST['age'];
    $email_address = $_POST['email_address'];
    $contact_number = $_POST['contact_number'];
    $department = $_POST['department'];
    $designation = $_POST['designation'];
    $password = $_POST['password'];
    $profile = $_POST['profile'];

    $file_name = $_FILES['avatar']['name'];
    $file_temp = $_FILES['avatar']['tmp_name'];
    $allowed_ext = array("jpeg", "jpg", "gif", "png");
    $exp = explode(".", $file_name);
    $ext = end($exp);
    $path = "../images/" . $file_name;

    if ($file_name == "") {

        try {

            $query = "SELECT * FROM employees WHERE id=:emp_id";
            $statement = $conn->prepare($query);
            $data = [':emp_id' => $employee_id];

            $statement->execute($data);
            $result = $statement->fetch();

            if ($result && password_verify($password, $result['password'])) {

                $query = "UPDATE employees SET last_name=:last_name, first_name=:first_name, middle_name=:middle_name, age=:age, gender=:gender, email_address=:email_address, contact_number=:contact_number, avatar=:avatar WHERE id =:emp_id LIMIT 1";
                $statement = $conn->prepare($query);

                $data = [
                    ':last_name' => $last_name,
                    ':first_name' => $first_name,
                    ':middle_name' => $middle_name,
                    ':age' => $age,
                    ':gender' => $gender,
                    ':email_address' => $email_address,
                    ':contact_number' => $contact_number,
                    ':avatar' => $profile,
                    ':emp_id' => $employee_id
                ];

                $result = $statement->execute($data);

                if ($result) {

                    $_SESSION['update-employee-profile-success'] = "Profile Updated Successfully!";
                    header("Location: ../employee/update.php?edit_id=$employee_id");
                    exit(0);
                } else {

                    $_SESSION['update-employee-profile-failed'] = "Something Went Wrong! Failed To Update Profile.";
                    header("Location: ../employee/update.php?edit_id=$employee_id");
                    exit(0);
                }
            } else {

                $_SESSION['incorrect-password'] = "Incorrect Password!";
                header("Location: ../employee/update.php?edit_id=$employee_id");
                exit(0);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    } else {

        if (in_array($ext, $allowed_ext)) {

            if (move_uploaded_file($file_temp, $path)) {

                try {

                    $query = "SELECT * FROM employees WHERE id=:emp_id";
                    $statement = $conn->prepare($query);
                    $data = [':emp_id' => $employee_id];

                    $statement->execute($data);
                    $result = $statement->fetch();

                    if ($result && password_verify($password, $result['password'])) {

                        $query = "UPDATE employees SET last_name=:last_name, first_name=:first_name, middle_name=:middle_name, age=:age, gender=:gender, email_address=:email_address, contact_number=:contact_number, avatar=:avatar WHERE id =:emp_id LIMIT 1";
                        $statement = $conn->prepare($query);

                        $data = [
                            ':last_name' => $last_name,
                            ':first_name' => $first_name,
                            ':middle_name' => $middle_name,
                            ':age' => $age,
                            ':gender' => $gender,
                            ':email_address' => $email_address,
                            ':contact_number' => $contact_number,
                            ':avatar' => $file_name,
                            ':emp_id' => $employee_id
                        ];

                        $result = $statement->execute($data);

                        if ($result) {

                            $_SESSION['update-employee-profile-success'] = "Profile Updated Successfully!";
                            header("Location: ../employee/update.php?edit_id=$employee_id");
                            exit(0);
                        } else {

                            $_SESSION['update-employee-profile-failed'] = "Something Went Wrong! Failed To Update Profile.";
                            header("Location: ../employee/update.php?edit_id=$employee_id");
                            exit(0);
                        }
                    } else {

                        $_SESSION['incorrect-password'] = "Incorrect Password!";
                        header("Location: ../employee/update.php?edit_id=$employee_id");
                        exit(0);
                    }
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
            }
        } else {

            $_SESSION['invalid-file-format'] = "Invalid File Format!";
            header("Location: ../employee/update.php?edit_id=$employee_id");
            exit(0);
        }
    }
}

// update user (admin) password

if (isset($_POST['update_user_password'])) {

    $user_id = $_POST['id'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    try {

        $query = "SELECT * FROM users WHERE id=:usr_id";
        $statement = $conn->prepare($query);
        $data = [':usr_id' => $user_id];

        $statement->execute($data);
        $result = $statement->fetch();

        if ($result && password_verify($old_password, $result['password'])) {

            if ($new_password == $confirm_password) {

                $new_password = password_hash($new_password, PASSWORD_BCRYPT);

                $query = "UPDATE users SET password=:password WHERE id =:usr_id LIMIT 1";
                $statement = $conn->prepare($query);

                $data = [
                    ':password' => $new_password,
                    ':usr_id' => $user_id
                ];

                $result = $statement->execute($data);

                if ($result) {

                    $_SESSION['update-user-password-success'] = "Password Updated Successfully!";
                    header("Location: ../admin/update_password.php?edit_id=$user_id");
                    exit(0);
                } else {

                    $_SESSION['update-user-password-failed'] = "Something Went Wrong! Failed To Update Password.";
                    header("Location: ../admin/update_password.php?edit_id=$user_id");
                    exit(0);
                }
            } else {

                $_SESSION['password-not-match'] = "Password Not Matched!";
                header("Location: ../admin/update_password.php?edit_id=$user_id");
                exit(0);
            }
        } else {

            $_SESSION['incorrect-password'] = "Incorrect Current Password!";
            header("Location: ../admin/update_password.php?edit_id=$user_id");
            exit(0);
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

// update employee password

if (isset($_POST['update_employee_password'])) {

    $employee_id = $_POST['id'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    try {

        $query = "SELECT * FROM employees WHERE id=:emp_id";
        $statement = $conn->prepare($query);
        $data = [':emp_id' => $employee_id];

        $statement->execute($data);
        $result = $statement->fetch();

        if ($result && password_verify($old_password, $result['password'])) {

            if ($new_password == $confirm_password) {

                $new_password = password_hash($new_password, PASSWORD_BCRYPT);

                $query = "UPDATE employees SET password=:password WHERE id =:emp_id LIMIT 1";
                $statement = $conn->prepare($query);

                $data = [
                    ':password' => $new_password,
                    ':emp_id' => $employee_id
                ];

                $result = $statement->execute($data);

                if ($result) {

                    $_SESSION['update-employee-password-success'] = "Password Updated Successfully!";
                    header("Location: ../employee/update_password.php?edit_id=$employee_id");
                    exit(0);
                } else {

                    $_SESSION['update-employee-password-failed'] = "Something Went Wrong! Failed To Update Password.";
                    header("Location: ../employee/update_password.php?edit_id=$employee_id");
                    exit(0);
                }
            } else {

                $_SESSION['password-not-match'] = "Password Not Matched!";
                header("Location: ../employee/update_password.php?edit_id=$employee_id");
                exit(0);
            }
        } else {

            $_SESSION['incorrect-password'] = "Incorrect Current Password!";
            header("Location: ../employee/update_password.php?edit_id=$employee_id");
            exit(0);
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
