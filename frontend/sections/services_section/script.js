var last_expanded = null;
var offsets = null;

document.addEventListener('DOMContentLoaded', event => {
	// last expand
	last_expanded = $('#servicesAccordion .accordion-collapse').get(0)
	$(last_expanded).parent().find('.accordion-button').prop('disabled', true);

	console.log(last_expanded)

	// show firts image
	show_image(0)

	// get default offsets
	offsets = set_offset();
	
	// get offsets on widows size changes
	$(window).resize(function(){
		offsets = set_offset();
	});

	// on expand
	$('#servicesAccordion .accordion-collapse').on('show.bs.collapse', function (e) {

		if ($('#servicesAccordion .accordion-collapse.collapsing').length > 0) {
			e.preventDefault()
			return;
		}

		$('#servicesAccordion .accordion-collapse').not($(this)).parent().find('.accordion-button').prop("disabled", false);
		$(this).parent().find('.accordion-button').prop('disabled', true);

		const index = +$(this).attr('accordion-index')

		start_move_image(index)
		hide_image(index)
		show_image(index)
	});

})

function set_offset() {
	collapse_all()

	min_offset = $('#servicesAccordion .accordion-item').first().offset().top

	const offsets = $('#servicesAccordion .accordion-item').map((index, item) => {
		return $(item).offset().top - min_offset
	})
	console.log(offsets)

	expand_last()

	return offsets
}

function collapse_all() {
	const shownItems = $('#servicesAccordion .accordion-collapse.show')
	shownItems.collapse('hide')

	if (shownItems.length > 0) {
		last_expanded = shownItems.get(0)
	}

	console.log(last_expanded)
}

function expand_last() {
	$(last_expanded).collapse('show')

	// console.log(last_expanded)
}

function start_move_image(index) {
	$('.services_section_images__wrapper').animate({
		top: `${offsets[index]}px`
	}, 800, 'easeInOutCubic');
}

function hide_image(except_index) {
	const exception = $(`#serviceImage${except_index} img`)
	$('.services_section_image__wrapper img').not(exception).fadeOut(500)
}

function show_image(index) {
	$($('.services_section_image__wrapper img').get(index)).fadeIn(500)
}
