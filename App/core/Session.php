<?php



class Session {
    
    
    public static function setFlashMessage(string $type, string $message){
        
        $_SESSION['flash-message'] = [ $type => $message ];
        
    }
    


    public static function setInputs(array $fields) :void{
        
        foreach($fields as $key => $value){

            $_SESSION['input'][$key] = $value;

        }
        

    }
    
    
    public static function setUser(array $fields) :void{
        
        foreach($fields as $key => $value){

            if (is_numeric($value)):
                $value = intval($value);
            else:
                $value = htmlspecialchars($value);
            endif;
            
            $_SESSION['user'][$key] = $value;

        }
        

    }
    
    
    public static function resetSession(string $tabSession):void{
        
        unset($_SESSION[$tabSession]);

    } 
    
    
}
