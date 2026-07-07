<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

Paginator::useBootstrap();

use App\User;
use App\UserData;
use App\UserItem;
use Mail;


class AdminCompletionController extends Controller
{
    // ...

    public function index(Request $request)
    {
        $searchFields = ['name', 'kana', 'tel', 'birthday'];
        $op = [];
        $likeConditions = [];
        $equalConditions = []; // equalConditionsを初期化

        foreach ($searchFields as $field) {
            if ($request->filled($field)) {
                if ($field === 'kana') {
                    $column = 'c.kana';
                    $op[$field] = '%' . $request->$field . '%';
                    $likeConditions[] = 'REPLACE(REPLACE(' . $column . ', " ", ""), "　", "") LIKE ?';
                } elseif ($field === 'birthday') {
                    $column = 'c.birthday';
                    $op[$field] = $request->$field; // LIKE検索でなく、そのままの値を代入
                    $equalConditions[] = $column . ' = ?'; // equalConditionsに追加
                } elseif ($field === 'tel') {
                    $column = 'a.mobile';
                    $op[$field] = '%' . $request->$field . '%';
                    $likeConditions[] = 'REPLACE(REPLACE(' . $column . ', " ", ""), "　", "") LIKE ?';
                } else {
                    $column = 'a.' . $field;
                    $op[$field] = '%' . $request->$field . '%';
                    $likeConditions[] = 'REPLACE(REPLACE(' . $column . ', " ", ""), "　", "") LIKE ?';
                }
            }
        }

        $query = 'SELECT a.id, a.name, a.display_name, a.mobile, a.from_url, a.email, a.created_at, b.id as list_id, c.kana, c.birthday, c.is_black, c.memo FROM users a 
                    INNER JOIN user_items b ON a.id = b.user_id 
                    INNER JOIN user_data c ON a.id = c.user_id 
                    WHERE 
                    a.id <> ALL (
                        SELECT user_id FROM user_items 
                        WHERE 
                        status_paid IS NULL OR 
                        status_paid = "商品到着待" OR 
                        status_paid = "商品到着済"
                    )';

        if (!empty($likeConditions)) {
            $query .= ' AND ' . implode(' AND ', $likeConditions);
        }

        if (!empty($equalConditions)) {
            $query .= ' AND ' . implode(' AND ', $equalConditions);
        }

        $query .= ' GROUP BY a.id ORDER BY a.created_at DESC';

        $comp_query = DB::select($query, array_values($op));

        // ... 他の処理

        $size = 100;
        $collect = collect($comp_query);

        $users = new LengthAwarePaginator(
            $collect->forPage($request->page ?? 1, $size),
            $collect->count(),
            $size,
            $request->page ?? 1,
            ['path' => $request->url()]
        );

        return view('admin.completion.index', compact('request', 'users'));
    }
}