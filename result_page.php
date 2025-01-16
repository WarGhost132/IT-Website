<?php

require_once 'frontend/template/page_generator.php';
require_once 'assets/texts/text_assembly.php';

get_head();

// Result section
require_once 'frontend/sections/result_section/index.php';
?>

<div class="divider footer mx-5"></div>

<?php
get_footer($footer_section_text);
