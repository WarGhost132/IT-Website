<?php

require_once 'frontend/template/page_generator.php';
require_once 'assets/texts/text_assembly.php';

get_head($general_company_name, 'en');
?>

<!-- Main -->
<?php require_once 'frontend/sections/main_section/index.php'; ?>

<div class="divider mx-5"></div>

<!-- Services -->
<?php require_once 'frontend/sections/services_section/index.php'; ?>

<div class="divider mx-5"></div>

<!-- About -->
<?php require_once 'frontend/sections/about_section/index.php'; ?>

<div class="divider mx-5"></div>

<!-- Projects -->
<?php require_once 'frontend/sections/projects_section/index.php'; ?>

<div class="divider mx-5"></div>

<!-- Contact -->
<?php require_once 'frontend/sections/contact_section/index.php'; ?>

<div class="divider footer mx-5"></div>

<?php get_footer($footer_section_text) ?>