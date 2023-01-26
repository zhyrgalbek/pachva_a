<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $services = ServiceController::GetServices();
        $services = array_splice($services, 0, 4);
        //        $services = [
        //            (object)[
        //                'id' => 1,
        //                'name' => 'Предложения по депозитам',
        //                'description' => 'Перечень условий предлагаемый банками',
        //                'icon' => 'fas fa-database'],
        //            (object)[
        //                'id' => 2,
        //                'name' => 'Кредиты',
        //                'description' => 'Предложения по кредитам, условия, виды и тд.',
        //                'icon' => 'fas fa-wallet'],
        //            (object)[
        //                'id' => 3,
        //                'name' => 'Страховые продукты',
        //                'description' => 'Страховые услуги государственных и частных компаний',
        //                'icon' => 'fas fa-shield-alt'],
        //            (object)[
        //                'id' => 4,
        //                'name' => 'Ценные бумаги',
        //                'description' => 'Информация о ценных бумагах',
        //                'icon' => 'fas fa-newspaper'],
        //        ];

        //        $applications = [
        //            (object)[
        //                'id' => 12,
        //                'name' => 'Запрос на получение кредита ОАО РСК-Банк',
        //                'status' => 1,
        //                'action' => ['cancel']
        //            ],
        //            (object)[
        //                'id' => 11,
        //                'name' => 'Запрос на получение кредита ОАО РСК-Банк',
        //                'status' => 1,
        //                'action' => ['cancel']
        //            ],
        //            (object)[
        //                'id' => 10,
        //                'name' => 'Запрос на получение кредита ОАО РСК-Банк',
        //                'status' => 1,
        //                'action' => ['cancel']
        //            ],
        //            (object)[
        //                'id' => 9,
        //                'name' => 'Запрос на получение кредита ОАО РСК-Банк',
        //                'status' => 1,
        //                'action' => ['cancel']
        //            ],
        //            (object)[
        //                'id' => 8,
        //                'name' => 'Запрос на получение кредита ОАО РСК-Банк',
        //                'status' => 1,
        //                'action' => ['cancel']
        //            ],
        //            (object)[
        //                'id' => 7,
        //                'name' => 'Запрос на получение кредита ОАО РСК-Банк',
        //                'status' => 2,
        //                'action' => []
        //            ],
        //            (object)[
        //                'id' => 6,
        //                'name' => 'Запрос на получение кредита ОАО РСК-Банк',
        //                'status' => 3,
        //                'action' => []
        //            ],
        //            (object)[
        //                'id' => 5,
        //                'name' => 'Запрос на получение кредита ОАО РСК-Банк',
        //                'status' => 3,
        //                'action' => []
        //            ],
        //            (object)[
        //                'id' => 4,
        //                'name' => 'Запрос на получение кредита ОАО РСК-Банк',
        //                'status' => 4,
        //                'action' => []
        //            ],
        //            (object)[
        //                'id' => 3,
        //                'name' => 'Запрос на получение кредита ОАО РСК-Банк',
        //                'status' => 4,
        //                'action' => []
        //            ],
        //            (object)[
        //                'id' => 2,
        //                'name' => 'Запрос на получение кредита ОАО РСК-Банк',
        //                'status' => 4,
        //                'action' => []
        //            ],
        //            (object)[
        //                'id' => 1,
        //                'name' => 'Запрос на получение кредита ОАО РСК-Банк',
        //                'status' => 4,
        //                'action' => []
        //            ],
        //        ];

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
        $user = auth()->user();

        if (auth()->check()) {
            $applications = Application::where('user_id', auth()->user()->id)->orderBy('id', 'DESC')->paginate(10);
        } else {
            $applications = [];
        }
        //        dd($applications);
        Session::put('page', isset($_GET['page']) ? $_GET['page'] : 1);
        //        $applications = $this->paginate($applications, 10, null, ['path' => '/applications']);

        //        $applications = $this->paginate($applications, 10, null, ['path' => '/dashboard']);

        return view('home', compact('services', 'applications', 'providers'));
    }

    public function paginate($items, $perPage = 10, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
