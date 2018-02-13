<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <?php if (isset($data['canonical'])): ?>
  <link rel="canonical" href="<?= htmlspecialchars($data['canonical']) ?>">
  <?php endif ?>
  <link rel="stylesheet" href="https://unpkg.com/abrusco@0.4.2/css/abrusco.min.css">
  <style>
  .bt,
  .bb {
    border-color: rgba(4, 4, 4, .1);
  }
  </style>
</head>
<body class="col">

  <div class="">
    <div class="max72 mx">
