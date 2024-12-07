<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function index()
    {
        $media = Media::latest()->get();
        return view('admin.media.index', compact('media'));
    }

    public function create()
    {
        return view('admin.media.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpeg,png,jpg,gif,mp4,mkv,pdf,doc,docx|max:10240',
        ]);

        $file = $request->file('file');
        $path = $file->store('media', 'public');

        Media::create([
            'name' => $file->getClientOriginalName(),
            'file_path' => 'storage/' . $path,
            'type' => $file->extension(),
            'mime_type' => $file->getMimeType(),
            'size' => $file->getSize(),
        ]);

        return redirect()->route('admin.media.index')->with('success', 'File uploaded successfully!');
    }

    public function destroy(Media $media)
    {
        if (Storage::disk('public')->exists(str_replace('storage/', '', $media->file_path))) {
            Storage::disk('public')->delete(str_replace('storage/', '', $media->file_path));
        }

        $media->delete();
        return redirect()->route('admin.media.index')->with('success', 'File deleted successfully!');
    }
}
