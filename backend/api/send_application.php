<?php

require_once __DIR__ . "/../infrastructure/google/GoogleRepository.php";
require_once __DIR__ . "/../infrastructure/data/ApplicationRepository.php";
require_once __DIR__ . "/../services/CreateApplicationService.php";
require_once __DIR__ . "/../../config.php";



if (isset($_POST)) {

    $fields_passed = [
        "source",
        "name",
        "email",
        "phone",
        "telegram",
        "message"
    ];

    $error_messages = [];
    foreach ($fields_passed as $name) {
        if (!isset($_POST[$name])) {
            $error_messages[] = "Field \"" . $name . "\" is missed";
        }
    }

    if (count($error_messages) == 0) {

        try {

            $application = Application::Create(
                uniqid(),
                $_POST[$fields_passed[0]],
                $_POST[$fields_passed[1]],
                $_POST[$fields_passed[2]],
                $_POST[$fields_passed[3]],
                $_POST[$fields_passed[4]],
                $_POST[$fields_passed[5]]
            );

            try {
                send_data_to_google($application);
            } catch (Exception $exc) {
            }

            try {
                // send_data_to_dumper($application);
            } catch (Exception $exc) {
            }


            echo json_encode(
                [
                    "success" => true,
                    "value" => [
                        "id" => $application->GetId()
                    ]
                ],
                JSON_UNESCAPED_UNICODE
            );
        } catch (Exception $exception) {
            echo json_encode(
                [
                    "success" => false,
                    "errors" => [$exception->getCode()],
                    "message" => $exception->getMessage()
                ],
                JSON_UNESCAPED_UNICODE
            );
        }
    } else {
        echo json_encode(
            [
                "success" => false,
                "errors" => $error_messages,
                "message" => "Properties missed"
            ],
            JSON_UNESCAPED_UNICODE
        );
    }
}

function send_data_to_dumper(Application $data)
{
    $db_repo = new ApplicationRepository(getDbConnection());
    $create_db_service = new CreateApplicationService($db_repo);

    $is_db_success = $create_db_service->createApplication(
        $data
    );
}

function send_data_to_google(Application $data)
{
    $google_repo = new GoogleRepository(getGoogleConnection());
    $create_google_service = new CreateApplicationService($google_repo);

    $is_google_success = $create_google_service->createApplication(
        $data
    );
}
