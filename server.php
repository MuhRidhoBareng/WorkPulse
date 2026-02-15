<?php

/**
 * Laravel Router Script for PHP Built-in Server
 * Serves static files directly if they exist, otherwise routes to index.php
 */

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Serve static file directly if it exists
if ($uri !== '/' && file_exists(__DIR__ . '/public' . $uri)) {
    // Let PHP built-in server handle the file
    return false;
}

// Route all other requests to index.php
require_once __DIR__ . '/public/index.php';
