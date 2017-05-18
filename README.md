# PROJECT BlogLite-PHP CODEBASE

Public fork of my private php blogging repository.

Automatic deployment to Azure VM
`testalphabd.eastasia.cloudapp.azure.com`
using DeployHQ through Github Webhooks

Authors:
__Alok Rajiv__

Visual Design Contributions:
__Koushika N & Nithin Bhalla__


__Deploy Checklist__:

1. Permissions for template_cache; else silent death from twig.
2. PHP's tokenizer for Reliabiity(php-autoloader)
3. Remove auto_reload from twig
4. Load prod env variables
5. isDevelod flag in bootstrap.php for doctrine
6. composer `require doctrine/orm`
    * symfony/console suggests installing symfony/event-dispatcher ()
    * symfony/console suggests installing symfony/process ()
    * symfony/console suggests installing psr/log (For using the console logger)
    * doctrine/orm suggests installing symfony/yaml (If you want to use YAML Metad
7. imagick extension for php
8. Add facebook key into fb-login controller
