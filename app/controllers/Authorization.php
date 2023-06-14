<?php
namespace App\controllers;
session_start();
class Authorization extends \App\core\Controller
{
public function index(){
 
     if(!empty($_POST)){   
         $this->authorization($_POST);
     }
}

public function authorization(array $request){
    if(!empty($request)){    
        $errors = $this->validate($request);    
        if(empty($errors)){
           $check = $this->check($request);
           if(!$check){
            $errors[]['name'] = 'Указанного пользователя не существует';
            http_response_code(401);
            echo json_encode([
              'errors' => $errors
            ]); 
           }else{
           $hash = $check['password'];
            if($hash){
                $password =$request['password'];
                $verify = password_verify($password,$hash);
                if(!$verify){
                    $errors[]['name'] = 'Пароль введен не верно';
                    http_response_code(401);
                    echo json_encode([
                      'errors' => $errors
                    ]);    
                }else{
                  
                    $_SESSION['nameUser'] = $request['name'];}

            }  
        }
        }else {
        http_response_code(401);
        echo json_encode([
          'errors' => $errors 
      ]);} ;
    }
    }

public function check(array $data){
     return \App\models\Db::checkUser($data['name']);
}        
public function validate(array $request){
    $errors = [];
    if (!isset($request['email']) || strlen($request['email']) == 0) {
         $errors[]['email'] = 'Email не указан';
    } elseif (!filter_var($request['email'], FILTER_VALIDATE_EMAIL)) {
         $errors[]['email'] = 'Неправильный формат email';
    } elseif (strlen($request['email']) < 4) {
         $errors[]['email'] = 'Email должен быть больше 4х символов';
    }    
    if (!isset($request['name']) || empty($request['name'])) {
         $errors[]['name'] = 'Имя не указано';
    } 
    if (!isset($request['password']) || empty($request['password'])) {
         $errors[]['password'] = 'Пароль не указан';
    }
    if (!isset($request['repeat-password']) || empty($request['repeat-password'])) {
         $errors[]['repeat-password'] = 'Нужно повторить пароль';
    } elseif ((isset($request['password']) && isset($request['repeat-password'])) && ($request['password'] != $request['repeat-password'])) {
         $errors[]['repeat-password'] = 'Пароли не совпадают';
    }
    return $errors ;
}

public function isEmailAlreadyExists(string $email){
    if (\App\models\Db::getUserByEmail($email)) {
        return true;
     }
    return false;
}
public function isNameAlreadyExists(string $name){
    if (\App\models\Db::getUserByName($name)) {
        return true;
    }
    return false;
}
}