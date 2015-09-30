# AppMigration: TYPO3.CMS Integration

This extension integrates the `dreadlabs/app-migration` packages into a TYPO3.CMS
instance to allow application runtime migration.

## Requirements

TYPO3.CMS 7.4.x or greater

## Installation

    ~$ composer require dreadlabs/app-migration-typo3:0.1.0

## Configuration

Create a file `.migrationrc` in the TYPO3.CMS project root directory. The syntax
corresponds to the one used in `php.ini`. Its content gets parsed by 
[`parse_ini_string`][php_parse_ini_string]  and therefore can contain constants which 
will be resolved automatically. This is  an example configuration with the default 
values:

    config_file_path = PATH_site"/phinx.yml"
    migration_path = PATH_site"/migrations/"
    lock_path = PATH_site"/typo3temp/"
    
**Hint:** Ensure your webserver setup blocks access to / delivery of dotfiles.

### Logging

By default, logging will use `FileWriter` to log all migration-related stuff into
`typo3temp/logs/migration.log`. The default log level is `EMERGENCY`.

If you want to override, disable or re-configure the logging, you must put the necessary
configuration either into the `ext_localconf.php` of a dedicated extension or simply into
`typo3conf/AdditionalConfiguration.php`.

#### Example #1: Increase log level sensitivity to "info"

    $GLOBALS['TYPO3_CONF_VARS']['LOG']['DreadLabs']['AppMigrationTypo3']['Domain']['Logger']['writerConfiguration'] = array(
        \TYPO3\CMS\Core\Log\LogLevel::INFO => array(
            \TYPO3\CMS\Core\Log\Writer\FileWriter::class => array(
                'logFile' => 'typo3temp/logs/migration.log',
            ),
        ),
    );

Note the additional `Logger` array key before `writerConfiguration`.

#### Example #2: Mute logging with NullWriter

    $GLOBALS['TYPO3_CONF_VARS']['LOG']['DreadLabs']['AppMigrationTypo3']['Domain']['Logger']['writerConfiguration'] = array(
        \TYPO3\CMS\Core\Log\LogLevel::EMERGENCY => array(
            \TYPO3\CMS\Core\Log\Writer\NullWriter::class => array(
            ),
        ),
    );

Note the additional `Logger` array key before `writerConfiguration`.

### Migration low-level API

Currently, the migrator adapter `dreadlabs/app-migration-migrator-phinx` is used. This
library out-of-the-box comes with a CLI. In order to use the CLI you also have to create 
a `phinx.yml` configuration file in your project's root directory (PATH_site in a default
TYPO3.CMS instance):

    paths:
        migrations: %%PHINX_CONFIG_DIR%%/migrations

    environments:
        default_migration_table: phinxlog

        # The naming is a bit unfortunate: it means default `environment`
        default_database: default

        default:
            adapter: mysql
            host: localhost
            name: DB_NAME
            user: DB_USERNAME
            pass: DB_PASSWORD
            port: DB_PORT
            charset: utf8
            
Please read the [Phinx Documentation][phinx_documentation] for more information.

## License

GPLv2, © 2015 Thomas Juhnke

[php_parse_ini_string]: https://secure.php.net/manual/en/function.parse-ini-string.php
[phinx_documentation]: http://docs.phinx.org/en/latest/
