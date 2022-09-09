<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Image;
use Carbon\Carbon;

class MediaModel extends Model
{
    public static function uploadMedia($file, $type, $foldername, $ref_id = NULL)
    {

        if ($ref_id == '')
            $ref_id = NULL;

        $foldername = $foldername . '/' . Carbon::now()->format('Y_m');

        $file_name = str_replace(" ", "_", $file->getClientOriginalName());
        if (file_exists(public_path() . '/uploads/' . $foldername . '/' . $file_name)) {
            $file_name = time() . '-' . $file_name;
        } else {
            $file_name = $file_name;
        }

        if (!file_exists('uploads/' . $foldername)) {
            mkdir('uploads/' . $foldername, 0777, true);
        }

        if (Str::contains($file->getClientMimeType(), ['image'])) {
            $img = Image::make($file);
            $img->save('uploads/' . $foldername . '/' . $file_name);

            $medium_path = 'uploads/' . $foldername . '/medium';

            if (!file_exists($medium_path)) {
                mkdir($medium_path, 0777, true);
            }

            $img->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $ImageUpload = $img->save($medium_path = 'uploads/' . $foldername . '/medium' . '/' . $file_name);


        } else {
            $file->move('uploads/' . $foldername, $file_name);
        }


        $product = ProductModel::find($ref_id);

        $product->product_image_url = url('uploads/' . $foldername.'/'.$file_name);
        $product->save();

        return array('success' => true, 'picture_name' => $file_name, 'folder_name' => $foldername, 'media_id' => $product->id);
    }


    public static function setMediaRefID($media_id = NULL, $ref_id = NULL)
    {

        $media = MediaModel::find($media_id);

        if ($media == NULL || $media_id == NULL || $ref_id == NULL)
            return false;

        $media->ref_id = $ref_id;
        $media->save();

        return true;

    }

    public static function setMediaListRefID($media_list, $ref_id = NULL)
    {

        $media_array = explode(",", $media_list);

        foreach ($media_array as $media_id) {
            $media = MediaModel::find($media_id);

            if ($media == NULL || $ref_id == NULL)
                continue;

            $media->ref_id = $ref_id;
            $media->save();
        }
        return true;

    }

    public static function saveMediaOrder($media_order, $type, $ref_id)
    {
        $order = MediaSortModel::where('ref_id', $ref_id)->where('media_type', $type)->first();

        if ($order == NULL)
            $order = new MediaSortModel();
        $order->ref_id = $ref_id;
        $order->media_type = $type;
        $order->image_order = $media_order;
        $order->save();
        return true;
    }


    public static function uploadDataImage($data, $type, $foldername, $ref_id = NULL)
    {

        $file_name = str_random(10) . '.' . 'png';
        $data = str_replace('data:image/png;base64,', '', $data);
        $data = str_replace(' ', '+', $data);

        if (file_exists(config('system.BASE_PATH_LOCAL') . '/public/uploads/' . $foldername . '/' . $file_name)) {
            $file_name = rand(10, 100) . $file_name;
        } else {
            $file_name = $file_name;
        }


        \File::put('public/uploads/' . $foldername . '/' . $file_name, base64_decode($data));


        $media = new MediaModel();
        $media->ref_id = $ref_id;
        $media->folder_name = $foldername;
        $media->file_name = $file_name;
        $media->media_type = $type;
        $media->save();

        return array('status' => 'success', 'picture_name' => $file_name, 'folder_name' => $foldername, 'media_id' => $media->id);
    }


    public static function deleteMediabyId($id)
    {
        $product = ProductModel::find($id);

        $product->product_image_url = "";
        $product->save();

        return true;

    }


    public static function deleteMediabyType($ref_id, $type)
    {
        $medias = MediaModel::where('media_type', $type)->where('ref_id', $ref_id)->get();

        foreach ($medias as $media) {
            File::delete(config('system.BASE_PATH_LOCAL') . '/public/uploads/' . $media->folder_name . '/' . $media->file_name);
            $media->delete();
        }
        return true;
    }


