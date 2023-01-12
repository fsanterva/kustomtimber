<?php if( $slantedBottom ) : ?>
    <?php
    $slantedBottomColorVal = ( $slantedBottomPos == 'left' ) ? 'transparent transparent transparent '.$slantedBottomColor : 'transparent transparent '.$slantedBottomColor.' transparent';
    ?>
    <span class="slanted__edge slanted__edge--bottom slanted__edge--bottom<?=$slantedBottomPos?>" style="border-color:<?= $slantedBottomColorVal ?>;"></span>
  <?php endif; ?>
</section>
<?php if($once[$row_layout] == 1) : ?>
  <?php if( $layoutName != $firstSection ) : ?>

    <?php if(file_exists($componentStyle)) : ?>
        <style><?php require $componentStyle; ?></style>
    <?php endif; ?>

    <?php if(file_exists($componentScript)) : ?>
        <script><?php require $componentScript; ?></script>
    <?php endif; ?>

  <?php endif; ?>

<?php endif; ?>

<!-- IF COMPONENT HAS CUSTOM CSS SET WITHIN ACF -->
<?php if( !empty( $custom_css ) ) : ?>
    <style><?php echo $custom_css; ?></style>
<?php endif; ?>