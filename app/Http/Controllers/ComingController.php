<?php

namespace App\Http\Controllers;

use App\Models\Coming;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ComingController extends Controller
{
    public function editComing(Request $request)
    {
        $currentImage=Coming::first();
        $fields = $request->validate([
        'image' => 'image|mimes:jpeg,png,jpg,webp|max:2048|dimensions:width=700,height=380',

]);
        if($request['image']) {
            if ($currentImage->image && Storage::exists('banners/' . $currentImage->image)) {
                Storage::delete('comingSoon/' . $currentImage->image);
            }
            $image=$request->file('image');
            $customName='ComingSoon-'.Str::uuid().'.'.$image->getClientOriginalExtension();
            $image->storeAs('comingSoon', $customName);
            $fields['image']=$customName;
        }
        $currentImage->update($fields);
        return redirect('/admin/comingSoon')->with('message', 'Image Updated Successfully');
   
    }

}