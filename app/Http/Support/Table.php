<?php



namespace App\Http\Support;



class Table {





    const VIEW_COLUMNS                          = "columns";
    const VIEW_COUNTERS                         = "counters";
    const VIEW_SPACING                          = "column_spacing";
    const VIEW_ITEMS                            = "items";

    const COUNTER_LABEL                         = "label";
    const COUNTER_VALUE                         = "value";

    const COLUMN_LABEL                          = "label";
    const COLUMN_SPACING                        = "spacing";
    const COLUMN_TYPE                           = "type";
    const ITEM_LINK                             = "link";

    const WIDTH_END_ACTION                      = "48px";





    public static function view($controller, $view, $title, $objects) {

        $counters                                           = $controller->list_counters();
        $columns                                            = $controller->list_columns();

        $spacing                                            = self::spacing($columns);

        $items                                              = [];

        foreach ($objects as $object) {

            $item                                           = [];

            foreach ($columns as $column) {

                $item[$column->{self::COLUMN_LABEL}]        = $controller->list_value($object, $column);
                $item[self::ITEM_LINK]                      = $controller->list_link($object);
            }

            array_push($items, (object) $item);
        }

        return view($view, [

            Key::PAGE_TITLE                                 => $title,

            self::VIEW_COLUMNS                              => $columns,
            self::VIEW_COUNTERS                             => $counters,
            self::VIEW_SPACING                              => $spacing,
            self::VIEW_ITEMS                                => $items,
        ]);
    }





    public static function column($label, $spacing, $type = null) {

        return (object) [
            self::COLUMN_LABEL                          => $label,
            self::COLUMN_SPACING                        => $spacing,
            self::COLUMN_TYPE                           => $type
        ];
    }





    public static function spacing($columns) {

        $column_spacing = '';

        foreach ($columns as $column) {

            $column_spacing .= $column->{self::COLUMN_SPACING}."fr ";

        }

        return $column_spacing.self::WIDTH_END_ACTION;
    }





}
