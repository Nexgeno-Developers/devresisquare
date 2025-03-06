<?php
// app/helpers.php
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
        return static_asset('asset/img/placeholder.jpg');
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

        if(env('ENVIRONMENT') == "Production"){
            $root .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
        }

        return $root;
    }
}

if (!function_exists('getFileBaseURL')) {
    function getFileBaseURL()
    {
        if (env('FILESYSTEM_DRIVER') == 's3') {
            return env('AWS_URL') . '/';
        } else {
            return getBaseURL() . '/storage/';
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
            return Carbon::parse($date)->format('d/m/Y');
        }
        return null; // Return null if no date is provided
    }
}

if (! function_exists('formatDateTime')) {
    /**
     * Format date & time to dd/mm/yyyy H:i A.
     *
     * @param  string  $dateTime
     * @return string|null
     */
    function formatDateTime($dateTime)
    {
        // Check if the dateTime is not null or empty
        if ($dateTime) {
            return \Carbon\Carbon::parse($dateTime)->format('d/m/Y h:i A');
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

if (!function_exists('beautify_string')) {
    /**
     * Replace hyphens, underscores, or special characters with spaces and convert to title case.
     *
     * @param string $value
     * @return string
     */
    function beautify_string($value)
    {
        // Replace hyphens and underscores with spaces
        $value = preg_replace('/[-_]+/', ' ', $value);

        // Convert to title case
        return ucwords($value);
    }
}

if (!function_exists('convert_to_uppercase')) {
    /**
     * Convert a string to uppercase.
     *
     * @param string $value
     * @return string
     */
    function convert_to_uppercase($value)
    {
        return strtoupper($value);
    }
}

if (!function_exists('convert_to_lowercase')) {
    /**
     * Convert a string to lowercase.
     *
     * @param string $value
     * @return string
     */
    function convert_to_lowercase($value)
    {
        return strtolower($value);
    }
}

if (!function_exists('capitalize_words')) {
    /**
     * Capitalize the first letter of each word in a string.
     *
     * @param string $value
     * @return string
     */
    function capitalize_words($value)
    {
        return ucwords(strtolower($value));
    }
}

if (!function_exists('capitalize_first_letter')) {
    /**
     * Capitalize the first letter of a string.
     *
     * @param string $value
     * @return string
     */
    function capitalize_first_letter($value)
    {
        return ucfirst(strtolower($value));
    }
}

if (!function_exists('searchProperties')) {

    function searchProperties(Request $request)
    {
        // Check if we are passing specific property IDs
        $ids = $request->input('ids');

        // If IDs are provided, fetch properties by IDs
        if ($ids) {
            $properties = Property::whereIn('id', $ids)
                ->get(['id', 'prop_ref_no', 'prop_name', 'line_1', 'line_2', 'city', 'country', 'postcode', 'specific_property_type', 'available_from']);  // Return only necessary fields
        } else {
            // If no IDs are passed, search properties based on the query (default behavior)
            $query = $request->input('query');
            $properties = Property::where('prop_ref_no', 'LIKE', '%' . $query . '%')
                ->orWhere('prop_name', 'LIKE', '%' . $query . '%')
                ->orWhere('line_1', 'LIKE', '%' . $query . '%')
                ->orWhere('line_2', 'LIKE', '%' . $query . '%')
                ->orWhere('city', 'LIKE', '%' . $query . '%')
                ->orWhere('country', 'LIKE', '%' . $query . '%')
                ->orWhere('postcode', 'LIKE', '%' . $query . '%')
                ->limit(10)
                ->get(['id', 'prop_ref_no', 'prop_name', 'line_1', 'line_2', 'city', 'country', 'postcode', 'specific_property_type', 'available_from']);
        }

        // Return the properties as JSON response
        return response()->json($properties->map(function($property) {
            return [
                'id' => $property->id,
                'address' => trim($property->line_1 . ' ' . $property->line_2 . ', ' . $property->city . ', ' . $property->postcode) ?: 'N/A',
                'type' => trim($property->specific_property_type) ?: 'N/A',
                'availability' => trim($property->available_from) ?: 'N/A',
                'prop_ref_no' => trim($property->prop_ref_no) ?: 'N/A',
                'prop_name' => trim($property->prop_name) ?: 'N/A',
            ];
        }));
    }
}

if (!function_exists('getPropertyDetails')) {
    /**
     * Fetch specific property details by property ID and multiple column names.
     *
     * @param  int   $propertyId
     * @param  array $columns
     * @return string
     */
    function getPropertyDetails($propertyId, $columns = [])
    {
        // Log property_id to confirm it's being passed correctly
        Log::info('Fetching details for Property ID:', ['property_id' => $propertyId]);

        // Find the property by ID
        $property = Property::find($propertyId);

        // Log the property to confirm it was fetched
        Log::info('Property Details:', ['property' => $property]);

        if ($property) {
            // Initialize an empty array to store column values
            $propertyDetails = [];

            // Iterate over the given columns and get their values
            foreach ($columns as $column) {
                // Check if the column exists in the property model
                if (isset($property->$column)) {
                    // If the column exists, add its value to the array
                    $propertyDetails[] = trim($property->$column);
                } else {
                    // Log if the column doesn't exist or is null
                    Log::warning("Column does not exist in the Property model or is null:", ['column' => $column, 'property_id' => $propertyId]);
                }
            }

            // Log the column values before concatenation
            Log::info('Property Details (Trimmed):', ['property_details' => $propertyDetails]);

            // Concatenate the non-empty values with a space
            return implode(', ', array_filter($propertyDetails));
        }

        // If property is not found, log the issue and return a default message
        Log::warning('Property not found for ID:', ['property_id' => $propertyId]);
        return 'Property not found';
    }
}

if (!function_exists('getRepairCategoryDetails')) {
    /**
     * Fetch repair category details by ID.
     *
     * @param int $categoryId
     * @return string
     */
    function getRepairCategoryDetails($categoryId)
    {
        // Log the category ID for debugging
        Log::info('Fetching details for Repair Category ID:', ['category_id' => $categoryId]);

        // Find the repair category
        $category = \App\Models\RepairCategory::find($categoryId);

        // Log the category details
        Log::info('Repair Category Details:', ['category' => $category]);

        // Return the category name or a default message if not found
        if ($category) {
            return $category->name; // Ensure that 'name' is the correct column
        }

        Log::warning('Repair Category not found for ID:', ['category_id' => $categoryId]);
        return 'Category not found';
    }
}

if (!function_exists('getFormattedRepairNavigation')) {
    /**
     * Convert stored repair_navigation (category ids) into human-readable category names.
     *
     * @param string $navigationString
     * @return string
     */
    function getFormattedRepairNavigation($navigationString)
    {
        // Decode the repair_navigation JSON string
        $categories = json_decode($navigationString, true);

        // Initialize an empty array to store category names
        $categoryNames = [];

        // Loop through each level in the decoded categories array
        foreach ($categories as $level => $categoryId) {
            // Fetch the category name by ID
            $category = \App\Models\RepairCategory::find($categoryId);

            // If category exists, append the name; otherwise, append the ID
            if ($category) {
                $categoryNames[] = $category->name;
            } else {
                $categoryNames[] = "Unknown Category (ID: $categoryId)";
            }
        }

        // Join the category names with " > " separator and return
        return implode(' > ', $categoryNames);
    }
}

