<?php

namespace Sicredi\Credeasy\Helper;

trait FlashMessageTrait 
{
    public function defMessage(string $msgType, string $msg)
    {
        $_SESSION['msg_type'] = $msgType;
        $_SESSION['msg'] = $msg;
    }
}