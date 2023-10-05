<?php

namespace App\Repository\Services;

use App\Interfaces\Services\GroupRepositoryInterface;
use App\Models\Group;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GroupRepository implements GroupRepositoryInterface
{
    public function index()
    {
        $groups = Group::all();
        return view('Dashboard.Service.Group.index', compact('groups'));
    }
    public function create()
    {
        $Items = [];
        $Total_before_dis = 0;
        $Total_after_dis = 0;
        $Tax = 0;
        $Total_with_tax = 0;
        $services = Service::all();
        return view('Dashboard.Service.Group.add', compact('services', 'Items', 'Total_before_dis', 'Total_after_dis', 'Tax', 'Total_with_tax'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'Services' => 'required',
            'discount' => 'required',
            'tax' => 'required',
            'description' => 'required',

        ]);
        $Items = [];
        $Total_before_dis = 0;
        $Total_after_dis = 0;
        $Total_with_tax = 0;
        $i = 0;
        foreach ($request->Services as $service) {
            $Items[$i] = $service;
            $i++;
        }
        foreach ($Items as $Item) {
            $service = Service::firstWhere('id', $Item);

            if ($service) {
                $Total_before_dis += $service->price;
            }
        }
        $Total_after_dis = $Total_before_dis - $request->discount;

        $Total_with_tax = ($Total_after_dis * $request->tax / 100) + $Total_after_dis;



        $group = Group::create([
            'Total_before_discount' => $Total_before_dis,
            'discount_value' => $request->discount,
            'Total_after_discount' => $Total_after_dis,
            'tax_rate' => $request->tax,
            'Total_with_Tax' => $Total_with_tax,
            'name' => $request->name,
            'notes' => $request->description
        ]);
        $group->service_group()->attach($request->Services);
        return redirect()->route('GroupService.index')->with('msg', __('service.Service Add Successfully'))->with('good', __('section_t.Good Job!'));
    }


    public function edit($id)
    {
        $group = Group::find($id);
        $services = Service::all();
        return view('Dashboard.Service.Group.edit', compact('group', 'services'));
    }


    public function update(Request $request, $id)
    {
        $group = Group::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'Services' => 'required',
            'discount' => 'required',
            'tax' => 'required',
            'description' => 'required',

        ]);
        $Items = [];
        $Total_before_dis = 0;
        $Total_after_dis = 0;
        $Total_with_tax = 0;
        $i = 0;
        foreach ($request->Services as $service) {
            $Items[$i] = $service;
            $i++;
        }
        foreach ($Items as $Item) {
            $service = Service::firstWhere('id', $Item);

            if ($service) {
                $Total_before_dis += $service->price;
            }
        }
        $Total_after_dis = $Total_before_dis - $request->discount;

        $Total_with_tax = ($Total_after_dis * $request->tax / 100) + $Total_after_dis;



        $group->update([
            'Total_before_discount' => $Total_before_dis,
            'discount_value' => $request->discount,
            'Total_after_discount' => $Total_after_dis,
            'tax_rate' => $request->tax,
            'Total_with_Tax' => $Total_with_tax,
            'name' => $request->name,
            'notes' => $request->description,
        ]);
        $group->service_group()->sync($request->Services);
        return redirect()->route('GroupService.index')->with('msg', __('service.Service Updated Successfully'))->with('good', __('section_t.Good Job!'));
    }
    public function destroy(Request $request, $id)
    {
        $group = Group::findOrFail($id)->delete();
        return redirect()->route('GroupService.index')->with('msg', __('service.Service Deleted Successfully'))->with('good', __('section_t.Good Job!'));
    }
}
