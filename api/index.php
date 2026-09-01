<?php

/**
 * Vercel Serverless Entry Point for Laravel
 *
 * Vercel's filesystem is read-only except for /tmp.
 * We create all required writable directories in /tmp
 * before booting Laravel.
 */

// Create all required writable directories in /tmp
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

// Symlink storage/app/public -> public/storage so asset URLs work
if (!file_exists(__DIR__ . '/../public/storage')) {
    @symlink('/tmp/storage/app/public', __DIR__ . '/../public/storage');
}

require __DIR__ . '/../public/index.php';
