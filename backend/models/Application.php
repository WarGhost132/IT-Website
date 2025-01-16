<?php
class Application {
    private string $id;
    private string $source;
    private string $name;
    private string $email;
    private string $phone;
    private string $telegram;
    private string $message;

    // Private constructor to prevent direct object creation
    private function __construct(string $id, string $source, string $name, string $email, string $phone, string $telegram, string $message) {
        $this->id = $id;
        $this->source = $source;
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->telegram = $telegram;
        $this->message = $message;
    }

    // Factory method to create an instance of Application
    public static function Create(string $id, string $source, string $name, string $email, string $phone, string $telegram, string $message) : Application {
        // Validate input
        if (empty($id) || empty($source) || empty($name) || empty($email) || empty($phone)) {
            throw new Exception("All fields are required");
        }

        // Validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email address");
        }

        return new self($id, $source, $name, $email, $phone, $telegram, $message);
    }
    
    // Getter for ID
    public function GetId() : string {
        return (string)$this->id;
    }

    public function GetSource() : string {
        return (string)$this->source;
    }

    // Getter for Name
    public function GetName() : string {
        return $this->name;
    }

    // Getter for Email
    public function GetEmail() : string {
        return $this->email;
    }

    
    public function GetPhone() : string {
        return $this->phone;
    }


    // Getter for Telegram 
    public function GetTelegram() : string {
        return $this->telegram;
    }


    public function GetMessage() : string {
        return $this->message;
    }
}