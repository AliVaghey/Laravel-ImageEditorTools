<?php

function imageEditor(string $sourcePath): \Vaghey\ImageEditor\AbstractImageEditor
{
    return new Vaghey\ImageEditor\AbstractImageEditor($sourcePath);
}
