<?php

namespace Mctesting\Model\Includes;

use Mctesting\Model\Includes\FPDF;

class myPDF extends FPDF {

    const MAX_WIDTH = 150;
    const MAX_HEIGHT = 100;
    const DPI = 96;
    const MM_IN_INCH = 25.4;

    function __construct() {
        parent::FPDF();
    }

    function createMyPage($test, $catname) {

        $this->AddPage();
        $this->SetFont('Arial', '', 30);

        $pageHeight = $this->h;

        //var_dump($pageHeight);
        //Set the interior cell margin to 1cm
        $this->cMargin = 5;

        //$this->SetTopMargin(10);
        //Make border for heading box thicker
        $this->SetLineWidth(0.7);

        //Invullen RRNr & Naam
        $this->SetFontSize(13);
        
        $this->Cell(190, 10, 'Voornaam: ..................................................', '', 1, 'L', 0);
        $this->Cell(190, 10, 'Familienaam: ..............................................', '',1, 'L', 0);
        
        $this->Cell(190, 10, 'Rijksregisternummer: ..................................', '', 1, 'L', 0);
        
        
        $this->SetLineWidth(0.2);
        $this->Cell(190,3, "", '', 1, 'L', 0);
        

        //TestName
        $this->SetFontSize(30);
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

            //***** Hoogt van box berekenen voor page-breaks *****//

            $totalHeight = 0;

            //hoogte van antwoorden
            $answers = $question->getAnswers();
            $length = count($answers);

            //hoogte images berekenen bij antwoorden

            foreach ($answers as $answer) {
                //voor elke answer de eventuele image ophalen
                $answerMedia = $answer->getMedia();
                if (count($answerMedia) > 0) {
                    //als er een image is, de hoogte berekenen
                    $answerMediaPath = $_SERVER['DOCUMENT_ROOT'] . ROOT . "/public/images/" . $answerMedia;
                    list($awd, $ahg) = $this->resizeToFit($answerMediaPath);
                    //hoogte image aftrekken met 13 (hoogte van de vraag zelf die er achteraf bij opgeteld wordt)
                    $totalHeight += $ahg - 13;
                }
            }

            $heightAnswers = $length * 13;

            $totalHeight += $heightAnswers;

            $heightImg = 0;
            $c = 0;

            //hoogte van eventuele image
            $media = $question->getMedia();
            if (count($media) > 0) {

                while ($c < count($media)) {
                    $filePath = $_SERVER['DOCUMENT_ROOT'] . ROOT . "/public/images/" . $media[$c];
                    list($wd, $hg) = $this->resizeToFit($filePath);
                    $heightImg += $hg;
                    $heightImg += 3;
                    $c++;
                }

                $c = 0;
            }

            $totalHeight += $heightImg;


            //filter out <p> and </p>
            //$vraag = str_replace("<p>", "", $question->getText());
            //$vraag = str_replace("</p>", "", $vraag);
            $vraag = $question->getText();
            $vraag = preg_replace("/\<[^>]+\>/", "", $vraag);
            //decode special signs to UTF-8
            $vraag = html_entity_decode($vraag);
            $vraag = iconv('UTF-8', 'windows-1252', $vraag);

            //hoogte vraag berekenen
            $height = $this->GetMultiCellHeight(145, 8, $vraag);

            if ($height > $heightImg) {
                $totalHeight += $height;
            }

            $totalHeight += 20;



            //var_dump($totalHeight);
            //Whitespace tussen vragen
            $this->Cell(190, 10, "", '', 1, 'L', 0);
            $this->cMargin = 5;

            // Y- positie ophalen, aftrekken van volledig document en kijken of dit kleiner is 
            // dan de hoogte van de te genereren box
            // --> anders pagebreak


            $currentY = $this->GetY();

            //var_dump((int) $currentY + (int) $totalHeight + 20);

            if (((int) $currentY + (int) $totalHeight) > (int) $pageHeight - 20) {

                $this->AddPage();
            }


            $this->SetFillColor(245);

            $this->Cell(190, 10, "Vraag " . $i, 'LTR', 1, 'L', 0);
            $this->SetFontSize(18);
            $this->cMargin = 10;

            $x = $this->GetX();
            $y = $this->GetY();

            //** Vraag-Cell korter maken zodat er een image naast kan komen **//

            $this->MultiCell(145, 8, $vraag, 'L', 'L', 0);

            //hoogte van de vraag berekenen (als het een lange vraag is komt hij op meerdere lijnen
            $height = $this->GetMultiCellHeight(145, 8, $vraag);
            //als er een image bij de vraag zit


            $imgHeight = 0;

            if (count($media) > 0) {

                while ($c < count($media)) {

                    $file = $question->getMedia();
                    $filePath = $_SERVER['DOCUMENT_ROOT'] . ROOT . "/public/images/" . $file[$c];
                    //cursor op de juiste positie zetten naast de vraagbox
                    $this->SetXY($x + 145, $y + $imgHeight);

                    //zorgen dat image nooit groter is dan constante vanboven gedeclareerd
                    list($wd, $hg) = $this->resizeToFit($filePath);

                    //image genereren
                    $this->Cell(45, $hg, $this->Image($filePath, $this->GetX(), $this->GetY(), $wd, $hg), 'R', 0, 'C', 0);

                    //naar een nieuwe lijn gaan
                    $this->Ln(0);

                    //cursur verlagen met de hoogte van de afbeelding
                    $this->SetXY($x, $y + $height);
                    $imgHeight += $hg;

                    $this->SetXY($x + 145, $y + $imgHeight);
                    $this->Cell(45, 3, '', 'R', 0, 'C', 0);
                    $this->Ln(0);
                    $this->SetXY($x, $y + $height);
                    $imgHeight += 3;
                    $c++;
                }

                //** cel ONDER vraag die compenseert voor de hoogte van de afbeelding **//
                $this->Cell(40, $imgHeight - $height - 3, '', 'L', 1, 'L', 0);
            } else {
                $this->SetXY($x + 150, $y);

                //*** VERVANGCEL voor als er geen afbeelding is ***//
                $this->Cell(40, $height, '', 'R', 1, 'L', 0);
                $this->Ln(0);
            }




            //kotje van vraag afsluiten vanonder
            $this->Cell(190, 7, "", 'LBR', 1, 'L', 0);



            $j = 1;
            $this->SetFontSize(12);
            $this->cMargin = 13;
            foreach ($answers as $answer) {

                //filter out <p> and </p>
//                $text = str_replace("<p>", "", $answer->getText());
//                $text = str_replace("</p>", "", $text);

                $text = $answer->getText();
                $text = preg_replace("/\<[^>]+\>/", "", $text);

                //decode special signs to UTF-8
                $text = html_entity_decode($text);
                $text = iconv('UTF-8', 'windows-1252', $text);

                //het antwoord

                $x = $this->GetX();
                $y = $this->GetY();

                //Image naast antwoord
                //get path naar image
                $answerMedia = $answer->getMedia();
                $answerMediaPath = $_SERVER['DOCUMENT_ROOT'] . ROOT . "/public/images/" . $answerMedia;

                //als er een image bestaat voor het antwoord
                if (count($answerMedia) > 0) {

                    //plaats maken boven eerste antwoord / image

                    $this->Cell(190, 5, "", 'LR', 1, 'L', 0);

                    $x = $this->GetX();
                    $y = $this->GetY();

                    //antwoord korter maken om er een image naast te kunnen pleuren
                    $this->MultiCell(145, 13, $text, 'L', 'L', 0);

                    //hoogte van de antwoord berekenen (als het een lange vraag is komt hij op meerdere lijnen
                    $aheight = $this->GetMultiCellHeight(145, 13, $text);


                    //var_dump($answerMediaPath);
                    //wat extra plaats aan de bovenkant voorzien
                    //$this->Cell(190, 10, "dd", "", 1, "L", 0);
                    //cursur op de juiste plaats zetten naast het antwoord
                    $this->Rect($x + 4, $y + 4, 5, 5);

                    $this->SetXY($x + 145, $y);

                    //zorgen dat image nooit groter is dan constante vanboven gedeclareerd
                    list($awd, $ahg) = $this->resizeToFit($answerMediaPath);

                    $this->Cell(45, $ahg, $this->Image($answerMediaPath, $this->GetX(), $this->GetY(), $awd, $ahg), 'R', 0, 'C', 0);
                    $this->Ln(0);
                    $this->SetXY($x, $y + $aheight);
                    //** cel ONDER antwoord die compenseert voor de hoogte van de afbeelding **//
                    $this->Cell(40, $ahg - $aheight + 5, '', 'L', 1, 'L', 0);

                    //nog cel maken om gap op te vullen
                    $this->setY($this->GetY() - 5);
                    $this->Cell(190, 5, '', 'R', 1, 'L', 0);
                } else {
                    $this->MultiCell(190, 13, $text, 'LR', 'L', 0);

                    //hoogte van de antwoord berekenen (als het een lange vraag is komt hij op meerdere lijnen
                    $aheight = $this->GetMultiCellHeight(190, 13, $text);


                    //positie van vraag zoeken om vierkant naast te plaatsen
                    $xPlace = $this->GetX() + 4;
                    $yPlace = $this->GetY() + 4 - 13;
                    $this->Rect($xPlace, $yPlace, 5, 5);
                    $j++;
                }
            }
            $this->Cell(190, 0, "", 'T', 1, 'L', 0);

            $i++;
        }

        $this->Output($test->getTestName() . ".pdf", 'D');
    }

    function resizeToFit($imgFilename) {
        list($width, $height) = getimagesize($imgFilename);

        $widthScale = self::MAX_WIDTH / $width;
        $heightScale = self::MAX_HEIGHT / $height;

        $scale = min($widthScale, $heightScale);

        return array(
            round($this->pixelsToMM($scale * $width)),
            round($this->pixelsToMM($scale * $height))
        );
    }

    function pixelsToMM($val) {
        return $val * self::MM_IN_INCH / self::DPI;
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
