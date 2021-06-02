<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class ManagersController extends Controller
{


    public function eventform()
    {

        return view('frontend.Managers.event');
    }




    public function event(Request $request)
    {

        $request->validate([
            'managers' => 'required',
            'max_participate' => 'required',
            'admin_fee' => 'required',
            'bkash' => 'required',
            'transac_id' => 'required',
            'fee' => 'required',
            'eventName' => 'required',
            'eventDate' => 'required',
            'startDate' => 'required',
            'endDate' => 'required',
            'banner' => 'required|max:5048',
        ]);


        $user_file = "";

        if ($request->hasFile('banner')) {

            $file = $request->file('banner');
            if ($file->isValid()) {

                $user_file = date('Ymdhms') . "." . $file->getClientOriginalExtension();
                $file->storeAs('banner', $user_file);
            }
        }

        $events = new Event();
        $events->managers = $request->managers;
        $events->max_participate = $request->max_participate;
        $events->admin_fee = $request->admin_fee;
        $events->bkash = $request->bkash;
        $events->transac_id = $request->transac_id;
        $events->fee = $request->fee;
        $events->eventName = $request->eventName;
        $events->eventDate = $request->eventDate;
        $events->startDate = $request->startDate;
        $events->endDate = $request->endDate;
        $events->banner = $user_file;
        $events->save();


        return redirect()->back()->with('message','Request Pending, wait for Confirm by Admin');
    }




    public function eventdelete($id)
    {
        Event::find($id)->delete();
        return redirect()->back()->with('message','Event deleted sucessfully');

    }



    // show participator list

    Public function showList($id)
    {
        $list=Event::find($id);

        return view('frontend.Managers.list',compact('list'));

    }
















}
