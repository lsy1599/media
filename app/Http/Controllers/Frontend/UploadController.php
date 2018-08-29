<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\Frontend\UploadImageRequest;

class UploadController extends BaseController
{

    public function imageHandler(UploadImageRequest $request)
    {
        [$path, $url] = $request->filldata();
        return $this->success('', $url);
    }

}
