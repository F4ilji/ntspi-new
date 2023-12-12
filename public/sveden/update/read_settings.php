<?php

function tempCopyFile($fromDir, $delDir, $tempDir)
{
    copy($fromDir . '/index.html', $tempDir. '/index.html');
    removeDirectory($delDir);
    if (!file_exists($fromDir)) mkdir($fromDir);
    copy($tempDir . '/index.html', $fromDir. '/index.html');
}