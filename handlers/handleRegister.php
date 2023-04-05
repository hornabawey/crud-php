<?php 
session_start();
include'../core/functions.php';
include'../core/validations.php';
include'../data/users.php';

$errors=[];


if(checkrRequestMethod("POST") && checkPostInput('name')){

    foreach($_POST as $key => $value){
        $$key = sanitize($value);

    }
    if(!requiredVal($name)){
        $errors[]= "name is required";
    }elseif(!minVal($name,3)){
        $errors[]="name is too short";
    }elseif(!maxVal($name,25)){
        $errors[]="name is too long";
    }


    if(!requiredVal($email)){
        $errors[]= "email is required";
    }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $errors[]="email not valid";
    }


    if(!requiredVal($password)){
        $errors[]= "password is required";
    }elseif(!minVal($password,3)){
        $errors[]="password is too short";
    }elseif(!maxVal($password,25)){
        $errors[]="password is too long";
    }

    if(!requiredVal($con_password)){
        $errors[]= "confirm password is required";
    }elseif($password !== $con_password){
        $errors[]="they are not cogrent";
    }

    if(!empty($errors)){
      $_SESSION['errors']=$errors;

        redirect("../register.php");
    }else{
       
       
       $new_user=['name'=>$name,'email'=>$email,'password'=>$password];
       createUser($new_user);
       $_SESSION['success']="user created";
       header("location:../login.php");
    }




  

}else{
    $errors[]="wrong method";
    $_SESSION['errors'] = $errors;
    header("Location:register.php");
}





?>