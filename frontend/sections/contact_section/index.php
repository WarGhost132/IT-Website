<section class="contact_section section-space" id="contacts">

  <div class="container">
    <div class="row">
      <div class="col-12 col-xs-12 col-sm-12 col-md-3 col-lg-4">
        <div class="logo__wrapper d-md-block mb-md-0 mb-4 d-flex justify-content-center">
          <a href="<?=$general_target_website?>" class="target_website">
						Core Sync
          </a>
        </div>
      </div>

      <div class="col-12 col-xs-12 col-sm-12 col-md-9 col-lg-8">
        <div class="contact_section_title__wrapper">
          <h2 class="text-h2 bordered-text"><?= $contact_section_header ?></h2>
        </div>

        <div class="contact_section_subtitle__wrapper">
          <p><?= $contact_section_subheader ?></p>
        </div>

        <div class="contact_section_form__wrapper">
          <form id="contactForm" source="ru" country-code="<?=$general_country_code?>">

            <div class="row">
              <?php
              foreach (array_slice($contact_form_text, 0, count($contact_form_text) - 2, true) as $key => $value) {
              ?>

                <div class="col-12 col-sm-12 col-md-6 mb-4 d-flex justify-content-center justify-content-md-start">

                  <div class="contact_form_input__wrapper w-100">

                    <label for="<?= $value['id'] ?>">
                      <?= $value['text'] ?>
                      <?php if ($value['is_required']) { ?> <span class="color-error text-error">*</span> <?php }?>
                    </label>

                    <div class="contact_form__input">
                      <input class="text-input w-100" type="<?= $value['type'] ?>" name="<?= $value['id'] ?>" id="<?= $value['id'] ?>">
                    </div>
                    <div class="contact_form_error__wrapper">
                      <?php

                      foreach ($value['errors'] as $error_key => $error_value) {
                      ?>
                        <p class="color-error text-error mb-0 d-none" id="<?= $value['id'] . '-' . $error_key ?>">
                          <?= $error_value ?>
                        </p>
                      <?php
                      }

                      ?>
                    </div>
                  </div>

                </div>

              <?php
              }
              ?>

              <div class="col-sm-12 contact_form_textarea__col mb-5">
                <?php
                $pre_last_ar_value = array_slice($contact_form_text, count($contact_form_text) - 2, 1, true);
                $value = end($pre_last_ar_value);
                ?>
                <div class="contact_form_input__wrapper">

                  <label for="<?= $value['id'] ?>">
                    <?= $value['text'] ?>
                    <?php if ($value['is_required']) { ?> <span class="color-error text-error">*</span> <?php }?>
                  </label>

                  <div class="contact_form__input">
                    <!-- <div class="contact_form_textarea__wrapper"> -->
                    <textarea type="<?= $value['type'] ?>" name="<?= $value['id'] ?>" id="<?= $value['id'] ?>" maxlength="126" class="w-100"></textarea>
                    <div class="contact_form_textarea__counter"></div>
                    <!-- </div> -->
                  </div>

                  <div class="contact_form_error__wrapper contact_form_error__textarea">
                    <?php
                    foreach ($value['errors'] as $error_key => $error_value) {
                    ?>
                      <p class="color-error text-error mb-0 d-none" id="<?= $value['id'] . '-' . $error_key ?>">
                        <?= $error_value ?>
                      </p>
                    <?php
                    }
                    ?>
                  </div>

                </div>
              </div>

              <?php
                $value = end($contact_form_text);
              ?>
              <div class="col-sm-8 contact_form_button__col d-flex mb-sm-0 mb-4">
                
                <div class="contact_form_checkbox__wrapper w-100 d-flex justify-content-start flex-column">

                  <div class="contact_form_checkbox__container d-flex">
                    <div class="contact_form__checkbox">
                      <input type="<?= $value['type'] ?>" name="<?= $value['id'] ?>" id="<?= $value['id'] ?>">
                    </div>

                    <label class="ms-2">
                      <a class="contact_open_privacy_policy__button" data-bs-toggle="modal" data-bs-target="#privacyModal">
                        <?= $value['text'] ?>
                        <?php if ($value['is_required']) { ?> <span class="color-error text-error">*</span> <?php }?>
                      </a> 
                    </label>
                  </div>

                  <div class="contact_form_error__wrapper">
                    <?php
                    foreach ($value['errors'] as $error_key => $error_value) {
                    ?>
                      <p class="text-error color-error d-none mb-0" id="<?= $value['id'] . '-' . $error_key ?>">
                        <?= $error_value ?>
                      </p>
                    <?php
                    }
                    ?>
                  </div>
                </div>
              </div>
              <div class="col-sm-4 col-12">
                <div class="contact_form_button__wrapper d-flex w-100 justify-content-center">
                  <button type="submit" id="contactFormSendButton" class="contact_form__button button-primary mb-2">

                    <span id="contactFormSendText">
                      <?= $contact_section_button_text[0] ?>
                    </span>

                    <span id="contactFormWaitText" class="d-none">
                      <?= $contact_section_button_text[1] ?>
                    </span>

                  </button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

</section>