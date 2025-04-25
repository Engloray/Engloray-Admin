<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Dashboard Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
            <div>
                <h1 class="text-3xl font-bold text-indigo-700">Engloray Admin Panel</h1>
                <p class="text-sm text-gray-500">Manage and view all contact form submissions here.</p>
            </div>
            <div class="flex items-center gap-4">
                <span class="text-sm text-gray-700">Welcome, <span class="font-bold text-lg text-indigo-700">{{ ucfirst(auth()->user()->name) }}</span></span>
                <a href="{{ route('admin.logout') }}" class="text-sm text-red-600 hover:underline">Logout</a>
            </div>
        </div>

        <!-- Search Box -->
        <div class="relative mb-6">
            <input type="text" id="search" class="w-full pl-10 pr-4 py-3 rounded-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm" placeholder="Search contacts by name, email, or phone..."  value="{{ @$_GET['query'] }}"/>
            <div class="absolute left-3 top-3.5 text-gray-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z"/>
                </svg>
            </div>
        </div>

        <!-- Contact Table -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto text-sm text-left text-gray-700">
                    <thead class="bg-indigo-600 text-white sticky top-0 z-10">
                        <tr>
                            <th class="px-6 py-3">S.No</th>
                            <th class="px-6 py-3">Name</th>
                            <th class="px-6 py-3">Email</th>
                            <th class="px-6 py-3">Phone No</th>
                            <th class="px-6 py-3">Message</th>
                            <th class="px-6 py-3">Submitted At</th>
                        </tr>
                    </thead>
                    <tbody id="contactTable" class="divide-y divide-gray-200">
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- AJAX Search Script -->
    <script>
    function fetchContacts(query = '', page = 1) {
        $.ajax({
            url: '{{ route("admin.searchContacts") }}',
            method: 'GET',
            data: { query: query, page: page },
            success: function(response) {
                $('#contactTable').html(response);
            }
        });
    }

    $(document).ready(function() {
        let searchTimeout;

        $('#search').on('input', function() {
            clearTimeout(searchTimeout);
            const query = $(this).val();
            searchTimeout = setTimeout(() => {
                fetchContacts(query);
            }, 300);
        });

        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            const page = $(this).attr('href').split('page=')[1];
            const query = $('#search').val();
            fetchContacts(query, page);
        });
    });
</script>


</body>
</html>
