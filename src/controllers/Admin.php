<?php
namespace Nifus\AdminPanel;

Class Admin extends \BaseController {

    protected $layout = 'admin::layouts.main';

    public function getIndex()
    {

    }

    public function getTable($name)
    {
        $config = \Config::get('admin::tables.'.$name);

        foreach ($config['fields'] as $k => $v) {
            $fields[] = $k;
        }

        $items = \DB::table($name)->select($fields);

        if (isset($_GET['order']) && isset($_GET['order_type'])) {
            $items->orderBy($_GET['order'], $_GET['order_type']);
        }

        $data = [
            'table_config'  => $config,
            'items'         => $items->paginate(15)
        ];

        $this->layout->content =
            \View::make('admin::admin.table', $data);
    }

    public function getNewItem($table)
    {
        $config = \Config::get('admin::tables.'.$table);
        $form = new AdminForm($config);

        $data = [
            'form'  => $form->render(),
            'table' => $config['name']
        ];

        $this->layout->content =
            \View::make('admin::admin.add_item_form', $data);
    }

    public function postNewItem($table)
    {
        $data = \Input::all();
        \DB::table($table)->insert($data);
        return \Redirect::to('/admin/table/'.$table);
    }

    public function getEditItem($table, $id)
    {
        $object_data = \DB::table($table)->where('id', $id)->first();

        $config = \Config::get('admin::tables.'.$table);
        $form = new AdminForm($config);

        $data = [
            'form'      => $form->render($object_data),
            'table'     => $config['name'],
            'object_id' => $id
        ];

        $this->layout->content =
            \View::make('admin::admin.edit_item_form', $data);
    }

    public function postEditItem($table, $id)
    {
        $data = \Input::all();
        \DB::table($table)->where('id', $id)->update($data);
        return \Redirect::to('/admin/table/'.$table);
    }

    public function getDeleteItem($table, $id)
    {
        \DB::table($table)->where('id', $id)->delete();
        return \Redirect::to('/admin/table/'.$table);
    }

}