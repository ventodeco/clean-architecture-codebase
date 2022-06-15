<?php

namespace App\Domains\Shared\Dtos;

abstract class AppResponse
{
    private $success;
    private $fullMessages;
    
    /**
     * getSuccess
     * @return void
     */
    public function getSuccess() {
        return $this->success;
    }
    
    /**
     * setSuccess
     *
     * @param  mixed $success
     * @return void
     */
    public function setSuccess(bool $success) {
        $this->success = $success;
    }
    
    /**
     * getFullMessages
     * @return void
     */
    public function getFullMessages() {
        return $this->fullMessages;
    }
    
    /**
     * setFullMessages
     *
     * @param  mixed $fullMessages
     * @return void
     */
    public function setFullMessages($fullMessages) {
        $this->fullMessages = $fullMessages;
    }
    
    /**
     * __con
     *
     * @param  mixed $success
     * @return void
     */
    function __con(bool $success) {
        $this->success = $success;
        $fullMessages = [];
    }
    
    /**
     * isSuccess
     * @return void
     */
    public function isSuccess() {
        return $this->success;
    }

    
    /**
     * addFullMessage
     *
     * @param  mixed $message
     * @return void
     */
    protected function addFullMessage(String $message) {
        if ($this->fullMessages == null)
            $this->fullMessages = [];

        $this->fullMessages->add($message);
    }


}
