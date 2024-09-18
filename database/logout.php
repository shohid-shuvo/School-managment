<?php  
    // session_start();
    // session_destroy();
    // header('Location: ../index.php');

    
        // Start the session
        session_start();

        // Destroy the session
        session_unset();  // Clear all session variables
        session_destroy();  // Destroy the session data

        // Clear the session cookie if it exists
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        // Redirect to the homepage
        header('Location: ../index.php');
        exit();


?>