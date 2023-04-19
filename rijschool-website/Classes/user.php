<!-- <?php
// class user {
// public function login($email, $password)
//     {
//         try {
//         $stmt = $this->pdo->prepare("SELECT * FROM instructeur WHERE email = :email");
//         $stmt->bindParam(':email', $email);
//         $stmt->execute();
//         $result = $stmt->fetch(PDO::FETCH_ASSOC);
      
//         if(password_verify($password, $result['wachtwoord']))
//         {
//            $_SESSION['instructeur_session'] = $result['instructeur_id'];
//            return true;
//         }
//         else
//         {
//            return false;
//         }}
//             catch(PDOException $e)
//             {
//                 echo $e->getMessage();
//             }
//     }
      
//         public function is_loggedin()
//         {
//            if(isset($_SESSION['instructeur_session']))
//            {
//               return true;
//            }
//         }
      
//         public function redirect($url)
//         {
//             header("Location: ../instructeur-page/instructeur.php");
//         }

    
    


// } -->
