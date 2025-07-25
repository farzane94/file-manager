<?php

namespace App\Http\Repositories;

use App\Http\Requests\FileRequest;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileRepository
{
    public function index(Request $request)
    {
        $query = File::where('user_id', auth()->id());

        if ($request->has('search')) {
            $query->where('original_name', 'like', '%' . $request->search . '%')
                ->orWhere('extension', 'like', '%' . $request->search . '%')
                ->orWhere('size', '<=', (int)$request->search);
        }

        return $query->latest()->get();
    }

    public function store(FileRequest $fileRequest)
    {
        $userId = auth()->id();
        $uploaded = $fileRequest->file('file');
        $storedName = uniqid() . '.' . $uploaded->getClientOriginalExtension();

        $uploaded->storeAs("files/user_{$userId}", $storedName, 'private');

        File::create([
            'user_id' => auth()->id(),
            'original_name' => $uploaded->getClientOriginalName(),
            'stored_name' => $storedName,
            'extension' => $uploaded->getClientOriginalExtension(),
            'size' => $uploaded->getSize(),
        ]);
    }

    public function download(File $file)
    {
        if ($file->user_id !== auth()->id()) abort(403);
        return Storage::disk('local')->download("files/user_{$file->user_id}/" . $file->stored_name, $file->original_name);
    }

    public function destroy(File $file)
    {
        if ($file->user_id !== auth()->id()) abort(403);
        Storage::disk('local')->delete("files/user_{$file->user_id}/" . $file->stored_name);
        $file->delete();
    }

}