    public static function getMediaByRefID($ref_id, $type = NULL)
    {
        $media = MediaModel::where('ref_id', $ref_id)->where('media_type', $type)->orderBy('created_at', 'desc')->first();

        if (!isset($media))
            return '';
        else {
            return url('uploads/' . $media->folder_name . '/' . $media->file_name);
        }
    }

    public static function getAllMediaByRefID($ref_id, $type = NULL)
    {
        $media = MediaModel::where('ref_id', $ref_id)->where('media_type', $type)->orderBy('created_at', 'desc')->get();
        return $media;
    }


    public static function getMediaOrder($ref_id, $type = NULL)
    {
        $order = MediaSortModel::where('ref_id', $ref_id)->where('media_type', $type)->first();
        if ($order == null)
        {
            $media = MediaModel::where('ref_id', $ref_id)->where('media_type', $type)->orderBy('updated_at','DESC')->first();
        }
        return $order->image_order ?? $media->id ?? '';
    }

    public static function getSortedMediaByRefID($ref_id, $type = null)
    {
        $media = MediaModel::where('ref_id', $ref_id)->where('media_type', $type)->orderBy('created_at', 'desc')->get();

        $media_order = MediaSortModel::where('ref_id', $ref_id)->where('media_type', $type)->first();

        if ($media == NULL || $media_order == NULL)
            return $media;

        $media_order = collect(explode(',', $media_order->image_order));// This is an array of IDs

        if ($media_order != NULL && $media != NULL) {

            $media_order_arr = $media_order->toArray();

            $media_order_arr = array_map('intval', $media_order_arr); //convert string array elements to integer

            $sort_media = $media->sortBy(function ($media) use ($media_order_arr) {

                return array_search($media->id, $media_order_arr);
            });

            return $sort_media;
        } else
            return $media;

    }


    public static function getMainImageByRefID($ref_id, $type = null)
    {

        $media_order = MediaSortModel::where('ref_id', $ref_id)->where('media_type', $type)->first();
        if ($media_order == null)
        {
            $media = MediaModel::where('ref_id', $ref_id)->where('media_type', $type)->orderBy('updated_at','DESC')->first();
        }

        $media_order = collect(explode(',', $media_order->image_order ?? $media->id ?? ''));// This is an array of IDs

        if ($media_order != NULL) {
            return self::getMediaByMediaID($media_order[0]);
        } else {
            return '';
        }

    }

    public static function getMainImageWithFancyboxByRefID($ref_id, $type = null, $size = 200)
    {

        $media_order = MediaSortModel::where('ref_id', $ref_id)->where('media_type', $type)->first();


        if ($media_order != NULL) {
            $media_order = collect(explode(',', $media_order->image_order));// This is an array of IDs
            $media_url = self::getMediaByMediaID($media_order[0], FALSE);
            $medium_url = self::getMediaByMediaID($media_order[0], TRUE);
            return '<a data-fancybox="gallery" href="' . $media_url . '">
                    <img width="' . $size . '" src="' . $medium_url . '"></a>';
        } else {
            return '';
        }

    }


    public static function getMediaByMediaID($id, $size_medium = FALSE)
    {
        $media = MediaModel::find($id);

        if (!$media)
            return '';
        else {
            if ($size_medium == TRUE)
                return url('uploads/' . $media->folder_name . '/medium/' . $media->file_name);
            else
                return url('uploads/' . $media->folder_name . '/' . $media->file_name);
        }
    }


    public function user()
    {
        return $this->hasOne('Admin\User\Models\UserModel', 'id', 'created_by');
    }

    public static function isImage($path)
    {
        $a = getimagesize($path);
        $image_type = $a[2];

        if (in_array($image_type, array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_BMP))) {
            return true;
        }
        return false;
    }

}
