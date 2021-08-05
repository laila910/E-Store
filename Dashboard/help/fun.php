<?php 


 session_start();


 function Clean($input){

    $input = trim($input);
    $input = stripcslashes($input);
    $input = htmlspecialchars($input);

    return $input;
  }



# Validate Inputs .... 
function Validate($input,$flag,$length=3){

    $status = true;
    switch ($flag) {
        case 1:
            if(empty($input)){
                $status = false;
            }
            break;
        
        case 2: 
            if(strlen($input) < $length){
                $status = false;
            }
            break;  
            
        case 3: 
            if(!filter_var($input,FILTER_VALIDATE_INT)){
                $status = false;
            }    
            break;

        case 4:
            if(!filter_var($input,FILTER_VALIDATE_EMAIL)){
                $status = false;
            }    
            break;
       
        case 5:
            $allowedExtension = ['png','jpg','jpeg'];    

            if(!(in_array($input,$allowedExtension))){
               $status = false;
            }
            break;

    }

    return $status;
}



# SANITIZE INPUTS ... 
function Sanitized($input,$flag){

    $sanitize_var = $input;

    switch ($flag) {
        case 1:
              
         $sanitize_var = filter_var($sanitize_var,FILTER_SANITIZE_NUMBER_INT);
            break;
        case 2: 
            $sanitize_var = filter_var($sanitize_var,FILTER_SANITIZE_STRING);     
           break;
    }

    return $sanitize_var;
}



 function urll($dis){

  return   $txt = "http://".$_SERVER['HTTP_HOST']."/E-Store/Dashboard/".$dis;


 }
