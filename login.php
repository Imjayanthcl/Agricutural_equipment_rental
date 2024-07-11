<?php



$conn= new mysqli('localhost', 'root', '', 'agrirent');
 if($conn->connect_error)
  { 
    die('Connection Failed :' .$conn->connect_error);
}

$username =$_POST['username'];
$password =$_POST['password'];


$stmt =$conn->prepare("select * from users where username= ? and password=?");
     $stmt->bind_param("ss",$username,$password); 
$stmt->execute(); 
$result =$stmt->get_result();
// check match ing recors

if($result->num_rows === 1){

    echo "login Successfully...";
    header("Location:index1.html");
}
     else
     {
     echo "login Failed!!!!. Please check your password and username";

}


$stmt->close();
$conn->close();

?>