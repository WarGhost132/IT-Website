<?php

include_once __DIR__ . "/../../abstraction/IRepository.php";
include_once __DIR__ . "/../../models/Application.php";

class GoogleRepository implements IRepository
{
    private $api_key;

    public function __construct($api_key)
    {
        $this->api_key = $api_key;   
    }

    public function save(Application $application) : bool
    {
        // Форматируем дату без времени
        $submissionDate = date("d/m/Y H:i:s", time());

        // Добавляем данные в массив для отправки
        $form_data = array(
            "CREATED" => $submissionDate,
            "ID" => $application->GetId(),
            "SOURCE" => $application->GetSource(),
            "NAME" => $application->GetName(),
            "EMAIL" => $application->GetEmail(),
            "PHONE" => $application->GetPhone(),
            "TELEGRAM" => $application->GetTelegram(),
            "MESSAGE" => $application->GetMessage()
        );

        $options = array(
            'http' => array(
                'method' => 'POST',
                'content' => http_build_query($form_data),
                'header' => 'Content-Type: application/x-www-form-urlencoded',
            ),
        );

        $context = stream_context_create($options);
        $response = file_get_contents($this->api_key, false, $context);

        return $response !== false;
    }
}