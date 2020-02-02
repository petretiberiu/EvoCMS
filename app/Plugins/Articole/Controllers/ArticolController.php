<?php

namespace App\Plugins\Articole\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Keyword;
use App\Models\Postare;
use App\Observers\ArticolObserver;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class ArticolController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index() {
        return view('Articole::articol.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create() {
        return view('Articole::articol.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse|Redirector|Response
     */
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'Titlu'=>'required',
            'Continut'=>'required',
            'Categorie'=>'required',
        ]);
        if($validator->fails()) {
            return redirect('/articol/create')
                ->withErrors($validator)
                ->withInput();
        }

        Postare::create($request->all(['Titlu', 'Continut', 'Categorie']))
            ->updateKeywords($request->all('keywords')['keywords']);
        return redirect('/articol');
    }

    /**
     * Display the specified resource.
     *
     * @param string $postare
     * @return Factory|View|Response
     */
    public function show(string $postare) {
        $keywords = Postare::find($postare)->keyword;
        $kwords = '';
        foreach ($keywords as $kw) {
            $kwords = trim($kwords.', '.$kw->Keyword, ', ');
        }
        return view('Articole::articol.show')
            ->with('postare', Postare::find($postare))
            ->with('kwords', $kwords);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $postare
     * @return Factory|View
     */
    public function edit(string $postare) {
        $keywords = Postare::find($postare)->keyword;
        $kwords = '';
        foreach ($keywords as $kw) {
            $kwords = trim($kwords.', '.$kw->Keyword, ', ');
        }
        return view('Articole::articol.edit')
            ->with('postare', Postare::find($postare))
            ->with('kwords', $kwords);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param string $postare
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request, string $postare) {
        $validator = Validator::make($request->all(), [
            'Titlu'=>'required',
            'Continut'=>'required',
        ]);
        $articol = Postare::find($postare);
        if($validator->fails()) {
            return redirect('/articol/'.$articol->slug.'/edit')
                ->withErrors($validator)
                ->withInput();
        }
        $articol->fill($request->all())->updateKeywords($request->all('keywords')['keywords'])->save();
        return redirect("articol/$articol->slug");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $postare
     * @return RedirectResponse|Redirector|Response
     * @throws Exception
     */
    public function destroy(string $postare)
    {
        Postare::find($postare)->delete();
        return redirect('/articol');
    }
}
