<?php



namespace App\Http\Support;

use App\Http\Traits\BaseTrait;
use App\Models\Person;


class Table {




    use BaseTrait;





    const VIEW_COLUMNS                                      = "columns";
    const VIEW_COUNTERS                                     = "counters";
    const VIEW_SPACING                                      = "column_spacing";
    const VIEW_ITEMS                                        = "items";
    const VIEW_FILTERS                                      = "filters";

    const COUNTER_ID                                        = "id";
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
    const DATA_SEARCH                                       = "data_search";
    const DATA_OFFSET                                       = "data_offset";
    const DATA_LAYOUT                                       = "layout";

    const SORT_MODE_ASC                                     = "asc";
    const SORT_MODE_DESC                                    = "desc";
    const SORT_MODE_NONE                                    = "none";
    const SORT_DISABLED                                     = "no_sort";

    const FILTER_COLUMN                                     = "column";
    const FILTER_VALUE                                      = "value";
    const FILTER_ACTIVE                                     = "filtered";
    const FILTER_DISABLED                                   = "no_filter";

    const ITEM_LINK                                         = "link";

    const WIDTH_END_ACTION                                  = "48px";





    public static function load($controller, $request) {

        $sort                                               = $request->input(Table::DATA_SORT, null);
        $filter                                             = $request->input(Table::DATA_FILTER, null);
        $search                                             = $request->input(Table::DATA_SEARCH, null);
        $offset                                             = $request->input(Table::DATA_OFFSET, 0);
        $mobile                                             = $request->input(Table::DATA_LAYOUT, 'desktop');

        $view_data                                          = [];

        $columns                                            = $controller->list_columns($sort, $filter, $mobile);
        $spacing                                            = self::spacing($columns);
        $query                                              = self::query($controller, $sort, $filter, $search);
        $objects                                            = self::objects($controller, clone $query, $offset);
        $objects                                            = self::prepare($controller, $objects);
        $items                                              = [];

        foreach ($columns as $column) {

            if ($column->{self::COLUMN_FILTER} != self::FILTER_DISABLED) {

                $data_name                                  = Key::AUTOCOMPLETE_DATA . Key::FILTER_INPUT . $column->{self::COLUMN_ID};
                $view_data[$data_name]                      = Format::encode($controller->list_filter_data(clone $query, $column));

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

        return view(($offset > 0 ? Views::LOAD_ITEMS : Views::LOAD_LIST) . ($mobile == 'mobile' ? '-mobile' : ''), $view_data);
    }





    public static function view($controller, $request) {

        return view($controller->list_view(), [

            Key::PAGE_TITLE                                 => $controller->list_title(),
            Table::DATA_TYPE                                => $controller->list_type(),
            Table::DATA_FILTER                              => self::filter($controller, $request)
        ]);
    }




    public static function query($controller, $sort, $filter, $search) {

        $query                                              = self::getModelClass($controller->list_type())::query();

        $controller->list_filter_default($query);

        if ($filter && !empty($filter)) {

            $controller->list_filter($query, $filter);

        }

        if ($search) {

            $controller->list_filter_search($query, $search);

        }

        if ($sort && !empty($sort)) {

            $controller->list_sort($query, $sort);

        } else {

            $controller->list_sort_default($query);

        }

        return $query;
    }





    public static function objects($controller, $query, $offset = 0, $limit = 20) {

        return $query->select($controller->list_type() . '.*')->offset($offset)->limit($limit)->get();

    }





    public static function prepare($controller, $objects) {

        return $controller->list_prepare($objects);

    }





    public static function filter($controller, $parameters) {

        $data_filter                                        = (object)[];

        foreach ($parameters->all() as $parameter => $value) {

            dd(24234234);
            $controller->list_filter_parameter($data_filter, $parameter, $value);

        }

        return Format::encode($data_filter);
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
