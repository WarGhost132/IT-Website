
$(document).ready(function() {

    const phoneInput = $("#contactsFieldPhone");

    $('.contact_form__input input, textarea').not(phoneInput).bind('blur', function () {
        if ($(this).val().trim() != '') {
            return;
        }
        $(this).val('')
        const label = $(this).parent().parent().find('label')
        label.removeClass('contact_form_placeholder_focused')
    }).bind('focus', function () {
        const label = $(this).parent().parent().find('label')
        label.addClass('contact_form_placeholder_focused')
    });

    const label = $(`label[for=${phoneInput.get(0).id}]`)
    label.addClass('contact_form_placeholder_focused')


    const textareaMaxLength = 126
    $('.contact_form_textarea__counter').html(`${textareaMaxLength}/${textareaMaxLength}`)

    $('.contact_form__input textarea').on('input', function () {
        this.style.height = "5px";
        this.style.height = (this.scrollHeight) + "px";

        const textLen = $(this).val().length
        $(this).parent().find('.contact_form_textarea__counter').html(`${textareaMaxLength - textLen}/${textareaMaxLength}`)
    });


    const countryCode = $('#contactForm').attr('country-code');

    // Init on phone entering county select
    if (phoneInput.length > 0) {
        const applicantITI = window.intlTelInput(phoneInput.get(0), {
            showSelectedDialCode: true,
            nationalMode: false,
            initialCountry: countryCode,
            utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@19.2.14/build/js/utils.js",
        });
    }

    var targetNode = document.getElementsByClassName('iti__selected-dial-code')[0];

    var last_value = targetNode.innerText;

    var observer = new MutationObserver(function(mutationsList, observer) {
        mutationsList.forEach(function(mutation) {
            if (mutation.type === 'childList' && last_value != targetNode.innerText) {
                last_value = targetNode.innerText
                phoneInput.val('')
            }
        });
    });

    observer.observe(targetNode, {
        childList: true, // Listen for changes to the child nodes
        subtree: true,  // Observe the entire subtree (including text nodes)
        characterData: true // Observe changes to the text of a node
    });

})
