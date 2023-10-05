<?php

namespace App\Traits;

use App\Models\Image;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait UploadTrait
{
    public function verifyAndStoreImage(Request $request, $inputname, $foldername, $disk, $imageable_id, $imageable_type)
    {

        if ($request->hasFile($inputname)) {

            // Check img
            if (!$request->file($inputname)->isValid()) {
                return redirect()->back()->error()->important();
            }

            $photo = $request->file($inputname);
            $name = Str::slug($request->input('name'));
            $filename = $name . '.' . $photo->getClientOriginalExtension();


            // insert Image
            $Image = new Image();
            $Image->filename = $filename;
            $Image->imageable_id = $imageable_id;
            $Image->imageable_type = $imageable_type;
            $Image->save();
            return $request->file($inputname)->storeAs($foldername, $filename, $disk);
        }

        return null;
    }
    public function Delete($disk, $path, $id, $filename)
    {
        Storage::disk($disk)->delete($path);
        image::where('imageable_id', $id)->delete();
    }
    public function verifyAndStoreImageForeach($varforeach, $foldername, $subfolder, $disk, $imageable_id, $imageable_type)
{
    Image::create([
        'filename' => $varforeach->getClientOriginalName(),
        'imageable_id' => $imageable_id,
        'imageable_type' => $imageable_type,
    ]);

    $path = $foldername . '/' . $subfolder; // تكوين المسار النهائي للملف
    return $varforeach->storeAs($path, $varforeach->getClientOriginalName(), $disk);
}
}
