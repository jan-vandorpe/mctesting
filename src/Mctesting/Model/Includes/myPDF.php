<?php

namespace Mctesting\Model\Includes;

use Mctesting\Model\Includes\FPDF;

class myPDF extends FPDF {

    function __construct() {
        parent::FPDF();
    }

    function createMyPage($test, $catname) {

        $this->AddPage();
        $this->SetFont('Arial', '', 30);

        //Set the interior cell margin to 1cm
        $this->cMargin = 5;

        //Make border for heading box thicker
        $this->SetLineWidth(0.7);

        //TestName
        $this->Cell(190, 20, $test->getTestName(), 'LTR', 1, 'L', 0);

        $this->SetFontSize(20);
        $this->Cell(190, 15, "Per vraag is maar 1 correct antwoord mogelijk", 'LR', 1, 'L', 0);
        $this->SetFontSize(15);

        //indent
        $this->cMargin = 10;
        $this->Cell(190, 10, "Categorie: " . ucfirst($catname), 'LR', 1, 'L', 0);

        $this->SetFontSize(11);
        $this->Cell(190, 11, "Maximum Duurtijd: " . $test->getTestMaxDuration() . " minuten.", 'LBR', 1, 'L', 0);

        $questions = $test->getQuestions();

        $this->SetFontSize(12);
        $this->SetLineWidth(0.2);

        $i = 1;
        
        //**   VRAAG   **//
        
        foreach ($questions as $question) {

            //filter out <p> and </p>
            $vraag = str_replace("<p>", "", $question->getText());
            $vraag = str_replace("</p>", "", $vraag);

            //decode special signs to UTF-8
            $vraag = html_entity_decode($vraag);
            $vraag = iconv('UTF-8', 'windows-1252', $vraag);

//            foreach ($question->getMedia() as $image) {
//                $file = $image;
//            }



            $this->Cell(190, 10, "", '', 1, 'L', 0);
            $this->cMargin = 5;
            $this->Cell(190, 10, "Vraag " . $i, 'LTR', 1, 'L', 0);
            $this->SetFontSize(18);
            $this->cMargin = 10;

            $x = $this->GetX();
            $y = $this->GetY();
            
            //** Vraag-Cell korter maken zodat er een image naast kan komen **//

            $this->MultiCell(150, 8, $vraag, 'LR', 'L', 0);
            
            //hoogte van de vraag berekenen (als het een lange vraag is komt hij op meerdere lijnen
            $height = $this->GetMultiCellHeight(150, 8, $vraag);

            $media = $question->getMedia();
            
            
            //als er een image bij de vraag zit
            if (count($media) > 0) {
                $file = $question->getMedia();
                $filePath = $_SERVER['DOCUMENT_ROOT'] . ROOT . "/public/images/" . $file[0];
                
                //cursor op de juiste positie zetten naast de vraagbox
                $this->SetXY($x + 150, $y);

                
                $this->Cell(40, 8, $this->Image($filePath, null, null, 40), 'R', 1, 'R', 0);
                
                $this->Ln(0);
                $this->SetXY($x , $y + $height);
                $this->Cell(40, 40, 'd', 'RBLT', 1, 'L', 0);

                //var_dump($filePath);
            } else {
                $this->SetXY($x + 150, $y);
                $this->Cell(40, $height, 'd', 'RBLT', 1, 'L', 0);
                $this->Ln(0);
            }

            

            $this->Cell(190, 4, "", 'LBR', 1, 'L', 0);


            $answers = $question->getAnswers();
            $j = 1;
            $this->SetFontSize(12);
            $this->cMargin = 13;
            foreach ($answers as $answer) {

                //filter out <p> and </p>
                $text = str_replace("<p>", "", $answer->getText());
                $text = str_replace("</p>", "", $text);

                //decode special signs to UTF-8
                $text = html_entity_decode($text);
                $text = iconv('UTF-8', 'windows-1252', $text);

                $this->MultiCell(190, 13, $text, 'LR', 'L', 0);
                $xPlace = $this->GetX() + 4;
                $yPlace = $this->GetY() + 4 - 13;
                $this->Rect($xPlace, $yPlace, 5, 5);
                $j++;
            }
            $this->Cell(190, 0, "", 'T', 1, 'L', 0);

            $i++;
        }

        $this->Output();
    }

    function GetMultiCellHeight($w, $h, $txt, $border = null, $align = 'J') {
        // Calculate MultiCell with automatic or explicit line breaks height
        // $border is un-used, but I kept it in the parameters to keep the call
        //   to this function consistent with MultiCell()
        $cw = &$this->CurrentFont['cw'];
        if ($w == 0)
            $w = $this->w - $this->rMargin - $this->x;
        $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
        $s = str_replace("\r", '', $txt);
        $nb = strlen($s);
        if ($nb > 0 && $s[$nb - 1] == "\n")
            $nb--;
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $ns = 0;
        $height = 0;
        while ($i < $nb) {
            // Get next character
            $c = $s[$i];
            if ($c == "\n") {
                // Explicit line break
                if ($this->ws > 0) {
                    $this->ws = 0;
                    $this->_out('0 Tw');
                }
                //Increase Height
                $height += $h;
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $ns = 0;
                continue;
            }
            if ($c == ' ') {
                $sep = $i;
                $ls = $l;
                $ns++;
            }
            $l += $cw[$c];
            if ($l > $wmax) {
                // Automatic line break
                if ($sep == -1) {
                    if ($i == $j)
                        $i++;
                    if ($this->ws > 0) {
                        $this->ws = 0;
                        $this->_out('0 Tw');
                    }
                    //Increase Height
                    $height += $h;
                } else {
                    if ($align == 'J') {
                        $this->ws = ($ns > 1) ? ($wmax - $ls) / 1000 * $this->FontSize / ($ns - 1) : 0;
                        $this->_out(sprintf('%.3F Tw', $this->ws * $this->k));
                    }
                    //Increase Height
                    $height += $h;
                    $i = $sep + 1;
                }
                $sep = -1;
                $j = $i;
                $l = 0;
                $ns = 0;
            } else
                $i++;
        }
        // Last chunk
        if ($this->ws > 0) {
            $this->ws = 0;
            $this->_out('0 Tw');
        }
        //Increase Height
        $height += $h;

        return $height;
    }

}
