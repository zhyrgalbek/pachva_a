<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Post;
use App\Models\TemporaryUser;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class WareHouseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     *
     *
     */

    public function classWarehouse()
    {
        $data = Post::whereId(21)->get();
        $services = ServiceController::GetServices();
        $services = array_splice($services, 0, 4);
        $providers = [
            (object)[
                'id' => 1,
                'name' => 'Банк АБС',
                'description' => 'Кредитование от 10% годовых.<br/>Срок от 2х до 10 лет.'
            ],
            (object)[
                'id' => 2,
                'name' => 'Банк Кыргызстан',
                'description' => 'Кредитование от 11% годовых.<br/>Срок от 3х до 10 лет.'
            ],
            (object)[
                'id' => 3,
                'name' => 'Демир Банк',
                'description' => 'Кредитование от 12% годовых.<br/>Срок от 4х до 10 лет.'
            ],
            (object)[
                'id' => 4,
                'name' => 'Банк KICB',
                'description' => 'Кредитование от 13% годовых.<br/>Срок от 5 до 10 лет.'
            ],
            (object)[
                'id' => 5,
                'name' => 'Керемет Банк',
                'description' => 'Кредитование от 14% годовых.<br/>Срок от 6 до 11 лет.'
            ],
            (object)[
                'id' => 6,
                'name' => 'Бакай Банк',
                'description' => 'Кредитование от 15% годовых.<br/>Срок от 7 до 12 лет.'
            ],
            (object)[
                'id' => 7,
                'name' => 'РСК Банк',
                'description' => 'Кредитование от 16% годовых.<br/>Срок от 8 до 13 лет.'
            ],
            (object)[
                'id' => 8,
                'name' => 'Айыл Банк',
                'description' => 'Кредитование от 17% годовых.<br/>Срок от 9 до 14 лет.'
            ],
            (object)[
                'id' => 9,
                'name' => 'Дос-Кредобанк',
                'description' => 'Кредитование от 18% годовых.<br/>Срок от 10 до 15 лет.'
            ],
            (object)[
                'id' => 10,
                'name' => 'Халык Банк',
                'description' => 'Кредитование от 19% годовых.<br/>Срок от 2х до 10 лет.'
            ],
        ];
        if (auth()->check()) {
            $applications = Application::where('user_id', auth()->user()->id)->orderBy('id', 'DESC')->paginate(10);
        } else {
            $applications = [];
        }
        Session::put('page', isset($_GET['page']) ? $_GET['page'] : 1);

        return view('vendor.classWarehouse', compact('services', 'applications', 'providers', 'data'));
    }

    public function about()
    {
        $data = Post::whereId(20)->get();

        $services = ServiceController::GetServices();
        $services = array_splice($services, 0, 4);
        $providers = [
            (object)[
                'id' => 1,
                'name' => 'Банк АБС',
                'description' => 'Кредитование от 10% годовых.<br/>Срок от 2х до 10 лет.'
            ],
            (object)[
                'id' => 2,
                'name' => 'Банк Кыргызстан',
                'description' => 'Кредитование от 11% годовых.<br/>Срок от 3х до 10 лет.'
            ],
            (object)[
                'id' => 3,
                'name' => 'Демир Банк',
                'description' => 'Кредитование от 12% годовых.<br/>Срок от 4х до 10 лет.'
            ],
            (object)[
                'id' => 4,
                'name' => 'Банк KICB',
                'description' => 'Кредитование от 13% годовых.<br/>Срок от 5 до 10 лет.'
            ],
            (object)[
                'id' => 5,
                'name' => 'Керемет Банк',
                'description' => 'Кредитование от 14% годовых.<br/>Срок от 6 до 11 лет.'
            ],
            (object)[
                'id' => 6,
                'name' => 'Бакай Банк',
                'description' => 'Кредитование от 15% годовых.<br/>Срок от 7 до 12 лет.'
            ],
            (object)[
                'id' => 7,
                'name' => 'РСК Банк',
                'description' => 'Кредитование от 16% годовых.<br/>Срок от 8 до 13 лет.'
            ],
            (object)[
                'id' => 8,
                'name' => 'Айыл Банк',
                'description' => 'Кредитование от 17% годовых.<br/>Срок от 9 до 14 лет.'
            ],
            (object)[
                'id' => 9,
                'name' => 'Дос-Кредобанк',
                'description' => 'Кредитование от 18% годовых.<br/>Срок от 10 до 15 лет.'
            ],
            (object)[
                'id' => 10,
                'name' => 'Халык Банк',
                'description' => 'Кредитование от 19% годовых.<br/>Срок от 2х до 10 лет.'
            ],
        ];
        if (auth()->check()) {
            $applications = Application::where('user_id', auth()->user()->id)->orderBy('id', 'DESC')->paginate(10);
        } else {
            $applications = [];
        }
        Session::put('page', isset($_GET['page']) ? $_GET['page'] : 1);

        return view('vendor.about', compact('services', 'applications', 'providers' , 'data'));
    }

    public function warehouse_data()
    {
        $services = ServiceController::GetServices();
        $services = array_splice($services, 0, 4);
        $providers = [
            (object)[
                'id' => 1,
                'name' => 'Банк АБС',
                'description' => 'Кредитование от 10% годовых.<br/>Срок от 2х до 10 лет.'
            ],
            (object)[
                'id' => 2,
                'name' => 'Банк Кыргызстан',
                'description' => 'Кредитование от 11% годовых.<br/>Срок от 3х до 10 лет.'
            ],
            (object)[
                'id' => 3,
                'name' => 'Демир Банк',
                'description' => 'Кредитование от 12% годовых.<br/>Срок от 4х до 10 лет.'
            ],
            (object)[
                'id' => 4,
                'name' => 'Банк KICB',
                'description' => 'Кредитование от 13% годовых.<br/>Срок от 5 до 10 лет.'
            ],
            (object)[
                'id' => 5,
                'name' => 'Керемет Банк',
                'description' => 'Кредитование от 14% годовых.<br/>Срок от 6 до 11 лет.'
            ],
            (object)[
                'id' => 6,
                'name' => 'Бакай Банк',
                'description' => 'Кредитование от 15% годовых.<br/>Срок от 7 до 12 лет.'
            ],
            (object)[
                'id' => 7,
                'name' => 'РСК Банк',
                'description' => 'Кредитование от 16% годовых.<br/>Срок от 8 до 13 лет.'
            ],
            (object)[
                'id' => 8,
                'name' => 'Айыл Банк',
                'description' => 'Кредитование от 17% годовых.<br/>Срок от 9 до 14 лет.'
            ],
            (object)[
                'id' => 9,
                'name' => 'Дос-Кредобанк',
                'description' => 'Кредитование от 18% годовых.<br/>Срок от 10 до 15 лет.'
            ],
            (object)[
                'id' => 10,
                'name' => 'Халык Банк',
                'description' => 'Кредитование от 19% годовых.<br/>Срок от 2х до 10 лет.'
            ],
        ];
        if (auth()->check()) {
            $applications = Application::where('user_id', auth()->user()->id)->orderBy('id', 'DESC')->paginate(10);
        } else {
            $applications = [];
        }
        Session::put('page', isset($_GET['page']) ? $_GET['page'] : 1);

        $users = TemporaryUser::latest()->get();
        return view('vendor.warehouse_data', compact('services','users', 'applications', 'providers'));
    }

    public function certificates_data()
    {
        $services = ServiceController::GetServices();
        $services = array_splice($services, 0, 4);
        $providers = [
            (object)[
                'id' => 1,
                'name' => 'Банк АБС',
                'description' => 'Кредитование от 10% годовых.<br/>Срок от 2х до 10 лет.'
            ],
            (object)[
                'id' => 2,
                'name' => 'Банк Кыргызстан',
                'description' => 'Кредитование от 11% годовых.<br/>Срок от 3х до 10 лет.'
            ],
            (object)[
                'id' => 3,
                'name' => 'Демир Банк',
                'description' => 'Кредитование от 12% годовых.<br/>Срок от 4х до 10 лет.'
            ],
            (object)[
                'id' => 4,
                'name' => 'Банк KICB',
                'description' => 'Кредитование от 13% годовых.<br/>Срок от 5 до 10 лет.'
            ],
            (object)[
                'id' => 5,
                'name' => 'Керемет Банк',
                'description' => 'Кредитование от 14% годовых.<br/>Срок от 6 до 11 лет.'
            ],
            (object)[
                'id' => 6,
                'name' => 'Бакай Банк',
                'description' => 'Кредитование от 15% годовых.<br/>Срок от 7 до 12 лет.'
            ],
            (object)[
                'id' => 7,
                'name' => 'РСК Банк',
                'description' => 'Кредитование от 16% годовых.<br/>Срок от 8 до 13 лет.'
            ],
            (object)[
                'id' => 8,
                'name' => 'Айыл Банк',
                'description' => 'Кредитование от 17% годовых.<br/>Срок от 9 до 14 лет.'
            ],
            (object)[
                'id' => 9,
                'name' => 'Дос-Кредобанк',
                'description' => 'Кредитование от 18% годовых.<br/>Срок от 10 до 15 лет.'
            ],
            (object)[
                'id' => 10,
                'name' => 'Халык Банк',
                'description' => 'Кредитование от 19% годовых.<br/>Срок от 2х до 10 лет.'
            ],
        ];
        if (auth()->check()) {
            $applications = Application::where('user_id', auth()->user()->id)->orderBy('id', 'DESC')->paginate(10);
        } else {
            $applications = [];
        }
        Session::put('page', isset($_GET['page']) ? $_GET['page'] : 1);
        $users = TemporaryUser::all();

        return view('vendor.certificates_data', compact('services', 'users', 'applications', 'providers'));
    }
}
