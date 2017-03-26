<?php

namespace Codecourse\Notify;

use Codecourse\Notify\Storage\Session;

class Notifier
{
    /**
     * Session storage.
     *
     * @var Codecourse\Storage\Session
     */
    protected $session;

    protected $static_messages = array();

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    /**
     * Flash a message.
     *
     * @param  string $message
     * @param  string $type
     * @param  array  $options
     *
     * @return void
     */
    public function flash($message, $type = null, array $options = [])
    {
        $messages = $this->get();

        $messages[] = array(
            'message' => $message,
            'type' => $type,
            'options' => json_encode($options),
        );

        $this->session->flash('notify', $messages);

        // $this->session->flash([
        //     'notify.message' => $message,
        //     'notify.type' => $type,
        //     'notify.options' => json_encode($options),
        // ]);
    }

    public function success($message, array $options = [])
    {
        $this->flash($message, 'success', $options);
    }

    public function alert($message, array $options = [])
    {
        $this->flash($message, 'alert', $options);
    }

    public function info($message, array $options = [])
    {
        $this->flash($message, 'info', $options);
    }

    public function error($message, array $options = [])
    {
        $this->flash($message, 'error', $options);
    }
    
    /**
     * Get the message
     *
     * @param  boolean $array
     * @return array
     */
    public function get()
    {
        return $this->session->get('notify');
    }

    /**
     * If a message is ready to be shown.
     *
     * @return bool
     */
    public function ready()
    {
        return $this->session->get('notify');
    }

    public function addStatic($message, $type = null, $options = [])
    {
        // dd('oi');
        $messages = $this->static_messages;

        $messages[] = array(
            'message' => $message,
            'type' => $type,
            'options' => json_encode($options),
        );

        $this->static_messages = $messages;
    }

    public function addSuccessStatic($message)
    {

    }

    public function getStatic()
    {
        return $this->static_messages;
    }

    public function readyStatic()
    {
        return $this->static_messages;
    }
}
