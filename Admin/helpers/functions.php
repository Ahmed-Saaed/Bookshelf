<?php 


function Clean($input){

     return   strip_tags(trim($input));
}



function validate($input,$flag,$length = 6){

     $status = true;
    switch ($flag) {
        case 1:
            # code...
              if(empty($input)){
                  $status = false;
              }
            break;
        
        case 2: 
        # code ... 
        if(!filter_var($input,FILTER_VALIDATE_EMAIL)){
            $status = false;
        }
        break;


        case 3:
        # code ... 
        if(strlen($input) < $length){
            $status = false; 
        }
        break;
  

        case 4: 
        # code ... 
        if(!filter_var($input,FILTER_VALIDATE_INT)){
            $status = false;
        }
        break;

       case 5: 
       #code .... 
       $allowedExtension = ["png",'jpg'];
       if(!in_array($input,$allowedExtension)){
           $status = false;
       }
       break;
    
    case 6 : 
      # code ..... 
      if(!preg_match('/^01[0-2,5][0-9]{8}$/',$input)){
          $status = false;
      }
      break;


      case 7 : 
      # code ..... 
      if(!preg_match('/^[a-zA-Z\s]*$/',$input)){
          $status = false;
      }
      break; 

      case 8 : 
      $date_str = date('m/d/Y',$input);

      $date_arr  = explode('/', $date_str);

      if (!checkdate($date_arr[0], $date_arr[1], $date_arr[2])) {
        $status = false;
      }

    // anothe way using regex : preg_match('%\A(0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])[- /.](19|20)\d\d\z%',$input
      break; 
    }
    return $status ; 
}





function url($url){

 return   "http://".$_SERVER['HTTP_HOST']."/nti-php/bookshelf/".$url;

}

?>