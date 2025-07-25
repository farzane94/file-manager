<x-app-layout>
    <div class="max-w-5xl mx-auto px-6 py-8 text-white">

        <h2 class="text-2xl font-bold mb-6 border-b border-gray-700 pb-2">📁 My File Dashboard</h2>

        @if (session('success'))
            <div class="bg-green-600 text-white px-4 py-2 rounded mb-4 flex items-center justify-between">
                <span>{{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" class="text-sm text-white hover:text-gray-200">✖</button>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-600 text-white px-4 py-2 rounded mb-4">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('files.store') }}" enctype="multipart/form-data" class="mb-6 bg-gray-800 p-4 rounded shadow">
            @csrf
            <div class="flex flex-col md:flex-row items-center gap-4">
                <input type="file" name="file" required class="text-sm text-white">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 transition px-4 py-2 rounded text-white">Upload File</button>
            </div>
        </form>

        <form method="GET" action="{{ route('dashboard') }}" class="mb-6">
            <div class="flex flex-row gap-2 items-center">
                <input type="text" name="search" placeholder="Search by name, format, or size..." class="rounded px-3 py-2 bg-gray-800 text-white border border-gray-600 focus:outline-none focus:border-blue-500 w-full">
                <button type="submit" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">Search</button>
            </div>
        </form>

        <div class="overflow-x-auto bg-gray-900 rounded shadow">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-700 text-gray-100">
                <tr>
                    <th class="px-4 py-2">File name</th>
                    <th class="px-4 py-2">Format</th>
                    <th class="px-4 py-2">Size (KB)</th>
                    <th class="px-4 py-2 text-center">Operation</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($files as $file)
                    <tr class="border-b border-gray-800 hover:bg-gray-800 transition">
                        <td class="px-4 py-2">{{ $file->original_name }}</td>
                        <td class="px-4 py-2">{{ $file->extension }}</td>
                        <td class="px-4 py-2">{{ number_format($file->size / 1024, 2) }}</td>
                        <td class="px-4 py-2 text-center space-x-2">
                            <a href="{{ route('files.download', $file) }}" class="text-blue-400 hover:underline">Download</a>
                            <form method="POST" action="{{ route('files.destroy', $file) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Are you sure you want to delete this file?')" class="text-red-400 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-6 text-gray-400">No files available to display.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
