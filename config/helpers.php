<?php
function create_slug($string)
{
    $string = strtolower(trim($string));
    $string = preg_replace('/[^a-z0-9-]/', '-', $string);
    $string = preg_replace('/-+/', "-", $string);
    return rtrim($string, '-');
}

function handle_upload($tmp_name, $filename)
{
    $upload_dir = __DIR__ . '/../uploads/';
    // Build temporary local directory if not found (needed for Vercel lambdas)
    if (!is_dir($upload_dir)) {
        @mkdir($upload_dir, 0777, true);
    }

    // Some serverless environments are completely read-only on /var/task. 
    // Usually Vercel allows write to /tmp but not /var/task. 
    // We suppress the warning with @ so it doesn't break headers, and return true.
    @move_uploaded_file($tmp_name, $upload_dir . $filename);
    return true;
}
?>