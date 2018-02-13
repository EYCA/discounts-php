<div class="p1">
  <table style="width: 100%;">
    <tbody class="bt">
      <?php foreach ($data['discounts']['data'] as $_discount): $_href = Eyca\link_to([ 'id' => $_discount['id'] ], TRUE); ?>
      <tr>
        <td class="p025 bb" style="vertical-align: top;">
          <div class="row">
            <div style="padding-right: .25rem;">
              <a class="show" href="<?= htmlspecialchars($_href) ?>">
                <svg
                  class="image bg-cover bg-black-10"
                  width="50"
                  height="50"
                  viewBox="0 0 1 1"
                  <?php if ($_discount['image']): ?>style="background-image: url(<?= $_discount['image'] ?>);"<?php endif ?>
                ></svg>
              </a>
            </div>
            <div class="span1 p025 f2 lh4">
              <a class="color-blue ul" href="<?= htmlspecialchars($_href) ?>"><?= $_discount['vendor'] ?></a><br><?= $_discount['name'] ?>
            </div>
          </div>
        </td>
        <td class="p05 f2 lh4 bb"><?= $_discount['categories'] ? join(', ', array_map(function ($a) { return $a['name']; }, $_discount['categories'])) : '-' ?></td>
        <td class="p05 f2 lh4 bb"><?= ($_discount['tags'] and $_tags = array_intersect($data['options']['tags'], $_discount['tags'])) ? join(', ', $_tags) : '-' ?></td>
        <td class="p05 f2 lh4 bb ar"><?= $_discount['locations']['count'] ? $_discount['locations']['count'] . ' location(s)' : 'online' ?></td>
      </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</div>
