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
    const COLUMN_SORT                                       = "sort";
    const COLUMN_FILTER                                     = "filter";

    const DATA_TYPE                                         = "data_type";
    const DATA_SORT                                         = "data_sort";
    const DATA_FILTER                                       = "data_filter";

    const SORT_MODE                                         = "mode";
    const SORT_MODE_ASC                                     = "asc";
    const SORT_MODE_DESC                                    = "desc";
    const SORT_DISABLED                                     = "no_sort";

    const FILTER_ACTIVE                                     = "filtered";
    const FILTER_DISABLED                                   = "no_filter";

    const ITEM_LINK                                         = "link";

    const WIDTH_END_ACTION                                  = "48px";





    public static function load($controller, $request) {

        $sort                                               = $request->input(Table::DATA_SORT, null);
        $filter                                             = $request->input(Table::DATA_FILTER, null);

        $view_data                                          = [];

        $columns                                            = $controller->list_columns($sort, $filter);
        $spacing                                            = self::spacing($columns);
        $query                                              = self::query($controller, $sort, $filter);
        $objects                                            = self::objects($controller, $query);
        $items                                              = [];

        foreach ($columns as $column) {

            if ($column->{self::COLUMN_FILTER} != self::FILTER_DISABLED) {

                $data_name                                  = Key::AUTOCOMPLETE_DATA . Key::FILTER_INPUT . $column->{self::COLUMN_ID};
                $view_data[$data_name]                      = Format::encode($controller->list_filter_data($query, $column));

            }
        }

        foreach ($objects as $object) {

            $item                                           = [];

            foreach ($columns as $column) {

                $item[$column->{self::COLUMN_ID}]           = $controller->list_value($object, $column);
                $item[self::ITEM_LINK]                      = $controller->list_link($object);
            }

            array_push($items, (object) $item);
        }

        $view_data[self::VIEW_COLUMNS]                      = $columns;
        $view_data[self::VIEW_SPACING]                      = $spacing;
        $view_data[self::VIEW_ITEMS]                        = $items;

        return view(Views::LOAD_LIST, $view_data);
    }




    public static function query($controller, $sort, $filter) {

        $query                                              = $controller->list_query();

        if ($filter) {

            $controller->list_filter($query, $filter);

        }

        if ($sort) {

            $controller->list_sort($query, $sort);

        }

        return $query;
    }




    public static function objects($controller, $query) {

        return $query->select($controller->list_type() . '.*')->get();

    }





    public static function column($id, $label, $spacing, $sortable, $sort, $filterable, $filter, $html = false) {

        return (object) [
            self::COLUMN_ID                                 => $id,
            self::COLUMN_LABEL                              => $label,
            self::COLUMN_SPACING                            => $spacing,
            self::COLUMN_HTML                               => $html,
            self::COLUMN_SORT                               => $sortable ? ($sort && array_key_exists($id, $sort) ? $sort[$id] : '') : self::SORT_DISABLED,
            self::COLUMN_FILTER                             => $filterable ? ($filter && array_key_exists($id, $filter) ? self::FILTER_ACTIVE : '') : self::FILTER_DISABLED,
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
