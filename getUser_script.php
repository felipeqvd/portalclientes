<?php
	function getUsuario ($usuario, $dir = null)
	{
		if ($dir != null)
			$reader = fopen($dir . 'users.key','r');
		else
			$reader = fopen('./users.key','r');

		if ($reader !== false)
		{
			while (($linea = fgetcsv($reader, 200, ',')) !== false)
			{
				if (count($linea) > 0)
				{
					if ($usuario == $linea[0])
					{
						fclose($reader);
						return array('username' => $linea[1], 'password' => $linea[2]);
					}
				}
			}
		}

		fclose($reader);
	}
?>
