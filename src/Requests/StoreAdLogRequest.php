<?php

namespace Qihucms\SiteAd\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdLogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'site_ad_id' => ['required', 'exists:site_ads,id'],
            'province' => ['max:55'],
            'city' => ['max:55'],
            'district' => ['max:55'],
            'device' => ['max:55'],
            'browse' => ['max:55'],
            'system' => ['max:55'],
            'net_type' => ['max:10'],
        ];
    }

    /**
     * @return array
     */
    public function attributes()
    {
        return trans('site-ad::log');
    }
}