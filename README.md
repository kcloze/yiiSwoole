yiiSwoole
========

Yii 1.1.16 with Swoole Http_Server

## Requirements

* PHP 5.3+
* Swoole 1.7.8
* Linux, OS X and basic Windows support (Thinks to cygwin)

## Installation Swoole

1. Install via pecl
    
    ```
    pecl install swoole
    ```

2. Install from source

    ```
    sudo apt-get install php5-dev
    git clone https://github.com/swoole/swoole-src.git
    cd swoole-src
    phpize
    ./configure
    make && make install
    ```
## How to run
1. cd yiiSwoole/application
2. php server.php
3. Open your browser and enter http://ip:9501

## Run with php-fpm
1. This application in a state of  beta,if you find some bug,it can run with php-fpm to fix bug
2. Set nginx root dir with yiiSwoole/application
3. Open your browser and enter http://ip/index.php