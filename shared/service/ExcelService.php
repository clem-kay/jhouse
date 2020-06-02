<?php

namespace Service;

use Constant\FileType;
use Entity\UploadFile;
use PHPExcel_IOFactory;

/**
 * Description of ExcelService
 *
 * @author Thomasino
 */
class ExcelService extends \Core\Service\Service {

    const parent_key = 'parent';
    const children_key = 'children';

    /**
     * 
     * @param UploadFile $file
     */
    public function getDataFromFile(UploadFile $file) {

        $path = $file->getAbsolutePath();
        $objPHPExcel = PHPExcel_IOFactory::load($path);

        // we are looping on the sheet
        $sheetsData = array();
        $categoryExist = $itemExist = true;
        $totalSheet = $objPHPExcel->getSheetCount();

        for ($i = 0; $i < $totalSheet; $i++) {
            $sheet = $objPHPExcel->getSheet($i);
            $categoryExist = ($sheet->getCell('A1')->getValue() && $sheet->getCell('A2')->getValue());
            $itemExist = ($sheet->getCell('A5')->getValue() && $sheet->getCell('A6')->getValue());
            if ($categoryExist || $itemExist) {
                $sheetsData[] = $this->loadExcelSheet($sheet);
            }
        }
        
        // deleting the file after reading its data
        $file->deleteFile();

        return $sheetsData;
    }

    /**
     * 
     * @param \PHPExcel_Worksheet $sheet
     * @return array
     */
    private function loadExcelSheet(\PHPExcel_Worksheet $sheet) {
        $result['title'] = $sheet->getTitle();
        $result[self::parent_key] = [];
        $result[self::children_key] = [];

        //loading of categories
        if ($sheet->getCell('A1')->getFormattedValue() && $sheet->getCell('A2')->getFormattedValue()) {
            $categ = [];
            $column = 'A';
            do {
                $categ[$sheet->getCell($column . '1')->getFormattedValue()] = $sheet->getCell($column . '2')->getFormattedValue();
                $column++;
            } while ($sheet->getCell($column . '1')->getFormattedValue());

            $result[self::parent_key] = $categ;
        }

        // loading of Items
        if ($sheet->getCell('A5')->getFormattedValue() && $sheet->getCell('A6')->getFormattedValue()) {
            $items = [];
            $itemAttribs = [];

            // we are reading the items properties
            $column = 'A';
            do {
                $itemAttribs[] = $sheet->getCell($column . '5')->getFormattedValue();
                $column++;
            } while ($sheet->getCell($column . '5')->getFormattedValue());

            // we are reading the items values
            $line = 6;
            do {
                $column = 'A';
                foreach ($itemAttribs as $index => $attr) {
                    $item[$attr] = $sheet->getCell($column . $line)->getFormattedValue();
                    $column++;
                }
                $items[] = $item;
                $line++;
            } while ($sheet->getCell('A' . $line)->getFormattedValue());

            $result[self::children_key] = $items;
        }


        return $result;
    }

    

    
}
