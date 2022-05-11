<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function general(){
        Gate::authorize('admin.settings.index');
        return view('backend.pages.settings.general');
    }

    public function generalUpdate(Request $request){
        Gate::authorize('admin.settings.index');
        $request->validate([
            'site_title' => 'required|string|min:2|max:255',
            'site_description' => 'nullable|string|min:2|max:255',
            'site_address' => 'nullable|string|min:2|max:255',
        ]);

        Setting::updateOrCreate(['name' => 'site_title'], ['value' => $request->get('site_title')]);
        //update .env
        // Artisan::call("env:set APP_NAME = '" . $request->get('site_title')."'");
        Setting::updateOrCreate(['name' => 'site_description'], ['value' => $request->get('site_description')]);
        Setting::updateOrCreate(['name' => 'site_address'], ['value' => $request->get('site_address')]);
        Toastr::success('Successfully General Settings Updated', '', ["positionClass" => "toast-top-right"]);
        return back();
    }

    public function mail(){
        Gate::authorize('admin.settings.index');
        return view('backend.pages.settings.mail');
    }

    public function mailUpdate(Request $request){
        Gate::authorize('admin.settings.index');
        $request->validate([
            'mail_mailer' => 'string|max:255',
            'mail_host' => 'nullable|string|max:255',
            'mail_port' => 'nullable|numeric',
            'mail_username' => 'nullable|string|max:255',
            'mail_password' => 'nullable|max:255',
            'mail_encryption' => 'nullable|string|max:255',
            'mail_from_address' => 'nullable|email|max:255',
            'mail_from_name' => 'nullable|string|max:255',
        ]);

        Setting::updateOrCreate(['name' => 'mail_mailer'], ['value' => $request->get('mail_mailer')]);
        Setting::updateOrCreate(['name' => 'mail_host'], ['value' => $request->get('mail_host')]);
        Setting::updateOrCreate(['name' => 'mail_port'], ['value' => $request->get('mail_port')]);
        Setting::updateOrCreate(['name' => 'mail_username'], ['value' => $request->get('mail_username')]);
        Setting::updateOrCreate(['name' => 'mail_password'], ['value' => $request->get('mail_password')]);
        Setting::updateOrCreate(['name' => 'mail_encryption'], ['value' => $request->get('mail_encryption')]);
        Setting::updateOrCreate(['name' => 'mail_from_address'], ['value' => $request->get('mail_from_address')]);
        Setting::updateOrCreate(['name' => 'mail_from_name'], ['value' => $request->get('mail_from_name')]);

        $this->changeEnvData([
            'MAIL_MAILER'     => $request->mail_mailer,
            'MAIL_HOST'       => $request->mail_host,
            'MAIL_PORT'       => $request->mail_port,
            'MAIL_USERNAME'   => $request->mail_username,
            'MAIL_PASSWORD'   => $request->mail_password,
            'MAIL_ENCRYPTION' => $request->mail_encryption,
            'MAIL_FROM_ADDRESS' => $request->mail_from_address,
            'APP_NAME'  => $request->mail_from_name
        ]);
        
        Toastr::success('Successfully Mail Settings Updated', '', ["positionClass" => "toast-top-right"]);
        return back();
    }

    public function appearance(){
        Gate::authorize('admin.settings.index');
        return view('backend.pages.settings.appearance');
    }

    public function appearanceUpdate(Request $request){
        Gate::authorize('admin.settings.index');
        $request->validate([
            'site_logo' => 'nullable|image',
            'site_favicon' => 'nullable|image',
        ]);

        if($request->hasFile('site_logo')){
            Setting::updateOrCreate(
                ['name' => 'site_logo'], 
                [
                    'value' => Storage::disk('public')->put('logos', $request->file('site_logo'))
                ]
            );
        }

        
        if($request->hasFile('site_favicon')){
            Setting::updateOrCreate(
                ['name' => 'site_favicon'], 
                [
                    'value' => Storage::disk('public')->put('logos', $request->file('site_favicon'))
                ]
            );
        }

        Toastr::success('Successfully Appearance Updated', '', ["positionClass" => "toast-top-right"]);
        return back();

    }


    protected function changeEnvData(array $data)
    {
        if(count($data) > 0){
            $env = file_get_contents(base_path().'/.env');
            $env = preg_split('/\s+/',$env);

            foreach ($data as $key => $value) {
                foreach ($env as $env_key => $env_value) {
                    $entry = explode("=",$env_value,2);
                    if($entry[0] == $key){
                        $env[$env_key] = $key."=".$value;
                    }else{
                        $env[$env_key] = $env_value;
                    }
                }
            }
            $env = implode("\n",$env);

            file_put_contents(base_path().'/.env',$env);
            return true;
        }else {
            return false;
        }
    }
}
