<?php

namespace Eyca;

function template($name, $data = [])
{
  include DIR . DS . 'templates' . DS . $name . '.php';
}
