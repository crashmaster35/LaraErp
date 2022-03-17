{{--

  The datatable parameters
  @params

  route   Route of the component
  array
      dtId          String      Required        No default      The id of the datatable, it's required, becauser you can display multiple instances of the same component on the
                                                                page and also you need an instance name to work with, datatable js need to get the id to draw the table and work
                                                                with it.
      dtCount       Integer     Not Required    1               If you have multiple instances of the component in the same page, then you need to enumerate each object, starting
                                                                with 1 and adding 1 to each component. n++. If you have only one component on a page you can ommit this parameter.
      dtData        Array       Not Required    []              The array of data to be displayed. Be sure to add ->toArray() to the collection given as parameter. This parameter
                                                                is required only if you will not use the server side processing with ajas parameters and you will send the array to
                                                                display on a one time display.
      dtClass       String      Not Required    ''              Extra class for the entire Datatable, you can add classes to the datatable to make looks better, this class is only
                                                                for the entire datatable, not for the columns only. If you need to add to the columns then you will see the class
                                                                parameter on teh dtColumns array.
      dtStyle       String      Not Required    ''              Extra style for the entire Datatable, sometimes you need to add a style directly to the datatable, this is it, but
                                                                is only to the entire datatable not for columns only.
      dtStateSave   String      Not Required    'false'         Save the state the user let the datatable, when come back will return to the exactly same place. Use it with caution,
                                                                because sometimes make things not predictible with the table.
      dtColReorder  String      Not Required    'false'         Let the end user to reorder the columns and then export the table, is better when the dtStateSave is set to 'true'
                                                                because will the the changes each time the user show the table.
      dtSearchBox   String      Not Required    'true'          Hide or show the search box of the datatable, enabling or disabling the search oprion.
      dtServerSide  String      Not Required    'true'          Server side processing for the pagination, the code on controller need to be there. Its really important to add as
                                                                string not boolean with 'true' or 'false'. With server side, all the data will be called as an ajax call, in this way
                                                                each time you change page the datatable will call the dtAjaxUrl to retrieve the page information or the search result.
      dtAjaxUrl     String      Not Required    ''              The entire url required to call the ajax where the data will be retieved, this is required if dtServerSide is set to
                                                                true by default, but if the dtServerSide will be set to false this parameter will not be required.
      dtExtraAjax   String      Not Required    ''              If you need to pass an extra parameter to the data inside the ajax all, you can pass it here, need to have an extra
                                                                comma (,) at the begining, because the first parameter not modificable is the token.
      dtExport      String      Not Required    'false'         This parameter need to set to true if you want the buttons to export the table or print the table. If this is set to
                                                                true then you need to fill the dtExportBtns array parameter to define the buttons you want to show.
      dtName        String      Not Required    'export'        This is the name of the file to be exported. By default the file will be called as export{date}. You can define the
                                                                name of the file and will be aded the actual date to prevent duplication names. Try to define the dtName to mantain
                                                                a congruience file names on your hard drive.
      dtVisibility  String      Not Required    'false'         Define if the button columnn visibility will be displayer to accept the user hide or show table columns. If you will
                                                                activate dtVisibility then you wish want to add 'dtStyle' => 'min-height: 800px', that with to be sure if you hide
                                                                all the columns then the list of the column visibility stay visible.
      dtExportBtns  Array       Not Required    [print,
                                                csv,
                                                excel,
                                                pdf]            This array contains the butons parameters to display, by default datatables have print, csv, excel or pdf, you can
                                                                remove or add any of this buttons in the following format:
                                                                    'dtExportBtns' =>   [
                                                                                            [
                                                                                                'type' => 'print',          // Send directly the table to a printer.
                                                                                                'title' => 'Print List'
                                                                                            ],[
                                                                                                'type' => 'printall',            // Export the table on csv format.
                                                                                                'title' => 'Print All'
                                                                                            ],[
                                                                                                'type' => 'csv',            // Export the table on csv format.
                                                                                                'title' => 'CSV File'
                                                                                            ],[
                                                                                                'type' => 'excel',          // Export the table on excel xls format.
                                                                                                'title' => 'Excel File XLS'
                                                                                            ],[
                                                                                                'type' => 'pdf',            // Export the table on adobe pdf format.
                                                                                                'title' => 'Adobe PDF File'
                                                                                            ]
                                                                                        ],
                                                                By default if dtExport is set to true, generate all the buttons: print, csv, excel and pdf, you can ommit the
                                                                dtExportBtns key on the array if you want all buttons.
      dtColumns     Array       Required        No default      A multidimensional array of the colums to be displayed. Is required for server side processing and non server side
                                                                processing with the local display of the array dtData. You need to fill this array with the columns you will have
                                                                displayed on your table or will be procesed on the datatable, this is the format you need to fill:
                                                                'dtColumns' =   [
                                                                                    [
                                                                                        'title'     => The title of the column to display on the datatable.
                                                                                        'width'     => The percentage of the with of the column into the datatable.
                                                                                        'data'      => This parameter is the most important, need to define the column name
                                                                                                       retrieved from the ajax call, this is the record name not the title of the
                                                                                                       column. For example: address1, that is the field name on the database.
                                                                                        'type'      => Define the type of the field, string or date, to parse
                                                                                        'class'     => Aditional css class to be added to each column to make the design,
                                                                                        'url'       => The url of the field to be pointed, you can create complex links from the
                                                                                                       information you retrieved from the database, just adding **field= and the
                                                                                                       field to add, clossing with **, for example:
                                                                                                            'url' => url('/centers/**field=id**/edit/**field=address1**'),
                                                                                                       in this example you will create the following route:
                                                                                                            https://admin.alliancevirtualoffices.com/centers/5706/edit/2000%20PGA%20Blvd.
                                                                                                       Its important to understand that the fields added to the field statement need to
                                                                                                       be set as dtColumns elemento of the array, also will be used only if the
                                                                                                       dtServerSide is set to 'false'.
                                                                                        'orderable' => 'true'/'false' define if the column will be orderable or not, depending of the
                                                                                                       needs of the table.
                                                                                        'visible'   => 'true/false' define if the column will be shown on the datatable of not. This
                                                                                                       means that the column will start as hidden on the table, but if canShow is
                                                                                                       defined as true then the column can be displayed.
                                                                                        'show'      => 'true/false' define if the column can be show or not. This define that the
                                                                                                       column can be diplayed on the table of not, if is set to 'false' then never
                                                                                                       will be displayed.
                                                                                    ],
                                                                                ]
                                                                The only one field that is totally required is data with the name of the field to display, if you are sending dtData,
                                                                then the entire dtColumns is not required.
                                                                Note: if you are runing as server side processing only url field all the others are required to display the datatable.
--}}

