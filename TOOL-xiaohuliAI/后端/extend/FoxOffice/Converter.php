<?php

namespace FoxOffice;
use Smalot\PdfParser\Parser;
use Mpdf\Mpdf;

class Converter
{
    private $bin;

    public function __construct($bin = 'soffice')
    {
        /*if ($bin == 'libreoffice' && strtolower(substr(PHP_OS, 0, 3)) === 'win') {
            $bin = 'soffice';
        }*/

        $this->bin = $bin;
    }

    /**
     * @param $file String Real file path
     */
    public function doc2pdf($file, $outExt = 'pdf')
    {
        if (!file_exists(realpath($file))) {
            throw new \Exception('没找到要转换的文件');
        }

        $oriExt = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        // 临时兼容txt乱码问题，先转成html再转pdf
        if ($oriExt == 'txt' && $outExt = 'pdf') {
            return $this->txt2pdf($file);
        }

        // 验证格式是否支持
        if (!array_key_exists($oriExt, $this->getAllowedConverter())) {
            throw new \Exception('不支持的文件类型 - ' . $oriExt);
        }
        $allowOutExts = $this->getAllowedConverter($oriExt);
        if (!in_array($outExt, $allowOutExts)) {
            throw new \Exception("此文件不支持转成{$outExt}格式");
        }

        // 拼接命令开始转换
        $cmd = $this->makeCommand(realpath($file), $outExt);
        $this->exec($cmd);

        // 转换完删除html临时文件
        if ($oriExt == 'html') {
            @unlink($file);
        }

        return dirname($file) . '/' . basename($file, '.' . $oriExt) . '.' . $outExt;
    }

    private function txt2pdf($file)
    {
        ini_set('pcre.backtrack_limit', '100000000');
        $content = file_get_contents($file);
        $content = str_replace("\n", '<br>', trim($content));
        $content = '<html><head><style type="text/css">body { font-size: 16px; font-family: "Microsoft YaHei"; line-height: 1.5; color: #222; }</style></head><body>' . $content . '</body></html>';

        $Mpdf = new Mpdf([
            'autoScriptToLang' => true,
            'autoLangToFont' => true,
            'useSubstitutions' => true,
            'useAdobeCJK' => true,
            'ignore_invalid_utf8' => true,
            'default_font' => 'Microsoft YaHei'
        ]);
        $Mpdf->WriteHTML($content);
        $pdfPath = dirname($file) . '/' . basename($file, '.txt') . '.pdf';
        $Mpdf->Output($pdfPath, 'F');
        return $pdfPath;
    }

    public function pdf2txt($file)
    {
        if (!file_exists(realpath($file))) {
            throw new \Exception('没找到要转换的文件');
        }
        try {
            $parser = new Parser();
            $pdf = $parser->parseFile(realpath($file));
            $text = $pdf->getText();
            $txtPath = str_replace('.pdf', '.txt', $file);
            file_put_contents($txtPath, trim($text));
            return $txtPath;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

    }

    protected function makeCommand($file, $outExt)
    {
        $oriFile = escapeshellarg($file);
        $outDir = escapeshellarg(dirname($file));
        return "{$this->bin} --headless --convert-to {$outExt} {$oriFile} --outdir {$outDir}";
    }

    private function getAllowedConverter($extension = null)
    {
        $allowedConverter = [
            '' => ['pdf'],
            'html' => ['pdf', 'docx'],
            'pptx' => ['pdf'],
            'ppt' => ['pdf'],
            'pdf' => ['pdf'],
            'docx' => ['pdf', 'odt', 'html'],
            'doc' => ['pdf', 'odt', 'html'],
            'wps' => ['pdf', 'odt', 'html'],
            'dotx' => ['pdf', 'odt', 'html'],
            'docm' => ['pdf', 'odt', 'html'],
            'dotm' => ['pdf', 'odt', 'html'],
            'dot' => ['pdf', 'odt', 'html'],
            'odt' => ['pdf', 'html'],
            'xlsx' => ['pdf'],
            'xls' => ['pdf'],
            'png' => ['pdf'],
            'jpg' => ['pdf'],
            'jpeg' => ['pdf'],
            'jfif' => ['pdf'],
            'PPTX' => ['pdf'],
            'PPT' => ['pdf'],
            'PDF' => ['pdf'],
            'DOCX' => ['pdf', 'odt', 'html'],
            'DOC' => ['pdf', 'odt', 'html'],
            'WPS' => ['pdf', 'odt', 'html'],
            'DOTX' => ['pdf', 'odt', 'html'],
            'DOCM' => ['pdf', 'odt', 'html'],
            'DOTM' => ['pdf', 'odt', 'html'],
            'DOT' => ['pdf', 'odt', 'html'],
            'ODT' => ['pdf', 'html'],
            'XLSX' => ['pdf'],
            'XLS' => ['pdf'],
            'PNG' => ['pdf'],
            'JPG' => ['pdf'],
            'JPEG' => ['pdf'],
            'JFIF' => ['pdf'],
            'Pptx' => ['pdf'],
            'Ppt' => ['pdf'],
            'Pdf' => ['pdf'],
            'Docx' => ['pdf', 'odt', 'html'],
            'Doc' => ['pdf', 'odt', 'html'],
            'Wps' => ['pdf', 'odt', 'html'],
            'Dotx' => ['pdf', 'odt', 'html'],
            'Docm' => ['pdf', 'odt', 'html'],
            'Dotm' => ['pdf', 'odt', 'html'],
            'Dot' => ['pdf', 'odt', 'html'],
            'Ddt' => ['pdf', 'html'],
            'Xlsx' => ['pdf'],
            'Xls' => ['pdf'],
            'Png' => ['pdf'],
            'Jpg' => ['pdf'],
            'Jpeg' => ['pdf'],
            'Jfif' => ['pdf'],
            'rtf' => ['docx', 'txt', 'pdf'],
            'txt' => ['pdf', 'odt', 'doc', 'docx', 'html'],
            'csv' => ['pdf'],
        ];

        if (null !== $extension) {
            if (isset($allowedConverter[$extension])) {
                return $allowedConverter[$extension];
            }

            return [];
        }

        return $allowedConverter;
    }

    private function exec($cmd)
    {
        try {
            $result = shell_exec($cmd);
            $arr = explode("\n", trim($result));
            $result = end($arr);
            if (strpos($result, 'Error: ') !== false) {
                throw new \Exception($result);
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
