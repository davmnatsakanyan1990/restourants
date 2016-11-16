<?php
namespace App\Http\Controllers\Admin\Lib\Twocheckout\Api;

use App\Http\Controllers\Admin\Lib\Twocheckout;
use App\Http\Controllers\Admin\Lib\Twocheckout\Api\TwocheckoutApiRequester;
use App\Http\Controllers\Admin\Lib\Twocheckout\Api\TwocheckoutUtil;

class TwocheckoutOption extends Twocheckout
{

    public static function create($params=array())
    {
        $request = new TwocheckoutApiRequester();
        $urlSuffix = '/api/products/create_option';
        $result = $request->doCall($urlSuffix, $params);
        return TwocheckoutUtil::returnResponse($result);
    }

    public static function retrieve($params=array())
    {
        $request = new TwocheckoutApiRequester();
        if(array_key_exists("option_id",$params)) {
            $urlSuffix = '/api/products/detail_option';
        } else {
            $urlSuffix = '/api/products/list_options';
        }
        $result = $request->doCall($urlSuffix, $params);
        return TwocheckoutUtil::returnResponse($result);
    }

    public static function update($params=array())
    {
        $request = new TwocheckoutApiRequester();
        $urlSuffix = '/api/products/update_option';
        $result = $request->doCall($urlSuffix, $params);
        return TwocheckoutUtil::returnResponse($result);
    }

    public static function delete($params=array())
    {
        $request = new TwocheckoutApiRequester();
        $urlSuffix = '/api/products/delete_option';
        $result = $request->doCall($urlSuffix, $params);
        return TwocheckoutUtil::returnResponse($result);
    }

}