<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Owner;
use App\Truck;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;

class TruckController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = request('orderBy', 'desc');
        $sort = request('sort', 'trucks.id');


        $data = Truck::all()
            ->load(['model', 'comments', 'owner'])
            ->sortBy($sort, 0, $order === 'desc');

        $search = request('search', '');
        if (!empty($search)) {
            $data = $data->filter(function ($item) use ($search) {

                if (!empty($item->id) && stripos($item->id, $search) !== false) {
                    return true;
                }
                if (!empty($item->manufacture_date) && stripos($item->manufacture_date, $search) !== false) {
                    return true;
                }
                if (isset($item->owner_count) && stripos($item->owner_count, $search) !== false) {
                    return true;
                }
                if (!empty($item->owner) && stripos($item->owner->first_name, $search) !== false) {
                    return true;
                }
                if (!empty($item->owner) && stripos($item->owner->last_name, $search) !== false) {
                    return true;
                }
                if (!empty($item->comments) && !empty($item->comments->content) && stripos($item->comments->content, $search) !== false) {
                    return true;
                }
                if (!empty($item->comments) && stripos($item->model->title, $search) !== false) {
                    return true;
                }
                return false;
            });
        }

        $data = $data->paginate(10)
            ->appends('sort', request('sort'))
            ->appends('orderBy', request('orderBy'));

        if ($search) {
            $data->appends('search', request('search'));
        }

        return view('pages.trucks.index', [
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(
            \App\Forms\TruckForm::class,
            [
                'method' => 'POST',
                'url' => route('trucks.store')
            ]
        );

        return view('pages.trucks.create', compact('form'));
    }

    public function store(FormBuilder $formBuilder, Request $request)
    {
        $form = $formBuilder->create(\App\Forms\TruckForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $data = [
            'model_id' => $request->get('model'),
            'manufacture_date' => $request->get('manufacture_date'),
        ];

        if ($request->get('owner_count')) {
            $data['owner_count'] = $request->get('owner_count');
        }
        $truck = Truck::create($data);

        if ($request->get('full_name')) {
            $name = explode(' ', $request->get('full_name'));

            $lastName = array_pop($name);
            $firstName = implode(' ', $name); //Longer than one word name.
            Owner::create([
                'first_name' => $firstName,
                'last_name' => $lastName,
                'truck_id' => $truck->id,
            ]);
        }

        if ($request->get('comments')) {
            Comment::create([
                'content' => $request->get('comments'),
                'truck_id' => $truck->id,
            ]);
        }

        return redirect()->route('trucks.index', ['success' => true, 'id' => $truck->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
