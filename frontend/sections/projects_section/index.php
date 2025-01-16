<section class="projects_section section-space" id="projects">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="projects_section_title__wrapper">
          <h2 class="text-h2"><span class="bordered-text"><?= $projects_section_header[0] ?> </span><?= $projects_section_header[1] ?></h2>
        </div>
      </div>

      <?php foreach (range(0, count($projects_section_content) - 1, 2) as $index) {
        $project_content_left = $projects_section_content[$index];
        $project_content_right = $projects_section_content[$index + 1];
      ?>

        <div class="<?= $project_content_left['col_type'] ?> px-1 py-1 project-card" ref_mobile="dropdown_mobile<?= $index ?>" project_name="<?= $project_content_left['name'] ?>" project_desc="<?= $project_content_left['desc'] ?>" project_button="<?= $project_section_button_text ?>">
          <div class="projects_section_images__wrapper h-100 position-relative">
            <img class="w-100 h-100 project-image" src="<?= $project_content_left['image'] ?>" alt="<?= $project_content_left['name'] ?>">
            <div class="projects_section_images__overlay position-absolute w-100 h-100 flex-column justify-content-between desktop-view">
              <div class="projects_section_images_text__content p-3 text-start">
                <h3 class="text-h3"><?= $project_content_left['name'] ?></h3>
                <p class="text-caption"><?= $project_content_left['desc'] ?></p>
              </div>
              <div class="projects_section_images_button__wrapper p-3 d-flex justify-content-end align-items-end">
                <button class="projects_section_images_contact__button text-caption"><?= $project_section_button_text ?></button>
              </div>
            </div>
          </div>
        </div>

        <div class="<?= $project_content_right['col_type'] ?> px-1 py-1 project-card" ref_mobile="dropdown_mobile<?= $index ?>" project_name="<?= $project_content_right['name'] ?>" project_desc="<?= $project_content_right['desc'] ?>" project_button="<?= $project_section_button_text ?>">
          <div class="projects_section_images__wrapper h-100 position-relative">
            <img class="w-100 h-100 project-image" src="<?= $project_content_right['image'] ?>" alt="<?= $project_content_right['name'] ?>">
            <div class="projects_section_images__overlay position-absolute w-100 h-100 flex-column justify-content-between desktop-view">
              <div class="projects_section_images_text__content p-3 text-start">
                <h3 class="text-h3"><?= $project_content_right['name'] ?></h3>
                <p class="text-caption"><?= $project_content_right['desc'] ?></p>
              </div>
              <div class="projects_section_images_button__wrapper p-3 d-flex justify-content-end align-items-end">
                <a href="#contacts" class="projects_section_images_contact__button text-caption"><?= $project_section_button_text ?></a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12 mobile-view px-1">
          <div class="dropdown-content px-3" id="dropdown_mobile<?= $index ?>">
            <h3 class="text-h3 mobile_name"></h3>
            <p class="text-caption mobile_desc text-start"></p>
            <div class="projects_section_images_button__wrapper d-flex justify-content-end align-items-end">
              <a href="#contacts" class="projects_section_images_contact__button text-caption mobile_button"></a>
            </div>
          </div>
        </div>
      <?php } ?>

    </div>
  </div>
</section>