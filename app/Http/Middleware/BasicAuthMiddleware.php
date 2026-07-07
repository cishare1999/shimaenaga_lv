<?php

namespace App\Http\Middleware;

use Closure;

class BasicAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $username = $request->getUser();
        $password = $request->getPassword();
        // dd($request);
        //2023.12.04追加変更　URLを見て認証を切り替える処理
        // dd($request->path());
        $uri = $request->path();
        if($uri === "customer/media"){
            if ($username == 'media' && $password == 'med2023') {
                return $next($request);
            }
        }elseif($uri === "customer/medialp3"){
            if ($username == 'medialp3' && $password == 'med2024') {
                return $next($request);
            }
        }elseif($uri === "customer/jmedia"){
            if ($username == 'medialp' && $password == 'med2025') {
                return $next($request);
            }
        }else{
            if ($username == 'shimaenaga' && $password == '26shima20') {
                return $next($request);
            }
        }

        abort(401, "Enter username and password.", [
            header('WWW-Authenticate: Basic realm="Sample Private Page"'),
            header('Content-Type: text/plain; charset=utf-8')
        ]);

    }
}
