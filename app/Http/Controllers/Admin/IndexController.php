<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function showConfigurationsPage() {
        return view('admin.configurations',['configuration' => DB::table('configurations')->first()]);
    }

    public function editConfigurations(Request $request) {
        $request->validate([
           'under_price' => 'required|numeric|min:5|max:1000',
           'price_range_max' => 'required|numeric|min:5|max:1000',
        ]);
         
        DB::table('configurations')->update([
            'gifts_under_price' => $request->input('under_price'),
            'price_range' => $request->input('price_range_max'),
        ]);
        session()->flash('complete', 'Your request completed successfully!');
        return back();
    }
}
