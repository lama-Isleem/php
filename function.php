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

class Change extends Connection {
    
    public function change($id, $oldpassword, $newpassword) {
        $id = mysqli_real_escape_string($this->conn, $id);
        $oldpassword = mysqli_real_escape_string($this->conn, $oldpassword);
        $newpassword = mysqli_real_escape_string($this->conn, $newpassword);
        
        // Hash the new password using MD5
        $newpassword = md5($newpassword);
        
        // Retrieve the current hashed password from the database using the unique identifier
        $query = "SELECT password FROM users WHERE id = '$id'";
        $result = mysqli_query($this->conn, $query);
        
        if ($result && mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $hashedPassword = $row['password'];
            
            // Verify the old password against the hashed password
            if (md5($oldpassword) === $hashedPassword) {
                // Update the password in the database
                $update = "UPDATE users SET password = '$newpassword' WHERE id = '$id'";
                $updateResult = mysqli_query($this->conn, $update);
                
                if ($updateResult) {
                    return 1; // Password updated successfully
                } else {
                    return 10; // Failed to update the password
                }
            } else {
                return 100; // Old password doesn't match
            }
        } else {
            return false; // Failed to fetch the current password
        }
    }
}



// class SelectAdmin extends Connection{
//     public function selectUsers(){
//         $query = mysqli_query($this->conn , "SELECT * FROM users WHERE id = 1");
//          $result= mysqli_query($query);
//     }
// }



?>
