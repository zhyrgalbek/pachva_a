<?php


namespace App\Http\Controllers;


use App\Models\Application;
use App\Models\LogActivity;
use App\Services\ApplicationService;
use App\VtigerAPIs\ApplicationApi;
use App\VtigerAPIs\ServiceApi;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

class ApplicationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $applicationService;

    public function __construct(ApplicationService $applicationService)
    {
        $this->applicationService = $applicationService;
    }

    public function create(Request $request, $service_id)
    {
        $result = $this->applicationService->create($service_id);
        if ($result['status'] == 'success') {
            return view('applications.create',
                [
                    'service' => $result['data'],
                    'member_id' => $request->input('member_id'),
                ]);
        } else {
            return redirect()->back()->withErrors(['error' => $result['error']]);
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
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
//        if (auth()->check()) {
//            $applications = Application::where('user_id', auth()->user()->id)->orderBy('id', 'DESC')->paginate(10);
//        } else {
//            $applications = [];
//        }
        $applications = $this->applicationService->getUserApplications();
        Session::put('page', isset($_GET['page']) ? $_GET['page'] : 1);
//        $applications = $this->paginate($applications, 10, null, ['path' => '/applications']);

        return view('applications.index', compact('applications'));
    }

    public function paginate($items, $perPage = 10, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required|numeric|min:1',
            'service_id' => 'required|numeric|min:1',
            'service_name' => 'required|string|max:255',
            'data' => 'required|array',
            'data.*' => 'required|array|max:255',
            'details' => 'nullable|array',
            'details.*' => 'required_with:details|array'
        ]);
        $data = $request->all();
        $result = $this->applicationService->store($data);
        if ($result['status'] == 'success') {
            return redirect()->route('services.detail', $request->service_id)
                ->with('success', 'Application created successfully.');
        } else {
            return redirect()->back()->withErrors(['error' => $result['error']]);
        }
    }

    public function showByQrCode($code)
    {

        $application = Application::where('code', $code)->first();
        if ($application) {
            $pdf = $this->applicationService->showByCode($application);
            return $pdf->stream("dompdf_out.pdf", array("Attachment" => false));
        } else {
            abort(404);
        }
    }
}
