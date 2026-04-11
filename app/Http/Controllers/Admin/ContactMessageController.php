<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;

class ContactMessageController extends Controller
{
    public function index()
    {
        $q      = request('q');
        $status = request('status');

        $messages = ContactMessage::when($q, fn($query) =>
                        $query->where('name', 'like', "%{$q}%")
                              ->orWhere('email', 'like', "%{$q}%")
                              ->orWhere('subject', 'like', "%{$q}%"))
                    ->when($status === 'unread', fn($query) => $query->where('is_read', false))
                    ->when($status === 'read', fn($query) => $query->where('is_read', true))
                    ->orderBy('created_at', 'desc')
                    ->paginate(20)
                    ->withQueryString();

        return view('admin.contact-messages.index', compact('messages'));
    }

    public function show(ContactMessage $contactMessage)
    {
        $contactMessage->update(['is_read' => true]);
        return view('admin.contact-messages.show', compact('contactMessage'));
    }

    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();
        return redirect()->route('admin.contact-messages.index')->with('success', 'Tin nhắn đã được xóa thành công.');
    }
}
