# DPB Starter Project

## System requirements

-   Docker Desktop
-   WSL2 with GIT and Composer

## Commands

```
composer create-project \
    --repository '{"type": "vcs", "url": "https://github.com/bdilhof/dpb-starter"}' \
    --stability=dev \
    --ignore-platform-reqs \
    bdilhof/dpb-starter your-project-name
```

Open http://localhost
