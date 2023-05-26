<?php
session_start();

$conn = mysqli_connect("localhost" ,'root' ,'', 'users');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

class Connection {
    public $host = "localhost";
    public $user = 'root';
    public $password = '';
    public $dbname = 'users';
    public $conn;

    public function __construct() {
        $this->conn = mysqli_connect($this->host, $this->user, $this->password, $this->dbname);
        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }
}

class Register extends Connection {

    public function registration($name, $email, $password, $repassword ) {
        $duplicate = mysqli_query($this->conn, "SELECT * FROM users WHERE name = '$name' OR email = '$email'");
        if (mysqli_num_rows($duplicate) > 0) {
            return 10;
            // Name or email has already been taken
        } else {
            if ($password == $repassword) {
                $query = "INSERT INTO users (name,email,password, role )VALUES ( '$name', '$email', '$password',2)";
                mysqli_query( $this-> conn, $query);
                return 1;
                // Registration successful
            }else{
                return 100;
                //password not identical
            }   
        }     
    }  
}

class login extends Connection{
    public $id;
    public function login( $email, $password ){
        $result = mysqli_query($this->conn, "SELECT * FROM users WHERE email = '$email'");
        $row= mysqli_fetch_assoc($result);

        if (mysqli_num_rows($result) > 0){
            if($password == $row["password"]){
                $this->id=$row["id"];
                return 1;
                //login succesful
           
            }else{
                return 10; //wrong password
            }

        }else{
            return 100;
            //user not registred
        }
    }
    public function idUser(){
        return $this->id;
    }
}

class Select extends Connection{
    public function selectUserById($id){
        $result= mysqli_query($this->conn , "SELECT * FROM users WHERE id = $id  ");
        return mysqli_fetch_assoc($result);
    }
}

class SelectUser extends Connection{
    public function selectUserById($id){
        $result= mysqli_query($this->conn , "SELECT * FROM users WHERE id = $id ");
        return mysqli_fetch_assoc($result);
    }
}


class Update extends Connection {

    public function update($name, $email ) {
        $update = "UPDATE users SET name='$name', email='$email' WHERE email='$email'";
        $result = mysqli_query($this->conn, $update);

    }  
}


class Delete extends Connection {
    public function delete($id) {
        $delete = "DELETE FROM users WHERE id = $id ";
        $result = mysqli_query($this->conn, $delete);

    
    }
}



// class SelectAdmin extends Connection{
//     public function selectUsers(){
//         $query = mysqli_query($this->conn , "SELECT * FROM users WHERE id = 1");
//          $result= mysqli_query($query);
//     }
// }



?>
