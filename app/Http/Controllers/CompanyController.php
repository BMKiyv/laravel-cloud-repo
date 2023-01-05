<?php

namespace App\Http\Controllers;
use App\Models\Year;
use Illuminate\Http\Request;

class CompanyController extends Controller
{

    
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        if (isset($_GET['investigationreporttitle']) && Year::where('id', '=', $_GET['investigationreporttitle'])->count() > 0)
        {
            $currentreporttitle = Year::where('id', $_GET['investigationreporttitle'])->first();

            $codedcards = Year::where('irt_id', $currentreporttitle->id)->with('investigationreporttitle', 'dictionarycodes1', 'dictionarycodes2', 'dictionarycodes3', 'dictionarycodes4', 'dictionarycodes5', 'dictionarycodes6', 'dictionarycodes7', 'dictionarycodes8', 'dictionarycodes9', 'dictionarycodes10', 'categoryOE')->orderBy('id', 'desc')->paginate(20);
        }else
        {
            $codedcards = Year::with('investigationreporttitle', 'dictionarycodes1', 'dictionarycodes2', 'dictionarycodes3', 'dictionarycodes4', 'dictionarycodes5', 'dictionarycodes6', 'dictionarycodes7', 'dictionarycodes8', 'dictionarycodes9', 'dictionarycodes10', 'categoryOE')->orderBy('id', 'desc')->paginate(20);
        }


        return view('admin.investigationreport.codedcard.index', compact('codedcards'));
    }

    /**
     * Show the form for creating a new resource.
     *{{ $companies->withQueryString()->links() }}
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {

        if (isset($_GET['name']) && Year::where('id', '=', $_GET['investigationreporttitle'])->count() > 0) {
            $reporttitle = Year::pluck('number', 'id')->all();
            $currentreporttitle = Year::where('id', $_GET['investigationreporttitle'])->first();
            $categoriesOE = Year::pluck('name', 'id')->all();
            $categoriescom = Year::pluck('comment', 'id')->all();
            $codes = Year::pluck('name', 'id')->all();
            $codescom = Year::pluck('comment', 'id')->all();
            return view('admin.investigationreport.codedcard.create', compact('currentreporttitle', 'categoriesOE', 'categoriescom', 'codes', 'codescom'));
        }
        else
        {
            return redirect()->route('investigationreporttitle.index')->with('error', 'Спочатку потрібно створити картку звіту з розслідування');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'irt_id' => 'required|exists:investigation_report_titles,id',
            'numb' => 'required|max:255',
            'oe_date' => 'required|date',
            'oe_time' => 'required|date_format:H:i:s',
            'oe_cat' => 'required',
            'npp_before' => 'required',
            'syst' => 'required',
            'element' => 'required',
            'concl1' => 'required',
            'concl2' => 'required',
            'infl' => 'required',
            'charact' => 'required',
            'tipe' => 'required',
            'viol_lmt' => 'required',
            'viol_cndtn' => 'required',
            'person' => 'required',

        ]);

        $data = $request->all();

        Year::create($data);


        return redirect()->route('codedcard.index')->with('success', 'Кодовану картку успішно додано');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $codedcard = Year::find($id);
        $currentreporttitle = Year::where('id', $codedcard->irt_id)->first();
        $categoriesOE = Year::pluck('name', 'id')->all();
        $categoriescom = Year::pluck('comment', 'id')->all();
        $codes = Year::pluck('name', 'id')->all();
        $codescom = Year::pluck('comment', 'id')->all();
        return view('admin.investigationreport.codedcard.edit', compact('codedcard','currentreporttitle', 'categoriesOE', 'categoriescom', 'codes', 'codescom'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'irt_id' => 'required|exists:investigation_report_titles,id',
            'numb' => 'required|max:255',
            'oe_date' => 'required|date',
            'oe_time' => 'required|date_format:H:i:s',
            'oe_cat' => 'required',
            'npp_before' => 'required',
            'syst' => 'required',
            'element' => 'required',
            'concl1' => 'required',
            'concl2' => 'required',
            'infl' => 'required',
            'charact' => 'required',
            'tipe' => 'required',
            'viol_lmt' => 'required',
            'viol_cndtn' => 'required',
            'person' => 'required',
        ]);



        $codedcard = Year::find($id);
        $currentreporttitle = Year::where('id', $codedcard->irt_id)->first();
        $data = $request->all();

        $codedcard->update($data);

        return redirect()->route('codedcard.index', ['investigationreporttitle' => $codedcard->irt_id])->with('success', 'Зміни до запису успішно внесено');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {

        $codedcard = Year::find($id);
        $codedcard->delete();
        return redirect()->route('codedcard.index')->with('success', 'Запис успішно видалено');




        /*        $operetionalevents = OperationalEvent::find($id);
                if($operetionalevents->shopevent->count())
                {
                    return redirect()->route('operetionalevent.index')->with('error', 'Експлуатаційна подія має цехове порушення');
                }
                $operetionalevents->delete();
                return redirect()->route('operetionalevent.index')->with('success', 'Запис успішно видалено');*/


    }





}
