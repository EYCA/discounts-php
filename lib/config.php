<?php

namespace Eyca;

function config()
{
  static $config;
  if (!$config) {
    $config = include DIR . DS . 'config.php';
  }
  return $config;
}
