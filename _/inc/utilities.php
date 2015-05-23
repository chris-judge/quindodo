<?php

function quindo_svg_icon($id, $title = NULL){
    ?>
    <svg viewBox="0 0 100 100" class="icon icon-<?php echo $id; ?>">
      <use xlink:href="#icon-<?php echo $id; ?>"></use>
      <?php if ($title) : ?><title><?php echo $title; ?></title><?php endif; ?>
    </svg>
    <?php
}