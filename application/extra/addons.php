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
    'sms_send' => 
    array (
      0 => 'rlsms',
      1 => 'smsbao',
    ),
    'sms_notice' => 
    array (
      0 => 'rlsms',
      1 => 'smsbao',
    ),
    'sms_check' => 
    array (
      0 => 'rlsms',
      1 => 'smsbao',
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
    '/third$' => 'third/index/index',
    '/third/connect/[:platform]' => 'third/index/connect',
    '/third/callback/[:platform]' => 'third/index/callback',
  ),
);