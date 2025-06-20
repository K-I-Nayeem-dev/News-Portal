<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;
use Illuminate\Support\Facades\File;


class ProcessImageUpload implements ShouldQueue
{
    use Queueable;


    protected $photo, $path, $width, $height, $quality, $watermarkPath;

    public function __construct($photo, $path = 'uploads/', $width = null, $height = null, $quality = 80, $watermarkPath = null)
    {
        $this->photo = $photo;
        $this->path = $path;
        $this->width = $width;
        $this->height = $height;
        $this->quality = $quality;
        $this->watermarkPath = $watermarkPath;
    }

    public function handle()
    {
        $manager = new ImageManager(new Driver());

        $new_name = Str::random(5) . time() . '.' . $this->photo->getClientOriginalExtension();
        $full_path = public_path($this->path . $new_name);

        if (!File::exists(public_path($this->path))) {
            File::makeDirectory(public_path($this->path), 0755, true);
        }

        $image = $manager->read($this->photo);

        if ($this->width && $this->height) {
            $image->resize($this->width, $this->height);
        }

        if ($this->watermarkPath && File::exists(public_path($this->watermarkPath))) {
            $image->place(public_path($this->watermarkPath), 'bottom');
        }

        $image->save($full_path, quality: $this->quality);

        return $this->path . $new_name;
    }
}