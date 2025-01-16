<?php

function get_head($header_text = "No title", $lang = "ru")
{
?>

  <!DOCTYPE html>
  <html lang="<?= $lang; ?>">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $header_text ?></title>

    <link rel="apple-touch-icon" sizes="60x60" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#3668b1">
    <meta name="theme-color" content="#ffffff">

    <!-- CDN -->
    <?php require_once 'frontend/cdn/top.php' ?>

  </head>

  <body>

    <div class="cursor"></div>

  <?php
}

function get_footer($footer_section_text)
{
  ?>

    <!-- Footer -->
    <footer>

      <div class="footer_content__wrapper mx-5 mt-3 mb-5">
        <p class="text-caption"><?= $footer_section_text ?></p>
      </div>

    </footer>

    <!-- Modals -->
    <?php require_once 'frontend/modal/privacy.php' ?>

    <!-- CDN -->
    <?php require_once 'frontend/cdn/bottom.php' ?>

  </body>

  </html>
<?php
}
