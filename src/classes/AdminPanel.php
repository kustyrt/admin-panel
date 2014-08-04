<?php
namespace Nifus\AdminPanel;


class AdminPanel
{

    /**
     * Create admin structure
     * @param array $items
     * @return Structure
     * @throws \Exception
     */
    static function createStructure(array $items)
    {

        if ( sizeof($items)==0 ){
            throw new \Exception('Не задана структура');
        }

        $structure = new Structure;
        foreach( $items as $item ){
            if ( is_array($item) ){
                $structure->item( MenuItem::create($item) );
            }elseif( $item instanceof MenuItem ){
                $structure->item($item);
            }elseif(  is_string($item) ){
                $section = Section::load($item);
                if ( false===$section ){
                    continue;
                }
                $config = [
                    'title'=>$section->title,'url'=>$section->path
                ];
                $structure->item( MenuItem::create($config) );
            }else{
                throw new \Exception('Неправильный формат');
            }
        }
        return $structure;
    }


    /**
     * Создаём раздел
     * @param string $prefix
     * @return AdminPanel
     */
    static function createSection($prefix = '')
    {
        $panel = new Section($prefix);
        return $panel;
    }

    /**
     * Create simple text
     *
     * @param $name
     * @return Field
     */
    static function createField($name)
    {
        $field = new Field($name);
        return $field;
    }

    /**
     * Create button
     *
     * @param null $title
     * @return Field\Button
     */
    static function createFieldButton($title=null)
    {
        $field = new Field\Button($title);
        return $field;
    }



    static function createItem($url,$title='')
    {
        return MenuItem::create(['url'=>$url,'title'=>$title]);
    }

}