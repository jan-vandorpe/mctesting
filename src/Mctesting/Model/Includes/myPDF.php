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
        //$this->SetFillColor(250, 180, 200);
        //Set the interior cell margin to 1cm
        $this->cMargin = 5;

        $this->SetLineWidth(0.7);
        //Print 2 Cells
        //$this->SetTopMargin(50);
        $this->Cell(190, 20, $test->getTestName(), 'LTR', 1, 'L', 0);

        $this->SetFontSize(20);

        $this->Cell(190, 15, "Per vraag is maar 1 correct antwoord mogelijk", 'LR', 1, 'L', 0);

        $this->SetFontSize(15);

        $this->cMargin = 10;

        $this->Cell(190, 10, "Categorie: " . ucfirst($catname), 'LR', 1, 'L', 0);

        $this->SetFontSize(11);

        $this->Cell(190, 11, "Maximum Duurtijd: " . $test->getTestMaxDuration() . " minuten.", 'LBR', 1, 'L', 0);

        $questions = $test->getQuestions();

        $this->SetFontSize(12);
        $this->SetLineWidth(0.2);

        $i = 1;
        foreach ($questions as $question) {

            //filter out <p> and </p>
            $vraag = str_replace("<p>", "", $question->getText());
            $vraag = str_replace("</p>", "", $vraag);

            //decode special signs to UTF-8
            $vraag = html_entity_decode($vraag);
            $vraag = iconv('UTF-8', 'windows-1252', $vraag);

            $this->Cell(190, 10, "", '', 1, 'L', 0);
            $this->cMargin = 5;
            $this->Cell(190, 10, "Vraag " . $i, 'LTR', 1, 'L', 0);
            $this->SetFontSize(18);
            $this->cMargin = 10;
            $this->MultiCell(190, 8, $vraag, 'LR', 'L', 0);
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
            $this->Cell(190, 1, "", 'T', 1, 'L', 0);

            $i++;
        }

        $this->Output();
    }

}
