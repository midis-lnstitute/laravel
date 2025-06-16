<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function welcome(){
        return view('welcome');
    }
    public function index() {
        $reports = Report::where('user_id', Auth::user()->id)->get();
        $userId = Auth::id();
        return view('reports.index', compact('reports', 'userId'));
    }

    public function create() {
        $reports = Report::all();
        return view('reports.create', compact('reports'));
    }

    public function store(Request $request): RedirectResponse {

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'path_img' => 'image|mimes:png,jpg,jpeg,gif|max:800',
        ]);

        

        $imageName = time() . '.' . $request['path_img']->extension();
        $request['path_img']->move(public_path('images'), $imageName);

        Report::create([
            'title' => $request->title,
            'description' => $request->description,
            'path_img' => $imageName,
            "user_id" => Auth::user()->id,
            "status" => "Новая",
        ]);

        return redirect()->route('reports.create'); 
        
        
    }

    public function update(Request $request) {
        $request->validate([
            'status' => ['required'],
            'id' => ['required']
        ]);

        Report::where('id', $request->id)->update([
            'status' => $request->status,
        ]);
        return redirect()->back();
    }
}



// $request->validate([
//     'title' => ['required', 'string', 'max:255'],
//     'category_id' => 'required|exists:categories,id',
//     'path_img' => 'image|mimes:png,jpg,jpeg,gif|max:800',
// ]);
// Report::create([
//     "user_id" => Auth::user()->id,
//     'category_id' => $request->category_id,
// ]);



// if (Report::where('user_id', Auth::id())->exists()) {
//     return redirect()->back()->withErrors(['report' => 'Вы уже создали заявку.']);
// } ПРОВЕРКА УНИКАЛЬНОСТИ

// для уведомлений
// composer require php-flasher/flasher-laravel
// php artisan flasher:install
// $result = $request->title * $request->description;
//Чтоб вывести сумму чего либо или сообщение->with('status', 'Сумма: ' . $result)
/*

    <VirtualHost *:80>
        DocumentRoot "D:/xampp/htdocs/laravel/public" ## <- путь до вашего проекта, в папку /public
        ServerName dummy-host2.example.com ## <- мусор
    </VirtualHost>
*/