<?php

namespace App\Http\Controllers\Admin;

use App\Property;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ListingCategory;
use App\City;
use App\PropertyPurpose;
use App\Aminity;
use App\PropertyAminity;
use App\PropertyImage;
use App\PropertyType;
use App\WishList;
use App\NearestLocation;
use App\PropertyReview;
use Str;
use File;
use Image;
use Auth;
use App\Setting;
use App\ManageText;
use App\ValidationText;
use App\PropertyNearestLocation;
use App\NotificationText;
class AdminPropertyController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $properties=Property::where('user_type',1)->orderBy('id','desc')->get();
        $settings=Setting::first();
        $websiteLang=ManageText::all();
        return view('admin.property.index',compact('properties','settings','websiteLang'));
    }


    public function create()
    {
        $propertyTypes=PropertyType::where('status',1)->get();
        $cities=City::where('status',1)->get();
        $purposes=PropertyPurpose::where('status',1)->get();
        $aminities=Aminity::where('status',1)->get();
        $nearest_locatoins=NearestLocation::where('status',1)->get();
        $websiteLang=ManageText::all();
        return view('admin.property.create',compact('propertyTypes','cities','purposes','aminities','nearest_locatoins','websiteLang'));
    }


    public function store(Request $request)
    {

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array(
                'messege'=>env('NOTIFY_TEXT'),
                'alert-type'=>'error'
            );

            return redirect()->back()->with($notification);
        }
        // end
        $valid_lang=ValidationText::all();

        $rules = [
            'title'=>'required|unique:properties',
            'slug'=>'required|unique:properties',
            'property_type'=>'required',
            'city'=>'required',
            'address'=>'required',
            'email'=>'required|email',
            'purpose'=>'required',
            'price'=>'required|numeric',
            'area'=>'required',
            'unit'=>'required',
            'room'=>'required',
            'bedroom'=>'required',
            'bathroom'=>'required',
            'floor'=>'required',
            "banner_image"    => "required|file",
            'thumbnail_image'=>'required|file',
            "slider_images"    => "required",
            'description'=>'required',
            'status'=>'required',
            'featured'=>'required',
            'urgent_property'=>'required',
            "pdf_file" => "mimes:pdf|max:10000"
        ];


        $customMessages = [
            'title.required' => $valid_lang->where('lang_key','title')->first()->custom_text,
            'title.unique' => $valid_lang->where('lang_key','unique_title')->first()->custom_text,
            'slug.required' => $valid_lang->where('lang_key','slug')->first()->custom_text,
            'slug.unique' => $valid_lang->where('lang_key','unique_slug')->first()->custom_text,
            'property_type.required' => $valid_lang->where('lang_key','property_type')->first()->custom_text,
            'city.required' => $valid_lang->where('lang_key','city')->first()->custom_text,
            'address.required' => $valid_lang->where('lang_key','address')->first()->custom_text,
            'email.required' => $valid_lang->where('lang_key','email')->first()->custom_text,
            'purpose.required' => $valid_lang->where('lang_key','purpose')->first()->custom_text,
            'price.required' => $valid_lang->where('lang_key','price')->first()->custom_text,
            'area.required' => $valid_lang->where('lang_key','area')->first()->custom_text,
            'unit.required' => $valid_lang->where('lang_key','unit')->first()->custom_text,
            'room.required' => $valid_lang->where('lang_key','room')->first()->custom_text,
            'bedroom.required' => $valid_lang->where('lang_key','bedroom')->first()->custom_text,
            'floor.required' => $valid_lang->where('lang_key','floor')->first()->custom_text,
            'banner_image.required' => $valid_lang->where('lang_key','banner_img')->first()->custom_text,
            'thumbnail_image.required' => $valid_lang->where('lang_key','thumb_img')->first()->custom_text,
            'slider_images.required' => $valid_lang->where('lang_key','slider_img')->first()->custom_text,
            'description.required' => $valid_lang->where('lang_key','des')->first()->custom_text,
        ];


        $this->validate($request, $rules, $customMessages);

        $video_link='';
        if(preg_match('/https:\/\/www\.youtube\.com\/watch\?v=[^&]+/', $request->video_link)) {
            $video_link=$request->video_link;
        }
        $property=new Property();
        $admin=Auth::guard('admin')->user();
        $property->admin_id=$admin->id;
        $property->title=$request->title;
        $property->slug=$request->slug;
        $property->property_type_id=$request->property_type;
        $property->city_id=$request->city;
        $property->address=$request->address;
        $property->phone=$request->phone;
        $property->email=$request->email;
        $property->website=$request->website;
        $property->property_purpose_id=$request->purpose;
        $property->price=$request->price;
        $property->period=$request->period ? $request->period : null;
        $property->area=$request->area;
        $property->number_of_unit=$request->unit;
        $property->number_of_room=$request->room;
        $property->number_of_bedroom=$request->bedroom;
        $property->number_of_bathroom=$request->bathroom;
        $property->number_of_floor=$request->floor;
        $property->number_of_kitchen=$request->kitchen;
        $property->number_of_parking=$request->parking;
        $property->video_link=$video_link;
        $property->google_map_embed_code=$request->google_map_embed_code;
        $property->description=$request->description;
        $property->status=$request->status;
        $property->is_featured=$request->featured;
        $property->urgent_property=$request->urgent_property;
        $property->top_property=$request->top_property;
        $property->seo_title=$request->seo_title ? $request->seo_title : $request->title;
        $property->seo_description=$request->seo_description ? $request->seo_description : $request->title;


        // pdf file
        if($request->file('pdf_file')){
            $file=$request->pdf_file;
            $file_ext=$file->getClientOriginalExtension();
            $file_name= 'property-file-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$file_ext;
            $file_path=$file_name;
            $file->move(public_path().'/uploads/custom-images/',$file_path);
            $property->file=$file_path;
        }


        //thumbnail image
        if($request->file('thumbnail_image')){
            $thumbnail_image=$request->thumbnail_image;
            $thumbnail_extention=$thumbnail_image->getClientOriginalExtension();
            $thumb_name= 'property-thumb-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$thumbnail_extention;
            $thumb_path='uploads/custom-images/'.$thumb_name;

            Image::make($thumbnail_image)
                ->resize(1300,null,function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path()."/".$thumb_path);
            $property->thumbnail_image=$thumb_path;

        }

        // banner image image
        if($request->file('banner_image')){
            $banner_image=$request->banner_image;
            $banner_ext=$banner_image->getClientOriginalExtension();
            $banner_name= 'listing-banner-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$banner_ext;
            $banner_path='uploads/custom-images/'.$banner_name;
            Image::make($banner_image)
                ->resize(1000,null,function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path()."/".$banner_path);
                $property->banner_image=$banner_path;

        }
        $property->save();
        // property end

        // insert aminity
        if($request->aminities){
            foreach($request->aminities as $amnty){
                $aminity= new PropertyAminity();
                $aminity->property_id=$property->id;
                $aminity->aminity_id=$amnty;
                $aminity->save();
            }
        }

        // insert nearest place
        $exist_location=[];
        if($request->nearest_locations){
            foreach($request->nearest_locations as $index => $location){
                if($location){
                    if($request->distances[$index]){
                        if(!in_array($location, $exist_location)){
                            $nearest_location= new PropertyNearestLocation();
                            $nearest_location->property_id=$property->id;
                            $nearest_location->nearest_location_id=$location;
                            $nearest_location->distance=$request->distances[$index];
                            $nearest_location->save();
                        }
                        $exist_location[]=$location;

                    }
                }
            }
        }

        // slider image
        if($request->file('slider_images')){
            $images=$request->slider_images;
            foreach($images as $image){
                if($image != null){
                    $propertyImage=new PropertyImage();
                    $slider_ext=$image->getClientOriginalExtension();
                    // for small image
                    $slider_image= 'property-slide-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$slider_ext;
                    $slider_path='uploads/custom-images/'.$slider_image;

                    Image::make($image)
                        ->resize(1000,null,function ($constraint) {
                        $constraint->aspectRatio();
                        })->save(public_path()."/".$slider_path);


                    $propertyImage->image=$slider_path;
                    $propertyImage->property_id=$property->id;
                    $propertyImage->save();

                }
            }
        }

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','create')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.property.index')->with($notification);

    }


    public function show(Property $property)
    {
        //
    }


    public function edit(Property $property)
    {
        $propertyTypes=PropertyType::where('status',1)->get();
        $cities=City::where('status',1)->get();
        $purposes=PropertyPurpose::where('status',1)->get();
        $aminities=Aminity::where('status',1)->get();
        $nearest_locatoins=NearestLocation::where('status',1)->get();
        $websiteLang=ManageText::all();
        return view('admin.property.edit',compact('property','propertyTypes','cities','purposes','aminities','nearest_locatoins','websiteLang'));
    }


    public function update(Request $request, Property $property)
    {

        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array(
                'messege'=>env('NOTIFY_TEXT'),
                'alert-type'=>'error'
            );

            return redirect()->back()->with($notification);
        }
        // end



        $valid_lang=ValidationText::all();

        $rules = [
            'title'=>'required|unique:properties,title,'.$property->id,
            'slug'=>'required|unique:properties,slug,'.$property->id,
            'property_type'=>'required',
            'city'=>'required',
            'address'=>'required',
            'email'=>'required|email',
            'purpose'=>'required',
            'price'=>'required|numeric',
            'area'=>'required',
            'unit'=>'required',
            'room'=>'required',
            'bedroom'=>'required',
            'bathroom'=>'required',
            'floor'=>'required',
            'description'=>'required',
            'status'=>'required',
            'featured'=>'required',
            'urgent_property'=>'required',
            "pdf_file" => "mimes:pdf|max:10000"
        ];


        $customMessages = [
            'title.required' => $valid_lang->where('lang_key','title')->first()->custom_text,
            'title.unique' => $valid_lang->where('lang_key','unique_title')->first()->custom_text,
            'slug.required' => $valid_lang->where('lang_key','slug')->first()->custom_text,
            'slug.unique' => $valid_lang->where('lang_key','unique_slug')->first()->custom_text,
            'property_type.required' => $valid_lang->where('lang_key','property_type')->first()->custom_text,
            'city.required' => $valid_lang->where('lang_key','city')->first()->custom_text,
            'address.required' => $valid_lang->where('lang_key','address')->first()->custom_text,
            'email.required' => $valid_lang->where('lang_key','email')->first()->custom_text,
            'purpose.required' => $valid_lang->where('lang_key','purpose')->first()->custom_text,
            'price.required' => $valid_lang->where('lang_key','price')->first()->custom_text,
            'area.required' => $valid_lang->where('lang_key','area')->first()->custom_text,
            'unit.required' => $valid_lang->where('lang_key','unit')->first()->custom_text,
            'room.required' => $valid_lang->where('lang_key','room')->first()->custom_text,
            'bedroom.required' => $valid_lang->where('lang_key','bedroom')->first()->custom_text,
            'floor.required' => $valid_lang->where('lang_key','floor')->first()->custom_text,
            'banner_image.required' => $valid_lang->where('lang_key','banner_img')->first()->custom_text,
            'thumbnail_image.required' => $valid_lang->where('lang_key','thumb_img')->first()->custom_text,
            'slider_images.required' => $valid_lang->where('lang_key','slider_img')->first()->custom_text,
            'description.required' => $valid_lang->where('lang_key','des')->first()->custom_text,
        ];


        $this->validate($request, $rules, $customMessages);



        $video_link='';
        if(preg_match('/https:\/\/www\.youtube\.com\/watch\?v=[^&]+/', $request->video_link)) {
            $video_link=$request->video_link;
        }
        $admin=Auth::guard('admin')->user();
        $property->title=$request->title;
        $property->slug=$request->slug;
        $property->property_type_id=$request->property_type;
        $property->city_id=$request->city;
        $property->address=$request->address;
        $property->phone=$request->phone;
        $property->email=$request->email;
        $property->website=$request->website;
        $property->property_purpose_id=$request->purpose;
        $property->price=$request->price;
        $property->period=$request->period ? $request->period : null;
        $property->area=$request->area;
        $property->number_of_unit=$request->unit;
        $property->number_of_room=$request->room;
        $property->number_of_bedroom=$request->bedroom;
        $property->number_of_bathroom=$request->bathroom;
        $property->number_of_floor=$request->floor;
        $property->number_of_kitchen=$request->kitchen;
        $property->number_of_parking=$request->parking;
        $property->video_link=$video_link;
        $property->google_map_embed_code=$request->google_map_embed_code;
        $property->description=$request->description;
        $property->status=$request->status;
        $property->is_featured=$request->featured;
        $property->urgent_property=$request->urgent_property;
        $property->top_property=$request->top_property;
        $property->seo_title=$request->seo_title ? $request->seo_title : $request->title;
        $property->seo_description=$request->seo_description ? $request->seo_description : $request->title;


        // pdf file
        if($request->file('pdf_file')){
            $file=$request->pdf_file;
            $old_file=$property->file;
            $file_ext=$file->getClientOriginalExtension();
            $file_name= 'property-file-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$file_ext;
            $file_path=$file_name;
            $file->move(public_path().'/uploads/custom-images/',$file_path);
            $property->file=$file_path;
            $property->save();

            if($old_file){
                if(File::exists(public_path().'/'."uploads/custom-images/".$old_file)) unlink(public_path().'/'."uploads/custom-images/".$old_file);
            }

        }


        //thumbnail image
        if($request->file('thumbnail_image')){
            $old_thumbnail=$property->thumbnail_image;
            $thumbnail_image=$request->thumbnail_image;
            $thumbnail_extention=$thumbnail_image->getClientOriginalExtension();
            $thumb_name= 'property-thumb-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$thumbnail_extention;
            $thumb_path='uploads/custom-images/'.$thumb_name;
            Image::make($thumbnail_image)
                ->resize(1300,null,function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path().'/'.$thumb_path);

            $property->thumbnail_image=$thumb_path;
            $property->save();
            if(File::exists(public_path().'/'.$old_thumbnail)) unlink(public_path().'/'.$old_thumbnail);
        }

        // banner image image
        if($request->file('banner_image')){
            $old_banner=$property->banner_image;
            $banner_image=$request->banner_image;
            $banner_ext=$banner_image->getClientOriginalExtension();
            $banner_name= 'listing-banner-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$banner_ext;
            $banner_path='uploads/custom-images/'.$banner_name;

            Image::make($banner_image)
                ->resize(1000,null,function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path().'/'.$banner_path);


            $property->banner_image=$banner_path;
            $property->save();
            if(File::exists(public_path().'/'.$old_banner)) unlink(public_path().'/'.$old_banner);
        }
        $property->save();
        // property end


        // for aminity
        $old_aminities=$property->propertyAminities;
        if($request->aminities){
            foreach($request->aminities as $amnty){
                $aminity= new PropertyAminity();
                $aminity->property_id=$property->id;
                $aminity->aminity_id=$amnty;
                $aminity->save();
            }

            if($old_aminities->count()>0){
                foreach($old_aminities as $old_aminity){
                    $old_aminity->delete();
                }
            }
        }else{
            if($old_aminities->count()>0){
                foreach($old_aminities as $old_aminity){
                    $old_aminity->delete();
                }
            }
        }



        // insert nearest place
        $old_nearest_locations=$property->propertyNearestLocations;
        $exist_location=[];
        $new_nearest_location=false;
        if($request->nearest_locations){
            foreach($request->nearest_locations as $index => $location){
                if($location){
                    if($request->distances[$index]){
                        if(!in_array($location, $exist_location)){
                            $nearest_location= new PropertyNearestLocation();
                            $nearest_location->property_id=$property->id;
                            $nearest_location->nearest_location_id=$location;
                            $nearest_location->distance=$request->distances[$index];
                            $nearest_location->save();
                            $new_nearest_location=true;
                        }
                        $exist_location[]=$location;

                    }
                }
            }

            if($new_nearest_location){
                if($old_nearest_locations->count() > 0){
                    foreach($old_nearest_locations as $old_location){
                        $old_location->delete();
                    }
                }
            }
        }else{
            if($old_nearest_locations->count() > 0){
                foreach($old_nearest_locations as $old_location){
                    $old_location->delete();
                }
            }

        }

        // slider image
        if($request->file('slider_images')){
            $images=$request->slider_images;
            foreach($images as $image){
                if($image != null){
                    $propertyImage=new PropertyImage();
                    $slider_ext=$image->getClientOriginalExtension();
                    // for small image
                    $slider_image= 'property-slide-'.date('Y-m-d-h-i-s-').rand(999,9999).'.'.$slider_ext;
                    $slider_path='uploads/custom-images/'.$slider_image;
                    Image::make($image)
                    ->resize(1000,null,function ($constraint) {
                    $constraint->aspectRatio();
                    })->save(public_path().'/'.$slider_path);

                    $propertyImage->image=$slider_path;
                    $propertyImage->property_id=$property->id;
                    $propertyImage->save();

                }
            }
        }

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','update')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');

        return redirect()->route('admin.property.index')->with($notification);
    }


    public function destroy(Property $property)
    {
        // project demo mode check
        if(env('PROJECT_MODE')==0){
            $notification=array(
                'messege'=>env('NOTIFY_TEXT'),
                'alert-type'=>'error'
            );

            return redirect()->back()->with($notification);
        }
        // end

        $old_thumbnail=$property->thumbnail_image;
        $old_banner=$property->banner_image;
        $old_pdf=$property->file;
        PropertyAminity::where('property_id',$property->id)->delete();
        WishList::where('property_id',$property->id)->delete();
        PropertyReview::where('property_id',$property->id)->delete();
        PropertyNearestLocation::where('property_id',$property->id)->delete();
        foreach($property->propertyImages as $image){
            if(File::exists(public_path().'/'.$image->image)) unlink(public_path().'/'.$image->image);
        }
        PropertyImage::where('property_id',$property->id)->delete();


        if($old_pdf){
            if(File::exists(public_path().'/'.'uploads/custom-images/'.$old_pdf)) unlink(public_path().'/'.'uploads/custom-images/'.$old_pdf);
        }
        if(File::exists(public_path().'/'.$old_thumbnail)) unlink(public_path().'/'.$old_thumbnail);
        if(File::exists(public_path().'/'.$old_banner)) unlink(public_path().'/'.$old_banner);

        $property->delete();
        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','delete')->first()->custom_text;
        $notification=array('messege'=>$notification,'alert-type'=>'success');
        return redirect()->back()->with($notification);

    }


    public function propertySliderImage($id){
        $image=PropertyImage::find($id);
        $old_image=$image->image;
        $image->delete();
        if(File::exists(public_path().'/'.$old_image)) unlink(public_path().'/'.$old_image);

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','delete')->first()->custom_text;

        return response()->json(['success'=>$notification]);
    }

    public function deletePdfFile($id){

        $property=Property::find($id);
        $old_file= $property->file;
        $property->file=null;
        $property->save();
        $old_file= "uploads/custom-images/".$old_file;
        if(File::exists(public_path().'/'.$old_file)) unlink(public_path().'/'.$old_file);

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','delete')->first()->custom_text;

        return response()->json(['success'=>$notification]);
    }

    public function changeStatus($id){
        $property=Property::find($id);
        if($property->status==1){
            $property->status=0;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','inactive')->first()->custom_text;
            $message=$notification;
        }else{
            $property->status=1;
            $notify_lang=NotificationText::all();
            $notification=$notify_lang->where('lang_key','active')->first()->custom_text;
            $message=$notification;
        }
        $property->save();
        return response()->json($message);

    }

    public function existNearestLocation($id){
        $nearest_location=PropertyNearestLocation::find($id);
        $nearest_location->delete();

        $notify_lang=NotificationText::all();
        $notification=$notify_lang->where('lang_key','delete')->first()->custom_text;

        return response()->json(['success'=>$notification]);
    }





    public function agentProperty(){
        $properties=Property::where('user_type',0)->orderBy('id','desc')->get();
        $settings=Setting::first();
        $websiteLang=ManageText::all();
        return view('admin.property.agent-property',compact('properties','settings','websiteLang'));
    }
}
