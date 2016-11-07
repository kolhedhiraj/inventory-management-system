<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests, \DB, App\Item, \Redirect;

class ConfigController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public static function getItems()
    {
        $items = [['value' => 0, 'text' => 'Raw Material'],['value' => 1, 'text' => 'Product']];

        return json_encode($items);
    }

    public function show()
    {
        return view('config.show');
    }

    #Category

    public function showCatGrid(Request $request)
    {
        if($request->ajax())
        {
            $records = DB::table('itemcategory')->where('deleted', '0')->count();

            #server order
            if($request->order[0]['column'] != '')
            {
                if($request->order[0]['column'] == '0')
                    $orderBy = 'category';
                else if($request->order[0]['column'] == '1')
                    $orderBy = 'item';

                $dir = $request->order[0]['dir'];
            }
            else
            {
                $orderBy = '';
                $dir = 'desc';
            }

            $items = DB::table('itemcategory')
                ->select('itemcategory.Itemcategory_name as category', 'itemcategory.is_for_product as item', 'itemcategory.Itemcategory_id as id')
                ->where('itemcategory.deleted', '0')
                ->orderBy($orderBy, $dir)
                ->get();


            $json_data = array(
                "draw"            => $request->draw,
                "recordsTotal"    => $records,
                "recordsFiltered" => $records,
                "data"            => $items
            );
            return $json_data;

        }
    }

    public function deleteCategory(Request $request)
    {
        if($request->ajax())
        {
            $response = [];
            $response['status'] = 200;

            DB::transaction(function () use ($request)
            {
                DB::table('itemcategory')
                    ->where('Itemcategory_id', $request->pk)
                    ->update(['deleted' => 1]);
            });

            return $response;
        }
    }

    public function addCategory(Request $request)
    {
        if($request->ajax())
        {
            $response = [];
            $response['status'] = 200;

            DB::transaction(function () use ($request)
            {
                DB::table('itemcategory')
                    ->insert(['Itemcategory_name' => $request->name, 'is_for_product' => $request->type, 'id_itemcategory' => 0]);
            });

            return $response;
        }
    }

    public function editCategory(Request $request)
    {
        if($request->ajax())
        {
            switch($request->name)
            {
                case "category":
                    DB::table('itemcategory')
                        ->where('Itemcategory_id', $request->pk)
                        ->update(["Itemcategory_name" => $request->value]);
                    break;
                case "name":
                    DB::table('itemcategory')
                        ->where('Itemcategory_id', $request->pk)
                        ->update(["is_for_product" => $request->value]);
                    break;
            }
        }
    }

    #Unity

    public function showUnityGrid(Request $request)
    {
        if($request->ajax())
        {
            $records = DB::table('itemunity')->where('deleted', '0')->count();

            #server order
            if($request->order[0]['column'] != '')
            {
                if($request->order[0]['column'] == '0')
                    $orderBy = 'unity';
                else if($request->order[0]['column'] == '1')
                    $orderBy = 'item';

                $dir = $request->order[0]['dir'];
            }
            else
            {
                $orderBy = '';
                $dir = 'desc';
            }

            $items = DB::table('itemunity')
                ->select('itemunity.Itemunity_name as unity', 'itemunity.is_for_product as item', 'itemunity.Itemunity_id as id')
                ->where('itemunity.deleted', '0')
                ->orderBy($orderBy, $dir)
                ->get();


            $json_data = array(
                "draw"            => $request->draw,
                "recordsTotal"    => $records,
                "recordsFiltered" => $records,
                "data"            => $items
            );
            return $json_data;

        }
    }

    public function deleteUnity(Request $request)
    {
        if($request->ajax())
        {
            $response = [];
            $response['status'] = 200;

            DB::transaction(function () use ($request)
            {
                DB::table('itemunity')
                    ->where('Itemunity_id', $request->pk)
                    ->update(['deleted' => 1]);
            });

            return $response;
        }
    }

    public function addUnity(Request $request)
    {
        if($request->ajax())
        {
            $response = [];
            $response['status'] = 200;

            DB::transaction(function () use ($request)
            {
                DB::table('itemunity')
                    ->insert(['Itemunity_name' => $request->name, 'is_for_product' => $request->type]);
            });

            return $response;
        }
    }

    public function editUnity(Request $request)
    {
        if($request->ajax())
        {
            switch($request->name)
            {
                case "unity":
                    DB::table('itemunity')
                        ->where('Itemunity_id', $request->pk)
                        ->update(["Itemunity_name" => $request->value]);
                    break;
                case "name":
                    DB::table('itemunity')
                        ->where('Itemunity_id', $request->pk)
                        ->update(["is_for_product" => $request->value]);
                    break;
            }
        }
    }

    #Type

    public function showTypeGrid(Request $request)
    {
        if($request->ajax())
        {
            $records = DB::table('itemtype')->where('deleted', '0')->count();

            #server order
            if($request->order[0]['column'] != '')
            {
                if($request->order[0]['column'] == '0')
                    $orderBy = 'type';
                else if($request->order[0]['column'] == '1')
                    $orderBy = 'item';

                $dir = $request->order[0]['dir'];
            }
            else
            {
                $orderBy = '';
                $dir = 'desc';
            }

            $items = DB::table('itemtype')
                ->select('itemtype.itemtype_name as type', 'itemtype.is_for_product as item', 'itemtype.itemtype_id as id')
                ->where('itemtype.deleted', '0')
                ->orderBy($orderBy, $dir)
                ->get();


            $json_data = array(
                "draw"            => $request->draw,
                "recordsTotal"    => $records,
                "recordsFiltered" => $records,
                "data"            => $items
            );
            return $json_data;

        }
    }

    public function deleteType(Request $request)
    {
        if($request->ajax())
        {
            $response = [];
            $response['status'] = 200;

            DB::transaction(function () use ($request)
            {
                DB::table('itemtype')
                    ->where('itemtype_id', $request->pk)
                    ->update(['deleted' => 1]);
            });

            return $response;
        }
    }

    public function addType(Request $request)
    {
        if($request->ajax())
        {
            $response = [];
            $response['status'] = 200;

            DB::transaction(function () use ($request)
            {
                DB::table('itemtype')
                    ->insert(['itemtype_name' => $request->name, 'is_for_product' => $request->type]);
            });

            return $response;
        }
    }

    public function editType(Request $request)
    {
        if($request->ajax())
        {
            switch($request->name)
            {
                case "type":
                    DB::table('itemtype')
                        ->where('itemtype_id', $request->pk)
                        ->update(["itemtype_name" => $request->value]);
                    break;
                case "name":
                    DB::table('itemtype')
                        ->where('itemtype_id', $request->pk)
                        ->update(["is_for_product" => $request->value]);
                    break;
            }
        }
    }
}
