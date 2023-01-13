<?php

namespace App\Http\Controllers;

use App\Services\ServiceService;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use JoeDixon\Translation\Drivers\Translation;

class ServiceController extends Controller
{
//    protected $services = [];
    private $translation;
    private $serviceService;

    public function __construct(Translation $translation, ServiceService $serviceService)
    {
        $this->serviceService = $serviceService;
        $this->translation = $translation;
        $this->middleware('permission:service-list', ['only' => ['index']]);
        $this->middleware('permission:file-manager', ['only' => ['files']]);
        $this->middleware('guest', ['only' => ['account', 'contact', 'accountAll', 'contactAll']]);

//        $this->services = [
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
//            (object)[
//                'id' => 5,
//                'name' => 'Предложения по ипотеке',
//                'description' => 'Перечень условий, предлагаемый банками',
//                'icon' => 'fas fa-city'],
//            (object)[
//                'id' => 6,
//                'name' => 'Платежные карты',
//                'description' => 'Предложения по депозитам, условия, виды и тд.',
//                'icon' => 'fas fa-credit-card'],
//            (object)[
//                'id' => 7,
//                'name' => 'Автокредит',
//                'description' => 'Перечень условий, предлагаемый банками',
//                'icon' => 'fas fa-car-side'],
//            (object)[
//                'id' => 8,
//                'name' => 'Наличие счетов',
//                'description' => 'Получить информацию о наличии счетов',
//                'icon' => 'fas fa-file-invoice'],
//            (object)[
//                'id' => 9,
//                'name' => 'Предложения по депозитам',
//                'description' => 'Перечень условий предлагаемый банками',
//                'icon' => 'fas fa-database'],
//            (object)[
//                'id' => 10,
//                'name' => 'Кредиты',
//                'description' => 'Предложения по кредитам, условия, виды и тд.',
//                'icon' => 'fas fa-wallet'],
//            (object)[
//                'id' => 11,
//                'name' => 'Страховые продукты',
//                'description' => 'Страховые услуги государственных и частных компаний',
//                'icon' => 'fas fa-shield-alt'],
//            (object)[
//                'id' => 12,
//                'name' => 'Ценные бумаги',
//                'description' => 'Информация о ценных бумагах',
//                'icon' => 'fas fa-newspaper'],
//            (object)[
//                'id' => 13,
//                'name' => 'Предложения по ипотеке',
//                'description' => 'Перечень условий, предлагаемый банками',
//                'icon' => 'fas fa-city'],
//            (object)[
//                'id' => 14,
//                'name' => 'Платежные карты',
//                'description' => 'Предложения по депозитам, условия, виды и тд.',
//                'icon' => 'fas fa-credit-card'],
//            (object)[
//                'id' => 15,
//                'name' => 'Автокредит',
//                'description' => 'Перечень условий, предлагаемый банками',
//                'icon' => 'fas fa-car-side'],
//            (object)[
//                'id' => 16,
//                'name' => 'Наличие счетов',
//                'description' => 'Получить информацию о наличии счетов',
//                'icon' => 'fas fa-file-invoice'],
//            (object)[
//                'id' => 17,
//                'name' => 'Предложения по депозитам',
//                'description' => 'Перечень условий предлагаемый банками',
//                'icon' => 'fas fa-database'],
//            (object)[
//                'id' => 18,
//                'name' => 'Кредиты',
//                'description' => 'Предложения по кредитам, условия, виды и тд.',
//                'icon' => 'fas fa-wallet'],
//            (object)[
//                'id' => 19,
//                'name' => 'Страховые продукты',
//                'description' => 'Страховые услуги государственных и частных компаний',
//                'icon' => 'fas fa-shield-alt'],
//            (object)[
//                'id' => 20,
//                'name' => 'Ценные бумаги',
//                'description' => 'Информация о ценных бумагах',
//                'icon' => 'fas fa-newspaper'],
//            (object)[
//                'id' => 21,
//                'name' => 'Предложения по ипотеке',
//                'description' => 'Перечень условий, предлагаемый банками',
//                'icon' => 'fas fa-city'],
//            (object)[
//                'id' => 22,
//                'name' => 'Платежные карты',
//                'description' => 'Предложения по депозитам, условия, виды и тд.',
//                'icon' => 'fas fa-credit-card'],
//            (object)[
//                'id' => 23,
//                'name' => 'Автокредит',
//                'description' => 'Перечень условий, предлагаемый банками',
//                'icon' => 'fas fa-car-side'],
//            (object)[
//                'id' => 24,
//                'name' => 'Наличие счетов',
//                'description' => 'Получить информацию о наличии счетов',
//                'icon' => 'fas fa-file-invoice'],
//
//            (object)[
//                'id' => 25,
//                'name' => 'Предложения по ипотеке',
//                'description' => 'Перечень условий, предлагаемый банками',
//                'icon' => 'fas fa-city'],
//            (object)[
//                'id' => 26,
//                'name' => 'Платежные карты',
//                'description' => 'Предложения по депозитам, условия, виды и тд.',
//                'icon' => 'fas fa-credit-card'],
//            (object)[
//                'id' => 27,
//                'name' => 'Автокредит',
//                'description' => 'Перечень условий, предлагаемый банками',
//                'icon' => 'fas fa-car-side'],
//            (object)[
//                'id' => 28,
//                'name' => 'Наличие счетов',
//                'description' => 'Получить информацию о наличии счетов',
//                'icon' => 'fas fa-file-invoice'],
//        ];

    }

