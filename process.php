<?php
    $conn = new mysqli("localhost", "root", "", "crud-vue");
    if ($conn->connect_error) {
        die("Connection Failed!".$conn->connect_error);
    }
    
    $result = array('error'=>false);
    $action = '';

    if (isset($_GET['action'])) {
        $action = $_GET['action'];
    }

    // read
    if ($action == 'read') {
        $sql = $conn->query("SELECT * FROM user");
        $user = array();
        while ($row = $sql->fetch_assoc()) {
            array_push($user, $row);
        }
        $result['user'] = $user;
    }

    // create
    if ($action == 'create') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        $sql = $conn->query("INSERT INTO user (name,email,phone) VALUES('$name', '$email', '$phone')");
        
        if ($sql) {
            $result['message'] = "User added success";
        }
        else {
            $result['error'] = true;
            $result['message'] = "failed to add user";
        }
    }

    // update
    if ($action == 'update') {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        $sql = $conn->query("UPDATE user SET name='$name', email='$email', phone='$phone' WHERE id='$id'");
        
        if ($sql) {
            $result['message'] = "User update success";
        }
        else {
            $result['error'] = true;
            $result['message'] = "failed to update user";
        }
    }

    // delete
    if ($action == 'delete') {
        $id = $_POST['id'];

        $sql = $conn->query("DELETE FROM user WHERE id='$id'");
        
        if ($sql) {
            $result['message'] = "User delete success";
        }
        else {
            $result['error'] = true;
            $result['message'] = "failed to delete user";
        }
    }

    $conn->close();
    echo json_encode($result);

?>