<?php


$contact_section_header = "Write to us";

$contact_section_subheader = "The conditions for each request are discussed individually";


$contact_section_button_text = ["Send", "Wait..."];


$contact_form_text = [
  [
    "text" => "Name",
    "id" => "contactsFieldName",
    "placeholder" => "Name",
    "type" => "text",
    "is_required" => true,
    "errors" => [
      "general_required" => "Required field",
      "name_length" => "The name can't be that long"
    ],
  ],
  [
    "text" => "E-mail",
    "id" => "contactsFieldEmail",
    "placeholder" => "E-mail",
    "type" => "text",
    "is_required" => true,
    "errors" => [
      "general_required" => "Required field",
      "email_length" => "E-mail не может быть таким длинным",
      "email_validate" => "Incorrect e-mail format"
    ],
  ],
  [
    "text" => "Phone number",
    "id" => "contactsFieldPhone",
    "placeholder" => "Номер телефона",
    "type" => "text",
    "is_required" => true,
    "errors" => [
      "general_required" => "Required field",
      "phone_validate" => "Incorrect phone number format"
    ],
  ],
  [
    "text" => "Telegram username",
    "id" => "contactsFieldTelegram",
    "placeholder" => "Telegram username",
    "type" => "text",
    "is_required" => false,
    "errors" => [
      "telegram_length" => "Telegram username can't be that long",
      "telegram_starts_with_at" => "Telegram username must start with the symbol @",
      "telegram_validate" => "Incorrect Telegram username format"
    ],
  ],
  [
    "text" => "Cover letter",
    "id" => "contactsFieldMessage",
    "placeholder" => "Cover letter",
    "type" => "text",
    "is_required" => false,
    "errors" => [
      "message_length" => "The message can't be that long",
    ],
  ],
  [
    "text" => "I consent to the processing of my personal data",
    "id" => "contactsFieldConset",
    "placeholder" => "",
    "type" => "checkbox",
    "is_required" => true,
    "errors" => [
      "conset_validate" => "Required field",
    ],
  ]
];
