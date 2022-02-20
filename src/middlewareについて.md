# middlewareについて

## kernel.phpのプロパティ
- ### $middleware  
    全ての処理で通る

- ### $middlewareGroups  
    $routeMiddlewareをまとめて指定できる

- ### $routeMiddleware  
    個別に指定する

## 指定の仕方

- controllerでの指定
    ```php
        $this->middleware('guest')->except('logout');
        // ->except('logout')はlogoutメソッドは除く
    ```

- web.php, api.phpでの指定
    ```php
        Route::middleware(['auth:api'])->group(function () {
            Route::put('auth/user/logout', [LoginController::class, 'logout']);
        });
        // 複数の場合は['auth:api', 'gurad']
        // 引数は'auth:hiki1, hiki2, hiki3'
        // apiはconfig/auth.phpのgurdsの値

        Route::put('auth/user/logout', [LoginController::class, 'logout'])->middleware('auth:api')
    ```

## route:listでのmiddlewareの確認方法
- laravel9からやり方が変わった
    ```bash
    $ php artisan route:list --sort=middleware -v
    # middleware順に並べ替えて -vで詳細を出している

    # middleware -> route:listには表示されない
    # middlewareGroups -> group名が表示される
    # routeMiddleware -> classまでのpathが表示される

    ```

## middlewareの追加
例) addmin_userの場合に上部に$requestをvar_dumpするmiddlewareを作成
- middlewareファイルの作成
    ```bash
    $ php artisan make:middleware DumpRequest
    ```

- kernel.phpに追加
    ```php
        protected $routeMiddleware = [
            // ~省略~
            'dumpRequest' => \App\Http\Middleware\DumpRequest::class,
        ];
    ```

- DumpRequestの編集
    ```php
        public function handle(Request $request, Closure $next, $user)
        {
            // dumpRequest:admin_userが第3引数に入っている
            // (二つはphp artisan make:middlewareで作成される)
            if ($user === 'admin_user') {
                var_dump(htmlspecialchars($request), $user);
            }
            return $next($request);
        }
    ```

- web.phpの編集
    ```php
        Route::get('/', function () {
            return view('welcome');
        })->middleware('dumpRequest:admin_user');
    ```

## authMiddlewareについて
- auth Middlewareの引数はconfig/auth.phpから拾ってくる
    ```php
        'guards' => [
            'web' => [
                'driver' => 'session',
                'provider' => 'users',
            ],
            'api' => [
                'driver' => 'token', // 認証状態の管理方法
                'provider' => 'users', // 認証方法
                'hash' => false,
            ],
        ],
    ```

## 最初から入っているmiddlewareについて
- ## $middleware
    ```php
        protected $middleware = [
            // \App\Http\Middleware\TrustHosts::class,
            \App\Http\Middleware\TrustProxies::class,
            // X-Forwarded-Protoプロトコル　ロードバランサやプロキシをスタマイズできる
            \Fruitcake\Cors\HandleCors::class,
            // cros関連のmiddleware
            \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
            // メンテナンス画面を表示するmiddleware
            \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
            // postのサイズに制限をかける
            \App\Http\Middleware\TrimStrings::class,
            // 文章に含まれる空白を削除する
            \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
            // 空文字をnullに変換する
        ];
    ```

- ## $middlewareGroups
    ```php
        protected $middlewareGroups = [
            'web' => [
                \App\Http\Middleware\EncryptCookies::class,
                // クッキーの暗号化を暗号化をしている（beforeで暗号解除afterで暗号化）
                \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
                // 指定された Cookie を Response ヘッダに登録する機能
                \Illuminate\Session\Middleware\StartSession::class,
                // Session の生成や取得などを行う機能
                // \Illuminate\Session\Middleware\AuthenticateSession::class,
                \Illuminate\View\Middleware\ShareErrorsFromSession::class,
                // Session に保存されたエラー情報を View にセットする機能
                \App\Http\Middleware\VerifyCsrfToken::class,
                // CSRF を防ぐためのトークンの発行やチェックを行う機能
                \Illuminate\Routing\Middleware\SubstituteBindings::class,
                // Route Model Binding を実行する機能(userなどをfindOrFailしてインスタンスを渡してくれるORエラーを返却)
            ],

            'api' => [
                // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
                'throttle:api',
                // 時間とアクセス回数に制限をかける事ができるapiはRouteServiceProvider.phpに定義されている

                \Illuminate\Routing\Middleware\SubstituteBindings::class,
            ],
        ];

    ```

- ## $routeMiddleware
    ```php
        protected $routeMiddleware = [
            'auth' => \App\Http\Middleware\Authenticate::class,
            // 特定のルートへのアクセスに対してユーザー認証を行う機能
            'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
            // 特定のルートへのアクセスに対して Basic 認証を行う機能
            'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
            // 任意のパラメータをキャッシュする機能
            'can' => \Illuminate\Auth\Middleware\Authorize::class,
            // 特定のモデルやリソースへのアクションに対してポリシーを付与する機能
            'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
            // 認証済かチェックし、認証済であれば /home にリダイレクトする機能
            'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
            // password再確認
            'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
            // ◯◯秒以内に遷移して下さいみたいな実装に使える
            'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
            // request回数に制限をかける事ができる
            'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
            // メールアドレスが確認済みの場合のみ通す機能
        ];
    ```
