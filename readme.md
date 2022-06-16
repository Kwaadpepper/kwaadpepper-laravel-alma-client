## Alma Client

A wrapper around `https://github.com/alma/alma-php-client`

## Installation

Via Composer

``` bash
$ composer require kwaadpepper/laravel-alma-client
```

---

## Usage

1. **Configure in .env**
    ``` 
    # Your alma api key
    ALMA_API_KEY="MY_KEY"
    # test or live
    ALMA_API_MODE=test
    ```
2. **Get Alma Client**
    ``` 
    /** @var \Kwaadpepper\AlmaClient\Client */
    $client = app('AlmaClient');
    ```

3. **Get Alam php doc to implement into your site**
    `https://github.com/alma/alma-php-client`

## Note to fix Alma client version

`composer require alma/alma-php-client`

---
## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.
---
## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

---
## Security

If you discover any security related issues, please email github@jeremydev.ovh instead of using the issue tracker.

---
## Credits

- [Jérémy Munsch][link-author]
- [All Contributors][link-contributors]

## License

MIT. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/kwaadpepper/laravel-alma-client.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/kwaadpepper/laravel-alma-client.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/kwaadpepper/laravel-alma-client/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/kwaadpepper/laravel-alma-client
[link-downloads]: https://packagist.org/packages/kwaadpepper/laravel-alma-client
[link-travis]: https://travis-ci.org/kwaadpepper/laravel-alma-client
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/kwaadpepper
[link-contributors]: ../../contributors
