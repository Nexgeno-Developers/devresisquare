<?php
// app/helpers.php
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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

if (!function_exists('current_user')) {
    /**
     * Get the currently authenticated user.
     *
     * @return \App\Models\User|null
     */
    function current_user()
    {
        return \App\Models\User::find(Auth::id());
    }
}

if (! function_exists('formatDate')) {
    /**
     * Format date to dd/mm/yyyy.
     *
     * @param  string  $date
     * @return string
     */
    function formatDate($date)
    {
        // Check if the date is not null or empty
        if ($date) {
            return \Carbon\Carbon::parse($date)->format('d/m/Y');
        }
        return null; // Return null if no date is provided
    }
}

if (! function_exists('booleanToYesNo')) {
    /**
     * Convert 0 or 1 to 'No' or 'Yes'.
     *
     * @param  int  $value
     * @return string
     */
    function booleanToYesNo($value)
    {
        return $value == 1 ? 'Yes' : 'No';
    }
}

if (! function_exists('jsonDecodeAndPrint')) {
    /**
     * Decode a JSON string and return its values as a string.
     *
     * @param  string  $json
     * @param  string  $separator  The separator between items when printing (default is a comma)
     * @return string
     */
    function jsonDecodeAndPrint($json, $separator = ', ')
    {
        // Decode the JSON string into an array
        $decoded = json_decode($json, true);

        // Check for JSON errors
        if (json_last_error() !== JSON_ERROR_NONE) {
            return "";  // Return error message if decoding fails
        }

        // Return the values as a string with the given separator
        return implode($separator, $decoded);
    }
}

if (!function_exists('todayDate')) {
    /**
     * Get today's date in YYYY-MM-DD format.
     *
     * @return string
     */
    function todayDate()
    {
        return (new \DateTime())->format('Y-m-d');
    }
}

if (!function_exists('tomorrowDate')) {
    /**
     * Get tomorrow's date in YYYY-MM-DD format.
     *
     * @return string
     */
    function tomorrowDate()
    {
        return Carbon::tomorrow()->toDateString();
    }
}

if (!function_exists('convert_to_boolean')) {
    /**
     * Convert 'Yes'/'No' values to boolean true/false.
     *
     * @param string $value
     * @return bool
     */
    function convert_to_boolean($value)
    {
        return strtolower($value) === 'yes' ? true : false;
    }
}
