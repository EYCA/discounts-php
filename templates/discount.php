<?php include __DIR__ . DS . 'header.php' ?>

  <div class="p1">

    <div class="p05">
      <div class="row justify-between items-center">
        <h1 class="p05 h3 lh3 fw500"><?= $data['discount']['vendor'] ?></h1>
        <div class="p05"><a class="color-black-50 ul" href="<?= htmlspecialchars(Eyca\link_to([ 'id' => NULL ], TRUE)) ?>">back</a></div>
      </div>
      <h2 class="p05 h5 lh3 fw700"><?= $data['discount']['name'] ?></h2>
    </div>
    <?php if ($data['discount']['categories'] or $data['discount']['tags']): ?>
    <div class="p05">
      <div class="p025">
        <?php if ($data['discount']['categories']): ?>
        <p class="p025 lh4"><?= join(', ', array_map(function ($a) { return $a['name']; }, $data['discount']['categories'])) ?></p>
        <?php endif ?>
        <?php if ($data['discount']['tags'] and $_tags = array_intersect($data['options']['tags'], $data['discount']['tags'])): ?>
        <p class="p025 lh4"><?= join(', ', $_tags) ?></p>
        <?php endif ?>
      </div>
    </div>
    <?php endif ?>
    <div class="p05">
      <p class="p05 lh4"><?= nl2br($data['discount']['text']) ?></p>
      <?php if ($data['discount']['textLocal']): ?><p class="p05 lh4 color-black-50"><?= nl2br($data['discount']['textLocal']) ?></p><?php endif ?>
    </div>
    <?php if ($data['discount']['email'] or $data['discount']['phone'] or $data['discount']['web']): ?>
    <div class="p05">
      <dl class="lh4 p025">
        <?php if ($data['discount']['email']): ?><dt class="p025 mr05 color-black-50" style="float: left;">Email</dt><dd class="p025"><?= $data['discount']['email'] ?></dd><?php endif ?>
        <?php if ($data['discount']['phone']): ?><dt class="p025 mr05 color-black-50" style="float: left;">Phone</dt><dd class="p025"><?= $data['discount']['phone'] ?></dd><?php endif ?>
        <?php if ($data['discount']['web']): ?><dt class="p025 mr05 color-black-50" style="float: left;">Web</dt><dd class="p025"><?= $data['discount']['web'] ?></dd><?php endif ?>
      </dl>
    </div>
    <?php endif ?>
    <?php if ($data['discount']['locations']['count']): ?>
    <div class="grid grid3 p05">
      <?php foreach ($data['discount']['locations']['data'] as $_location): ?>
      <div class="p05 lh4">
        <a class="ul" target="_blank" href="<?php if ($_location['geo']): ?>http://maps.google.com/maps?q=<?= $_location['geo']['lat'] ?>,<?= $_location['geo']['lng'] ?><?php else: ?>#<?php endif ?>"><?= nl2br($_location['street']) ?></a><br>
        <?= $_location['zip'] ?> <?= $_location['city'] ?><br>
        <?= $_location['country']['name'] ?>
        <?php if ($_location['country']['region']): ?>
        - <?= $_location['country']['region'] ?>
        <?php endif ?>


      </div>
      <?php endforeach ?>
    </div>
    <?php endif ?>

  </div>

<?php include __DIR__ . DS . 'footer.php' ?>
