<?php

namespace App\Traits;

trait DateTimeTrait
{
    /**
     * Convertit des secondes en hh:mm:ss
     * @param  [integer] $seconds   Secondes
     * @return [string]             Secondes en hh:mm:ss
     */
    public function secondsToHhmmss($seconds) {
      $t = round($seconds);
      return sprintf('%02d:%02d:%02d', ($t/3600),($t/60%60), $t%60);
    }
}