    public function index(Request $request)
    {
        $search = $request->get('search');

        $filterType = $request->get('type');
        $filterCategory = $request->get('category');
        $filterKind = $request->get('kind');

        $filteredTypesArr = [];
        if ($filterType) {
            array_push($filteredTypesArr, $filterType);
            if ($filterCategory) {
                array_push($filteredTypesArr, $filterCategory);
                if ($filterKind) {
                    array_push($filteredTypesArr, $filterKind);
                }
            }
        }

        $services = $this->get_services($search, null, $filterType, $filterCategory, $filterKind);

        $services = $this->paginate($services, 24, null, ['path' => '/services']);

        $service_types = $this->get_service_types($this->get_services());

        Session::put('search', isset($_GET['search']) ? $_GET['search'] : null);
        Session::put('page', isset($_GET['page']) ? $_GET['page'] : 1);

        return view('services.index', compact('services', 'search', 'service_types', 'filteredTypesArr'));
    }

    public function account()
    {
        $topBanner = true;
        $topLogin = true;

        $services = $this->get_popular_services(8, 'juridical');

        $services_route = 'services.account.all';

        return view('services.popular', compact('topBanner', 'topLogin', 'services', 'services_route'));
    }

    public function accountAll(Request $request)
    {
        $search = $request->get('search');

        $filterType = $request->get('type');
        $filterCategory = $request->get('category');
        $filterKind = $request->get('kind');

        $filteredTypesArr = [];
        if ($filterType) {
            array_push($filteredTypesArr, $filterType);
            if ($filterCategory) {
                array_push($filteredTypesArr, $filterCategory);
                if ($filterKind) {
                    array_push($filteredTypesArr, $filterKind);
                }
            }
        }


        $services = $this->get_services($search, 'juridical', $filterType, $filterCategory, $filterKind);

        $service_types = $this->get_service_types($this->get_services(null, 'juridical'));

        $services = $this->paginate($services, 24, null, ['path' => '/services/account/all']);
        return view('services.index', compact('services', 'search', 'service_types', 'filteredTypesArr'));
    }

    public function contact()
    {
//        dd('qweqwe');
        $topBanner = true;
        $topLogin = true;

        $services = $this->get_popular_services(8, 'individual');
//
        $services_route = 'services.contact.all';

        return view('services.popular', compact('topBanner', 'topLogin', 'services', 'services_route'));
    }

    public function contactAll(Request $request)
    {

        $search = $request->get('search');

        $filterType = $request->get('type');
        $filterCategory = $request->get('category');
        $filterKind = $request->get('kind');
        $filteredTypesArr = [];
        if ($filterType) {
            array_push($filteredTypesArr, $filterType);
            if ($filterCategory) {
                array_push($filteredTypesArr, $filterCategory);
                if ($filterKind) {
                    array_push($filteredTypesArr, $filterKind);
                }
            }
        }

        $services = $this->get_services($search, 'individual', $filterType, $filterCategory, $filterKind);

        $services = $this->paginate($services, 24, null, ['path' => '/services/contact/all']);

        $service_types = $this->get_service_types($this->get_services(null, 'individual'));

        return view('services.index', compact('services', 'search', 'service_types', 'filteredTypesArr'));
    }