<table id="{{ $dtId }}" class="display {{ $dtClass }}" style="width: 100%; {{ $dtStyle }}">
    <thead>
        <tr>
            @foreach ($dtColumns as $columns)
                @if ($columns['show'] == 'true')
                    <th class="{{ $columns['class']}}">{{ $columns['title'] }}</th>
                @endif
            @endforeach
        </tr>
    </thead>
    @if ($dtServerSide == 'false')
        <tbody>
            @foreach($dtData as $data)
            <tr style="vertical-align:top">
                @foreach ($dtColumns as $column)
                    @if (strpos($column['data'], '->') !== false)
                        @php
                        dd($column);
                            $startField = $column['data'];
                            $relations = explode('->', $startField);
                            $value = $data;
                            $finalField = '';
                            $i = 0;
                            foreach ($relations as $relation) {
                                try {
                                    $value = $value[$relation];
                                    $finalField = $relation;
                                } catch (\Throwable $th) {
                                    dd($relations, $relation, $value, $value[$relation]);
                                }
                            }
                            $finalValue = $value;
                            $finalType = $column['type'];
                            $isRelation = true;
                        @endphp
                    @else
                        @php
                            $startField = $column['data'];
                            $finalValue = $data[$column['data']];
                            $finalType  = $column['type'];
                            $finalField = $startField;
                            $isRelation = false;
                        @endphp
                    @endif

                    @if ($column['url'] != '')
                        @php
                            /** This code obtain the url and replace the fields to get the correct url **/
                            $urlArray = explode('**', $column['url']);
                            foreach ($urlArray as $urlData) {
                                if (strpos($urlData, 'field=') === 0) {
                                    $column['url'] = $url = str_replace('**field='.$startField.'**', $finalValue, $column['url']);
                                    $data[$column['data']] = $finalField;
                                }
                            }
                        @endphp
                        <td style="{{ $column['style'] }}"><a href="{!! $column['url'] !!}">{!! $finalValue !!}</a></td>
                    @else
                        @if ($isRelation)
                            @if ($finalType == 'date')
                                @if ((strlen($finalValue) > 5) && (is_numeric(strtotime($finalValue))))
                                    <td>{!! date('j M Y h:i a', strtotime($finalValue)) !!}</td>
                                @else
                                    <td style="{{ $column['style']}}">{{ $finalValue }}</td>
                                @endif
                            @else
                                <td style="{{ $column['style']}}">{{ $finalValue }}</td>
                            @endif
                        @else
                            @if ($finalType == 'date')
                                @if ((strlen($data[$column['data']]) > 5) && (is_numeric(strtotime($data[$column['data']]))))
                                    <td>{!! date('j M Y h:i a', strtotime($data[$column['data']])) !!}</td>
                                @else
                                    @if (array_key_exists($column['data'], $data))
                                        <td style="{{ $column['style'] }}">{!! $data[$column['data']] !!}</td>
                                    @else
                                        <td> </td>
                                    @endif
                                @endif
                            @else
                                @if (array_key_exists($column['data'], $data))
                                    <td style="{{ $column['style'] }}">{!! $data[$column['data']] !!}</td>
                                @else
                                    <td> </td>
                                @endif
                            @endif
                        @endif
                    @endif
                @endforeach
            </tr>
            @endforeach
        </tbody>
    @endif
    <tfoot>
        <tr>
            @foreach ($dtColumns as $columns)
                @if ($columns['show'] == 'true')
                    <th class="{{ $columns['class']}}">{{ $columns['title'] }}</th>
                @endif
            @endforeach
        </tr>
    </tfoot>
  </table>
