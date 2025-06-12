<?php

namespace shein\util;

class TimeUtil {
	
	static function currentTimeMillis() {
		list($t1, $t2) = explode(' ', microtime());
        $msectime = (float)(floatval($t1) + floatval($t2)) * 1000;
        return substr($msectime,0,13);
	}

}