    /**
     * Store a new user.
     *
     * @param \Illuminate\Http\Request $request
     * @param integer $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function detail(Request $request, $id)
    {

        $utype = $request->get('utype');

        $service = $this->get_service($id);

        if (!auth()->check() && $service->type != 'Informational') {
            return redirect()->route('login')
                ->with('info', __('Please log in to continue'));
        }

        $date_start = date('Y-m-d H:i:s', strtotime($request->get('date_start') ?: 'today -7 day'));
        $date_end = date('Y-m-d H:i:s', strtotime($request->get('date_end') ?: 'tomorrow'));

        $data = self::GetData($service, $date_start, $date_end);

        $members = self::GetMembers($service->id);

        if ($service == null) {
            abort(404);
        }

//        $service->fields = [
//            (object)[
//                'name' => 'logo',
//                'title' => '',
//                'type' => 'image'
//            ],
//            (object)[
//                'name' => 'bank',
//                'title' => 'Банк',
//                'type' => 'select',
//                'options' => [
//                    '1' => 'Демир банк',
//                    '2' => 'Бакай банк',
//                    '3' => 'KICB',
//                ]
//            ],
//            (object)[
//                'name' => 'sum_min',
//                'title' => 'Минимальная сумма',
//                'type' => 'decimal',
//            ],
//            (object)[
//                'name' => 'sum_max',
//                'title' => 'Максимальная сумма',
//                'type' => 'decimal',
//            ],
//            (object)[
//                'name' => 'currency',
//                'title' => 'Валюта кредита',
//                'type' => 'select',
//                'options' => [
//                    'KGS' => 'Сом',
//                    'RUB' => 'Рубль',
//                    'USD' => 'Доллар',
//                ]
//            ],
//            (object)[
//                'name' => 'percent',
//                'title' => 'Процентная ставка',
//                'type' => 'percent',
//            ],
//            (object)[
//                'name' => 'purpose',
//                'title' => 'Цель кредита',
//                'type' => 'select',
//                'options' => [
//                    '1' => 'Ипотека',
//                    '2' => 'Сельхоз',
//                    '3' => 'Бизнес',
//                ]
//            ],
//            (object)[
//                'name' => 'credit_term',
//                'title' => 'Срок кредита',
//                'type' => 'select',
//                'options' => [
//                    '1' => 'От 24 до 60 месяцев',
//                    '2' => 'От 60 до 120 месяцев',
//                    '3' => 'От 120 до 240 месяцев',
//                ]
//            ],
//            (object)[
//                'name' => 'date',
//                'title' => 'Дата',
//                'type' => 'date'
//            ],
//        ];

        $service->fields = [
            (object)[
                'name' => 'logo',
                'title' => '',
                'type' => 'image'
            ],
            (object)[
                'name' => 'member_id',
                'title' => 'Банк',
                'type' => 'select',
                'options' => array_column($members, 'name', 'id')
            ],
            (object)[
                'name' => 'status',
                'title' => 'Статус',
                'type' => 'text'
            ],
        ];

        $service->filters = ['member_id' => null];
        $service->titles = ['logo', 'member_id'];

        foreach ($service->texts as $field => $label) {
            $service->fields[] = (object)[
                'name' => $field,
                'title' => $label,
                'type' => 'text'
            ];
            $service->filters[$field] = null;
            $service->titles[] = $field;
        }
        foreach ($service->numbers as $field => $label) {
            $service->fields[] = (object)[
                'name' => $field,
                'title' => $label,
                'type' => 'decimal'
            ];
            $service->filters[$field] = null;
            $service->titles[] = $field;
        }
        foreach ($service->dates as $field => $label) {
            $service->fields[] = (object)[
                'name' => $field,
                'title' => $label,
                'type' => 'date'
            ];
            $service->filters[$field] = null;
            $service->titles[] = $field;
        }

        $service->fields[] = (object)[
            'name' => 'date_start',
            'title' => __('Valid from'),
            'type' => 'datetime'
        ];
        $service->fields[] = (object)[
            'name' => 'date_end',
            'title' => __('Valid to'),
            'type' => 'datetime'
        ];

        $service->titles[] = 'date_start';
        $service->titles[] = 'date_end';


        $service->data = [];

        foreach ($data as $row) {
            $logo = '/storage/photos/5/images/org.jpg';
            foreach ($members as $member) {
                if ($row->member_id == $member->id) {
                    $logo = $member->image;
                }
            }
            $item = (object)[
                'id' => $row->id,
                'logo' => $logo,
                'member_id' => $row->member_id,
                'date_start' => $row->date_start,
                'date_end' => $row->date_end,
                'nested_data' => $row->nested_data,
                '__actions' => $service->type == 'Personal' ? ['send_request'] : []
            ];

            foreach ($row->texts as $field => $value) {
                $item->{$field} = strval($value);
            }
            foreach ($row->numbers as $field => $value) {
                $item->{$field} = floatval($value);
            }
            foreach ($row->dates as $field => $value) {
                $item->{$field} = date('Y-m-d H:i:s', strtotime($value));
            }

            $service->data[] = $item;
        }

//        $service->data = [
//            (object)[
//                'id' => 1,
//                'logo' => '/storage/photos/1/images/demirbank.png',
//                'bank' => 1,
//                'sum_min' => 500000,
//                'sum_max' => 1000000,
//                'currency' => 'KGS',
//                'credit_term' => 1,
//                'percent' => 18.99,
//                'purpose' => 1,
//                'date' => date('Y-m-d H:i:s'),
//                '__actions' => ['send_request']
//            ],
//            (object)[
//                'id' => 2,
//                'logo' => '/storage/photos/1/images/demirbank.png',
//                'bank' => 1,
//                'sum_min' => 350000,
//                'sum_max' => 500000,
//                'currency' => 'KGS',
//                'credit_term' => 1,
//                'percent' => 18.99,
//                'purpose' => 1,
//                'date' => date('Y-m-d H:i:s'),
//                '__actions' => ['send_request']
//            ],
//            (object)[
//                'id' => 3,
//                'logo' => '/storage/photos/1/images/demirbank.png',
//                'bank' => 1,
//                'sum_min' => 350000,
//                'sum_max' => 500000,
//                'currency' => 'KGS',
//                'credit_term' => 1,
//                'percent' => 18.99,
//                'purpose' => 1,
//                'date' => date('Y-m-d H:i:s'),
//                '__actions' => ['send_request']
//            ],
//            (object)[
//                'id' => 4,
//                'logo' => '/storage/photos/1/images/demirbank.png',
//                'bank' => 1,
//                'sum_min' => 350000,
//                'sum_max' => 500000,
//                'currency' => 'KGS',
//                'credit_term' => 1,
//                'percent' => 18.99,
//                'purpose' => 1,
//                'date' => date('Y-m-d H:i:s'),
//                '__actions' => ['send_request']
//            ],
//            (object)[
//                'id' => 5,
//                'logo' => '/storage/photos/1/images/bakaibank.png',
//                'bank' => 2,
//                'sum_min' => 350000,
//                'sum_max' => 500000,
//                'currency' => 'KGS',
//                'credit_term' => 1,
//                'percent' => 18.99,
//                'purpose' => 1,
//                'date' => date('Y-m-d H:i:s'),
//                '__actions' => ['send_request']
//            ],
//            (object)[
//                'id' => 6,
//                'logo' => '/storage/photos/1/images/bakaibank.png',
//                'bank' => 2,
//                'sum_min' => 350000,
//                'sum_max' => 500000,
//                'currency' => 'KGS',
//                'credit_term' => 1,
//                'percent' => 18.99,
//                'purpose' => 1,
//                'date' => date('Y-m-d H:i:s'),
//                '__actions' => ['send_request']
//            ],
//            (object)[
//                'id' => 7,
//                'logo' => '/storage/photos/1/images/bakaibank.png',
//                'bank' => 2,
//                'sum_min' => 350000,
//                'sum_max' => 500000,
//                'currency' => 'KGS',
//                'credit_term' => 1,
//                'percent' => 18.99,
//                'purpose' => 1,
//                'date' => date('Y-m-d H:i:s'),
//                '__actions' => ['send_request']
//            ],
//            (object)[
//                'id' => 8,
//                'logo' => '/storage/photos/1/images/bakaibank.png',
//                'bank' => 2,
//                'sum_min' => 350000,
//                'sum_max' => 500000,
//                'currency' => 'KGS',
//                'credit_term' => 1,
//                'percent' => 18.99,
//                'purpose' => 1,
//                'date' => date('Y-m-d H:i:s'),
//                '__actions' => ['send_request']
//            ],
//            (object)[
//                'id' => 9,
//                'logo' => '/storage/photos/1/images/kicbbank.png',
//                'bank' => 3,
//                'sum_min' => 350000,
//                'sum_max' => 500000,
//                'currency' => 'KGS',
//                'credit_term' => 1,
//                'percent' => 18.99,
//                'purpose' => 1,
//                'date' => date('Y-m-d H:i:s'),
//                '__actions' => ['send_request']
//            ],
//            (object)[
//                'id' => 10,
//                'logo' => '/storage/photos/1/images/kicbbank.png',
//                'bank' => 3,
//                'sum_min' => 350000,
//                'sum_max' => 500000,
//                'currency' => 'KGS',
//                'credit_term' => 1,
//                'percent' => 18.99,
//                'purpose' => 1,
//                'date' => date('Y-m-d H:i:s'),
//                '__actions' => ['send_request']
//            ],
//            (object)[
//                'id' => 11,
//                'logo' => '/storage/photos/1/images/kicbbank.png',
//                'bank' => 3,
//                'sum_min' => 350000,
//                'sum_max' => 500000,
//                'currency' => 'KGS',
//                'credit_term' => 1,
//                'percent' => 18.99,
//                'purpose' => 1,
//                'date' => date('Y-m-d H:i:s'),
//                '__actions' => ['send_request']
//            ],
//            (object)[
//                'id' => 12,
//                'logo' => '/storage/photos/1/images/kicbbank.png',
//                'bank' => 3,
//                'sum_min' => 350000,
//                'sum_max' => 500000,
//                'currency' => 'KGS',
//                'credit_term' => 1,
//                'percent' => 18.99,
//                'purpose' => 1,
//                'date' => date('Y-m-d H:i:s'),
//                '__actions' => ['send_request']
//            ],
//            (object)[
//                'id' => 13,
//                'logo' => '/storage/photos/1/images/kicbbank.png',
//                'bank' => 3,
//                'sum_min' => 350000,
//                'sum_max' => 500000,
//                'currency' => 'KGS',
//                'credit_term' => 1,
//                'percent' => 18.99,
//                'purpose' => 1,
//                'date' => date('Y-m-d H:i:s'),
//                '__actions' => ['send_request']
//            ],
//            (object)[
//                'id' => 14,
//                'logo' => '/storage/photos/1/images/kicbbank.png',
//                'bank' => 3,
//                'sum_min' => 350000,
//                'sum_max' => 500000,
//                'currency' => 'KGS',
//                'credit_term' => 1,
//                'percent' => 18.99,
//                'purpose' => 1,
//                'date' => date('Y-m-d H:i:s'),
//                '__actions' => ['send_request']
//            ],
//            (object)[
//                'id' => 15,
//                'logo' => '/storage/photos/1/images/kicbbank.png',
//                'bank' => 3,
//                'sum_min' => 350000,
//                'sum_max' => 500000,
//                'currency' => 'KGS',
//                'credit_term' => 1,
//                'percent' => 18.99,
//                'purpose' => 1,
//                'date' => date('Y-m-d H:i:s'),
//                '__actions' => ['send_request']
//            ],
//            (object)[
//                'id' => 16,
//                'logo' => '/storage/photos/1/images/kicbbank.png',
//                'bank' => 3,
//                'sum_min' => 350000,
//                'sum_max' => 500000,
//                'currency' => 'KGS',
//                'credit_term' => 1,
//                'percent' => 18.99,
//                'purpose' => 1,
//                'date' => date('Y-m-d H:i:s'),
//                '__actions' => ['send_request']
//            ],
//            (object)[
//                'id' => 17,
//                'logo' => '/storage/photos/1/images/kicbbank.png',
//                'bank' => 3,
//                'sum_min' => 350000,
//                'sum_max' => 500000,
//                'currency' => 'KGS',
//                'credit_term' => 1,
//                'percent' => 18.99,
//                'purpose' => 1,
//                'date' => date('Y-m-d H:i:s'),
//                '__actions' => ['send_request']
//            ],
//            (object)[
//                'id' => 18,
//                'logo' => '/storage/photos/1/images/kicbbank.png',
//                'bank' => 3,
//                'sum_min' => 350000,
//                'sum_max' => 500000,
//                'currency' => 'KGS',
//                'credit_term' => 1,
//                'percent' => 18.99,
//                'purpose' => 1,
//                'date' => date('Y-m-d H:i:s'),
//                '__actions' => ['send_request']
//            ],
//            (object)[
//                'id' => 19,
//                'logo' => '/storage/photos/1/images/kicbbank.png',
//                'bank' => 3,
//                'sum_min' => 350000,
//                'sum_max' => 500000,
//                'currency' => 'KGS',
//                'credit_term' => 1,
//                'percent' => 18.99,
//                'purpose' => 1,
//                'date' => date('Y-m-d H:i:s'),
//                '__actions' => ['send_request']
//            ],
//            (object)[
//                'id' => 20,
//                'logo' => '/storage/photos/1/images/kicbbank.png',
//                'bank' => 3,
//                'sum_min' => 350000,
//                'sum_max' => 500000,
//                'currency' => 'KGS',
//                'credit_term' => 1,
//                'percent' => 18.99,
//                'purpose' => 1,
//                'date' => date('Y-m-d H:i:s'),
//                '__actions' => ['send_request']
//            ],
//        ];

        $service->actions = [];
        if ($service->type == 'Personal') {
            $service->actions[] = (object)['name' => 'send_request', 'title' => 'Отправить заявку'];
        }


        // filter
        $filtered = [];
        foreach ($service->data as $data) {
            $matched = true;
            foreach ($service->filters as $fkey => &$filter) {
                foreach ($data as $key => $value) {
                    if ($fkey == $key) {
                        $filter = $request->get($key) ?: $filter;
                        if (!empty($filter)) {
                            foreach ($service->fields as $field) {
                                if ($field->name == $fkey) {
                                    if ($field->type == 'select') {
                                        if ($value != $filter)
                                            $matched = false;
                                    } elseif ($field->type == 'date') {
                                        if (date('Y-m-d', strtotime($value)) != date_format(date_create_from_format('d-m-Y', $filter), 'Y-m-d'))
                                            $matched = false;
                                    } elseif ($field->type == 'datetime') {
                                        if (date('Y-m-d H:i:s', strtotime($value)) != date_format(date_create_from_format('d-m-Y H:i', $filter), 'Y-m-d H:i:s'))
                                            $matched = false;
                                    } else {
                                        if (mb_stripos($value, $filter) === false)
                                            $matched = false;
                                    }
                                }
                            }
                        }
                    }
                }
            }
            if ($matched) {
                $filtered[] = $data;
            }
        }

        $service->filters['date_start'] = date('d-m-Y H:i', strtotime($date_start));
        $service->filters['date_end'] = date('d-m-Y H:i', strtotime($date_end));

        $service->pagination = (object)[
            'page' => $request->get('page') ?: 1,
            'per_page' => $request->get('per_page') ?: 10,
            'total' => count($filtered),
        ];

        $service->data = [];

        for ($i = 0; $i < count($filtered); $i++) {
            if (count($service->data) < $service->pagination->per_page)
                $service->data[] = $filtered[$i];
        }

        return view('services.detail', compact('service', 'utype'));
    }

    public function files()
    {
        return view('services.files');
    }

    public function get_services($search = null, $role_type = null, $filterType = null, $filterCategory = null, $filterKind = null)
    {

        $services = self::GetServices($role_type);
        if (!empty($search) || !empty($filterType)) {
            $filtered = [];
            foreach ($services as $service) {
                if (
                    (empty($search) ||
                        mb_stripos($service->name, $search) !== false ||
                        mb_stripos($service->description, $search) !== false
                    ) &&
                    (empty($filterType) || $service->type == $filterType) &&
                    (empty($filterCategory) || $service->category == $filterCategory) &&
                    (empty($filterKind) || $service->kind == $filterKind)
                ) {
                    $filtered[] = $service;
                }
            }
            $services = $filtered;
        }
        return $services;
    }

    public function get_service($id)
    {

        $services = self::GetServices();
//        dd($services);
        $service = null;

        foreach ($services as $s) {
            if ($s->id == $id) {
                $service = $s;
                break;
            }
        }

        return $service;
    }

    public function get_popular_services($count = 8, $role_type = null)
    {
        $services = self::GetServices($role_type);

        return array_slice($services, 0, $count);
    }

    public function get_members($service_id)
    {
        $members = self::GetMembers($service_id);
        return view('layouts.serviceMembers', compact('members'));
    }

    public function create(Request $request, $service_id)
    {
        $service = $this->get_service($service_id);
        return view('services.create', []);
    }

    /**
     * @param array $services = []
     * @return array
     */
    public function get_service_types($services = [])
    {
        $types = [];
        //get types from services
        foreach ($services as $key => $service) {
            if (!array_key_exists($service->type, $types)) {
                $st = $service->type;
                $types[$service->type] = [];

                $servicesByType = array_filter($services, function ($service) use ($st) {
                    return $service->type == $st;
                });
                if (!array_key_exists('count_services', $types[$service->type])) {
                    $types[$service->type]['count_services'] = count($servicesByType);
                }
            }
            if (!array_key_exists($service->category, $types[$service->type])) {
                $sc = $service->category;

                $types[$service->type][$sc] = [];

                $servicesByCategory = array_filter($services, function ($service) use ($sc) {
                    return $service->category == $sc;
                });

                if (!array_key_exists('count_services', $types[$service->type][$sc])) {
                    $types[$service->type][$service->category]['count_services'] = count($servicesByCategory);
                }
            }
            if (!array_key_exists($service->kind, $types[$service->type][$service->category])) {
                $sk = $service->kind;
                $types[$service->type][$service->category][$sk] = [];

                $servicesByKind = array_filter($services, function ($service) use ($sk) {
                    return $service->kind == $sk;
                });

                if (!array_key_exists('count_services', $types[$service->type][$service->category][$sk])) {
                    $types[$service->type][$service->category][$sk]['count_services'] = count($servicesByKind);
                }
            }
        }
        //add type, category and kind names to translation
        if (auth()->check() && auth()->user()->hasRole('admin')) {
            $servicesLangArr = Lang::get('services');
            if (!is_array($servicesLangArr)) {
                $servicesLangArr = [];
            }
            foreach ($types as $type_key => $categories) {
                if (!array_key_exists($type_key, $servicesLangArr)) {
                    $this->translation->addGroupTranslation('en', 'services', $type_key, $type_key);
                    $this->translation->addGroupTranslation('ky', 'services', $type_key, $type_key);
                    $this->translation->addGroupTranslation('ru', 'services', $type_key, $type_key);
                }

                foreach ($categories as $category_key => $kinds) {
                    if ($category_key == 'count_services') {
                        continue;
                    }
                    if (!array_key_exists($category_key, $servicesLangArr)) {
                        $this->translation->addGroupTranslation('en', 'services', $category_key, $category_key);
                        $this->translation->addGroupTranslation('ky', 'services', $category_key, $category_key);
                        $this->translation->addGroupTranslation('ru', 'services', $category_key, $category_key);
                    }
                    foreach ($kinds as $kind_key => $kind) {
                        if ($kind_key == 'count_services' || array_key_exists($kind_key, $servicesLangArr)) {
                            continue;
                        }
                        $this->translation->addGroupTranslation('en', 'services', $kind_key, $kind_key);
                        $this->translation->addGroupTranslation('ky', 'services', $kind_key, $kind_key);
                        $this->translation->addGroupTranslation('ru', 'services', $kind_key, $kind_key);
                    }
                }
            }
        }
        return $types;
    }

