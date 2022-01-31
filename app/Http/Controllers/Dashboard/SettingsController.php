<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingValidation;
use App\Models\Setting;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    public function editShippingMethods ($type)
    {
        if ($type === 'free')
            $shippingMethod = Setting::where('key','free_shipping_label')->first();

        elseif ($type === 'inner')
            $shippingMethod = Setting::where('key','local_label')->first();

        elseif ($type === 'outer')
            $shippingMethod = Setting::where('key','outer_label')->first();

        else 
            $shippingMethod = Setting::where('key','free_shipping_label')->first();

        return view('dashboard.settings.shipping.edit',compact('shippingMethod'));

    }

    public function updateShippingMethods(ShippingValidation $request, $id)
    {    

        try{

            DB::beginTransaction();

            $shipping_method = Setting::find($id);

            $shipping_method->update(['plain_value' => $request->plain_value]);

            $shipping_method->value = $request->value;

            $shipping_method->save();

            DB::commit();

            return redirect()->back()->with(['success' => __('admin/shipping.success')]);

        }catch(Exception $ex){

            return redirect()->back()->with(['error' => __('admin/shipping.error')]);

            DB::rollBack();

        }
       
    }
}