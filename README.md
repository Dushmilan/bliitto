# BLII-TTO Website

Website for the Business Linkage, Innovation, Incubation and Technology Transfer Office (BLII-TTO) at the University of Peradeniya.

The site is a Laravel application with a Blade front end backed by a database. News and announcements are managed through an admin panel, contact-form submissions are stored and emailed to staff, and the same published content is exposed through a public, read-only JSON API.

## Requirements

- PHP 8.3 or newer with the usual Laravel extensions (`pdo_sqlite`, `mbstring`, `openssl`, `fileinfo`)
- Composer 2
- SQLite (the default) or another supported database such as MySQL or PostgreSQL

There is no JavaScript build step: the front-end CSS and JavaScript are served directly from `public/`.

## Local setup

```bash
git clone https://github.com/kavindunimsaraone-cyber/bliitto.git bliitto-main
cd bliitto-main
touch database/database.sqlite
composer setup
```

`composer setup` installs dependencies, creates `.env` from `.env.example`, generates the application key, runs the migrations, seeds the demo content, and links the public storage directory.

The `touch` step is only needed on a fresh checkout. It creates the SQLite file that the default `DB_CONNECTION=sqlite` expects; you can skip it when the file already exists.

Start the development environment with:

```bash
composer dev
```

This runs the PHP development server, a queue listener, and the log viewer together. Open <http://localhost:8000>.

If you prefer to run the steps yourself:

```bash
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed
php artisan storage:link
php artisan serve
```

## Configuration

The settings most likely to need changing are in `.env`:

| Variable | Purpose |
| --- | --- |
| `APP_URL` | Base URL used when generating absolute links and image URLs. |
| `DB_CONNECTION` | Database driver. Defaults to `sqlite`; the file lives at `database/database.sqlite`. |
| `ADMIN_DOMAIN` | Host that serves the admin panel, for example `admin.example.com`. Leave empty to use the `/admin` path instead. |
| `CONTACT_RECIPIENT_EMAIL` | Address that receives contact-form notifications. Defaults to `bliitto@pdn.ac.lk`. |
| `MAIL_*` | Mail transport. The default `MAIL_MAILER=log` writes messages to `storage/logs/laravel.log` instead of sending them. |
| `QUEUE_CONNECTION` | Queue driver for the contact notification. Defaults to `sync`; use a real queue with a worker in production. |

## Admin panel

The admin panel manages site content at:

- `/admin` when `ADMIN_DOMAIN` is empty (the local default)
- the configured `ADMIN_DOMAIN` host otherwise

Create the first administrator account with:

```bash
php artisan make:admin
```

The command prompts for a name, email address, and password (at least 8 characters). It can also be run non-interactively:

```bash
php artisan make:admin --name="Admin" --email=admin@example.com --password="secret-password"
```

Running it again with an existing email address updates that account's name and password, which is also how a forgotten password is reset.

From the panel you can:

- See counts of published news, active announcements, and unread messages on the dashboard.
- Create, edit, publish/unpublish, and delete news items. Images may be uploaded (JPEG, PNG, or WebP, up to 2 MB) and are stored on the public disk under `news/`.
- Create, edit, activate/deactivate, and delete announcements.
- Read contact messages, which are marked as read when opened, and delete them.

Login attempts are throttled to five failures per minute per email address and IP.

## Contact form

The public contact form at `/contact`:

- Validates the name, email address, and a message of 10–5000 characters.
- Uses a hidden honeypot field (`website`); submissions that fill it are silently accepted but discarded.
- Is rate limited to six submissions per minute.
- Stores the message in `contact_messages` so it appears in the admin panel.
- Queues a notification to `CONTACT_RECIPIENT_EMAIL` with the submitter's address set as `Reply-To`.

Because the notification is queued, run `php artisan queue:work` in any environment where `QUEUE_CONNECTION` is not `sync`.

## Content model

| Table | Fields | Notes |
| --- | --- | --- |
| `news` | `title`, `date`, `image`, `description`, `link`, `published` | Only published items appear on the site and in the API. `image` may be a bundled asset in `public/` or an uploaded path on the public disk. `link` may be a legacy `.php` path, which is translated to a route URL. |
| `announcements` | `date`, `text`, `active` | Only active announcements are shown. |
| `contact_messages` | `name`, `email`, `message`, `read_at` | Admin-only; `read_at` is `null` until the message is opened. |

Dates are stored as calendar dates (no time component). The seeded news and announcement content is imported from the previous hard-coded site; see `database/seeders/NewsSeeder.php` and `database/seeders/AnnouncementSeeder.php`.

## Public pages

| Route | Page |
| --- | --- |
| `/` | Home, with published news and active announcements |
| `/about` | About, vision and mission, staff, and committees |
| `/services` | Services overview |
| `/tisc` | Technology and Innovation Support Centers |
| `/consultancy` | Consultancy and advisory services |
| `/ip-services` | Intellectual property services |
| `/patent-searches` | Patent searches |
| `/industry` | Industry collaboration |
| `/patented-technologies` | Patented technologies |
| `/technology-know-how` | Technology know-how |
| `/researchers` | Researchers |
| `/centers` | Centers |
| `/downloads` | Downloads |
| `/submission` | Invention submission |
| `/contact` | Contact form |

## Public API

Base URL: `/api/v1`. The API is read-only, unauthenticated, returns JSON, paginates at 15 items per page, and is rate limited to 60 requests per minute per client (`429` when exceeded).

| Method | Endpoint | Description |
| --- | --- | --- |
| `GET` | `/api/v1/news` | Published news, newest first |
| `GET` | `/api/v1/news/{id}` | A single published news item; `404` when it is unpublished or missing |
| `GET` | `/api/v1/announcements` | Active announcements, newest first |

News item fields: `id`, `title`, `date` (`YYYY-MM-DD`), `description`, `image` (absolute URL or `null`), `link` (route URL; `#` when absent), `updated_at` (ISO 8601).

Announcement fields: `id`, `date` (`YYYY-MM-DD`), `text`, `updated_at` (ISO 8601).

List responses use Laravel's standard pagination envelope: a `data` array plus `links` and `meta` (`current_page`, `last_page`, `per_page`, `total`, and related URLs). A missing or unpublished record returns `404` with `{"message": "Not Found"}`.

Example:

```bash
curl http://localhost:8000/api/v1/news
```

## Testing

```bash
composer test
# or
php artisan test
```

Tests use an in-memory SQLite database and array-based mail, cache, and session drivers, so they do not touch development data.

Coverage includes the public pages, legacy content parity, the content schema, the API, the contact form, and the admin authentication and CMS screens. Code style is enforced with [Laravel Pint](https://laravel.com/docs/pint):

```bash
./vendor/bin/pint
```

## Production notes

- Set `APP_ENV=production`, `APP_DEBUG=false`, and the correct `APP_URL`.
- Configure a real mail transport and queue connection, and run a queue worker for contact notifications.
- Set `ADMIN_DOMAIN` if the admin panel should live on its own host.
- Run `php artisan migrate --force` and `php artisan storage:link` during deployment, then cache configuration, routes, and views with `php artisan optimize`.
- Keep `database/database.sqlite` or the external database backed up; all managed content lives there.

## Legacy files

The `legacy/` directory contains the previous PHP site and its data files. It is kept as the reference for the content and page copy that were ported to Blade, and it is not served by the application. Bundled images, styles, and scripts used by the current site live in `public/`.

## Built on Laravel

This application uses [Laravel](https://laravel.com), whose documentation covers the framework's routing, Eloquent ORM, migrations, queues, and testing tools. The framework is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
