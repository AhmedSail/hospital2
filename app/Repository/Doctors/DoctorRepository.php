<?php

namespace App\Repository\Doctors;

use Closure;
use App\Models\Image;
use App\Models\Doctor;
use App\Models\Section;
use App\Models\Appointment;
use App\Traits\UploadTrait;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\DoctorTranslation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use App\Interfaces\Doctors\DoctorRepositoryInterface;

class DoctorRepository implements DoctorRepositoryInterface
{
    use UploadTrait;
    public function index()
    {
        $doctors = Doctor::with('doctorappointments')->get();
        return view('Dashboard.Doctor.index', compact('doctors'));
    }
    function create()
    {
        $sections = Section::all();
        $appointments = Appointment::all();
        return view('Dashboard.Doctor.add', compact('sections', 'appointments'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|unique:doctors,email',
            'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#$%^&*!])[A-Za-z\d@#$%^&*!]+$/',
            'phone' => 'required',
            'section_id' => 'required|exists:sections,id',
            'appointments' => 'required|array|min:1|max:7',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        DB::beginTransaction();

        try {
            $doctor = Doctor::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'section_id' => $request->section_id,
                'phone' => $request->phone,
                'status' => 1,
                'name' => $request->name,
            ]);

            // استخدم attach لحفظ المواعيد المختارة
            $doctor->doctorappointments()->attach($request->appointments);

            $this->verifyAndStoreImage($request, 'photo', 'doctors', 'upload_image', $doctor->id, 'App\Models\Doctor');

            DB::commit();

            session()->flash('success', __('doctor.Doctor Add Successfully'));
            return redirect()->route('doctors.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }




    function edit($id)
    {
        $sections = Section::all();
        $appointments = Appointment::all();
        $doctor = Doctor::findOrFail($id);
        return view('Dashboard.Doctor.edit', compact('doctor', 'sections', 'appointments'));
    }

    function update(Request $request, $id)
    {
        $doctor = Doctor::findOrFail($id);
        // $doctor = Doctor::findOrFail($request->id);
        $request->validate([
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|unique:doctors,email,' . $doctor->id,
            'phone' => 'required',
            'section_id' => 'required|exists:sections,id',
            'appointments' => 'required|array|min:1|max:7',
        ]);
        DB::beginTransaction();

        try {
            $doctor->update([
                'email' => $request->email,
                'section_id' => $request->section_id,
                'phone' => $request->phone,
                'status' => 1,
                'name' => $request->name,
            ]);
            $doctor->doctorappointments()->sync($request->appointments);
            if ($request->hasFile('photo')) {
                // حذف الصورة القديمة إذا كانت موجودة
                if ($doctor->image) {
                    $this->Delete('upload_image', 'doctors' . $request->filename, $doctor->id, $request->filename);
                }

                // حفظ الصورة الجديدة
                $this->verifyAndStoreImage($request, 'photo', 'doctors', 'upload_image', $doctor->id, 'App\Models\Doctor');
            }
            DB::commit();
            session()->flash('success', __('doctor.Doctor Updated Successfully'));
            return redirect()->route('doctors.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    function destroy(Request $request, $id)
    {
        $doctor = Doctor::findOrFail($id);

        if ($request->page_id == 1) {

            if ($request->filename) {
                $this->Delete('upload_image', 'doctors' . $request->filename, $request->id, $request->filename);
            }
            $doctor->doctorappointments()->detach($request->appointments);
            Doctor::destroy($request->id);
            return redirect()->back()->with('msg', __('doctor.Doctor Deleted Successfully'))->with('good', __('section_t.Good Job!'));
        } else {

            $delete_select_ids = explode(",", $request->delete_select_id);
            foreach ($delete_select_ids as $delete_select_id) {
                $doctor = Doctor::findOrFail($delete_select_id);
                if ($doctor->image) {
                    $this->Delete('upload_image', 'doctors' . $request->filename, $doctor->id, $request->filename);
                }
            }
            $doctor->doctorappointments()->detach($request->appointments);
            Doctor::destroy($delete_select_ids);

            if (count($delete_select_ids) > 1) {
                return redirect()->back()->with('msg', __('doctor.Doctors Deleted Successfully'))->with('good', __('section_t.Good Job!'));
            } else {
                return redirect()->back()->with('msg', __('doctor.Doctor Deleted Successfully'))->with('good', __('section_t.Good Job!'));
            }
        }
    }


    function update_password(Request $request, $id)
    {
        $doctor=Doctor::find($id);
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'password'=>['required','min:6','confirmed'],
            'password_confirmation'=>['required','min:6'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
            // return 'yes';
        }

        if (!Hash::check($request->old_password, $doctor->password)) {
            $validator->after(function ($validator) {
                $validator->errors()->add(
                    'old_password',
                    'Old Password doesn\'t match'
                );
            });
        }



        if (Hash::check($request->old_password, $doctor->password)) {

            if (!Hash::check($request->password, $doctor->password)) {


                $doctor->update([
                    'password' => bcrypt($request->password)
                ]);


                return redirect()->back()->with('msg',__('doctor.Password Updated Successfully'))->with('good',__('section_t.Good Job!'));
            } else {

                return redirect()->back();
            }
        } else {

            return redirect()->back()->withInput()->withErrors($validator);
            // return 'yes';
        }
    }





    function update_status(Request $request,$id)
    {
        $doctor=Doctor::find($id);
        Validator::make($request->all(),[
            'status'=>['required','in:0,1']
        ]);
         $doctor->update([
            'status'=>$request->status
         ]);
         if ($doctor) {
            return redirect()->back()->with('msg',__('doctor.Status Updated Successfully'))->with('good',__('section_t.Good Job!'));
         }else{
            return redirect()->back();
         }
    }
    public function getMessage()
    {
        return [
            'email.required' => trans('validation.required'),
            'email.email' => trans('validation.email'),
            'email.unique' => trans('validation.unique'),
            'password.required' => trans('validation.required'),
            'phone.required' => trans('validation.required'),
            'phone.numeric' => trans('validation.numeric'),
            'phone.unique' => trans('validation.unique'),
            'name.required' => trans('validation.required'),
            'name.regex' => trans('validation.regex'),
            'section_id.required' => trans('validation.required'),
        ];
    }
}
