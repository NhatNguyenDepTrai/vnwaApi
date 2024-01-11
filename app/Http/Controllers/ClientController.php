<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Brand;
use App\Models\Project;
use App\Models\CategoryProject;
use Illuminate\Auth\Events\Validated;
use Google\Recaptcha\Recaptcha;
class ClientController extends Controller
{
    function getDataCompany()
    {
        return response()->json(Company::find(1));
    }
    function getDataBrands()
    {
        $data = Brand::where('status', 1)
            ->where('highlight', 1)
            ->orderBy('ord', 'ASC')
            ->get();
        return response()->json($data);
    }
    function getDataTopProject()
    {
        $data = Project::where('status', 1)
            ->where('highlight', 1)
            ->orderBy('ord', 'ASC')
            ->get(['name', 'slug', 'id_category_project', 'url_avatar', 'url_avatar_mobile', 'desc']);
        foreach ($data as $key => $value) {
            $value->cate_name = CategoryProject::find($value->id_category_project)->name;
        }
        return response()->json($data);
    }
    function getDataFeedback()
    {
        $data = Project::where('feedback_name', '!=', null)
            ->where('feedback_content', '!=', null)
            ->get(['feedback_name', 'feedback_content']);
        return response()->json($data);
    }
    function submitContact(Request $request)
    {
        $recaptcha = new ReCaptcha(env('RECAPTCHA_SECRET_KEY'));
        $response = $recaptcha->verify($request->input('recaptcha_token'), $request->ip());

        if (!$response->isSuccess()) {
            // Xử lý khi reCAPTCHA không hợp lệ
            return response()->json(['error' => 'reCAPTCHA verification failed'], 422);
        }

        $this->validate(
            $request,
            [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9|max:11',
                'budget' => 'required|max:255',
                'note' => 'max:500',
            ],
            [
                'name.max' => 'Tối đa 255 kí tự!',
                'name.required' => 'Vui lòng nhập tên!',
                'email.required' => 'Vui lòng nhập email!',
                'email.email' => 'Vui lòng nhập đúng định dạng email!',
                'email.max' => 'Tối đa 255 kí tự!',
                'phone.required' => 'Vui lòng nhập số điện thoại!',
                'phone.regex' => 'Vui lòng nhập đúng định dạng số điện thoại!',
                'phone.min' => 'Vui lòng nhập đúng định dạng số điện thoại!',
                'phone.max' => 'Vui lòng nhập đúng định dạng số điện thoại!',
                'budget.required' => 'Vui lòng nhập ngân sách!',
                'budget.max' => 'Tối đa 255 kí tự!',
                'note.max' => 'Tối đa 500 kí tự!',
            ],
        );

        return response()->json($request);
    }
}
