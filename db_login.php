<?php
    

    session_start();
    
    include "db_conn.php";
    
    if (isset($_POST['userName']) && isset($_POST['password'])) {
    
        function validate($data){
    
           $data = trim($data);
    
           $data = stripslashes($data);
    
           $data = htmlspecialchars($data);
    
           return $data;
    
        }
    
        $userName = validate($_POST['userName']);
    
        $password = validate($_POST['password']);
    
        if (empty($userName)) {
    
            header("Location: login.php?error=User Name is required");
    
            exit();
    
        }else if(empty($password)){
    
            header("Location: login.php?error=Password is required");
    
            exit();
    
        }else{
    
            $sql = "SELECT * FROM user WHERE userName ='$userName' AND password ='$password'";
    
            $result = mysqli_query($conn, $sql);
    
            if (mysqli_num_rows($result) === 1) {
    
                $row = mysqli_fetch_assoc($result);
    
                if ($row['userName'] === $userName && $row['password'] === $password) {
    
                    echo "Logged in!";
    
                    $_SESSION['userName'] = $row['userName'];
    
                    $_SESSION['name'] = $row['name'];
    
                    $_SESSION['id'] = $row['id'];
    
                    header("Location: indexLI.php");
    
                    exit();
    
                }else{
    
                    header("Location: login.php?error=Incorect User name or password");
    
                    exit();
    
                }
    
            }else{
    
                header("Location: login.php?error=Incorect User name or password");
    
                exit();
    
            }
    
        }
    
    }else{
    
        header("Location: indexLI.php");
    
        exit();
    
    }
?>