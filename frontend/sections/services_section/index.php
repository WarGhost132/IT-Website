<section class="services_section section-space">
  <div class="container">
    <div class="row">
      <div class="col-12 mb-5">
        <div class="services_section_title__wrapper">
          <h2 class="text-h2">
            <span class="bordered-text">
              <?= $services_section_header[0] ?>
            </span>
            <?= $services_section_header[1] ?>
          </h2>
        </div>
      </div>
      <div class="col-xl-6 col-lg-4 col-md-3 col-sm-2 col-2 d-none d-sm-flex justify-content-center">
        <div class="services_section_images__wrapper">

          <?php
          foreach ($services_section_list as $index => $service) {
          ?>
            <div class="services_section_image__wrapper d-flex justify-content-center align-items-start" id="serviceImage<?= $index ?>">
              <img src="<?= $service['image'] ?>" class="img-fluid" alt="Service Image" style="display: none;">
            </div>
          <?php
          }
          ?>


        </div>
      </div>
      <div class="col-xl-6 col-lg-8 col-md-9 col-sm-10 col-12">
        <div class="accordion" id="servicesAccordion">
          <?php
          foreach ($services_section_list as $index => $service) {
            $collapseId = "collapse" . $index;
            $headingId = "heading" . $index;
            $isActive = $index === 0 ? '' : '';
            $buttonCollapsed = $index === 0 ? 'collapsed' : ' collapsed';
            $expanded = $index === 0 ? 'false' : 'false';
          ?>
            <div class="accordion-item">
              <h2 class="accordion-header" id="<?= $headingId ?>">
                <button class="accordion-button <?= $buttonCollapsed ?>" type="button" data-bs-toggle="collapse" data-bs-target="#<?= $collapseId ?>" aria-expanded="<?= $expanded ?>" aria-controls="<?= $collapseId ?>">
                  <h3 class="text-h3"><?= $service["header"] ?></h3>
                </button>
              </h2>
              <div id="<?= $collapseId ?>" class="accordion-collapse collapse<?= $isActive ?>" aria-labelledby="<?= $headingId ?>" data-bs-parent="#servicesAccordion" ref-image="serviceImage<?= $index ?>" accordion-index="<?= $index ?>">
                <div class="accordion-body">
                  <ul class="ps-2">
                    <?php
                    foreach ($service["texts"] as $text) {
                    ?>
                      <li><?= $text ?></li>
                    <?php
                    }
                    ?>
                  </ul>
                </div>
              </div>
            </div>
          <?php
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</section>