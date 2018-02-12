<?php include __DIR__ . DS . 'header.php' ?>

  <div class="p1">

    <?php include __DIR__ . DS . 'form.php' ?>

    <?php if ($data['discounts']['count']): ?>

      <?php include __DIR__ . DS . 'results.php' ?>
      <?php include __DIR__ . DS . 'paginate.php' ?>

    <?php else: ?>

      <div class="p1">
        <p class="lh4">No discounts.</p>
      </div>

    <?php endif ?>

  </div>

<?php include __DIR__ . DS . 'footer.php' ?>
