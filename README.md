## version

|  | version |
| --- | --- |
| PHP | PHP 8.1.3 (cli) (built: Feb 18 2022 19:32:26) (NTS)<br>Copyright (c) The PHP Group<br>Zend Engine v4.1.3, Copyright (c) Zend Technologies<br> |
| Laravel | Laravel Framework 9.1.0 |
| MySql | mysql  Ver 8.0.28 for Linux on x86_64 <br>(MySQL Community Server - GPL) |

## プロジェクトの立ち上げ方

- gitからクローンする

    ```bash
    $ git clone 'URL'
    ```

- dockerを立ち上げる

    ```bash
    $ docker-compose exec app bash
    ```

- laravelの準備

    ```bash
    $ composer install
    $ touch .env
    $ cat .env.example >> .env
    # envファイルは個人に合わせ修正する
    $ composer dumpautoload
    $ php artisan key:generate
    $ php artisan migrate
    ```

- 下記URLにアクセスできれば環境構築完了です

    [localhost](http://127.0.0.1:8000)
