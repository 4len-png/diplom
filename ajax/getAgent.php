<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/classes/DeepseekChatService.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/classes/AiAgentService.php");


$chat = new \services\DeepseekChatService("sk-94a9095a828743d5a4ca38825d88e672");

//            $agent = new \services\AiAgentService($chat, "Я хочу научиться рисовать");
$agent = new \services\AiAgentService($chat, $_POST["message"]);

$response = $agent->handle();

echo $response['choices'][0]['message']['content'];


?>
