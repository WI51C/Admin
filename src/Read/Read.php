<?php

namespace Admin\Read;

use Admin\ModuleInterface;
use Admin\Read\Renderer\TableRenderer;
use Admin\Read\Tables\Table;

class Read extends Table implements ModuleInterface
{

    /**
     * Renders the read Module.
     *
     * @return string
     */
    public function render()
    {
        $renderer = new TableRenderer();
        $renderer->setHeaders(['Username', 'Email']);
        $renderer->setColumns(['Username', 'Email']);
        $renderer->setData([
                               [
                                   'Username' => 'Thomas',
                                   'Email'    => 'thom-mas@hotmail.com',
                               ],
                               [
                                   'Username' => 'Kasper',
                                   'Email'    => 'kasp-mas@hotmail.com',
                               ],
                           ]);

        return $renderer->render();
    }
}
