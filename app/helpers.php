<?php
// app/helpers.php

if (!function_exists('getPoundSymbol')) {
    function getPoundSymbol()
    {
        return '£';
    }
}

if (!function_exists('uploaded_asset')) {
    function uploaded_asset($id)
    {
        $asset = Cache::rememberForever('uploaded_asset_'.$id , function() use ($id) {
            return \App\Models\Upload::find($id);
        });
        
        if ($asset != null) {
            return $asset->external_link == null ? my_asset($asset->file_name) : $asset->external_link;
        }
        return static_asset('assets/img/placeholder.jpg');
    }
}
if (!function_exists('my_asset')) {
    /**
     * Generate an asset path for the application.
     *
     * @param string $path
     * @param bool|null $secure
     * @return string
     */
    function my_asset($path, $secure = null)
    {
        if (env('FILESYSTEM_DRIVER') == 's3') {
            return Storage::disk('s3')->url($path);
        } else {
            // return app('url')->asset('public/' . $path, $secure);

            if(env('ENVIRONMENT') == "Production"){
                return app('url')->asset('public/' . $path, $secure);
            } else {
                return app('url')->asset('storage/' . $path, $secure);
            }

        }
    }
}

if (!function_exists('static_asset')) {
    /**
     * Generate an asset path for the application.
     *
     * @param string $path
     * @param bool|null $secure
     * @return string
     */
    function static_asset($path, $secure = null)
    {
        // return app('url')->asset('public/' . $path, $secure);

        if(env('ENVIRONMENT') == "Production"){
            return app('url')->asset('public/' . $path, $secure);
        } else {
            return app('url')->asset($path, $secure);
        }

    }
}

if (!function_exists('getBaseURL')) {
    function getBaseURL()
    {
        $root = '//' . $_SERVER['HTTP_HOST'];
        $root .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);

        return $root;
    }
}


if (!function_exists('getFileBaseURL')) {
    function getFileBaseURL()
    {
        if (env('FILESYSTEM_DRIVER') == 's3') {
            return env('AWS_URL') . '/';
        } else {
            return getBaseURL() . 'storage/';
        }
    }
}

