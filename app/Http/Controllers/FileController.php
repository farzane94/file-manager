<?php

namespace App\Http\Controllers;

use App\Http\Repositories\FileRepository;
use App\Http\Requests\FileRequest;
use App\Http\Tools\ITHelper;
use App\Models\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function __construct(private FileRepository $fileRepository)
    {
    }

    public function index(Request $request)
    {

        $files = $this->fileRepository->index($request);

        return view('dashboard', compact('files'));

    }

    public function store(FileRequest $fileRequest)
    {
        $this->fileRepository->store($fileRequest);

        return back()->with('success', ITHelper::FILE_SUBMITTED_SUCCESS);
    }

    public function download(File $file)
    {
        return $this->fileRepository->download($file);

    }

    public function destroy(File $file)
    {
        $this->fileRepository->destroy($file);

        return back()->with('success', ITHelper::FILE_DELETED_SUCCESS);
    }
}
