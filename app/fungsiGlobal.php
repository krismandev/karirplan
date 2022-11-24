<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/*Untuk custom pagination*/
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
/*Untuk custom pagination*/

/* Untuk decrypt/encrypt + Custom Error */
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
/* Untuk decrypt/encrypt + Custom Error */

/* Untuk Manajemen Akun */
use Illuminate\Support\Facades\Auth;
use App\User;
/* Untuk Manajemen Akun */

class fungsiGlobal extends Model
{
     public static function customPaginate($collection, $perPage, $pageName = 'page', $fragment = null) {
	    $currentPage = \Illuminate\Pagination\LengthAwarePaginator::resolveCurrentPage($pageName);
	    $currentPageItems = $collection->slice(($currentPage - 1) * $perPage, $perPage);
	    parse_str(request()->getQueryString(), $query);
	    unset($query[$pageName]);
	    $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
	        $currentPageItems,
	        $collection->count(),
	        $perPage,
	        $currentPage,
	        [
	            'pageName' => $pageName,
	            'path' => \Illuminate\Pagination\LengthAwarePaginator::resolveCurrentPath(),
	            'query' => $query,
	            'fragment' => $fragment
	        ]
	    );

	    return $paginator;
	}

	public static function decrypt($data) {
		try {
    		$data = Crypt::decrypt($data);
    		return $data;
    	} catch (DecryptException $e) {
    		return false;
    	};
	}

	public static function encrypt($data) {
		$data = Crypt::encrypt($data);
		return $data;
	}
}
