# Dev About

Minimal Laravel package for local `dev` helper routes.

## What It Adds

When the app environment is `local`, this package registers:

- `/dev/about`
- `/dev/logout`
- `/dev/{identifier}`

## Purpose

This package is meant for lightweight local development helpers, including:

- a simple about page
- quick logout
- quick user login by id, email, or `nokp` when available

## Installation

### Local Path Repository

Add this to your app `composer.json`:

```json
{
    "repositories": [
        {
            "type": "path",
            "url": "packages/dev-about"
        }
    ]
}
```

Then require the package:

```bash
composer require ejoi8/dev-about:*
```

### GitHub VCS Repository

Add this to your app `composer.json`:

```json
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/your-vendor/dev-about"
        }
    ]
}
```

Then require it:

```bash
composer require your-vendor/dev-about:dev-main
```

## Notes

- The service provider only loads routes when the app environment is `local`.
- The package uses Laravel package auto-discovery.
