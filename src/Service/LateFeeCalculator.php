<?php

namespace App\Service;

use DateTimeInterface;

class LateFeeCalculator
{

    public function calculateLateFee(\DateTime $dueDate, \DateTime $returnDate)
    {
        $prix = 0;
        $retard = $returnDate->getTimestamp() - $dueDate->getTimestamp();
        if ($retard  > 0)
        {
            for ($i = 0; $i < $retard; $i += 86400)
            {
                $prix += 0.5;
            }
        }
        return $prix;
    }
}