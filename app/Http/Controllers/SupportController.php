<?php

namespace App\Http\Controllers;

use App\Http\Requests\Support\StoreSupportRequest;
use App\Http\Requests\Support\UpdateSupportRequest;
use App\Models\Category;
use App\Models\Image;
use App\Models\Support;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class SupportController extends Controller
{
    public function index(){
        $supports = Support::orderBy('created_at', 'DESC')->get();
        return view('tech_supports.index' , compact('supports'));
    }
    public function create(){
        $categories = Category::where('disabled',0)->get();
        return view('tech_supports.create',compact('categories'));
    }

    public function show($id){
        $support = Support::findOrFail($id);
        return view('tech_supports.show',compact('support'));
    }

    public function store(StoreSupportRequest $request){
        //dd($request->images);
        $validated_date = $request->validated();
        DB::beginTransaction();
        $support = Support::create(Arr::except($validated_date, ['images']));
        if ($request->hasFile('images')) {
            //dd('hello');
            foreach ($request->file('images') as $image) {
                $image_data = self::uploadFileTo($image, 'supports');
                $image = Image::create([
                    'image_path' => $image_data["media_path"],
                ]);
                $support->images()->save($image);
            }
        }
        Mail::send('emails.tech_support', ['support' => $support], function($message) {
            $message->to('rola.r@appagroup.net')
                ->subject('New Tech Support Needed!');
        });
        DB::commit();
        return redirect(route('tech-supports.create'))->with('message', 'Submitted!');
    }

    public function edit($id){
        $support = Support::findOrFail($id);
        return view('tech_supports.edit',compact('support'));
    }

    public function update(UpdateSupportRequest $request,$id){
        $support = Support::findOrFail($id);
        $validated_date = $request->validated();
        $support->update($validated_date);
        return redirect(route('tech-supports.index'))->with('message', 'Updated!');;
    }


    public static function uploadFileTo($file,$path)
    {

        $file_path = Storage::disk('public_images')->put($path, $file);

        return [
            'media_path' => $file_path,
            'media_url' => self::getMediaUrl($file_path)
        ];


    }

    public static function getMediaUrl($path)
    {
        return url('/uploads/'.$path);
    }

}
