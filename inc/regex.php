<?php

function get_regex_patterns($index) {
    $regex_patterns = [
    'username_html' => '^[a-zA-Z0-9]{3,50}$',
    'password_html' => '^[a-zA-Z0-9_.\-]{8,50}$',
    'email_html' => '^[^@\s]+@[^@\s]+\.[^@\s]+$',
    'emailoruser' => '^([a-zA-Z0-9_.\-]{3,50}|[a-zA-Z0-9._%+\-]+@[a-zA-Z0-9.\-]+\.[a-zA-Z]{2,})$',
    // Patterns for server-side validation
    'username' => '/^(?!.*[_.-]{2})[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ0-9](?:[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ0-9_.-]{0,48}[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ0-9])?$/',
    'email' => '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
    'password' => '/^[a-zA-Z0-9_.-]{8,50}$/',
    'username_or_email' => '/^([a-zA-Z0-9_.-]{3,50}|[a-zA-Z0-9._%+\-]+@[a-zA-Z0-9.\-]+\.[a-zA-Z]{2,})$/'
];
    return $regex_patterns[$index] ?? null;
}

function verify_regex_text($input_data) {
    $errors = [];
    foreach ($input_data as $field => $data) {
        if (!preg_match($data['regex'], $data['value'])) {
            $errors[] = $data['error_msg'];
        }
    }
    return $errors;
}

function clean_text($text) {
    $text = trim($text);
    $text = str_ireplace(['<script>', '</script>', '<iframe>', '</iframe>'], '', $text);
    $text = str_ireplace(['<', '>', '"', "'"], ['&lt;', '&gt;', '&quot;', '&#39;'], $text);
    $text = strip_tags($text); // Remove HTML tags  
    $text = str_ireplace('SELECT', '', $text); // Remove SQL keywords
    $text = str_ireplace('INSERT', '', $text);
    $text = str_ireplace('UPDATE', '', $text);
    $text = str_ireplace('DELETE', '', $text);  
    $text = str_ireplace('DROP', '', $text);
    $text = str_ireplace('CREATE', '', $text);  
     $text = str_ireplace('<?php', '', $text);  
    $text = str_ireplace('?>', '', $text);  
    $text = str_ireplace('<?', '', $text);  
    $text = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
    $text = trim($text); // Trim again to remove any leading or trailing spaces
    return $text;
}