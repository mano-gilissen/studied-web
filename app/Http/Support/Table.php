<?php



namespace App\Http\Support;



class Table {





    const VIEW_COLUMNS                                      = "columns";
    const VIEW_COUNTERS                                     = "counters";
    const VIEW_SPACING                                      = "column_spacing";
    const VIEW_ITEMS                                        = "items";

    const COUNTER_LABEL                                     = "label";
    const COUNTER_VALUE                                     = "value";

    const COLUMN_ID                                         = "id";
    const COLUMN_SPACING                                    = "spacing";
    const COLUMN_LABEL                                      = "label";
    const COLUMN_HTML                                       = "html";
    const COLUMN_STATE                                      = "state";

    const DATA_TYPE                                         = "data_type";
    const DATA_SORT                                         = "data_sort";
    const DATA_FILTER                                       = "data_filter";

    const SORT_MODE                                         = "mode";
    const SORT_MODE_ASC                                     = "asc";
    const SORT_MODE_DESC                                    = "desc";
    const SORT_MODE_NONE                                    = "none";

    const ITEM_LINK                                         = "link";

    const WIDTH_END_ACTION                                  = "48px";





    public static function load($controller, $request) {

        $sort                                               = $request->input(Table::DATA_SORT, null);
        $filter                                             = $request->input(Table::DATA_FILTER, null);

        $columns                                            = $controller->list_columns($sort);
        $spacing                                            = self::spacing($columns);
        $objects                                            = self::objects($controller, $sort, $filter);
        $items                                              = [];

        foreach ($objects as $object) {

            $item                                           = [];

            foreach ($columns as $column) {

                $item[$column->{self::COLUMN_ID}]           = $controller->list_value($object, $column);
                $item[self::ITEM_LINK]                      = $controller->list_link($object);
            }

            array_push($items, (object) $item);
        }

        return view(Views::LOAD_LIST, [

            self::VIEW_COLUMNS                              => $columns,
            self::VIEW_SPACING                              => $spacing,
            self::VIEW_ITEMS                                => $items
        ]);
    }




    public static function objects($controller, $sort, $filter) {

        $query                                              = $controller->list_query();
/*
        if ($filter) {

            $controller->list_filter($query, $filter);

        }
*/
        if ($sort) {

            $controller->list_sort($query, $sort);

        }

        return $query->select($controller->list_type() . '.*')->get();
    }





    public static function column($id, $label, $spacing, $sortable, $sort, $html = false) {

        return (object) [
            self::COLUMN_ID                                 => $id,
            self::COLUMN_LABEL                              => $label,
            self::COLUMN_SPACING                            => $spacing,
            self::COLUMN_HTML                               => $html,
            self::COLUMN_STATE                              => $sortable ? ($sort ? $sort[$id] : '') : self::SORT_MODE_NONE
        ];
    }





    public static function spacing($columns) {

        $column_spacing = '';

        foreach ($columns as $column) {

            $column_spacing .= $column->{self::COLUMN_SPACING} . "fr ";

        }

        return $column_spacing.self::WIDTH_END_ACTION;
    }





}
