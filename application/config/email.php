<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

$config['useragent']      = 'CodeIgniter';
$config['protocol']       = 'sendmail';
$config['mailpath']       = '/usr/sbin/sendmail';
$config['wordwrap']       = true;
$config['wrapchars']      = 76;
$config['mailtype']       = 'html';
$config['charset']        = 'utf-8';
$config['validate']       = false;
$config['priority']       = 3;
$config['crlf']           = "\r\n";
$config['newline']        = "\r\n";
$config['bcc_batch_mode'] = false;
$config['bcc_batch_size'] = 200;

//SMTP settings
$config['protocol']  = 'smtp';
$config['smtp_host'] = 'ssl://smtp.gmail.com';
$config['smtp_port'] = 465;
$config['smtp_user'] = 'a.vdberg98@gmail.com';
$config['smtp_pass'] = 'zhyspylujuakntzn';
$config['mailtype']  = 'html';
$config['charset']   = 'utf-8';
