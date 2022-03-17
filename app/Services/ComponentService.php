<?php

namespace App\Services;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use App\Contracts\ComponentInterface;

class ComponentService implements ComponentInterface
{

    public function dataTableConfigObject($config = []) {
        $error = false;

        $object = [
            'dtId' => (array_key_exists('dtId', $config)?$config['dtId']:'dataTable'),                              // Required parameter.
            'dtCount' => (array_key_exists('dtCount', $config)?$config['dtCount']:1),
            'dtData' => (array_key_exists('dtData', $config)?$config['dtData']:[]),
            'dtClass' => (array_key_exists('dtClass', $config)?$config['dtClass']:''),
            'dtStyle' => (array_key_exists('dtStyle', $config)?$config['dtStyle']:''),
            'dtStateSave' => (array_key_exists('dtStateSave', $config)?$config['dtStateSave']:'false'),
            'dtColReorder' => (array_key_exists('dtColReorder', $config)?$config['dtColReorder']:'false'),
            'dtSearchBox' => (array_key_exists('dtSearchBox', $config)?$config['dtSearchBox']:'true'),
            'dtServerSide' => (array_key_exists('dtServerSide', $config)?$config['dtServerSide']:'true'),
            'dtAjaxType' => (array_key_exists('dtAjaxType', $config)?$config['dtAjaxType']:'POST'),
            'dtAjaxDataType' => (array_key_exists('dtAjaxDataType', $config)?$config['dtAjaxDataType']:'json'),
            'dtAjaxUrl' => (array_key_exists('dtAjaxUrl', $config)?$config['dtAjaxUrl']:''),                        // If dtAjax is true this parameter is required
            'dtExtraAjax' => (array_key_exists('dtExtraAjax', $config)?$config['dtExtraAjax']:''),
            'dtExport' =>  (array_key_exists('dtExport', $config)?$config['dtExport']:'false'),
            'dtName' => (array_key_exists('dtName', $config)?$config['dtName']:'export'),                           // Required parameter.
            'dtVisibility' =>  (array_key_exists('dtVisibility', $config)?$config['dtVisibility']:'false'),
        ];

        // If dtExport is true then dtExportBtns are required if not then is not required
        $expbtns = [];
        if ($object['dtExport'] == 'true') {
            if (array_key_exists('dtExportBtns', $config)) {
                foreach ($config['dtExportBtns'] as $buttons) {
                    $expbtns[] = $buttons;
                }
            } else {
                $expbtns =  [
                    [
                      'type' => 'print',
                      'title' => 'Print List',
                      'orientation' => 'landscape',
                      'pageSize' => 'LETTER',
                    ],[
                      'type' => 'csv',
                      'title' => 'CSV File',
                      'orientation' => 'landscape',
                      'pageSize' => 'LETTER',
                    ],[
                      'type' => 'excel',
                      'title' => 'Excel File XLS',
                      'orientation' => 'landscape',
                      'pageSize' => 'LETTER',
                    ],[
                      'type' => 'pdf',
                      'title' => 'Adobe PDF File',
                      'orientation' => 'landscape',
                      'pageSize' => 'LETTER',
                    ]
                ];
            }
        }

        $object['dtExportBtns'] = $expbtns;

        // dtColumns is a required parameter. need to have the array with all the parameters needed to display the table columns. Check datatable component for documentation.
        $columns = [];
        $i = 0;
        if (array_key_exists('dtColumns', $config)) {
            foreach ($config['dtColumns'] as $column) {
                $columns[$i]['data'] = (array_key_exists('data', $column)?$column['data']:'error'.rand(0,1000));
                if (array_key_exists('title', $column)) {
                    $columns[$i]['title'] = $column['title'];
                } else {
                    $title = str_replace('-', ' ', $columns[$i]['data']);
                    $title = str_replace('_', ' ', $title);
                    $columns[$i]['title'] = ucwords($title);
                }
                $columns[$i]['width'] = (array_key_exists('width', $column)?$column['width']:'');
                $columns[$i]['class'] = (array_key_exists('class', $column)?$column['class']:'');
                $columns[$i]['url'] = (array_key_exists('url', $column)?$column['url']:'');
                $columns[$i]['orderable'] = (array_key_exists('orderable', $column)?$column['orderable']:true);
                $columns[$i]['visible'] = (array_key_exists('visible', $column)?$column['visible']:'true');
                $columns[$i]['show'] = (array_key_exists('show', $column)?$column['show']:'true');
                $columns[$i]['style'] = (array_key_exists('style', $column)?$column['style']:'');
                $i++;
            }
        } else {
            $error = true;
        }

        $object['dtColumns'] = $columns;

        return $object;
    }
};
