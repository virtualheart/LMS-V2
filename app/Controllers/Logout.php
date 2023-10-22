<?php

namespace App\Controllers;

class Logout extends BaseController
{
    public function index()  
    {  
        $session = Session();
        $session->destroy();

        // Get the session save path
        $sessionSavePath = session_save_path();

        // Get the maximum session lifetime (in seconds)
        $maxLifetime = ini_get('session.gc_maxlifetime');
        

        if (!empty($sessionSavePath) && is_dir($sessionSavePath)) {
            // Get the current timestamp
            $currentTime = time();

            // List session files in the save path
            $sessionFiles = glob($sessionSavePath . '/ci_*');

            foreach ($sessionFiles as $file) {
                // Check if the session file is older than the maximum lifetime
                if (filemtime($file) + $maxLifetime < $currentTime) {
                    unlink($file); // Delete the expired session file
                }
            }
        }
        
        return redirect()->to('/');
    }
}