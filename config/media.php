<?php

return [
    'max_width' => (int) env('IMAGE_MAX_WIDTH', 1600),
    'max_height' => (int) env('IMAGE_MAX_HEIGHT', 1600),
    'quality' => (int) env('IMAGE_QUALITY', 80),
    'thumb_width' => (int) env('IMAGE_THUMB_WIDTH', 600),
    'max_upload_size' => (int) env('IMAGE_MAX_UPLOAD_SIZE', 5120),
];
