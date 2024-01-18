# DPB Starter Project

## System requirements

-   WSL2
-   Docker
-   Git
-   Composer

## Commands

```
git clone git@github.com:bdilhof/dpb-helpdesk.git && cd dpb-helpdesk/
```

```
composer install --ignore-platform-reqs
```

```
cp .env.example .env
```

```
sail up -d
```

```
sail composer install
```

```
sail artisan key:generate
```

```
sail artisan migrate:fresh --seed
```

```
sail npm install
```

```
sail npm run build
```

Open http://localhost
