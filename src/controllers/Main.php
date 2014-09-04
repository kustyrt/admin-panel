<?php
Namespace Nifus\AdminPanel;


Class Main extends \BaseController
{

    protected $layout = 'admin-panel::views.layout.Index';

    function Homepage(){
        $this->layout->content = \View::make('admin-panel::views/Main/Homepage');
    }

    function Exel($module,$action){
        $builder = Builder\Listing::create($module);
        $builder->setPage( \Input::get('page') );
        $builder->setOnPage( \Input::get('rows') );
        $builder->setOrder( \Input::get('sidx'),\Input::get('sord') );
        if ( \Input::has('filter') ){
            $builder->setFilter( \Input::get('filter') );
        }

        if ( false===$builder ){
            \App::abort(404);
        }

        $names = $builder->getColNames();



        $cacheMethod = \PHPExcel_CachedObjectStorageFactory::cache_to_phpTemp;
        $cacheSettings = array('memoryCacheSize ' => '256MB');
        \PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);
        $objPHPExcel = new \PHPExcel();

        $objPHPExcel->getProperties()->setCreator(" cms")
            ->setLastModifiedBy(" cms")
            ->setTitle("Export test result statistics")
            ->setSubject("Export test result statistics")
            ->setDescription("Export test result statistics")
            ->setKeywords("Export test result statistics")
            ->setCategory("Export test result statistics");

        $sheet = $objPHPExcel->setActiveSheetIndex(0);

        $chars = 'ABCDEFGHIJKL';
        foreach($names as $i=>$name ){
            $char = $chars[$i];
            $sheet->setCellValue($char.'1', $name);
        }

        $rows = $builder->getData($action);
        foreach( $rows as $j=>$row ){
            $i=0;
            //$sheet = $objPHPExcel->setActiveSheetIndex(0);
            foreach($row as $key=>$value){
                $char = $chars[$i];
                $sheet->setCellValue($char.($j+2), $value);
                $i++;
            }

        }

        /*
         */
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="export_'.time().'.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit();
    }

    function Json($module,$action){
        $builder = Builder\Listing::create($module);
        $builder->setPage( \Input::get('page') );
        $builder->setOnPage( \Input::get('rows') );
        $builder->setOrder( \Input::get('sidx'),\Input::get('sord') );
        if ( \Input::has('filter') ){
            $builder->setFilter( \Input::get('filter') );
        }

        if ( false===$builder ){
            \App::abort(404);
        }

        $total = ($builder->getTotal()==0) ? 0 : ceil($builder->getTotal()/$builder->getRowNum() );
        $response = [
            'page'=> (\Input::has('page') ? \Input::get('page') : 1),
            'rows'=> $builder->getData($action),
            'records'=> $builder->getRowNum(),
            'total'=> $total
        ];

        return \Response::json($response);
    }

    function Listing($module){
        $builder = Builder\Listing::create($module);
        if ( false===$builder ){
            \App::abort(404);
        }
        $this->layout->content =  $builder->execute();
    }

    function Edit(){

    }

    function Page($module){
        $builder = Builder\Listing::create($module);
        $config = $builder->getField(\Input::get('name'));
        if ( false!==$config && isset($config['page']) ){
            $content = $config['page']['url'](\Input::get('id'),\Input::get('name'),$module);
            return \Response::json(
                [
                    'content'=>$content,
                ]
            );
        }

        return \Response::json(
            [
                'error'=>'Not found'
            ]
        );
    }

    function SimplePage($module){
        $builder = Builder\Listing::create($module);
        $config = $builder->getButton(\Input::get('name'));
        if ( false!==$config && isset($config['method']) ){

            $content = $config['method'](\Input::get('name'),$module);
            return \Response::json(
                [
                    'content'=>$content,
                ]
            );
        }

        return \Response::json(
            [
                'error'=>'Not found'
            ]
        );
    }

}