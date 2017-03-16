## PHP library for Facebook Messenger - October 2016

PHP library used by Facebook Messenger for Chatbot AI services without an external API.  

## Technologies, APIs, and Datasets Utilized

We made use of:
- [PHP] - HHVM
- [Facebook Messenger API](https://developers.facebook.com/docs/messenger-platform/product-overview)

## Examples
- [example.php] - Uses Redis caching to initate functions in the bot_functions.php include file

## How to send back to the Facebook Messenger API

The following will send a simulating typing back to the Messenger chat as an indicator for response processing
$bot->send(new SenderActions($message['sender']['id'], 'typing_on'));

The following is a response generated from using a contextual look-up of an array of cities searched from the chat input.
$bot->send(structure_element_buttons($message, $cities));

## License

The code is licensed under the [MIT License](LICENSE.md).
