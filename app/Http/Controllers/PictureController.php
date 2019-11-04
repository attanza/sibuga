<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePicture;
use App\Http\Requests\UpdatePicture;
use App\Traits\DbTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;

class PictureController extends Controller
{
    use DbTrait;

    protected $searchable = ['url'];

    public function list(Request $request)
    {
        return $this->getPaginated($request, 'Picture', $this->searchable);
    }

    public function store(StorePicture $request)
    {
        $body = $request->only(['pictureable_id', 'pictureable_type']);
        $file = $request->file('file');
        $lowerCasePluralModelName = strtolower(Str::plural($body['pictureable_type']));
        $folder = 'app/public/'.$lowerCasePluralModelName.'/';
        $mainFileName = time().'.'.$file->getClientOriginalExtension();
        if (!file_exists(storage_path($folder))) {
            mkdir(storage_path($folder), 0755, true);
        }

        Image::make($file)->resize(400, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save(storage_path($folder).$mainFileName);

        $request->merge([
            'url' => $lowerCasePluralModelName.'/'.$mainFileName,
            'pictureable_type' => $this->getModel($request->pictureable_type),
        ]);
        $data = $this->dbStore($request, 'Picture');
        return $data;
    }

    public function update(UpdatePicture $request, $id)
    {
        $data = $this->dbUpdate($request, $id, 'Picture');
        return $data;
    }

    public function destroy($id)
    {
        $data = $this->dbDelete($id, 'Picture');
        $originalUrl = explode("storage/", $data->url);
        if (file_exists(storage_path('app/public/'.$originalUrl[1]))) {
            unlink(storage_path('app/public/'.$originalUrl[1]));
        }
        return ['message' => 'Picture deleted'];
    }
}
