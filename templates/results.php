<div class="p1">
  <table style="width: 100%;">
    <tbody class="bt">
      <?php foreach ($data['discounts']['data'] as $_discount): ?>
      <tr>
        <td class="p05 f2 lh4 bb"><a class="color-blue ul" href="<?= htmlspecialchars(Eyca\link_to([ 'id' => $_discount['id'] ], TRUE)) ?>"><?= $_discount['vendor'] ?></a><br><?= $_discount['name'] ?></td>
        <td class="p05 f2 lh4 bb"><?= $_discount['categories'] ? join(', ', array_map(function ($a) { return $a['name']; }, $_discount['categories'])) : '-' ?></td>
        <td class="p05 f2 lh4 bb"><?= ($_discount['tags'] and $_tags = array_intersect($data['options']['tags'], $_discount['tags'])) ? join(', ', $_tags) : '-' ?></td>
        <td class="p05 f2 lh4 bb ar"><?= $_discount['locations']['count'] ? $_discount['locations']['count'] . ' location(s)' : 'online' ?></td>
      </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</div>
