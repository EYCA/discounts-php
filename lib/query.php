<?php

namespace Eyca;

function query($query = '{ hello }', $vars = NULL)
{
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, config()['api']['url']);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([ 'query' => $query, 'variables' => $vars ]));
  curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Accept: application/json',
  ]);
  $res = curl_exec($ch);

  if (strpos(curl_getinfo($ch, CURLINFO_CONTENT_TYPE), 'application/json') === FALSE) {
    throw new \Exception('invalid data returned');
  }

  $json = json_decode($res, TRUE);

  if (gettype($json) !== 'array') {
    throw new \Exception('invalid data returned');
  }
  if (isset($json['errors'])) {
    throw new \Exception($json['errors'][0]['message']);
  }
  if (!isset($json['data'])) {
    throw new \Exception('no data returned');
  }

  return $json['data'];
}
