<?php

namespace App\Traits;

trait GetImage
{
    public function getThumbnail()
    {

        if (str_starts_with($this->image, 'https')) {
            return $this->image;
        }

        return '/storage/' . $this->image;
    }
}
