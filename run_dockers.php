<?php
    for ($i = 1; $i <= 30; $i++)
    {
        $run = 'docker run --name war' . $i . ' -d -it -p "' . (9000+$i) . ':80" -p "' . (2200+$i) . ':22" wargame_ynovb2:wargame1';
        shell_exec($run);
    }

    sleep(10);

    for ($i = 1; $i <= 30; $i++)
    {
        $exec = 'docker exec -it war' . $i . ' bash /app/updatesql.sh';
        shell_exec($exec);
    }

