yiiSwoole
========

* Yii 1.1.14 with Swoole Http_Server
* In high-concurrency situations,will be better than php-fpm

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

##Stress testing
1. centos 6.6 ,cpu 12 core,memory 64G
2. php-fpm : 2 pool total 200 php-fpm process, pm = static,pm.max_children = 100,pm.max_requests = 2048
3. swoole_http_server worker_num 200,max_request 10000
4. ab -c200 -n10000 url

## php-fpm
    ```
    ab -c200 -n10000 http://yiisw.test.com/

    Server Software:        nginx
    Server Hostname:        yiisw.test.com
    Server Port:            80

    Document Path:          /
    Document Length:        19 bytes

    Concurrency Level:      200
    Time taken for tests:   3.682 seconds
    Complete requests:      10000
    Failed requests:        0
    Write errors:           0
    Total transferred:      1750000 bytes
    HTML transferred:       190000 bytes
    Requests per second:    2716.01 [#/sec] (mean)
    Time per request:       73.637 [ms] (mean)
    Time per request:       0.368 [ms] (mean, across all concurrent requests)
    Transfer rate:          464.16 [Kbytes/sec] received

    Connection Times (ms)
                  min  mean[+/-sd] median   max
    Connect:        0   13 125.9      0    3000
    Processing:     3   57  42.6     51    1448
    Waiting:        3   57  42.7     51    1448
    Total:         18   70 143.5     51    3252

    Percentage of the requests served within a certain time (ms)
      50%     51
      66%     53
      75%     56
      80%     59
      90%     71
      95%     78
      98%    112
      99%   1048
     100%   3252 (longest request)
    ```

## swoole_http_server
    ```
    ab -c200 -n10000 http://127.0.0.1:9501/

    Server Software:        swoole-http-server
    Server Hostname:        127.0.0.1
    Server Port:            9501

    Document Path:          /
    Document Length:        19 bytes

    Concurrency Level:      200
    Time taken for tests:   2.882 seconds
    Complete requests:      10000
    Failed requests:        391
       (Connect: 0, Receive: 0, Length: 391, Exceptions: 0)
    Write errors:           0
    Total transferred:      1604703 bytes
    HTML transferred:       182571 bytes
    Requests per second:    3470.04 [#/sec] (mean)
    Time per request:       57.636 [ms] (mean)
    Time per request:       0.288 [ms] (mean, across all concurrent requests)
    Transfer rate:          543.79 [Kbytes/sec] received

    Connection Times (ms)
                  min  mean[+/-sd] median   max
    Connect:        0   11 103.8      0    1001
    Processing:     3   44  47.7     35     466
    Waiting:        0   42  47.7     34     466
    Total:          3   55 115.7     35    1259

    Percentage of the requests served within a certain time (ms)
      50%     35
      66%     40
      75%     44
      80%     48
      90%     62
      95%     85
      98%    341
      99%   1020
     100%   1259 (longest request)
     ```