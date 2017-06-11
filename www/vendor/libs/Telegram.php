<?php
namespace vendor\libs;

class Telegram {

    private $token;
    protected $api = "https://api.telegram.org/bot";
    public $chatId;
    public function __construct($token, $chat = ''){
        $this->token = $token;
        $this->api .= $this->token;
        $this->chatId = $chat;
    }
    public function sendMessage($message) {
        $data = array(
            'chat_id' => $this->chatId,
            'text' => $message,
        );
        try {
            file_get_contents($this->api . '/sendMessage?' . http_build_query($data));
        } catch (Exception $e) {

        }
    }

}