<?php
class oauthLogin {
    
    public function userDetails($user_session)
    {
        $db = getDB();
        $query = $db->prepare("SELECT * FROM users WHERE  id=:session_id");
        $query->bindParam("session_id", $user_session,PDO::PARAM_INT) ;
        $query->execute();
        $data = $query->fetch(PDO::FETCH_OBJ);
        $db = null;
        return $data;
    }
    
    public function userSignup($userData,$loginProvider)
    {
        
        $first_name='';
        $last_name='';
        $gender='';
        $birthday='';
        $location= '';
        $hometown='';
        $bio='';
        $relationship='';
        $timezone='';
        $picture='';
        $blog='';
        
        if($loginProvider == 'microsoft')
        {
            $email=$userData->emails->account;
        }
        else {
            $email=$userData->email;
        }
        
        $emain_check = preg_match('~^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.([a-zA-Z]{2,4})$~i', $email);
        //Email Check
        if(strlen(trim($email))>0 && $emain_check>0){
            
            
            
            $provider_id=$userData->id;
            // Common for facebook and git
            if($loginProvider == 'linkedin') {
                $name=$userData->firstName.' '.$userData->lastName;
            }
            else{
                $name=$userData->name;
            }
            
            if($loginProvider == 'facebook')
            {
                $first_name=$userData->first_name;
                $last_name=$userData->last_name;
                $gender=$userData->gender;
                $timezone=$userData->timezone;
                $picture='https://graph.facebook.com/'.$provider_id.'/picture?type=large';
                
            }
            
            else if($loginProvider == 'microsoft'){
                
                $first_name=$userData->first_name;
                $last_name=$userData->last_name;
                if($userData->birth_month)
                $birthday=$userData->birth_month.'/'.$userData->birth_day.'/'.$userData->birth_year;
            }
            
            else if($loginProvider == 'google')
            {
                
                $first_name=$userData->given_name;
                $last_name=$userData->family_name;
                $gender=$userData->gender;
                $timezone=$userData->timezone;
                $picture=$userData->picture;
            }
            
            else if($loginProvider == 'github')
            {
                
                $picture=$userData->avatar_url;
                $blog=$userData->blog;
                $bio=$userData->bio;
            }
            else if($loginProvider == 'linkedin')
            {
                
                $first_name=$userData->firstName;
                $last_name=$userData->lastName;
            }
            
            
            
            
            $db = getDB();
            
            $sql = $db->prepare("SELECT id,provider FROM users WHERE  email=:email");
            $sql->bindParam("email", $email,PDO::PARAM_STR) ;
            $sql->execute();
            // User check with email
            if($sql->rowCount() == 0){
                
                $query = $db->prepare("INSERT INTO users
                (email, name, first_name, last_name, gender, birthday, location,
                hometown, bio, relationship, timezone, provider, provider_id,picture)
                VALUES (:email, :name, :first_name, :last_name, :gender, :birthday, :location, :hometown,
                :bio, :relationship,:timezone, :provider , :provider_id, :picture)");
                $query->bindParam("name", $name ,PDO::PARAM_STR) ;
                $query->bindParam("first_name", $first_name ,PDO::PARAM_STR) ;
                $query->bindParam("last_name", $last_name ,PDO::PARAM_STR) ;
                $query->bindParam("email", $email ,PDO::PARAM_STR) ;
                $query->bindParam("gender", $gender ,PDO::PARAM_STR) ;
                $query->bindParam("birthday", $birthday ,PDO::PARAM_STR) ;
                $query->bindParam("location", $location ,PDO::PARAM_STR) ;
                $query->bindParam("hometown", $hometown ,PDO::PARAM_STR) ;
                $query->bindParam("bio", $bio ,PDO::PARAM_STR) ;
                $query->bindParam("relationship", $relationship ,PDO::PARAM_STR) ;
                $query->bindParam("timezone", $timezone ,PDO::PARAM_STR) ;
                $query->bindParam("provider_id", $provider_id ,PDO::PARAM_STR) ;
                $query->bindParam("provider", $loginProvider ,PDO::PARAM_STR) ;
                $query->bindParam("picture", $picture ,PDO::PARAM_STR) ;
                $query->execute();
                
                
            }
            else {
                
                $row= $sql->fetch(PDO::FETCH_OBJ);
                $provider=$row->provider;
                $id=$row->id;
                
                if($provider != $loginProvider)
                {
                    
                    if(strlen($first_name)){
                        $query = $db->prepare(" UPDATE users SET first_name =:first_name WHERE id=:id ");
                        $query->bindParam("first_name", $first_name ,PDO::PARAM_STR) ;
                        $query->bindParam("id", $id ,PDO::PARAM_STR) ;
                        $query->execute();
                    }
                    
                    if(strlen($last_name)){
                        $query = $db->prepare(" UPDATE users SET last_name =:last_name WHERE id=:id ");
                        $query->bindParam("last_name", $last_name ,PDO::PARAM_STR) ;
                        $query->bindParam("id", $id ,PDO::PARAM_STR) ;
                        $query->execute();
                    }
                    
                    if(strlen($gender)){
                        $query = $db->prepare(" UPDATE users SET gender =:gender WHERE id=:id ");
                        $query->bindParam("gender", $gender ,PDO::PARAM_STR) ;
                        $query->bindParam("id", $id ,PDO::PARAM_STR) ;
                        $query->execute();
                    }
                    
                    if(strlen($location)){
                        $query = $db->prepare(" UPDATE users SET location =:location WHERE id=:id ");
                        $query->bindParam("location", $location ,PDO::PARAM_STR) ;
                        $query->bindParam("id", $id ,PDO::PARAM_STR) ;
                        $query->execute();
                    }
                    
                    if(strlen($birthday)){
                        $query = $db->prepare(" UPDATE users SET birthday =:birthday WHERE id=:id ");
                        $query->bindParam("birthday", $birthday ,PDO::PARAM_STR) ;
                        $query->bindParam("id", $id ,PDO::PARAM_STR) ;
                        $query->execute();
                    }
                    
                    
                    if(strlen($picture)){
                        $query = $db->prepare(" UPDATE users SET picture =:picture WHERE id=:id ");
                        $query->bindParam("picture", $picture ,PDO::PARAM_STR) ;
                        $query->bindParam("id", $id ,PDO::PARAM_STR) ;
                        $query->execute();
                    }
                    
                    
                    $query = $db->prepare(" UPDATE users SET provider_id =:provider_id, provider =:provider WHERE id=:id ");
                    $query->bindParam("provider_id", $provider_id ,PDO::PARAM_STR) ;
                    $query->bindParam("provider", $loginProvider ,PDO::PARAM_STR) ;
                    $query->bindParam("id", $id ,PDO::PARAM_STR) ;
                    $query->execute();
                    
                }
                
            }
            
            $success_query = $db->prepare("SELECT * FROM users WHERE  email=:email");
            $success_query->bindParam("email", $email ,PDO::PARAM_STR) ;
            $success_query->execute();
            $data = $success_query->fetch(PDO::FETCH_OBJ);
            $db = null;
            return $data;
            
            
        }
        
        
    }
    
    
}

?>