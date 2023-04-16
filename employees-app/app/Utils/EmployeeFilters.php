<?php

namespace App\Utils;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeFilters
{
    //The Levenshtein distance is the distance between two words, 
    //i.e., the minimum number of single-character edits required for both the strings/words to match.
    const LEV_DISTANCE = 3;

    public function filterRequest(Request $request)
    {
        $search = $request->query('search');
        $page = $request->query('page');
        $perPage = $request->query('perPage');
        $sortField = $request->query('sortField');
        $sortOrder = $request->query('sortOrder');

        $query = DB::table('employees');

        if($search != '')
        {
            $bindArray = [$search, self::LEV_DISTANCE];
            $query->whereRaw('levenshtein(name, ?) <= ?', $bindArray)
            ->orwhereRaw('levenshtein(patronymic, ?) <= ?', $bindArray)
            ->orwhereRaw('levenshtein(surname, ?) <= ?', $bindArray)
            ->orwhereRaw('levenshtein(position, ?) <= ?', $bindArray);
        }

        if($sortOrder != '' && $sortField != '')
        {
            $query->orderBy($sortField, $sortOrder);
        }

        if($page != '' && $perPage != '')
        {
            return $query->paginate($perPage, ['*'], 'page', $page);
        }

        return $query->get();
    }
}