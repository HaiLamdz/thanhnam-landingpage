<?php

namespace Database\Seeders;

use App\Models\ActivityImage;
use Illuminate\Database\Seeder;

class ActivityImageSeeder extends Seeder
{
    public function run(): void
    {
        $images = [
            [
                'title' => 'Thi công ép cọc Thành Nam',
                'caption' => 'Hình ảnh thi công ép cọc bê tông tại công trường.',
                'image_path' => 'images/Aspose.Words.4bc199bf-9f3d-489a-a241-0b9706d15e84.033.png',
            ],
            [
                'title' => 'Công trình nền móng Thành Nam',
                'caption' => 'Máy móc và công nhân thi công công trình nền móng.',
                'image_path' => 'images/Aspose.Words.4bc199bf-9f3d-489a-a241-0b9706d15e84.034.png',
            ],
            [
                'title' => 'Hoạt động thi công Thành Nam',
                'caption' => 'Hoạt động thi công ngoài hiện trường.',
                'image_path' => 'images/Aspose.Words.4bc199bf-9f3d-489a-a241-0b9706d15e84.035.png',
            ],
            [
                'title' => 'Ép cọc bê tông Thành Nam',
                'caption' => 'Hình ảnh dự án ép cọc bê tông của công ty.',
                'image_path' => 'images/Aspose.Words.4bc199bf-9f3d-489a-a241-0b9706d15e84.036.jpeg',
            ],
        ];

        foreach ($images as $index => $data) {
            ActivityImage::create([
                'title' => $data['title'],
                'caption' => $data['caption'],
                'image_path' => $data['image_path'],
                'sort_order' => $index + 1,
                'status' => 'published',
            ]);
        }
    }
}
