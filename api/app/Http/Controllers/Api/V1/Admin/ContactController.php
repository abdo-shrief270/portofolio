<?php
namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\ContactSubmissionResource;
use App\Models\ContactSubmission;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = ContactSubmission::with('project')
            ->orderBy('created_at', 'desc')
            ->paginate(request()->get('per_page', 20));

        return ContactSubmissionResource::collection($contacts);
    }

    public function show($id)
    {
        return new ContactSubmissionResource(ContactSubmission::with('project')->findOrFail($id));
    }

    public function updateStatus(Request $request, $id)
    {
        $contact = ContactSubmission::findOrFail($id);
        $validated = $request->validate([
            'status' => 'required|in:new,read,replied,archived',
        ]);

        $contact->update($validated);
        return new ContactSubmissionResource($contact);
    }

    public function reply(Request $request, $id)
    {
        $contact = ContactSubmission::findOrFail($id);
        $validated = $request->validate([
            'message' => 'required|string',
        ]);

        // Placeholder for Mail logic
        $contact->update([
            'reply_message' => $validated['message'],
            'replied_at' => now(),
            'status' => 'replied',
        ]);

        return response()->json(['message' => 'Reply sent (simulated)']);
    }

    public function destroy($id)
    {
        $contact = ContactSubmission::findOrFail($id);
        $contact->delete();

        return response()->json(['message' => 'Contact submission deleted']);
    }
}
