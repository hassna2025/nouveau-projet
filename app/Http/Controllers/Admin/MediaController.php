<?php
// app/Http/Controllers/Admin/MediaController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function index($contentId)
    {
        $content = Content::with('media')->findOrFail($contentId);
        return view('admin.media.manage', compact('content'));
    }
    
    public function upload(Request $request, $contentId)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpg,jpeg,png,mp3,mp4',
            'type' => 'required|in:image,audio,video',
            'alt_text' => 'nullable|string',
        ]);
        
        $content = Content::findOrFail($contentId);
        $file = $request->file('file');
        $path = $file->store("media/{$content->id}", 'public');
        
        Media::create([
            'content_id' => $content->id,
            'type' => $request->type,
            'path' => $path,
            'alt_text' => $request->alt_text,
        ]);
        
        return back()->with('success', 'Media uploaded successfully.');
    }
    
    public function destroy($id)
    {
        $media = Media::findOrFail($id);
        Storage::disk('public')->delete($media->path);
        $media->delete();
        
        return back()->with('success', 'Media deleted successfully.');
    }
}