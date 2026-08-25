<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AmrtmOfficeRegistrationController extends Controller
{
    /**
     * عرض صفحة تسجيل المنشأة
     */
    public function create()
    {
        return view('update_service.provider-register');
    }

    /**
     * استقبال النموذج - للتجربة فقط
     */
    public function store(Request $request)
    {
        return back()->with(
            'success',
            'تم استقبال البيانات بنجاح للتجربة.'
        );
    }
}