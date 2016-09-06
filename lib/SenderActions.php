<?php

/**
 * Class SenderActions
 *
 * @package slimtrader\SenderActions
 */
class SenderActions extends Message
{
    /**
     * @var null|string
     */
    protected $recipient = null;

    /**
     * @var null|string
     */
    protected $sender_action = null;

    /**
     * Message constructor.
     *
     * @param string $recipient
     * @param string $file Web Url or local file with @ prefix
     */
    public function __construct($recipient, $type)
    {
        $this->recipient = $recipient;
		$this->sender_action = $type;

    }

    /**
     * Get message data
     *
     * @return array
     */
    public function getData()
    {
        $res = [
            'recipient' =>  [
                'id' => $this->recipient
            ]
        ];

        $res['sender_action'] = $this->sender_action;

        return $res;
    }
}