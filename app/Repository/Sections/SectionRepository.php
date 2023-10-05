<?php

namespace App\Repository\Sections;

use App\Interfaces\Sections\SectionRepositoryInterface;
use App\Models\Section;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class SectionRepository implements SectionRepositoryInterface
{
    function index() {
        $sections=Section::all();
        return view('Dashboard.Sections.index',compact('sections'));
    }


    function store(Request $request){
        $request->validate([
            'name'=>'required',
        ]);

        Section::create([
            'name'=>$request->input('name')
        ]);

        return redirect()->route('sections.index')->with('msg',__('section_t.Section Add Successfully'))->with('good',__('section_t.Good Job!'));
    }



    function update(Request $request){
        $section = Section::find($request->id);
        $section->update([
            'name'=>$request->input('name')
        ]);
        return redirect()->route('sections.index',compact('section'))->with('msg',__('section_t.Section Updated Successfully'))->with('good',__('section_t.Good Job!'));
    }



    function destroy(Request $request) {
        $section = Section::find($request->id);
        $section->delete();
        return redirect()->route('sections.index')->with('msg',__('section_t.Section Deleted Successfully'))->with('good',__('section_t.Good Job!'));
    }
    function show($id) {
        $section=Section::find($id);
        $doctors = Section::find($id)->doctors;
        return view('Dashboard.Sections.doctor_section',compact('section','doctors'));
    }
}
