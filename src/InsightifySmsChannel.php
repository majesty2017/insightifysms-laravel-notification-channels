<?php

namespace NotificationChannels\InsightifySMS;

use Illuminate\Notifications\Notification;
use Insightify\InsightifySMS;
use NotificationChannels\InsightifySMS\Exceptions\CouldNotSendNotification;

class InsightifySmsChannel
{
    /** @var InsightifySMS */
    private $client;

    public function __construct(InsightifySMS $client)
    {
        $this->client = $client;
    }

    /**
     * @throws CouldNotSendNotification
     */
    public function send($notifiable, Notification $notification): void
    {
        $to = $notifiable->routeNotificationFor('insightifysms');

        if (! $to) {
            $to = $notifiable->routeNotificationFor(InsightifySmsChannel::class);
        }

        if (! $to) {
            return;
        }

        $message = $notification->toInsightifySms($notifiable);

        if (is_string($message)) {
            $message = new InsightifySmsMessage($message);
        }

        if (! $message instanceof InsightifySmsMessage) {
            return;
        }

        $response = $this->client->send_sms(
            $to,
            $message->content
        );

        if ($response->code !== 200) {
            throw CouldNotSendNotification::insightifysmsError($response->message ?? '', $response->code ?? 500);
        }
    }
}
