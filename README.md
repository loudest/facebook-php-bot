## PHP library for Facebook Messenger - October 2016

PHP library used by Facebook Messenger for Chatbot AI services without an external API.  

## Technologies, APIs, and Datasets Utilized

We made use of:
- [PHP] - HHVM
- [Facebook Messenger API](https://developers.facebook.com/docs/messenger-platform/product-overview)

## Examples
- [example.php] - Uses Redis caching to initate functions in the bot_functions.php include file

## How to send back to the Facebook Messenger API

if(($state['state'] == 'init' or $state['state'] == 'started') and strstr($command,',')) {
        $state['state'] = 'date';
        $state['location'] = $command;
        $redis->set('hnn-bot-'.$message['sender']['id'],json_encode($state));
        $text = $text_array['date'];
        if($debug) {
            echo $text;
        } else {
            $bot->send(new SenderActions($message['sender']['id'], 'typing_on'));
            sleep(1.5);            
            $bot->send(new Message($message['sender']['id'], $text));    
        }        
}

Our code is licensed under the [MIT License](LICENSE.md).
