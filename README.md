# Steekjelos — website

Marketingwebsite voor **Steekjelos** (merk) en **Steekijs** (product). Bezoekers kunnen het aanbod bekijken, een prijsindicatie berekenen en contact opnemen.

## Tech stack

| Onderdeel | Technologie |
|-----------|-------------|
| Backend | [Laravel](https://laravel.com) 13, PHP 8.3+ |
| Templates | Blade |
| Styling | Tailwind CSS v4, Vite 8 |
| Frontend | Vanilla JavaScript (menu-selectie, prijscalculator, contactformulier) |
| Database | SQLite (standaard, lokaal) |

## Vereisten

- [Git](https://git-scm.com/)
- [PHP](https://www.php.net/) 8.3 of hoger (extensies: `mbstring`, `openssl`, `pdo`, `tokenizer`, `xml`, `ctype`, `json`, `bcmath`)
- [Composer](https://getcomposer.org/)
- [Node.js](https://nodejs.org/) 20+ en npm

## Repository ophalen via CLI

### Eerste keer (clone)

Kies een map waar je projecten bewaart en clone de repository:

```bash
git clone https://github.com/JOUW-ORGANISATIE/websitesteekjelos.git
cd websitesteekjelos
```

Vervang de URL door de echte remote van jullie Git-hosting (GitHub, GitLab, Azure DevOps, enz.).

**Clone via SSH** (als je SSH-sleutels hebt ingesteld):

```bash
git clone git@github.com:JOUW-ORGANISATIE/websitesteekjelos.git
cd websitesteekjelos
```

### Updates binnenhalen (pull)

Als je het project al lokaal hebt en alleen de nieuwste wijzigingen wilt:

```bash
cd pad/naar/websitesteekjelos
git pull
```

Bij een specifieke branch:

```bash
git pull origin main
```

Na een pull altijd dependencies en assets bijwerken als er wijzigingen zijn in `composer.lock`, `package.json` of front-end bestanden:

```bash
composer install
npm install
npm run build
```

## Installatie

### Snelle setup (aanbevolen)

```bash
composer setup
```

Dit script voert uit: `composer install`, `.env` aanmaken, app key genereren, migraties, `npm install` en `npm run build`.

### Handmatige setup

```bash
composer install
cp .env.example .env   # Windows: copy .env.example .env
php artisan key:generate
php artisan migrate
npm install
npm run build
```

### Contactgegevens en menu

- Bedrijfsgegevens: [`config/steekijs.php`](config/steekijs.php)
- Menukaart (smaken, opties): [`config/menu.php`](config/menu.php)

### Afstand (Google Maps)

Voor de rijafstand op `/prijzen` (vanaf Grote Markt 27, Groningen):

1. Zet in `.env`: `GOOGLE_MAPS_API_KEY=jouw-sleutel`
2. Schakel in Google Cloud de **Distance Matrix API** in voor dit project.
3. Optioneel: pas `GOOGLE_MAPS_DISTANCE_ORIGIN` aan (standaard: `Grote Markt 27, Groningen, Netherlands`).

De sleutel wordt alleen server-side gebruikt (`GET /prijzen/afstand`); de prijs zelf houdt nog geen rekening met afstand.

**cURL error 60 (Windows):** PHP kan het SSL-certificaat niet verifiëren. Voor lokaal testen kun je in `.env` zetten: `GOOGLE_MAPS_SSL_VERIFY=false` (of `Google_SSL_verify=false`). Gebruik dit niet op productie. Beter op termijn: CA-bundle instellen in `php.ini` (`curl.cainfo` / `openssl.cafile`).

## Ontwikkeling

Start Laravel, Vite en hulpdiensten tegelijk:

```bash
composer dev
```

De site draait standaard op [http://127.0.0.1:8000](http://127.0.0.1:8000).

Alleen de PHP-server (zonder hot reload voor CSS/JS):

```bash
php artisan serve
```

In een tweede terminal voor Vite:

```bash
npm run dev
```

## Tests

```bash
composer test
```

of:

```bash
php artisan test
```

## Productie-build

```bash
npm run build
```

Zorg dat `APP_ENV=production` en `APP_DEBUG=false` in `.env` staan op de server. Punt de webserver-documentroot naar de map `public/`.

## Pagina’s

| URL | Beschrijving |
|-----|--------------|
| `/` | Home |
| `/prijzen` | Menukaart en prijscalculator |
| `/contact` | Contactformulier |

## Belangrijke mappen

```
websitesteekjelos/
├── app/                 # PHP-applicatiecode
├── config/              # Configuratie (steekijs, menu)
├── public/              # Webroot (img/, images/, build/)
├── resources/
│   ├── css/app.css      # Tailwind & design tokens
│   ├── js/              # JavaScript
│   └── views/           # Blade-templates
├── routes/web.php       # Routes
└── tests/               # Feature tests
```

### Afbeeldingen

| Pad | Gebruik |
|-----|---------|
| `public/img/` | Hero en featurefoto’s (`image.png`, `Untitled*.png`) |
| `public/images/posters/` | Posterafbeeldingen (product, menukaart) |
| `public/images/brand/` | Logo |
| `public/build/` | Gecompileerde CSS/JS (na `npm run build`) |

## Veelvoorkomende Git-commando’s

```bash
# Status bekijken
git status

# Wijzigingen ophalen
git pull

# Nieuwe branch
git checkout -b feature/mijn-aanpassing

# Wijzigingen committen
git add .
git commit -m "Beschrijving van de wijziging"

# Branch naar remote pushen
git push -u origin feature/mijn-aanpassing
```

## Licentie

MIT (Laravel skeleton). Inhoud en merkafbeeldingen zijn eigendom van Steekjelos.
