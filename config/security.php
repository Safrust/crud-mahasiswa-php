<?php
/**
 * Security Configuration for CRUD Mahasiswa
 * Berisi fungsi-fungsi keamanan untuk aplikasi
 */

class Security {
    
    /**
     * Validate and sanitize input
     */
    public static function sanitizeInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    /**
     * Validate NIM format (8 digits)
     */
    public static function validateNIM($nim) {
        return preg_match('/^\d{8}$/', $nim);
    }
    
    /**
     * Validate name (only letters, spaces, and common characters)
     */
    public static function validateName($name) {
        return preg_match('/^[a-zA-Z\s\.\',-]+$/', $name);
    }
    
    /**
     * Validate date format
     */
    public static function validateDate($date) {
        $d = DateTime::createFromFormat('Y-m-d', $date);
        return $d && $d->format('Y-m-d') === $date;
    }
    
    /**
     * Generate CSRF token for future use
     */
    public static function generateCSRFToken() {
        if (!isset($_SESSION)) {
            session_start();
        }
        return $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    
    /**
     * Verify CSRF token
     */
    public static function verifyCSRFToken($token) {
        if (!isset($_SESSION)) {
            session_start();
        }
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }
}
?>