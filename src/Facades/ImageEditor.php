<?php

namespace Vaghey\ImageEditor\Facades;

use Vaghey\ImageEditor\AbstractImageEditor;

class ImageEditor
{
    static public function make($path): AbstractImageEditor
    {
        return new AbstractImageEditor($path);
    }
}
