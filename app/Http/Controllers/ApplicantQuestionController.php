<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplicantQuestion\StoreRequest;
use App\Http\Resources\ApplicantQuestionResource;
use App\Models\ApplicantQuestion;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ApplicantQuestionController extends Controller
{
    public function index(Request $request)
    {
        $applicantQuestions = ApplicantQuestionResource::collection(ApplicantQuestion::query()
            ->when(request()->input('search'), function ($query, $search) {
                $query->whereRaw("LOWER(first_name || ' ' || last_name) LIKE ?", ["%{$search}%"])
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('phone', 'like', "%{$search}%");
            })
            ->orderBy('id', 'desc')
            ->paginate(request()->input('perPage', 9))
            ->withQueryString());
        $filters = request()->input('search');

        return Inertia::render('AdminPanel/ApplicantQuestion/Index', compact('applicantQuestions', 'filters'));
    }

    public function create()
    {
        return Inertia::render('AdminPanel/ApplicantQuestion/Create');
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        ApplicantQuestion::create($data);

        return redirect()->route('admin.applicantQuestion.index');
    }
}
