<?php
/**
 * Created by PhpStorm.
 * User: Peter Bustraan
 * Date: 10/1/2017
 * Time: 2:25 PM
 */

namespace PeterBustraan\VapeCalculator\Helper;


class Ohmlaw
{
    protected $volts = 0.0;
    protected $ohms  = 0.0;
    protected $amps  = 0.0;
    protected $watts = 0.0;

    public function __construct(array $values)
    {
        $this->volts = $values['volts'];
        $this->ohms  = $values['ohms'];
        $this->amps  = $values['amps'];
        $this->watts = $values['watts'];
        $this->determineTriangles();
    }

    protected function determineTriangles()
    {
        try
        {
            if ((is_numeric($this->watts) && $this->watts > 0.0))
            {
                $this->powerTriangles();
            }
            elseif ((is_numeric($this->volts) && $this->volts > 0.0))
            {
                $this->voltsTriangles();
            }
            elseif ((is_numeric($this->ohms) && $this->ohms > 0.0))
            {
                $this->resistanceTriangles();
            }
            elseif ((is_numeric($this->amps) && $this->amps > 0.0))
            {
                $this->drainTriangles();
            }
            else
            {
                $this->returnValues();
            }
        }
        catch (\Exception $e)
        {
            //TODO: Produce friendly error!!
        }
    }

    protected function powerTriangles()
    {
        if (is_numeric($this->volts) && $this->volts > 0)
        {
            $this->ohms  = pow($this->volts,2) / $this->watts;
            $this->amps  = $this->watts / $this->volts;
        }
        elseif (is_numeric($this->ohms) && $this->ohms > 0)
        {
            $this->volts = sqrt(($this->watts * $this->ohms));
            $this->amps  = sqrt(($this->watts / $this->ohms));
        }
        elseif (is_numeric($this->amps) && $this->amps > 0)
        {
            $this->ohms  = $this->watts / pow($this->amps,2);
            $this->volts = $this->watts / $this->amps;
        }
    }

    protected function voltsTriangles()
    {
        if(is_numeric($this->watts) && $this->watts > 0)
        {
            $this->ohms  = pow($this->volts,2) / $this->watts;
            $this->amps  = $this->watts / $this->volts;
        }
        elseif (is_numeric($this->ohms) && $this->ohms > 0)
        {
            $this->watts = pow($this->volts,2) / $this->ohms;
            $this->amps  = $this->volts / $this->ohms;
        }
        elseif (is_numeric($this->amps) && $this->amps > 0)
        {
            $this->watts = $this->volts * $this->amps;
            $this->ohms  = $this->volts / $this->amps;
        }
    }

    protected function resistanceTriangles()
    {
        if (is_numeric($this->watts) && $this->watts > 0)
        {
            $this->amps  = $this->volts / $this->ohms;
            $this->volts = sqrt(($this->watts * $this->ohms));
        }
        elseif (is_numeric($this->volts) && $this->volts > 0)
        {
            $this->watts = pow($this->volts, 2) / $this->ohms;
            $this->amps  = sqrt(($this->watts/$this->ohms));
        }
        elseif (is_numeric($this->amps) && $this->amps > 0)
        {
            $this->volts = $this->amps * $this->ohms;
            $this->watts = $this->ohms * pow($this->amps,2);
        }
    }

    protected function drainTriangles()
    {
        if (is_numeric($this->watts) && $this->watts > 0)
        {
            $this->volts = $this->watts / $this->amps;
            $this->ohms  = $this->watts / pow($this->amps,2);
        }
        elseif (is_numeric($this->volts) && $this->volts > 0)
        {
            $this->watts = $this->amps * $this->volts;
            $this->ohms  = $this->volts / $this->amps;
        }
        elseif (is_numeric($this->ohms) && $this->ohms > 0)
        {
            $this->watts = $this->ohms * pow($this->amps,2);
            $this->volts = $this->amps * $this->ohms;
        }
    }

    public function returnValues()
    {
        $volts  = $this->volts;
        $ohms   = $this->ohms;
        $amps   = $this->amps;
        $watts  = $this->watts;

        $resultSet = array(
            'volts' => number_format((float)$volts,2, '.',''),
            'ohms'  => number_format((float)$ohms,2, '.',''),
            'amps'  => number_format((float)$amps,2, '.',''),
            'watts' => number_format((float)$watts,2, '.','')
        );

        return $resultSet;
    }

}