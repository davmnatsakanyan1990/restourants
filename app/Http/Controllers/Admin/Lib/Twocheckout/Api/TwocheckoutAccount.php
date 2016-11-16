<?php
namespace App\Http\Controllers\Admin\Lib\Twocheckout\Api;

use App\Http\Controllers\Admin\Lib\Twocheckout;
use App\Http\Controllers\Admin\Lib\Twocheckout\Api\TwocheckoutApiRequester;
use App\Http\Controllers\Admin\Lib\Twocheckout\Api\TwocheckoutUtil;

class TwocheckoutCompany extends Twocheckout
{

    public static function retrieve()
    {
        $request = new TwocheckoutApiRequester();
        $urlSuffix = '/api/acct/detail_company_info';
        $result = $request->doCall($urlSuffix);
        return TwocheckoutUtil::returnResponse($result);
    }
}

class TwocheckoutContact extends Twocheckout
{

    public static function retrieve()
    {
        $request = new TwocheckoutApiRequester();
        $urlSuffix = '/api/acct/detail_contact_info';
        $result = $request->doCall($urlSuffix);
        return TwocheckoutUtil::returnResponse($result);
    }
}