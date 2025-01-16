// =================================
// 		Interfaces
// =================================
class IValidator {
	constructor(error_type) {
		this.error_type = error_type
	}

	handle($element, value) {}
}

class IFormatter {
	constructor() {}

	handle(value) {}
}

// =================================
// 		Formatters
// =================================

class GeneralFormatter extends IFormatter {
	handle(value) {
		return value.trim()
	}
}

class PhoneFormatter extends IFormatter {
	handle(value) {
		return value.replace(/[^0-9\+]/g, '')
	}
}

class FormatterHandler {
	constructor() {
		this.formatters = {}
	}

	addFormatter($element, validators) {
		const elementId = $element.get(0).id
		if (!this.formatters[elementId]) {
			this.formatters[elementId] = []
		}
		this.formatters[elementId] = this.formatters[elementId].concat(validators)
	}

	format($element, value) {
		const elementId = $element.get(0).id

		if (!this.formatters[elementId]) {
			return value
		}

		this.formatters[elementId].forEach(function (formatter) {
			value = formatter.handle(value)
		})

		return value
	}

	formatAll() {
		var validationResult = true

		Object.keys(this.formatters).forEach(key => {
			const $el = $('#' + key)

			const validationCurrentResult = this.validate($el)
			validationResult = validationResult && validationCurrentResult
		})
	}
}

// =================================
// 		Validators
// =================================


class GeneralRequiredValidator extends IValidator {
	handle($el, isRequired) {
		return true
	}
}


class GeneralRequiredStringValidator extends IValidator {
	handle($el, isRequired) {
		let value = $el.val()
		return value.trim().length > 0
	}
}

class NameLengthValidator extends IValidator {
	handle($el, isRequired) {
		let value = $el.val()
		return !isRequired && value == "" || value.trim().length <= 62
	}
}

class EmailLengthValidator extends IValidator {
	handle($el, isRequired) {
		let value = $el.val()
		return !isRequired && value == "" || value.trim().length <= 62
	}
}

class EmailFormatValidator extends IValidator {
	handle($el, isRequired) {
		const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/
		let value = $el.val()
		return !isRequired && value == "" || emailPattern.test(value.trim())
	}
}

class PhoneFormatValidator extends IValidator {
	handle($el, isRequired) {
		const rawFormat = $el.attr('placeholder')
		const format = rawFormat.replace(/\d/g, '\\d')
		const phonePattern = new RegExp(format)

		const value = $el.val()
		return !isRequired && value == "" || phonePattern.test(value.trim())
	}
}

class TelegramLengthValidator extends IValidator {
	handle($el, isRequired) {
		let value = $el.val()
		return !isRequired && value == "" || value.trim().length <= 33
	}
}

class TelegramStartsWithAtValidator extends IValidator {
	handle($el, isRequired) {
		let value = $el.val()
		return !isRequired && value == "" || value.trim().startsWith('@')
	}
}

class TelegramValidator extends IValidator {
	handle($el, isRequired) {
		let value = $el.val()
		const telegramPattern = /^[a-zA-Z][a-zA-Z0-9_]{4,31}$/
		return !isRequired && value == "" || telegramPattern.test(value.trim().substring(1))
	}
}

class MessageLengthValidator extends IValidator {
	handle($el, isRequired) {
		let value = $el.val()
		// console.log(value)
		return !isRequired && value == "" || value.trim().length <= 125
	}
}

class ConsetValidation extends IValidator {
	handle($el, isRequired) {
		let value = $el.prop('checked')
		return !isRequired || value
	}
}

class ValidatorHandler {
	constructor() {
		this.validators = {}
	}

	addValidators($element, validators) {
		const elementId = $element.get(0).id
		if (!this.validators[elementId]) {
			this.validators[elementId] = []
		}
		this.validators[elementId] = this.validators[elementId].concat(validators)
	}

	validate($element) {
		const elementId = $element.get(0).id
		
		if (!this.validators[elementId]) {
			return true
		}
		
		const isRequired = Object.entries(this.validators[elementId]).some(validator => 
			validator[1] instanceof GeneralRequiredStringValidator || validator[1] instanceof GeneralRequiredValidator)

		let validationResult = true

		const _this = this

		var isShowErrorOccurred = false

		this.validators[elementId].forEach(function (validator) {
			validationResult = validator.handle($element, isRequired)
			if (!validationResult && !isShowErrorOccurred) {
				isShowErrorOccurred = true
				_this.showError($element, validator.error_type)
			} else {
				_this.hideError($element, validator.error_type, isShowErrorOccurred)
			}
		})

		return validationResult
	}

	validateAll() {
		var validationResult = true

		Object.keys(this.validators).forEach(key => {
			const $el = $('#' + key)

			const validationCurrentResult = this.validate($el)
			validationResult = validationResult && validationCurrentResult
		})

		return validationResult
	}

	hideError($element, error_type, isShowErrorOccurred) {
		const errorElId = '#' + $element.get(0).id + '-' + error_type

		$(errorElId).addClass('d-none')
		if (!isShowErrorOccurred) {
			$(errorElId).parent().parent().find('.contact_form__input').removeClass('contact_form__error_state')
			$element.parent().find('.contact_form_textarea__counter').removeClass('contact_form_textarea_error__counter')
		}

	}

	showError($element, error_type) {
		const errorElId = '#' + $element.get(0).id + '-' + error_type

		$(errorElId).removeClass('d-none')
		$(errorElId).parent().parent().find('.contact_form__input').addClass('contact_form__error_state')
		$element.parent().find('.contact_form_textarea__counter').addClass('contact_form_textarea_error__counter')
	}
}

// =================================
// 		Models
// =================================

