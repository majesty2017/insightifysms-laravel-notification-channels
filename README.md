# InsightifySMS Notification Channel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/laravel-notification-channels/insightifysms.svg?style=flat-square)](https://packagist.org/packages/laravel-notification-channels/insightifysms)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/laravel-notification-channels/insightifysms/master.svg?style=flat-square)](https://travis-ci.org/laravel-notification-channels/insightifysms)
[![StyleCI](https://styleci.io/repos/339892204/shield)](https://styleci.io/repos/339892204)
[![Total Downloads](https://img.shields.io/packagist/dt/laravel-notification-channels/insightifysms.svg?style=flat-square)](https://packagist.org/packages/laravel-notification-channels/insightifysms)

📲  [InsightifySMS](https://app.insightifysms.com) Notifications Channel for Laravel

## Contents

- [Installation](#installation)
	- [Setting up the InsightifySMS service](#setting-up-the-InsightifySMS-service)
- [Usage](#usage)
	- [Available Message methods](#available-message-methods)
- [Changelog](#changelog)
- [Testing](#testing)
- [Security](#security)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)


## Installation

```bash
composer require insightifysms-laravel-notification-channels/insightifysms
```

### Configuration

Add your InsightifySMS SENDER_ID and API_TOKEN to your `.env`

```php
INSIGHTIFYSMS_API_TOKEN=100|hjwewhwjew8234wej # always required
INSIGHTIFYSMS_SENDER_ID=Demo # always required
```

Add the configuration to your `services.php` config file:

```php
'insightifysms' => [
    'sender_id' => env('INSIGHTIFYSMS_SENDER_ID'),
    'api_token' => env('INSIGHTIFYSMS_API_TOKEN'),
]
```

### Setting up the InsightifySMS service

You'll need a InsightifySMS account. Head over to their [website](https://www.app.insightifysms.com/) and create or login to your account.

Navigate to `API Integration` and then `API Token` in the sidebar to copy existing one or generate an API Token.

## Usage

You can use the channel in your `via()` method inside the notification:

```php
use Illuminate\Notifications\Notification;
use \NotificationChannels\InsightifySMS\InsightifySmsMessage;
use \NotificationChannels\InsightifySMS\InsightifySmsChannel;

class LoginNeedsVerification extends Notification
{
    public function via($notifiable)
    {
        return [InsightifySmsChannel::class];
    }

    public function toInsightifySms($notifiable)
    {
        return (new InsightifySmsMessage)
            ->content("Task #{$notifiable->id} is complete!")
            ->from('My App');
    }
}
```

In your notifiable model, make sure to include a `routeNotificationForInsightifySms()` method, which returns a phone number including country code.

```php
public function routeNotificationForInsightifySms()
{
    return $this->phone; // 0200000001
}
```

### Available methods

`sender()`: Sets the sender's name or phone number.

`content()`: Set a content of the notification message.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Security

If you discover any security related issues, please email support@insightifysms.com instead of using the issue tracker.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [InsightifySMS](https://github.com/majesty2017)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
