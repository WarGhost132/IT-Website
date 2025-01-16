<?php

use PgSql\Connection;

use function PHPSTORM_META\map;

include_once __DIR__ . "/../../abstraction/IRepository.php";
include_once __DIR__ . "/../../models/Application.php";


class ApplicationRepository implements IRepository
{
    private $conn;

    public function __construct(array $conn)
    // public function __construct($db)
    {
        $this->conn = $conn;
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
                'content' => json_encode($form_data),
                'header' => $this->conn['header'],
            ),
        );

        $context = stream_context_create($options);
        $response = file_get_contents($this->conn['url'], false, $context);

        return $response !== false;

    }
}