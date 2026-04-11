<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactRequest;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    public function index()
    {
        return view('public.contact');
    }

    public function store(StoreContactRequest $request)
    {
        ContactMessage::create($request->validated());

        $referer = url()->previous();

        // Nếu submit từ trang chủ → redirect về home với anchor #contact
        if (str_contains($referer, route('home'))) {
            return redirect(route('home') . '#contact')->with('success', 'Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi sớm nhất có thể.');
        }

        // Trang liên hệ → redirect về trang liên hệ
        return redirect()->route('contact.index')->with('success', 'Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi sớm nhất có thể.');
    }
}
