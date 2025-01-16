$(document).ready(function () {
	const projectCards = $('.project-card')
	let selectedCard = null

	projectCards.each(function () {
		const card = $(this)
		const image = card.find('.project-image')

		image.on('click', function () {
			if (card.hasClass('active')) {
				selectedCard = null
				toggleCardState(card, false)
			} else {
				const previousCard = selectedCard
				selectedCard = card
				toggleCardState(previousCard, false)
				toggleCardState(selectedCard, true)
			}
		})
	})

	function toggleCardState(card, isActive) {
		if (!card) return
		const ref = card.attr('ref_mobile')
		const refElement = $('#' + ref)

		if (isActive) {
			card.addClass('active')
			refElement.parent().css('display', 'block')
			refElement.removeClass('d-none')
			refElement.find('.mobile_name').text(card.attr('project_name'))
			refElement.find('.mobile_desc').text(card.attr('project_desc'))
			refElement.find('.mobile_button').text(card.attr('project_button'))

			setTimeout(() => refElement.addClass('animate'), 10)
		} else {
			card.removeClass('active')
			refElement.removeClass('animate')

			setTimeout(function () {
				const stillActiveCards = $(`.project-card[ref_mobile="${ref}"]`).filter(
					'.active'
				)
				if (stillActiveCards.length === 0) {
					refElement.parent().css('display', 'none')
				}
			}, 500)
		}
	}
})