<style>
.dataTables_wrapper .dt-buttons {
    position: relative;
    float: none;
    text-align: center;
}
.dt-button.red {
    color: red;
}
.dt-button.orange {
    color: orange;
}
.dt-button.green {
    color: green;
}
</style>
@if ($dtCount == 1)
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.11.4/b-2.2.2/b-colvis-2.2.2/b-html5-2.2.2/b-print-2.2.2/cr-1.5.5/date-1.1.2/fc-4.0.2/fh-3.2.2/kt-2.6.4/r-2.2.9/rg-1.1.4/rr-1.2.8/sc-2.0.5/sb-1.3.1/sp-1.4.0/sl-1.3.4/sr-1.1.0/datatables.min.css" defer/>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js" defer></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js" defer></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.11.4/b-2.2.2/b-colvis-2.2.2/b-html5-2.2.2/b-print-2.2.2/cr-1.5.5/date-1.1.2/fc-4.0.2/fh-3.2.2/kt-2.6.4/r-2.2.9/rg-1.1.4/rr-1.2.8/sc-2.0.5/sb-1.3.1/sp-1.4.0/sl-1.3.4/sr-1.1.0/datatables.min.js" defer></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js" defer></script>
@endif

  <script type="text/javascript">
    $(document).ready(function(){
        var dtTable = $('#{{ $dtId }}').DataTable({
            "responsive": true,
            "processing": {{ $dtServerSide }},
            "serverSide": {{ $dtServerSide }},
            "order": [[0, 'desc']],
            "stateSave": {{ $dtStateSave }},
            "colReorder": {{ $dtColReorder }},
            "searching": {{ $dtSearchBox }},
            "lengthMenu": [ 10, 25, 50, 75, 100, 250, 500, 750, 1000, 1500, 2000, 3000 ],
            @if ($dtServerSide == 'true')
                "ajax": {
                    "url": "{{ $dtAjaxUrl }}",
                    "dataType": "{{ $dtAjaxDataType }}",
                    "type": "{{ $dtAjaxType }}",
                    "data": {_token: "{{csrf_token()}}"{!! ($dtExtraAjax != '')?$dtExtraAjax:'' !!}}
                },
            @endif
            "columns": [
                @foreach ($dtColumns as $columns)
                    @if ($columns['show'] == 'true')
                        {"width": "{{ $columns['width'] }}", "data": "{{ $columns['data'] }}", "orderable": "{{ $columns['orderable'] }}", "visible": "{{$columns['visible'] }}"},
                    @endif
                @endforeach
            ]
        });

        @if ($dtExport == 'true')
            new $.fn.dataTable.Buttons( dtTable, {
                buttons: [
                    {
                        extend: 'collection',
                        text: 'Export',
                        className: 'custom-html-collection green',
                        select: false,
                        buttons: [
                            @foreach ($dtExportBtns as $buttons)
                                {
                                    extend: "{!! $buttons['type'] !!}",
                                    text: "{!! $buttons['title'] !!}",
                                    title: "{{ $dtName . date('dmY') }}",
                                    className: 'orange'
                                },
                            @endforeach
                        ]
                    }
                ]
            });

            dtTable.buttons( 0, null ).container().prependTo(
                dtTable.table().container()
            );
        @endif
        @if ($dtVisibility == 'true')
            new $.fn.dataTable.Buttons( dtTable, {
                buttons: [
                    {
                        extend: 'colvis',
                        className: 'custom-html-collection green',
                    }
                ]
            });

            dtTable.buttons( 0, null ).container().prependTo(
                dtTable.table().container()
            );
        @endif

    });
  </script>

