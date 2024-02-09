<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Brand;
use App\Models\Project;
use App\Models\CategoryProject;
use App\Models\ListSlug;
use App\Models\Contact;
use Illuminate\Auth\Events\Validated;
use Mail;
use App\Mail\VerifyContact;
use App\Mail\MailAdminContact;

class ClientController extends Controller
{
    function getDataCompany()
    {
        return response()->json(Company::find(1));
    }
    function getDataBrands()
    {
        try {
            $data = Brand::where('status', 1)
                ->where('highlight', 1)
                ->orderBy('ord', 'ASC')
                ->get();
        } catch (\Throwable $th) {
            return response()->json('error', 'Có lỗi xảy ra');
        }

        return response()->json($data);
    }
    function getDataTopProject()
    {
        try {
            $data = Project::where('status', 1)
                ->where('highlight', 1)
                ->orderBy('ord', 'ASC')
                ->get(['name', 'slug', 'id_category_project', 'url_avatar', 'url_avatar_mobile', 'desc']);
        } catch (\Throwable $th) {
            return response()->json('error', 'Có lỗi xảy ra');
        }
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
        // if (!$request->token) {
        //     return response()->json(['error' => 'reCAPTCHA verification failed'], 422);
        // }

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
        try {
            Contact::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'budget' => $request->budget,
                'note' => $request->note,
            ]);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Có Lỗi Xảy Ra, Vui Lòng Thử Lại'], 200);
        }

        $company = Company::find(1);
        $mailClientData = [
            'title' => 'Xin chào ' . $request->name,
            'mess' => 'Chúng tôi đã nhận được yêu cầu của bạn, chúng tôi sẽ liên hệ lại bạn sau ít phút.',
            'bg_header' => '#999',
            'nameCompany' => $company->short_name,
            'url_avatar' => $company->url_avatar_full,
            'url_website' => $company->website,
            'hotline' => $company->url_avatar_full,
        ];
        Mail::to($request->email)->send(new VerifyContact($mailClientData));

        $mailAdminContactData = [
            'url_avatar' => $company->url_avatar_full,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'budget' => $request->budget,
            'note' => $request->note,
        ];
        Mail::to($company->mail)->send(new MailAdminContact($mailAdminContactData));

        return response()->json(['success' => 'Gửi Liên Hệ Thành Công!'], 200);
    }
    function checkSlugTable($slug)
    {
        $data = ListSlug::where('slug', $slug)->first();
        return response()->json($data);
    }
}
