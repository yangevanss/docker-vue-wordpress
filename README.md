Overview
==================================

- [Installation](#installation)
  - [Development](#development)
  - [Production](#production)
  - [Export SQL](#export-sql)
- [Guides](#guides)
  - [Routing](#routing)
  - [Components](#components)
    - [Global components](#global-components)
      - [Twig](#twig)
      - [Vue](#vue)
    - [Local components](#local-components)
      - [Twig](#twig-1)
      - [Vue](#vue-1)
  - [Alias](#alias)
    - [Vite](#vite)
    - [Twig](#twig)
  - [Assets](#assets)
    - [Vite](#vite-1)
    - [Twig](#twig-1)
  - [Twig functions](#twig-functions)
- [Wordpress](#wordpress)
  - [Hierarchy](#hierarchy)

----------------------------------

# Installation

## Development

1. Setting .env file

Name | Description |
--- | --- |
`COMPOSE_PROJECT_NAME` | Docker container name |
`VITE_PORT` | Vite port |
`WP_PORT` | Wordpress port |
`WP_PORT_PHP_MY_ADMIN` | phpMyAdmin Port |
`WP_MYSQL_DATABASE` | MySQL database name  |
`WP_MYSQL_USERNAME` | MySQL username |
`WP_MYSQL_PASSWORD` | MySQL password |
`WP_MYSQL_ROOT_PASSWORD` | MySQL root password |

2. Install Docker
  * MAC: https://docs.docker.com/desktop/install/mac-install/
  * Windows: https://docs.docker.com/desktop/install/windows-install/
3. Install Docker images
```bash
  docker compose up -d
```
4. Install npm packages
```bash
  pnpm install
  # or
  npm install
```
5. Start development
```bash
  pnpm dev
  # or
  npm run dev
```
6. Open http://localhost:{`WP_PORT`} in browser

## Production

1. Build 
```bash
  pnpm build
  # or
  npm run build
```
2. Change `WP_DEBUG` to `false`
```php
  // wp-config.php

  define('WP_DEBUG', false);
```

## Export SQL
```bash
  sh dump.sh
```
----------------------------------

# Guides

All development files are in `wordpress/wp-content/themes/custom-theme` directory.

## Routing
----------------------------------
Put your routing file in `src/views` directory.

Example: Home page

file tree:
```
views/
--| index/
-----| index.twig
-----| index.js
-----| style.scss
```

in vite.config.js
```js
// vite.config.js

build: {
  ...
  rollupOptions: {
    input: [
      ...
      "wordpress/wp-content/themes/custom-theme/src/views/index/index.js",
    ],
  },
},
```

in index.twig
```twig
<!-- views/index/index.twig -->

{% extends "base.twig" %}

{% block head %}
  {{ enqueue_script_style('@/views/index/index') }}
{% endblock %}

{% block content %}
  <div class="page-index">
    ...
  </div>
{% endblock %}
```

in index.js
```js
// views/index/index.js

import "./style.scss";
import { createApp } from "vue";
import { webFont } from "@/plugins/webFont";
import { globalComponents } from "@/plugins/globalComponents";
import { emitter } from "@/plugins/emitter";
import { breakpoints } from "@/plugins/breakpoints";

const app = createApp({});

app.use(webFont);
app.use(globalComponents);
app.use(emitter);
app.use(breakpoints);

app.mount("#app");
```

in front-page.php
```php
// custom-theme/front-page.php

Timber::render(array('index/index.twig'), $context);
```

----------------------------------
## Components

Twig file tree:
```
{component-name}/
--| index.twig
--| index.js
--| style.scss
```

in index.js
```js
// {component-name}/index.js

import "./style.scss";
```

vue file tree:
```
{component-name}/
--| index.vue
```

### Global components

#### Twig: 
Put your global components in `src/components` directory.

in main.js
```js
// src/main.js

import "@/components/{component-name}/index";
```

#### Vue:
Put your global components in `src/components/vue` directory.

in src/plugins/globalComponents/index.js
```js
import MyComponent from "@/components/vue/{component-name}/index.vue";

export const globalComponents = {
  install(app, options) {
    app.components = {
      // put your global components here
      MyComponent,
    };
  },
};
```

### Local components

#### Twig:
Put your local components in `src/views/{your-view}/components` directory.

in src/views/{your-view}/index.js
```js
// src/views/{your-view}/index.js

import "./components/{component-name}/index";
```

#### Vue:
Put your local components in `src/views/{your-view}/components/vue` directory.

in src/views/{your-view}/index.js
```js
// src/views/{your-view}/index.js

import MyComponent from "./components/vue/{component-name}/index.vue";

const app = createApp({
  components: {
    // put your local components here
    MyComponent,
  },
});

```

----------------------------------
## Alias
### Vite

Find | Replacement |
--- | --- |
`@` | `src` |

### Twig

Default root path: `src/views`

`enqueue_script_style`: 

Find | Replacement |
--- | --- |
`@` | `src` |

`require_assets`:

Find | Replacement |
--- | --- |
`@` | `src/assets/global` |

`include`:

Find | Replacement |
--- | --- |
`components` | `src/components` |

----------------------------------
## Assets
### Vite

Put your assets in `src/assets` directory.

### Twig

Put your assets in `src/assets/global` directory.

----------------------------------
## Twig functions
`enqueue_script_style`

Enqueue script and style

```twig
{{ enqueue_script_style('@/views/index/index') }}
```

`require_assets`

Require assets

```twig
{{ require_assets('@/img/logo.svg') }}
```

----------------------------------

# Wordpress

## Hierarchy

https://developer.wordpress.org/files/2014/10/Screenshot-2019-01-23-00.20.04.png


