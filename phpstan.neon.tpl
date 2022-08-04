# rexstan auto generated file - do not edit

includes:
    - %REXSTAN_USERCONFIG%
    - vendor/spaze/phpstan-disallowed-calls/extension.neon

parameters:
    ### parameters we expect from user-config.neon
    # level: 5
    # paths:
    #    - ../mblock/

    excludePaths:
        - */vendor/*

    # don't report not found ignores
    reportUnmatchedIgnoredErrors: false

    ignoreErrors:
        # ignore errors when analyzing rex modules/templates, caused by rex-vars
        -
            message: '#Constant REX_[A-Z_]+ not found\.#'
            path: *data/addons/developer/*
        -
            message: '#.* will always evaluate to (true|false).#'
            path: *data/addons/developer/*
        -
            message: '#.* is always (true|false).#'
            path: *data/addons/developer/*
        -
            message: '#^Variable \$this might not be defined\.#'
            path: *data/addons/developer/*
        -
            message: '#^Variable \$this might not be defined\.#'
            path: */fragments/*

    # autoload core/core-addon symbols which are not autoloadable
    scanDirectories:
        - ../../core/functions/
        - ../structure/functions/
        - ../metainfo/functions/
        - ../mediapool/functions/

    phpVersion: 70300 # PHP 7.3
    treatPhpDocTypesAsCertain: false

    bootstrapFiles:
        - phpstan-bootstrap.php

    # https://phpstan.org/config-reference#universal-object-crates
    universalObjectCratesClasses:
        - rex_fragment

    disallowedSuperglobals:
        -
            superglobal: '$_GET'
            message: 'use rex_request::get() or rex_get() instead.'
        -
            superglobal: '$_POST'
            message: 'use rex_request::post() or rex_post() instead.'
        -
            superglobal: '$_REQUEST'
            message: 'use rex_request::request() or rex_request() instead.'
        -
            superglobal: '$_COOKIE'
            message: 'use rex_request::cookie() or rex_cookie() instead.'
        -
            superglobal: '$_SESSION'
            message: 'use rex_request::session(), rex_request::setSession() or rex_session(), rex_set_session() instead for proper per instance scoping.'
        -
            superglobal: '$_FILES'
            message: 'use rex_request::files() or rex_files() instead.'
        -
            superglobal: '$_ENV'
            message: 'use rex_request::env() or rex_env() instead.'
        -
            superglobal: '$_SERVER'
            message: 'use rex_request::server() or rex_server() instead.'

    disallowedFunctionCalls:
        -
            function: 'setcookie()'
            message: 'use rex_response::sendCookie() or rex_response::clearCookie() instead.'
services:
    -
        class: redaxo\phpstan\RexClassDynamicReturnTypeExtension
        tags:
            - phpstan.broker.dynamicStaticMethodReturnTypeExtension

    -
        class: redaxo\phpstan\RexFunctionsDynamicReturnTypeExtension
        tags:
            - phpstan.broker.dynamicFunctionReturnTypeExtension
