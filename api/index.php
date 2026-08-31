<?php

/**
 * Setup writable /tmp directories for Vercel serverless (read-only filesystem).
 * Vercel's filesystem is read-only except for /tmp.
 */
$tmpDirs = [
    '/tmp/storage/app/public',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/framework/testing',
    '/tmp/storage/framework/views',
    '/tmp/storage/logs',
];

foreach ($tmpDirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

require __DIR__.'/../public/index.php';
