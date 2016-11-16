<?php
namespace App\Http\Controllers\Admin\Lib\Twocheckout\Api;

use App\Http\Controllers\Admin\Lib\Twocheckout;
use App\Http\Controllers\Admin\Lib\Twocheckout\Api\TwocheckoutApiRequester;
use App\Http\Controllers\Admin\Lib\Twocheckout\Api\TwocheckoutUtil;

class TwocheckoutPayment extends Twocheckout
{

    public static function retrieve()
    {
        $request = new TwocheckoutApiRequester();
        $urlSuffix = '/api/acct/list_payments';
        $result = $request->doCall($urlSuffix);
        $response = TwocheckoutUtil::returnResponse($result);
        return $response;
    }

    public static function pending()
    {
        $request = new TwocheckoutApiRequester();
        $urlSuffix = '/api/acct/detail_pending_payment';
        $result = $request->doCall($urlSuffix);
        $response = TwocheckoutUtil::returnResponse($result);
        return $response;
    }

}