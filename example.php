<?php
header("Content-type: text/plain");

/** require */
require_once("bot_base.php");
require_once("lib/Message.php");
require_once("lib/ImageMessage.php");
require_once("lib/UserProfile.php");
require_once("lib/MessageButton.php");
require_once("lib/StructuredMessage.php");
require_once("lib/MessageElement.php");
require_once("lib/MessageReceiptElement.php");
require_once("lib/Address.php");
require_once("lib/Summary.php");
require_once("lib/Adjustment.php");
require_once("lib/Attachment.php");
require_once("lib/SenderActions.php");

/** specific settings */
require_once("bot_functions.php");
function main() {
    
    /** tokens */
    $token = array();
    $token['verify_token'] = "example_bot";
    $token['page_access_token'] = ""; 
    $token['app_token'] = "";
    $token['app_secret'] = "";
    
    // redis host
    define('REDIS_HOST', 'localhost');
    // Make Bot Instance
    $debug = false;
    $bot = new FbBotApp($token['page_access_token'], $token['app_token'], $token['app_secret']);
    if(!empty($_REQUEST['local']) and $_REQUEST['local'] == 'debug') {
        $debug = true;
    }
    // Receive something
    if(!empty($_REQUEST['hub_mode']) && $_REQUEST['hub_mode'] == 'subscribe' && $_REQUEST['hub_verify_token'] == $token['verify_token']) {
        // Webhook setup request
        echo $_REQUEST['hub_challenge'];
    } else {
        
        $redis = new Redis();
        $redis->connect( REDIS_HOST ); 

        // Other event
        $data = json_decode(file_get_contents("php://input"), true, 512, JSON_BIGINT_AS_STRING);
        
        if(!empty($data['entry'][0]['messaging'])) {
            foreach($data['entry'][0]['messaging'] as $message) {
                // Skipping delivery messages
                if (!empty($message['delivery'])) {
                    continue;
                }
                // When bot receive message from user
                if (!empty($message['message'])) {
                    $command = $message['message']['text'];
                // When bot receive button click from user
                } else if (!empty($message['postback'])) {
                    $command = $message['postback']['payload'];
                }
                bot_parse_command($bot, $message, $command, $debug, $redis);
            } //end facebook message queues
        } elseif($debug == true) {
            $command = $_REQUEST['text'];
            bot_parse_command($bot, $message, $command, $debug, $redis);
        } //parse command from GET
    }
} //end main
main();
