<?php if ($data['paginate']['pages'] > 1): ?>
<div class="p1 row justify-center">
  <?php /* prev */ ?>
  <?php if ($data['paginate']['pageno'] > 0): ?>
  <a class="show p05 color-black-50" href="<?= htmlspecialchars(Eyca\link_to([ 'pageno' => $data['paginate']['pageno'] ], TRUE)) ?>">&lt;</a>
  <?php endif ?>
  <?php /* first */ ?>
  <?php if ($data['paginate']['min'] > 0): ?>
  <a class="show p05 color-black-50" href="<?= htmlspecialchars(Eyca\link_to([ 'pageno' => NULL ], TRUE)) ?>">1</a>
  <span class="show p05 color-black-20">&hellip;</span>
  <?php endif ?>
  <?php /* range */ ?>
  <?php foreach (range($data['paginate']['min'], $data['paginate']['max'] - 1) as $i): ?>
  <?php if ($i === $data['paginate']['pageno']): ?>
  <span class="show p05 bold"><?= $i + 1 ?></span>
  <?php else: ?>
  <a class="show p05 color-black-50" href="<?= htmlspecialchars(Eyca\link_to([ 'pageno' => $i + 1 ], TRUE)) ?>"><?= $i + 1 ?></a>
  <?php endif ?>
  <?php endforeach ?>
  <?php /* last */ ?>
  <?php if ($data['paginate']['max'] < $data['paginate']['pages']): ?>
  <span class="show p05 color-black-20">&hellip;</span>
  <a class="show p05 color-black-50" href="<?= htmlspecialchars(Eyca\link_to([ 'pageno' => $data['paginate']['pages'] ], TRUE)) ?>"><?= $data['paginate']['pages'] ?></a>
  <?php endif ?>
  <?php /* next */ ?>
  <?php if ($data['paginate']['pageno'] + 1 < $data['paginate']['pages']): ?>
  <a class="show p05 color-black-50" href="<?= htmlspecialchars(Eyca\link_to([ 'pageno' => $data['paginate']['pageno'] + 2 ], TRUE)) ?>">&gt;</a>
  <?php endif ?>
</div>
<?php endif ?>
