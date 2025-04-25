@forelse($contacts as $index => $contact)
    <tr class="hover:bg-gray-50 transition-colors duration-150">
        <td class="px-6 py-4">{{ ($contacts->currentPage() - 1) * $contacts->perPage() + $index + 1 }}</td>
        <td class="px-6 py-4">{{ $contact->name }}</td>
        <td class="px-6 py-4">{{ $contact->email }}</td>
        <td class="px-6 py-4">{{ $contact->phone_no }}</td>
        <td class="px-6 py-4 max-w-xs truncate" title="{{ $contact->message }}">{{ Str::limit($contact->message, 50) }}</td>
        <td class="px-6 py-4">{{ $contact->created_at->format('Y-m-d H:i:s') }}</td>
    </tr>
@empty
    <tr>
        <td colspan="6" class="text-center py-6 text-gray-500">No contacts found.</td>
    </tr>
@endforelse
<tr>
    <td colspan="6">
        <div class="flex justify-end m-4">
            {!! $contacts->links() !!}
        </div>
    </td>
</tr>
