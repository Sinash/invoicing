<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Input;
use App\Excelsap;
use App\Http\Requests\Admin\ExcelsapRequest;
use App\Http\Requests\Admin\DeleteRequest;
use App\Http\Requests\Admin\ReorderRequest;
use Illuminate\Support\Facades\Auth;
use Datatables;

class ExcelsapController extends AdminController {
    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        // Show the page
        return view('admin.excelsap.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
       // Show the page
        return view('admin/excelsap/create_edit');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postCreate(ExcelsapRequest $request)
	{
        $excelsap = new Excelsap();
        $excelsap -> user_id = Auth::id();
        $excelsap -> description = $request->description;

        $excelfile = "";
        if(Input::hasFile('excelfile'))
        {
            $file = Input::file('excelfile');
            $filename = $file->getClientOriginalName();
            $extension = $file -> getClientOriginalExtension();
            $excelfile = sha1($filename . time()) . '.' . $extension;
        }
        $excelsap -> excelfile = $excelfile;
        $excelsap -> save();

        if(Input::hasFile('excelfile'))
        {
            $destinationPath = public_path() . '/images/excelsap/'.$excelsap->id.'/';
            Input::file('excelfile')->move($destinationPath, $excelfile);
			$excel = App::make('excel');
			
        }
	}
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id)
	{
        $excelsap = Excelsap::find($id);

        return view('admin/excelsap/create_edit',compact('excelsap'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postEdit(ExcelsapRequest $request, $id)
	{
        $excelsap = Excelsap::find($id);
        $excelsap -> user_id_edited = Auth::id();
        $excelsap -> description = $request->description;
        $excelfile = "";

        if(Input::hasFile('excelfile'))
        {
            $file = Input::file('excelfile');
            $filename = $file->getClientOriginalName();
            $extension = $file -> getClientOriginalExtension();
            $excelfile = sha1($filename . time()) . '.' . $extension;
        }
        $excelsap -> excelfile = $excelfile;
        $excelsap -> save();

        if(Input::hasFile('excelfile'))
        {
            $destinationPath = public_path() . '/images/excelsap/'.$excelsap->id.'/';
            Input::file('excelfile')->move($destinationPath, $excelfile);
        }
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return Response
     */

    public function getDelete($id)
    {
        $excelsap = $id;
        // Show the page
        return view('admin/excelsap/delete', compact('excelsap'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return Response
     */
    public function postDelete(DeleteRequest $request,$id)
    {
        $excelsap = Excelsap::find($id);
        $excelsap->delete();
    }

    /**
     * Show a list of all the excelsaps posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function data()
    {
        $excelsap = Excelsap::whereNull('excelsaps.deleted_at')
            ->orderBy('excelsaps.updated_at', 'ASC')
            ->select(array('excelsaps.id', 'excelsaps.description', 'excelsaps.updated_at',
            'excelsaps.created_at'));
//        "<span class='flag flag-$lang_code' alt='flag'></span>"
        return Datatables::of($excelsap)
//            ->edit_column('icon', '{!! ($icon!="")? "<img style=\"max-width: 30px; max-height: 30px;\" src=\"../images/excelsap/$id/$icon\">":""; !!}')
            //->edit_column('icon', '{!! ($icon!="")? "<span class=\"flag $icon\" alt=\"flag\">&nbsp</span>":""; !!}')

            ->add_column('actions', '<a href="{{{ URL::to(\'admin/excelsap/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span> {{ trans("admin/modal.edit") }}</a>
                    <a href="{{{ URL::to(\'admin/excelsap/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>
                    <input type="hidden" name="row" value="{{$id}}" id="row">')
            ->remove_column('id')

            ->make();
    }

    /**
     * Reorder items
     *
     * @param items list
     * @return items from @param
     */
    public function getReorder(ReorderRequest $request) {
        $list = $request->list;
        $items = explode(",", $list);
        $order = 1;
        foreach ($items as $value) {
            if ($value != '') {
                Excelsap::where('id', '=', $value) -> update(array('updated_at' => $order));
                $order++;
            }
        }
        return $list;
    }

}
