<?php

namespace NotificationChannels\InsightifySMS\Exceptions;

class CouldNotSendNotification extends \Exception
{
    public static function insightifysmsError(string $message, int $code): self
    {
        return new static(sprintf('Insightify SMS responded with error %d, message: %s', $code, $message), $code);
    }
}
