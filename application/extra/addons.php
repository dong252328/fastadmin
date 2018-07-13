<?php

return array (
  'autoload' => false,
  'hooks' => 
  array (
    'login_init' => 
    array (
      0 => 'loginbg',
    ),
    'testhook' => 
    array (
      0 => 'markdown',
    ),
    'upload_after' => 
    array (
      0 => 'thumb',
    ),
    'wipecache_after' => 
    array (
      0 => 'tinymce',
    ),
    'set_tinymce' => 
    array (
      0 => 'tinymce',
    ),
  ),
  'route' => 
  array (
    '/qrcode$' => 'qrcode/index/index',
    '/qrcode/build$' => 'qrcode/index/build',
  ),
);