class ApplicationModel {
	constructor(source, name, email, phone, telegram, message) {
		this.source = source
		this.name = name
		this.email = email
		this.phone = phone
		this.telegram = telegram
		this.message = message
	}

	getFormData() {
		return {
			source: this.source,
			name: this.name,
			email: this.email,
			phone: this.phone,
			telegram: this.telegram,
			message: this.message,
		}
	}
}

// =================================
// 		Sender
// =================================

class ApplicationSender {
	constructor(validationHandler, $form) {
		this.validationHandler = validationHandler
		this.$form = $form
	}

	trySend(model) {
		if (!this.validationHandler.validateAll()) {
			return
		}

		const _this = this
		const formData = model.getFormData()

		_this.start_load()

		$.ajax({
			type: 'POST',
			url: '/backend/api/send_application.php',
			data: formData,
			success: function (response) {
				if (JSON.parse(response).success) {
					_this.redirect_to_result(1)
				} else {
					_this.redirect_to_result(0)
				}
			},
			error: function (response) {
				_this.redirect_to_result(0)
			},
			complete: function () {
				_this.stop_load()
			},
		})
	}

	redirect_to_result(isSuccess) {
		console.log(isSuccess)
		// window.location.href = `/result.php?isSuccess=${isSuccess}`
	}

	start_load() {
		const blure = $('#backgroundBlure')
		blure.removeClass('d-none')
		setTimeout(function () {
			blure.css('background-color', '#87878796')
		}, 10)

		// blure.addClass('make-blure')

		$('body').css('overflow', 'hidden')

		const submit = this.$form.find(':submit')
		submit.addClass('over-all')
		submit.prop('disabled', true)

		submit.find('#contactFormSendText, #formModalSendText').addClass('d-none')
		submit
			.find('#contactFormWaitText, #formModalWaitText')
			.removeClass('d-none')
	}

	stop_load() {
		const blure = $('#backgroundBlure')
		// blure.removeClass('make-blure')
		blure.css('background-color', '#ffffff00')
		setTimeout(function () {
			blure.addClass('d-none')
			submit.prop('disabled', false)
		}, 200)

		$('body').css('overflow', 'unset')

		const submit = this.$form.find(':submit')
		submit.removeClass('over-all')

		submit
			.find('#contactFormSendText, #formModalSendText')
			.removeClass('d-none')
		submit.find('#contactFormWaitText, #formModalWaitText').addClass('d-none')
	}
}

// =================================
// 		Prccess main page
// =================================

$(document).ready(function () {
	let $contactForm = $('#contactForm')

	// prevent errors
	if ($contactForm.length == 0) return

	// init
	const source = $contactForm.attr('source')
	const validatorHandler = new ValidatorHandler()
	const formatterHandler = new FormatterHandler()
	const sender = new ApplicationSender(validatorHandler, $contactForm)

	// add validations
	validatorHandler.addValidators($('#contactsFieldName'), [
		new GeneralRequiredStringValidator('general_required'),
		new NameLengthValidator('name_length'),
	])
	validatorHandler.addValidators($('#contactsFieldEmail'), [
		new GeneralRequiredStringValidator('general_required'),
		new EmailLengthValidator('email_length'),
		new EmailFormatValidator('email_validate'),
	])
	validatorHandler.addValidators($('#contactsFieldPhone'), [
		new GeneralRequiredStringValidator('general_required'),
		new PhoneFormatValidator('phone_validate'),
	])
	validatorHandler.addValidators($('#contactsFieldTelegram'), [
		// new GeneralRequiredStringValidator('general_required'),
		new TelegramLengthValidator('telegram_length'),
		new TelegramStartsWithAtValidator('telegram_starts_with_at'),
		new TelegramValidator('telegram_validate'),
	])
	validatorHandler.addValidators($('#contactsFieldMessage'), [
		new MessageLengthValidator('message_length'),
	])
	validatorHandler.addValidators($('#contactsFieldConset'), [
		new GeneralRequiredValidator('required'),
		new ConsetValidation('conset_validate'),
	])

	// add formatters
	formatterHandler.addFormatter($('#contactsFieldName'), [
		new GeneralFormatter(),
	])
	formatterHandler.addFormatter($('#contactsFieldEmail'), [
		new GeneralFormatter(),
	])
	formatterHandler.addFormatter($('#contactsFieldPhone'), [
		new GeneralFormatter(),
		new PhoneFormatter(),
	])
	formatterHandler.addFormatter($('#contactsFieldTelegram'), [
		new GeneralFormatter(),
	])
	formatterHandler.addFormatter($('#contactsFieldMessage'), [
		new GeneralFormatter(),
	])

	// add event handlers
	$('#contactForm input, textarea').on('keyup', function () {
		validatorHandler.validate($(this))
	})
	$('#contactForm input, textarea').on('blur', function () {
		validatorHandler.validate($(this))
	})

	// on submit handler
	$contactForm.submit(function (e) {
		e.preventDefault()

		const application = new ApplicationModel(
			source,
			formatterHandler.format(
				$('#contactsFieldName'),
				$('#contactsFieldName').val()
			),
			formatterHandler.format(
				$('#contactsFieldEmail'),
				$('#contactsFieldEmail').val()
			),
			formatterHandler.format(
				$('#contactsFieldPhone'),
				$('#contactsFieldPhone').val()
			),
			formatterHandler.format(
				$('#contactsFieldTelegram'),
				$('#contactsFieldTelegram').parent().find('.iti__selected-dial-code').html() + $('#contactsFieldTelegram').val()
			),
			formatterHandler.format(
				$('#contactsFieldMessage'),
				$('#contactsFieldMessage').val()
			),
			$('#contactsFieldConset').prop('checked')
		)

		sender.trySend(application)
	})
})