    private static function GetRoleType($default = null)
    {
        if (auth()->check()) {
            if (auth()->user()->hasRole('admin'))
                $role_type = null;
            elseif (auth()->user()->user_type == 1)
                $role_type = 'individual';
            else
                $role_type = 'juridical';
        } else {
            $role_type = $default;
        }

        return $role_type;
    }

    public static function GetServices($role_type = null)
    {
        $vtiger = config('vtiger');

        $client = new \GuzzleHttp\Client();

        try {
            $response = $client->post($vtiger['url'], [
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                    'Accept' => 'application/json',
                    'Access-Key' => $vtiger['access_key']
                ],
                'form_params' => [
                        'username' => $vtiger['username'],
                        'operation' => 'GetServices',
                        'role_type' => self::GetRoleType($role_type),
                    ] + (auth()->check() ? [
                        'user_id' => auth()->user()->sbk_user_id
                    ] : []),
                'connect_timeout' => 15,
                'timeout' => 30
            ]);
        } catch (\Exception $exception){
//            abort(503);
            return [];
        }

        if ($response->getStatusCode() != 200) {
            return [];
        }

        $services = json_decode($response->getBody(), true);

        if (!$services['success'])
            return [];

        $result = [];
        foreach ($services['result'] as $service) {
            $item = (object)[
                'id' => $service['service_id'],
                'name' => $service['service_name'],
                'type' => $service['type'],
                'category' => $service['category'],
                'kind' => $service['kind'],
                'subkind' => $service['subkind'],
                'description' => $service['description'],
                'icon' => $service['icon_name'], // 'fas fa-archive',
                'date_start' => $service['valid_from_date'],
                'date_end' => $service['valid_until_date'],
                'texts' => [],
                'numbers' => [],
                'dates' => [],
                'nested_data' => [],
            ];
            for ($i = 0; in_array("text_" . ($i + 3), array_keys($service)); $i += 3) {
                if (!empty($service["text_" . ($i + 3)])) {
                    list($key, $value) = self::parseText($i, $service);
                    $item->texts[$key] = $value;
                }
            }
            for ($i = 1; in_array("number_$i", array_keys($service)); $i++) {
                if (!empty($service["number_$i"])) {
                    list($key, $value) = self::parseNumber($i, $service);
                    $item->numbers[$key] = $value;
                }
            }
            for ($i = 1; in_array("date_$i", array_keys($service)); $i++) {
                if (!empty($service["date_$i"])) {
                    list($key, $value) = self::parseDate($i, $service);
                    $item->dates[$key] = $value;
                }
            }
            if (isset($service['nested_data'])) {
                foreach ($service['nested_data'] as $data) {
                    $nested_item = (object)[
                        'id' => $data['id'],
                        'subject' => $data['subject'],
                        'texts' => [],
                        'numbers' => [],
                        'dates' => [],
                    ];

                    for ($i = 0; in_array("text_" . ($i + 3), array_keys($data)); $i += 3) {
                        if (!empty($data["text_" . ($i + 3)])) {
                            list($key, $value) = self::parseText($i, $data);
                            $nested_item->texts[$key] = $value;
                        }
                    }
                    for ($i = 1; in_array("number_$i", array_keys($data)); $i++) {
                        if (!empty($data["number_$i"])) {
                            list($key, $value) = self::parseNumber($i, $data);
                            $nested_item->numbers[$key] = $value;
                        }
                    }
                    for ($i = 1; in_array("date_$i", array_keys($data)); $i++) {
                        if (!empty($data["date_$i"])) {
                            list($key, $value) = self::parseDate($i, $data);
                            $nested_item->dates[$key] = $value;
                        }
                    }

                    $item->nested_data[] = $nested_item;
                }
            }

            $result[] = $item;
        }
        return $result;
    }

    private static function parseText($i, $data): array
    {
        switch (app()->getLocale()) {
            case 'ru':
                if (preg_match_all('/^(ru:)?(.+?)(kg:|en:|\r?\n|$)/uim', $data["text_" . ($i + 1)], $matches))
                    return ["text_" . ($i + 1), trim($matches[2][0])];
                else
                    return ["text_" . ($i + 1), trim($data["text_" . ($i + 1)])];
            case 'ky':
                if (preg_match_all('/^(ru:)?(.+?)(kg:|en:|\r?\n|$)/uim', $data["text_" . ($i + 2)], $matches))
                    return ["text_" . ($i + 2), trim($matches[2][0])];
                else
                    return ["text_" . ($i + 2), trim($data["text_" . ($i + 2)])];
            case 'en':
                if (preg_match_all('/^(ru:)?(.+?)(kg:|en:|\r?\n|$)/uim', $data["text_" . ($i + 3)], $matches))
                    return ["text_" . ($i + 3), trim($matches[2][0])];
                else
                    return ["text_" . ($i + 3), trim($data["text_" . ($i + 3)])];
            default:
                return ["text_" . ($i + 1), trim($data["text_" . ($i + 1)])];
        }
    }

    private static function parseNumber($i, $data): array
    {
        switch (app()->getLocale()) {
            case 'ru':
                if (preg_match_all('/^(ru:)?(.+?)(kg:|en:|\r?\n|$)/uim', $data["number_$i"], $matches))
                    return ["number_$i", trim($matches[2][0])];
                else
                    return ["number_$i", trim($data["number_$i"])];
            case 'ky':
                if (preg_match_all('/^(kg:)(.+?)(ru:|en:|\r?\n|$)/uim', $data["number_$i"], $matches))
                    return ["number_$i", trim($matches[2][0])];
                else
                    return ["number_$i", trim($data["number_$i"])];
            case 'en':
                if (preg_match_all('/^(en:)(.+?)(ru:|kg:|\r?\n|$)/uim', $data["number_$i"], $matches))
                    return ["number_$i", trim($matches[2][0])];
                else
                    return ["number_$i", trim($data["number_$i"])];
            default:
                return ["number_$i", trim($data["number_$i"])];
        }
    }

    private static function parseDate($i, $data): array
    {
        switch (app()->getLocale()) {
            case 'ru':
                if (preg_match_all('/^(ru:)?(.+?)(kg:|en:|\r?\n|$)/uim', $data["date_$i"], $matches))
                    return ["date_$i", trim($matches[2][0])];
                else
                    return ["date_$i", trim($data["date_$i"])];
            case 'ky':
                if (preg_match_all('/^(kg:)(.+?)(ru:|en:|\r?\n|$)/uim', $data["date_$i"], $matches))
                    return ["date_$i", trim($matches[2][0])];
                else
                    return ["date_$i", trim($data["date_$i"])];
            case 'en':
                if (preg_match_all('/^(en:)(.+?)(ru:|kg:|\r?\n|$)/uim', $data["date_$i"], $matches))
                    return ["date_$i", trim($matches[2][0])];
                else
                    return ["date_$i", trim($data["date_$i"])];
            default:
                return ["date_$i", trim($data["date_$i"])];
        }
    }

    public static function GetMembers($service_id)
    {
        $vtiger = config('vtiger');

        $client = new \GuzzleHttp\Client();
        $response = $client->post($vtiger['url'], [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Accept' => 'application/json',
                'Access-Key' => $vtiger['access_key']
            ],
            'form_params' => [
                    'username' => $vtiger['username'],
                    'operation' => 'GetMembers',
                    'service_id' => $service_id,
                ] + (auth()->check() ? [
                    'user_id' => auth()->user()->sbk_user_id
                ] : [])
        ]);

        if ($response->getStatusCode() != 200) {
            return [];
        }

        $members = json_decode($response->getBody(), true);

        if (!$members['success'] || empty($members['result']))
            return [];

        $result = [];

        foreach ($members['result'] as $member) {
            $item = (object)[
                'id' => $member['member_id'],
                'name' => $member['member_name'],
                'active' => $member['status'] == 'Active',
                'image' => !empty($member['icon_link']) ? $member['icon_link'] : '/storage/photos/5/images/org.jpg'
            ];
            $result[] = $item;
        }

        return $result;
    }

    public static function GetData($service, $date_start = null, $date_end = null)
    {
        $vtiger = config('vtiger');

        $client = new \GuzzleHttp\Client();
        $response = $client->post($vtiger['url'], [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Accept' => 'application/json',
                'Access-Key' => $vtiger['access_key']
            ],
            'form_params' => [
                    'username' => $vtiger['username'],
                    'operation' => 'GetData',
                    'service_id' => $service->id,
                    'date_from' => $date_start ?: date('Y-m-d', strtotime('today -7 day')),
                    'date_until' => $date_end ?: date('Y-m-d'),
                ] + (auth()->check() ? [
                    'user_id' => auth()->user()->sbk_user_id
                ] : [])
        ]);

        if ($response->getStatusCode() != 200) {
            return [];
        }

        $detail = json_decode($response->getBody(), true);

        if (!$detail['success'] || !is_array($detail['result']))
            return [];

        $result = [];

        function setData(object $item, object $service, array $data)
        {
            foreach ($service->texts as $field => $label) {
                $item->texts[$field] = $data[$field];
            }
            foreach ($service->numbers as $field => $label) {
                $item->numbers[$field] = $data[$field];
            }
            foreach ($service->dates as $field => $label) {
                $item->dates[$field] = $data[$field];
            }
        }

        foreach ($detail['result'] as $data) {
            $item = (object)[
                'id' => $data['message_id'],
                'member_id' => $data['member_id'],
                'member_name' => $data['member_name'],
                'status' => $data['status'],
                'state' => $data['state'],
                'date_start' => $data['valid_from_date'],
                'date_end' => $data['valid_until_date'],
                'texts' => [],
                'numbers' => [],
                'dates' => [],
                'nested_data' => []
            ];

            setData($item, $service, $data);

            foreach ($service->nested_data as $i => $service_nested_data) {
                if (isset($data['nested_data'][$i])) {
                    $nested_data = $data['nested_data'][$i];
                    $nested_item = (object)[
                        'id' => $nested_data['id'],
                        'subject' => $nested_data['subject'],
                        'texts' => [],
                        'numbers' => [],
                        'dates' => [],
                    ];

                    setData($nested_item, $service_nested_data, $nested_data);

                    $item->nested_data[$i] = $nested_item;
                }
            }

            $result[] = $item;
        }

        return $result;
    }

    public function paginate($items, $perPage = 10, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
