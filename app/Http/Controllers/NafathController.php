<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NafathController extends Controller
{
    /**
     * عرض صفحة نفاذ (محاكاة).
     */
    public function show()
    {
        return view('amrtm.auth.nafath');
    }

    /**
     * إرسال طلب التحقق إلى نفاذ (محاكاة).
     */
    
    public function verify(Request $request)
{
    $request->validate([
        'national_id' => 'required|digits:10',
    ]);

    session([
        'nafath_request' => [
            'national_id'  => $request->national_id,
            'verification' => rand(100,999),
            'status'       => 'PENDING',
            'transaction'  => (string) \Illuminate\Support\Str::uuid(),
        ]
    ]);

    return redirect()->route('amrtm.nafath.wait');
}

public function wait()
{
    if(!session()->has('nafath_request')){
        return redirect()->route('amrtm.nafath.show');
    }

    return view('amrtm.auth.nafath-wait',[
        'nafath'=>session('nafath_request')
    ]);
}

    /**
     * استقبال نتيجة التحقق من نفاذ.
     */
   public function callback(Request $request)
{
    $status = $request->status;

    if (!$status) {
        return redirect()->route('amrtm.nafath.show');
    }

    switch ($status) {

        case 'approved':

            return "✅ تمت الموافقة - هنا سنسجل دخول المستخدم.";

        case 'rejected':

            return "❌ المستخدم رفض الطلب.";

        case 'expired':

            return "⏰ انتهت مهلة التحقق.";

        default:

            return redirect()->route('amrtm.nafath.show');
    }
}
}

