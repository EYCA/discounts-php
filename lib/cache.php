<?php

namespace Eyca;

// cache: dir
if (empty(config()['cache']['dir'])) {
  throw new \Exception('cache (config): dir must be defined');
} elseif (!is_string(config()['cache']['dir'])) {
  throw new \Exception('cache (config): dir must be a string, "' .gettype(config()['cache']['dir']). '" given');
}
// cache: ttl
if (empty(config()['cache']['ttl'])) {
  throw new \Exception('cache (config): ttl must be defined');
} elseif (!is_int(config()['cache']['ttl'])) {
  throw new \Exception('cache (config): ttl must be an integer, "' .gettype(config()['cache']['ttl']). '" given');
}

// define constants
define('CACHE_TTL', config()['cache']['ttl']);
define('CACHE_DIR', '/' === config()['cache']['dir']{0} ? config()['cache']['dir'] : DIR . DS . config()['cache']['dir']);
if (!is_writable(CACHE_DIR)) {
  throw new \Exception('cache (config): directory not writable or does not exist');
}

// cache fnc
function cache($ns, $key, $callback, $ttl = CACHE_TTL)
{
  $file = CACHE_DIR . DS . $ns . '-' . md5(serialize($key)) . '.json';
  if (file_exists($file) and filemtime($file) + $ttl >= time()) {
    return json_decode(file_get_contents($file), TRUE);
  }
  $data = $callback();
  file_put_contents($file, json_encode($data));
  return $data;
}
