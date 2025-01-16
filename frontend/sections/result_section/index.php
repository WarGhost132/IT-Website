<section class="result_section section section-space">
  <div class="container">
    <div class="row">
      <div class="col-12 mb-5">
        <a href="/" class="logo__wrapper">
					Core Sync
        </a>
      </div>


      <div class="result_section_message_col col-12">
        <?php
        if (isset($_GET)) {
          $value = null;
          if (isset($_GET["isSuccess"]) ? $_GET["isSuccess"] : false) {
            $value = $result_section['success'];
          } else {
            $value = $result_section['unsuccess'];
          }
        }
        ?>

        <div class="result_section_content_wrapper d-flex flex-column justify-content-center align-items-center text-center">
          <div class="result_section_content_image_wrapper mb-3">
            <img src="<?= $value['img'] ?>" loading="eager" alt="<?= $value['title'] ?>">
          </div>

          <div class="result_section_content_title_wrapper mb-3">
            <h2 class="result_section_text text-h2">
              <span class="bordered-text"><?= $value['title'][0] ?></span>
              <?= $value['title'][1] ?>
            </h2>
          </div>

          <div class="result_section_content_subtitle_wrapper mb-3">
            <p><?= $value['text'] ?></p>
          </div>

          <div class="result_section_button_wrapper">
            <a href="/" class="result_section_button button-primary"><?= $result_button_text ?></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>